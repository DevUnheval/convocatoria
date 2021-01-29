<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConvocatoriaController extends Controller
{
    //vistas
    public function vigentes()
    {
        return view('convocatorias.vigentes');
    }

    public function en_curso()
    {
        return view('convocatorias.en_curso');
    }
    public function historico()
    {
        return view('convocatorias.historico');
    }

    //CRUD
    
    public function store(Request $request)
    {
        return $request->all();
    }

    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
