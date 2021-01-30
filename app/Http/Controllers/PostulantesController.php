<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostulantesController extends Controller
{
    public function index($cas=null, $etapa=null){
        return view('postulantes.index');
    }
}
