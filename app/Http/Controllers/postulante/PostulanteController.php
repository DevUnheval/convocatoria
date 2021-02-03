<?php

namespace App\Http\Controllers\postulante;

use App\Http\Controllers\Controller;
use App\Proceso;
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
        
        //return dd($proceso);
        return view('postulante.postular',compact('proceso','proceso'));
       // return view('postulante.postular',compact('procesoseleccionado'));
    }

   
}
