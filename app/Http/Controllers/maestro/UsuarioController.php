<?php

namespace App\Http\Controllers\maestro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rol;
use App\User;
use App\DatosPostulante;
use App\LogCambioUsuario;
use ZipArchive;
use File;
use DB;

class UsuarioController extends Controller
{
    protected $data_null;

    public function __construct()
    {
        $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }
    public function index()
    {
        $roles= Rol::where('id','<>',1)->pluck('nombre','id');
        return view("maestro.usuarios.index",compact('roles'));
    }
    public function data(Request $r)
    {
        $tipo = $r->get('tipo', 'postulantes');
        $rolesOtros = ['Comisionado', 'Operador', 'Editor'];

        $draw = intval($r->get('draw', $r->get('sEcho', 1)));
        $start = intval($r->get('start', $r->get('iDisplayStart', 0)));
        $length = intval($r->get('length', $r->get('iDisplayLength', 15)));
        if ($length < 1 || $length > 100) {
            $length = 15;
        }

        $search = '';
        if (is_array($r->get('search'))) {
            $search = trim((string) ($r->input('search.value', '')));
        } else {
            $search = trim((string) $r->get('sSearch', ''));
        }

        $base = User::query()
            ->whereNotIn('users.id', [1, 2])
            ->whereHas('roles', function ($q) use ($tipo, $rolesOtros) {
                if ($tipo === 'otros') {
                    $q->whereIn('nombre', $rolesOtros);
                } else {
                    $q->where('nombre', 'Postulante');
                }
            });

        $recordsTotal = (clone $base)->count();

        if ($search !== '') {
            $like = '%'.$search.'%';
            $base->where(function ($q) use ($like) {
                $q->where('dni', 'like', $like)
                    ->orWhere('nombres', 'like', $like)
                    ->orWhere('apellido_paterno', 'like', $like)
                    ->orWhere('apellido_materno', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhereRaw("CONCAT(nombres,' ',apellido_paterno,' ',apellido_materno) LIKE ?", [$like]);
            });
        }

        $recordsFiltered = (clone $base)->count();

        $orderCol = intval($r->input('order.0.column', $r->get('iSortCol_0', 1)));
        $orderDir = strtolower((string) $r->input('order.0.dir', $r->get('sSortDir_0', 'asc'))) === 'asc' ? 'asc' : 'asc';
        $sortable = [
            1 => 'users.id',
            5 => 'users.dni',
            6 => 'users.nombres',
        ];
        if (isset($sortable[$orderCol])) {
            $base->orderBy($sortable[$orderCol], $orderDir);
        } else {
            $base->orderBy('users.id', 'asc');
        }

        $users = $base->with('roles')->skip($start)->take($length)->get();

        if ($users->isEmpty()) {
            return response()->json([
                'sEcho' => $draw,
                'iTotalRecords' => $recordsTotal,
                'iTotalDisplayRecords' => $recordsFiltered,
                'aaData' => [],
                'draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => [],
            ]);
        }

        $postulanteIds = DB::table('postulantes as p')
            ->join('datos_postulantes as dp', 'p.id', '=', 'dp.postulante_id')
            ->whereIn('p.user_id', $users->pluck('id'))
            ->groupBy('p.user_id')
            ->select('p.user_id', DB::raw('MAX(p.id) as id'))
            ->pluck('id', 'user_id');

        $aaData = [];
        $defaultFoto = asset('/imagenes/users/user.png');

        foreach ($users as $dato) {
            $id_postulante = $postulanteIds[$dato->id] ?? null;

            $config = ' <div class="btn-group">';
            $config .= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>';
            $config .= "<div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                <button class='dropdown-item' class='btn' onclick='editar($dato->id)'><i class='ti-pencil-alt'></i> Editar</button>
                            </div>
                        </div>"; 
            
            $usuarios_all = $dato->nombres.' '.$dato->apellido_paterno.' '.$dato->apellido_materno;
            $ruta_foto = $this->urlFotoUsuario($dato->img);
            $foto = "<img src='$ruta_foto' height='45px' onerror=\"this.onerror=null;this.src='$defaultFoto';\"/>";

            if ($id_postulante) {
                $cvvitae = "<a href='/reportes/cv/$id_postulante' target='_blank'><i class='fas fa-download' style='color:green'></i></a>";
                $cvdownload = "<a class='btn btn-round btnDescargar' href='/maestro/usuarios/zip/$dato->id' download><i class='fas fa-download' style='color:green'></i></a>";
            } else {
                $cvvitae = '-';
                $cvdownload = '-';
            }
            $cvuser = "<a class='btn btn-round btnDescargar' href='/maestro/usuarios/zipuser/$dato->id' download><i class='fas fa-download' style='color:green'></i></a>";
            $roles = $dato->roles->pluck('nombre');

            $aaData[] = [$config, $dato->id, $cvvitae, $cvdownload, $cvuser, $dato->dni, $usuarios_all, $foto, $roles];
        }

        return response()->json([
            'sEcho' => $draw,
            'iTotalRecords' => $recordsTotal,
            'iTotalDisplayRecords' => $recordsFiltered,
            'aaData' => $aaData,
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $aaData,
        ]);
    }

    

    /**
     * Devuelve la URL de la foto si el archivo existe; si no, la imagen por defecto.
     */
    private function urlFotoUsuario($img)
    {
        $default = '/imagenes/users/user.png';

        if (empty($img) || $img === $default) {
            return asset($default);
        }

        // Rutas tipo: public/procesos/foto_users/xxx.jpg
        if (strpos($img, 'public/') === 0) {
            $relStorage = substr($img, strlen('public/'));
            $existe = file_exists(storage_path('app/public/'.$relStorage))
                || file_exists(public_path('storage/'.$relStorage));

            return $existe ? asset('storage/'.$relStorage) : asset($default);
        }

        // Rutas tipo: /imagenes/users/user.png u otras en public/
        $relPublic = ltrim($img, '/');
        if (file_exists(public_path($relPublic))) {
            return asset($img);
        }

        return asset($default);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return 
            [
                "usuario"  =>  $user,
                "roles"    =>  $user->roles->pluck("id")
            ];
    }

    public function zipCreateAndDownload($id)
    {
        $datopostulante = DB::selectOne(
            'SELECT max(p.id) as id FROM postulantes p INNER JOIN datos_postulantes dp ON p.id = dp.postulante_id WHERE p.user_id = ?',
            [(int) $id]
        );

        if (! $datopostulante || (int) $datopostulante->id < 1) {
            abort(404);
        }

        return $this->downloadDirectoryZip(
            storage_path('app/public/procesos/postulantes/'.(int) $datopostulante->id),
            'cv_postulante.zip'
        );
    }

    public function zipCreateAndDownloadPostu($id)
    {
        $id = (int) $id;
        if ($id < 1) {
            abort(404);
        }

        return $this->downloadDirectoryZip(
            storage_path('app/public/procesos/postulantes/'.$id),
            'cv_postulante.zip'
        );
    }

    public function zipCreateAndDownloadUser($id)
    {
        $datouser = DB::selectOne('SELECT dni FROM users WHERE id = ?', [(int) $id]);
        $dni = (string) ($datouser->dni ?? '');

        if (! preg_match('/^\d{6,12}$/', $dni)) {
            abort(404);
        }

        return $this->downloadDirectoryZip(
            storage_path('app/public/procesos/users/'.$dni),
            'cv_user.zip'
        );
    }

    private function downloadDirectoryZip(string $directory, string $downloadName)
    {
        $absoluteDir = realpath($directory);
        $base = realpath(storage_path('app/public/procesos'));
        $basePrefix = $base ? rtrim($base, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR : null;

        if ($absoluteDir === false || $basePrefix === null || ! str_starts_with($absoluteDir.DIRECTORY_SEPARATOR, $basePrefix) || ! is_dir($absoluteDir)) {
            abort(404);
        }

        if (! class_exists(\ZipArchive::class)) {
            abort(500, 'La extensión ZIP de PHP no está habilitada.');
        }

        $tmp = storage_path('app/tmp');
        if (! is_dir($tmp)) {
            mkdir($tmp, 0750, true);
        }

        $zipPath = $tmp.DIRECTORY_SEPARATOR.uniqid('cv_', true).'.zip';
        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'No se pudo generar el archivo.');
        }

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($absoluteDir, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        $added = false;

        foreach ($files as $file) {
            if ($file->isDir()) {
                continue;
            }
            $filePath = $file->getRealPath();
            if ($filePath === false || ! str_starts_with($filePath, $absoluteDir)) {
                continue;
            }
            $zip->addFile($filePath, substr($filePath, strlen($absoluteDir) + 1));
            $added = true;
        }

        $zip->close();

        if (! $added) {
            @unlink($zipPath);
            abort(404);
        }

        return response()->download($zipPath, $downloadName)->deleteFileAfterSend(true);
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'dni' => 'required|unique:users,dni,'.$id,
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $q=User::find($id);
        $campos = [
            'dni' => $r->dni,
            'nombres' => $r->nombres,
            'apellido_paterno' => $r->apellido_paterno,
            'apellido_materno' => $r->apellido_materno,
            'email' => $r->email,
        ];

        $adminId = Auth::id();
        $ip = $r->ip();
        $fecha = now();

        foreach ($campos as $campo => $valorNuevo) {
            $valorAnterior = $q->$campo;
            if ((string) $valorAnterior !== (string) $valorNuevo) {
                LogCambioUsuario::create([
                    'admin_id' => $adminId,
                    'user_id' => $q->id,
                    'campo' => $campo,
                    'valor_anterior' => $valorAnterior,
                    'valor_nuevo' => $valorNuevo,
                    'ip' => $ip,
                    'fecha' => $fecha,
                ]);
                $q->$campo = $valorNuevo;
            }
        }

        if ($r->filled('password')) {
            $r->validate([
                'password' => ['string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d).+$/'],
            ], [
                'password.regex' => 'La contraseña debe tener al menos 8 caracteres, una letra y un número.',
            ]);
            LogCambioUsuario::create([
                'admin_id' => $adminId,
                'user_id' => $q->id,
                'campo' => 'password',
                'valor_anterior' => '[protegido]',
                'valor_nuevo' => '[actualizada]',
                'ip' => $ip,
                'fecha' => $fecha,
            ]);
            $q->password = bcrypt($r->password);
        }

        $q->save();
        $r->validate(['rol' => 'required|exists:rols,id']);
        $q->roles()->sync([$r->rol]);
        return $q->roles;
       
    }
}
