<?php

namespace App\Http\Controllers\postulante;

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
        
        $datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        ->select("*")
        ->get();
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

    public function store(Request $data){

        return dd($data);

    }
   
}
