<?php

namespace App\Http\Controllers\Auth;

use App\DatosUser;
use App\GradoFormacion;
use App\Http\Controllers\Controller;
use App\Proceso;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
       
    public function index(){
        //$proceso = Proceso::where('id',$idproceso)->first();
       // $proceso_formacion = Proceso::join("grado_formacions", "grado_formacions.id", "=", "procesos.nivel_acad_convocar")
        //->select("grado_formacions.nombre","procesos.especialidad")
        //->where("procesos.id",$idproceso)
        //->get();
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
  
    
}
