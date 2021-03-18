<?php

namespace App\Http\Controllers\maestro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\TipoProceso;


class ProcesoController extends Controller
{
    public function __construct()
    {
        $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

    public function index(){
        return view("maestro.proceso.index");
    }

    
    public function data(){
        $query = TipoProceso::orderBy("id","desc")->get();
        if($query->count()<1)
        return $this->data_null;
        foreach ($query as $dato) {
        
            $config = ' <div class="btn-group">';
            $config.= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>';
            $config.= " <div class='dropdown-menu animated slideInUp' x-placement='ottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                <button class='dropdown-item' onclick='editar($dato->id)' ><i class='ti-pencil-alt'></i> Editar</button>
                            </div>
                            </div>";
                               
            $nombre=$dato->nombre;   
            $descripcion=$dato->descripcion;                          
            
            $data['aaData'][] = [$config,$dato->id,$nombre,$descripcion];
        }
        return json_encode($data, true);        
                
            
                
    }

   
    public function store(Request $request)
    {
        TipoProceso::create($request->all());
    //    request()->validate([
    //         'nombre'=>'required',
    //         'descripcion'=>'required',
    //     ],
    //    [
    //         'nombre.required'=>'el campo es obligatoriro',
    //        'descripcion.required'=> 'el campo es obligatorio',  
    //    ]);
    //    dd($request);
    }


        
    

  
    public function edit($id)
    {
        return TipoProceso::find($id);
    }

   
    public function update(Request $request, $id)
    {
        $query = TipoProceso::find($id);
        $query->nombre = $request->nombre;
        $query->descripcion = $request->descripcion;
        $query->save();
    }

   
    public function destroy($id)
    {
        //
    }
}
