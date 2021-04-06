<?php

namespace App\Http\Controllers\Auth;

use App\DatosUser;
use App\ExperienciaLabUser;
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

        $pesoMaxArchivo = \App\Ajuste::where('nombre','Peso archivo (B)')->first()->valor;
        $pesoMaxArchivo_c = number_format(($pesoMaxArchivo / 1048576), 1, '.', "");

        return view('auth.perfil',compact('datos_formacion','gradoformac','datos_usuario','datos_capacitacion','datos_experiencia','ubigeos','pesoMaxArchivo','pesoMaxArchivo_c'));  

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

    public function actualizarexperiencia(Request $data){
        
        $Exper = ExperienciaLabUser::find($data->id);
        
        if($data->file('archivo_experiencia')){
            $q= ExperienciaLabUser::find($data->id);
            Storage::delete($q->archivo); //eliminar archivo ya cargado
            $Exper->archivo = $data->file('archivo_experiencia')->store('public/procesos/users/'.auth()->user()->dni.'/arch_exper');
            $Exper->archivo_tipo = "local";
        }

        $Exper->es_exp_gen = $data->es_exp_gen;
        $Exper->es_exp_esp = $data->es_exp_esp;
        $Exper->centro_laboral = $data->centro_laboral;
        
        $Exper->tipo_institucion = $data->tipo_institucion;
        $Exper->tipo_experiencia = $data->tipo_experiencia;
        $Exper->cargo_funcion = $data->cargo_funcion;
        $Exper->desc_cargo_funcion = $data->desc_cargo_funcion;
        $Exper->fecha_inicio = $data->fecha_inicio;
        $Exper->fecha_fin = $data->fecha_fin;
        $Exper->num_pag = $data->num_pag;
        $Exper->dias_exp_gen =$data->dias_exp_gen;
        $Exper->dias_exp_esp = $data->dias_exp_esp;
        
        $Exper->save();
        
        $query = ExperienciaLabUser::where('id',$data->id)->get();
        /*$suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp'); */

        //____________________inicio interseccion fechas_______________

        //$proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       //____________________fin interseccion fechas_______________

        return compact('query','query_inter');
    }
  
    public function guardarexperiencia(Request $data){
      
        $el = new ExperienciaLabUser();
         
         $el->user_id = auth()->user()->id;
         $el->es_exp_gen = $data->es_exp_gen;
         $el->es_exp_esp = $data->es_exp_esp;
         $el->centro_laboral = $data->centro_laboral;
         
         $el->tipo_institucion = $data->tipo_institucion;
         $el->tipo_experiencia = $data->tipo_experiencia;
         $el->cargo_funcion = $data->cargo_funcion;
         $el->desc_cargo_funcion = $data->desc_cargo_funcion;
         $el->fecha_inicio = $data->fecha_inicio;
         $el->fecha_fin = $data->fecha_fin;
         $el->num_pag = $data->num_pag;
         $el->dias_exp_gen =$data->dias_exp_gen;
         $el->dias_exp_esp = $data->dias_exp_esp;
 
         $el->archivo = $data->file('archivo_experiencia')->store('public/procesos/users/'.auth()->user()->dni.'/arch_exper');
         $el->archivo_tipo = "local";
         
         $el->save();
     
         $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->get()->last();
        /* $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
         ->where('user_id',auth()->user()->id)
         ->sum('dias_exp_gen');
         $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
         ->where('user_id',auth()->user()->id)
         ->sum('dias_exp_esp');
        */

         //____________________inicio interseccion fechas_______________
 
         $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        //____________________fin interseccion fechas_______________
 
         return compact('query','query_inter');
 
     }
    
     public function eliminarexperiencia(Request $data){
        
        $q= ExperienciaLabUser::find($data->id);
        Storage::delete($q->archivo);   
        
        $Exper = ExperienciaLabUser::find($data->id);
        $Exper->delete();
        

        //____________________inicio interseccion fechas_______________

        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       //____________________fin interseccion fechas_______________

        return compact('query_inter');
      }
}
