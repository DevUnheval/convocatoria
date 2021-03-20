<?php

namespace App\Http\Controllers\Auth;

use App\DatosUser;
use App\GradoFormacion;
use App\Http\Controllers\Controller;
use App\Proceso;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    use RegistersUsers; 
    public function index(){
        //$proceso = Proceso::where('id',$idproceso)->first();
       // $proceso_formacion = Proceso::join("grado_formacions", "grado_formacions.id", "=", "procesos.nivel_acad_convocar")
        //->select("grado_formacions.nombre","procesos.especialidad")
        //->where("procesos.id",$idproceso)
        //->get();
        
        if (session()->has('ruta_temporal')) {
                $ruta = session('ruta_temporal');
                session()->forget('ruta_temporal');
                return redirect($ruta);
        }

        $gradoformac = GradoFormacion::get();
        
        $datos_usuario = DatosUser::where('user_id',auth()->user()->id)->get();
        $datos_formacion = User::join("formacion_users", "formacion_users.user_id", "=", "users.id")
        ->select("*")
        ->where("formacion_users.user_id", "=", auth()->user()->id)
        ->get();
        $datos_capacitacion = User::join("capacitacion_users", "capacitacion_users.user_id", "=", "users.id")
        ->select("*")
        ->where("capacitacion_users.user_id", "=", auth()->user()->id)
        ->get();
        $datos_experiencia = User::join("experiencia_lab_users", "experiencia_lab_users.user_id", "=", "users.id")
        ->select("*")
        ->where("experiencia_lab_users.user_id", "=", auth()->user()->id)
        ->get();

        $ubigeos = \App\Ubigeo::select(DB::raw("CONCAT(desc_ubigeo_reniec,' - ', desc_prov_reniec,' - ', desc_dep_reniec) AS descripcion"), 'cod_ubigeo_reniec as ubigeo')
        ->where("cod_ubigeo_reniec","<>","NA") 
        ->pluck('descripcion','ubigeo');

        return view('auth.perfil',compact('datos_formacion','gradoformac','datos_usuario','datos_capacitacion','datos_experiencia','ubigeos'));  

    }

    public function update_password(Request $request){

        
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User;
                $user->where('id', '=', Auth::user()->id)
                     ->update(['password' => Hash::make($request->password)]);
                //return redirect('user')->with('status', 'Password cambiado con éxito');
                return true;
            }
            else
            {
                //return redirect('user/password')->with('message', 'Credenciales incorrectas');
                return false;
            }
       
    }

    public function update_fotografia(Request $data){
        $user = User::find(auth()->user()->id);
               
       //archivo DNI
       if($user->img == '/imagenes/users/user.png'){
        $user->img = $data->file('foto')->store('public/procesos/foto_users');
        $user->save();
        
       }else{
        Storage::delete($user->img); //eliminar archivo ya cargado
        $user->img = $data->file('foto')->store('public/procesos/foto_users');
        $user->save();
        
       }
        
       return $user->img;
    }

    public function cambiocorreo(Request $data){
        
        if(User::where('email',$data->correonuevo)->exists()){
            return true;
        }else{

        $var = User::find(auth()->user()->id);
        $var->email = $data->correonuevo;
        $var->email_verified_at = NULL;
        $var->save();
           
       $data->user()->sendEmailVerificationNotification(); //envio de correo de confirmación
       
        return false;
        }
    }
  
    
}
