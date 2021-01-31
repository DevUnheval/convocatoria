<?php

namespace App\Http\Controllers\postulante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BuscarEstudianteController extends Controller
{
    
    public function index()
    {
        //
    }

    public function buscardni($dni)
    {
        $respuesta = Http::get('https://api.reniec.cloud/dni/71539325');
        $resultadodni = $respuesta->json();

        return dd($respuesta);
        
    }
}
