<?php

namespace App\Http\Controllers\postulante;

use App\DatosUser;
use App\Http\Controllers\Controller;
use App\Proceso;
use App\User;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
    public function index()
    {
        
    }

    public function postular()
    {
        $idproceso =$_GET["idproceso"];
        $proceso = Proceso::where('id',$idproceso)->get();
        
       // $datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        //->select("*")
        //->get();
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

        return view('postulante.postular',compact('proceso','datos_usuario','datos_formacion','datos_capacitacion','datos_experiencia'));
        //return dd(compact('datos_usuario','datos_formacion','datos_capacitacion','datos_experiencia'));
       // return view('postulante.postular',compact('proceso','proceso'));
       // return view('postulante.postular',compact('procesoseleccionado'));
    }

    public function actualizar(Request $data){
        
        //$datap =$data->nacionalidad;
        //return response()->json(['dataaa'=>$data->ruc]);
        $datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        ->select("*")
        ->get();
        $datosuser = DatosUser::find($data->id);
        $datosuser->telefono_celular = $data->celular;
        $datosuser->telefono_fijo = $data->telfijo;
        $datosuser->ruc = $data->ruc;
        $datosuser->domicilio = $data->domicilio;
        $datosuser->ubigeo = $data->ubigeodni;
        $datosuser->es_pers_disc = $data->dicapacidad;
        $datosuser->es_lic_ffaa = $data->ffaa;
        $datosuser->es_deportista = $data->deportista;
        $datosuser->save();

        $datosuser2 = User::find(auth()->user()->id);
        $datosuser2->nacionalidad = $data->nacionalidad;
        $datosuser2->fecha_nacimiento = $data->fechanac;
        $datosuser2->save();
        
        return response()->json(['mensaje'=>"correcto"]);

    }
   
}
