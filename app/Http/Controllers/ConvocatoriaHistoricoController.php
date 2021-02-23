<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvocatoriaHistoricoController extends Controller
{
    public function index_concluidos(){

        return view("convocatorias.historico.concluidos.index");

    }

    public function index_cancelados(){
        return view("convocatorias.historico.cancelados.index");

    }

    public function data_concluidos(){

    }

    public function data_cancelados(){
        
    }
}
