<?php

namespace App\Http\Controllers\postulante;

use App\Http\Controllers\Controller;
use App\Postulante;
use Illuminate\Http\Request;

class mispostulacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('postulante.mispostulaciones');
    }

    public function datatabla()
    {/*$datos_formacion = User::join("formacion_users", "formacion_users.user_id", "=", "users.id")
        ->select("*")
        ->where("formacion_users.user_id", "=", auth()->user()->id)
        ->get();*/
         $data = Postulante::join("procesos","procesos.id","=","postulantes.proceso_id")
         ->select("procesos.cod","procesos.nombre","procesos.oficina","procesos.estado")
         ->where("postulantes.user_id",auth()->user()->id)->get();
        return $data;
    }
}
