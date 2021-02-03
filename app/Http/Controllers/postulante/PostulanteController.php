<?php

namespace App\Http\Controllers\postulante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostulanteController extends Controller
{
    public function index()
    {
        return view('postulante.postular');
    }

    public function postular(Request $request)
    {
        
    }

   
}
