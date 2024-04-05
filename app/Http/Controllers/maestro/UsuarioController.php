<?php

namespace App\Http\Controllers\maestro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rol;
use App\User;
use App\DatosPostulante;
use ZipArchive;
use File;
use DB;

class UsuarioController extends Controller
{
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
    public function data(){
        $query = User::whereNotIn("id",[1,2])->get();
        if($query->count()<1)
        return $this->data_null;

        // return $query;
        foreach ($query as $dato) {
            //return $dato->tipoproceso;
                $datopostulante = DB::select("SELECT max(p.id) as id FROM postulantes p 
                    inner join datos_postulantes dp
                    on p.id = dp.postulante_id
                    where p.user_id = '$dato->id'");

                $id_postulante=$datopostulante[0]->id;


                $config = ' <div class="btn-group">';
                $config.= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>';
                $config.= "<div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                    <button class='dropdown-item'  class='btn' onclick='editar($dato->id)'><i class='ti-pencil-alt'></i> Editar</a>
                                </div>
                            </div>";
                
                            $usuarios_all = $dato->nombres.' '.$dato->apellido_paterno.' '.$dato-> apellido_materno;
                            $dni=$dato->dni;
                            $ruta_foto=asset(str_replace('public/','storage/',$dato->img));
                            $foto="<img src='$ruta_foto' height='45px'/>";
                            $cvvitae="<td align='center'><a href='/reportes/cv/$id_postulante' target='_blank'><i class='fas fa-download' style='color:green'></i></button>";
                            $cvdownload="<td align='center'><a class='btn btn-round btnDescargar' href='/maestro/usuarios/zip/$dato->id' download><i class='fas fa-download' style='color:green'></i></button>";
                            $cvuser="<td align='center'><a class='btn btn-round btnDescargar' href='/maestro/usuarios/zipuser/$dato->id' download><i class='fas fa-download' style='color:green'></i></button>";
                            $roles=$dato->roles->pluck('nombre');
        


                            $data['aaData'][] = [$config,$dato->id,$cvvitae,$cvdownload,$cvuser,$dni,$usuarios_all,$foto, $roles];

        }
        return json_encode($data, true);      
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
        
        //$datopostulante = Postulante::where('user_id','=',$id)->first();
        $datopostulante = DB::select("SELECT max(p.id) as id FROM postulantes p 
        inner join datos_postulantes dp
        on p.id = dp.postulante_id
        where p.user_id = '$id'");
        //dd($datopostulante);    
        //$name_archivo = $request->nombre_carpeta;
        $zip_file = 'cv_postulante.zip'; 
        //$zip_file = $id.'.zip';   
        $zip = new ZipArchive;
        if($datopostulante[0]->id >= 1)
        {

            if($zip->open(public_path($zip_file),ZipArchive::CREATE | ZipArchive::OVERWRITE)==TRUE)
            {
                
                //$files = File::files(storage_path('app\public\procesos\postulantes'));
                //$origen = storage_path('app/public/procesos/postulantes/10');
                $origen = storage_path('app/public/procesos/postulantes/'.$datopostulante[0]->id);
            
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($origen),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );
            
                //$rutafinal = str_replace("public","storage",$files);
            

                /*foreach($files as $key => $value){
                    $relativeName = basename($value);
                    $zip->addFile($value,$relativeName);
                }*/
                foreach ($files as $name => $file)
                {
                    if (!$file->isDir())
                    {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($origen) + 1);

                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                //dd($files);
                
            }
        }else{

        }

        if($files==TRUE){
            return response()->download(public_path($zip_file));
        }
       
    }

    public function zipCreateAndDownloadUser($id)
    {
        
        /*$datouser = DB::select("SELECT max(p.id) as id FROM postulantes p 
        inner join datos_postulantes dp
        on p.id = dp.postulante_id
        where p.user_id = '$id'");*/

        $datouser = DB::select("SELECT dni FROM users where id = '$id' ");

        //dd($datopostulante);    
        //$name_archivo = $request->nombre_carpeta;
        $zip_file = 'cv_user.zip'; 
        //$zip_file = $id.'.zip';   
        $zip = new ZipArchive;
        if($datouser[0]->dni >= 1)
        {

            if($zip->open(public_path($zip_file),ZipArchive::CREATE | ZipArchive::OVERWRITE)==TRUE)
            {
                
                //$files = File::files(storage_path('app\public\procesos\postulantes'));
                //$origen = storage_path('app/public/procesos/postulantes/10');
                $origen = storage_path('app/public/procesos/users/'.$datouser[0]->dni);
            
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($origen),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );
            
                //$rutafinal = str_replace("public","storage",$files);
            

                /*foreach($files as $key => $value){
                    $relativeName = basename($value);
                    $zip->addFile($value,$relativeName);
                }*/
                foreach ($files as $name => $file)
                {
                    if (!$file->isDir())
                    {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($origen) + 1);

                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                //dd($files);
                
            }
        }else{

        }

        if($files==TRUE){
            return response()->download(public_path($zip_file));
        }
       
    }
    
    public function update(Request $r, $id)
    {
        $q=User::find($id);
        $q->nombres=$r->nombres;
        $q->apellido_paterno=$r->apellido_paterno;
        $q->apellido_materno=$r->apellido_materno;
        $q->email=$r->email;
        if($q->password!=""){
            $q->password=bcrypt($r->password);
        }
        $q->save();
        $q->roles()->sync($r->roles);
        return $q->roles;
       
    }
}
