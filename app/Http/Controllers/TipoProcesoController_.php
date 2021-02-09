<?php

namespace App\Http\Controllers;

use App\Proceso;
use App\Rol;
use App\TipoProceso;
use App\User;
use App\UserRol;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class TipoProcesoController extends Controller
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
        return view('auth.register');
    }
 
    public function registrar(Request $request)
    {
       // return "asdsd";
        $v = \Validator::make($request->all(), [
            'dni' =>'required|unique:users',
            'email' =>'required|unique:users',
            'password' =>'required|confirmed|min:8',
        ]);


        if ($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }        
        $Usuario = new User();
        $Usuario->dni = $request->dni;
        $Usuario->nombres = $request->nombres;
        $Usuario->apellido_paterno = $request->apellido_paterno;
        $Usuario->apellido_materno = $request->apellido_materno;
        $Usuario->email = $request->email;
        $Usuario->password = Hash::make($request->password);
        $Usuario->save();
        
        $rol = new UserRol();
        $rol->user_id =$Usuario->id;
        $rol->rol_id = 3;
        $rol->save();

        $this->guard()->login($Usuario); //autologin despues de guardar el registro

        //Mail::to($request->user())->send();
        $correo=$request->email; 
        $request->user()->sendEmailVerificationNotification(); //envio de correo de confirmación
        //return redirect('/email/verify')->with('correo',$correo);
        //return redirect()->route('postulante_inicio', array('dni' => $request->dni, 'password' => $request->password));
        

        return redirect()->route('postulante_inicio');

        
    }
    public function api_reniec($dni)
    {
        //var_dump (openssl_get_cert_locations ());
         $respuesta = Http::get('https://api.reniec.cloud/dni/'.$dni);
         //$respuesta->throw();
         if (array_key_exists('dni',  $respuesta->json() )) {
            return [
                'nombres'           => html_entity_decode($respuesta->json()['nombres']),
                'apellido_paterno'  => html_entity_decode($respuesta->json()['apellido_paterno']),
                'apellido_materno'  => html_entity_decode($respuesta->json()['apellido_materno']),
            ];
         }
         return "error";
        
    }
    public function vista_tipoprocesos(){
        
        return view("maestro.tipoprocesos");
    }
    public function data_tipoprocesos(){
        $query = TipoProceso::all();
        // $dato=$query[0];
        // $dato->tipoproceso->nombre;
        if($query->count()<1)
        return $this->data_null;

        // return $query;
        foreach ($query as $dato) {
            //return $dato->tipoproceso;
           
            
                $config = ' <div class="btn-group">';
                $config.= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>';
                $config.= " <div class='dropdown-menu animated slideInUp' x-placement='ottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                    <a class='dropdown-item' href='javascript:void(0)'><i class='ti-eye'></i> Abrir </a>
                                    <button class='dropdown-item btn opcion-editar' data-id='$dato->id' data-nombre='$dato->nombre' data-descripcion='$dato->descripcion'><i class='ti-pencil-alt'></i> Editar</button>
                                    <a class='dropdown-item' href='javascript:void(0)'><i class='ti-comment-alt'></i> Comunicar</a>
                                </div>
                             </div>";
                               
                            $nombre=$dato->nombre;   
                            $descripcion=$dato->descripcion;                          
                           
                            $data['aaData'][] = [$config,$dato->id,$nombre,$descripcion];
        }
                        return json_encode($data, true);        
                
                    }
                
    }
