<?php

namespace App\Http\Controllers;


use App\User;
use App\UserRol;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    use RegistersUsers; //usando esto podre autologuearme y enviar el correo de confirmación
    
    public function __construct()
    {
      
    }

    public function index()
    {
        return view('auth.register');
    }
 
    public function registrar(Request $request)
    {
          $v = Validator::make($request->all(), [
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
        
        //_________________________________________________
        if(\App\Ajuste::find(13)=='1'){
            $Usuario->email_verified_at = date('Y-m-d');
        }
        //______________________________________________
        $Usuario->password = Hash::make($request->password);
        $Usuario->save();
        
        $rol = new UserRol();
        $rol->user_id =$Usuario->id;
        $rol->rol_id = 4;
        $rol->save();

        $this->guard()->login($Usuario); //autologin despues de guardar el registro
 
        $request->user()->sendEmailVerificationNotification(); //envio de correo de confirmación
        return redirect('/email/verify')->with('correo',$Usuario->email);
        //return redirect()->route('postulante_inicio');
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
                
}

