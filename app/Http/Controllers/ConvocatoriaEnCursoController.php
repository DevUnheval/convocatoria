<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Proceso;
use App\TipoProceso;
use App\GradoFormacion;
use App\Comunicado;
use App\Postulante;

class ConvocatoriaEnCursoController extends Controller
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

    public function en_curso(){

        $datos = [
            'tipos_proc'=>TipoProceso::pluck('nombre','id'),
            'grado_formacion'=>GradoFormacion::pluck('nombre','id')
        ];
        return view("convocatorias.en_curso.index",compact('datos'));
    }

    
    public function encurso_data(){
        $query = Proceso::orderBy("id","desc")->get();
        if($query->count()<1)
        return $this->data_null;
        foreach ($query as $dato) {
        
            $config = ' <div class="btn-group">';
            $config.= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>';
            $config.= "     <div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                            <a class='dropdown-item' href='javascript:void(0)' onclick='ver_comunicados($dato->id)'><i class='ti-comment-alt'></i> Comunicar</a>
                            <a class='dropdown-item' href='javascript:void(0)' onclick='editar($dato->id)'><i class='ti-pencil-alt'></i> Editar</a>
                            </div>
                            </div>";
            
            $comunicados = ""; 
            if($dato->comunicados->count() > 0 ){
            $texto = date_format(date_create($dato->ultimo_comunicado()->created_at),"d/m/Y"); 
            $comunicados = "<button class='btn btn-outline-danger waves-effect waves-light btn-xs' onclick='ver_comunicados($dato->id)'><span class='btn-label'><i class='ti-comment'></i></span> Comunicado <br> $texto </button>";
            }                
            $convocatoria_all = '<b><i class="fa fa-address-book"></i></b> '.$dato->tipoproceso->nombre.'<br><b><i class="fa fa-briefcase"></i></b> '.$dato->nombre.'<br><b><i class="fa fa-home"></i> </b><small> '.$dato->oficina.'<small>';
            $evaluaciones=$dato->evaluaciones; 
            $resultado=$dato->resultado;                        
         
            if(auth()->check() && auth()->user()->hasRoles(['Administrador'])){
                $data['aaData'][] = [$config,$dato->cod,$convocatoria_all,$comunicados,$evaluaciones,$resultado];
            }
            else{
                $data['aaData'][] = [$dato->cod,$convocatoria_all,$comunicados,$evaluaciones,$resultado];    
            }

        }
        return json_encode($data, true);        
                
            
                
    }

   
    public function store(Request $r)
    {
        Proceso::create($r->all());
    }

  
    public function edit($id)
    {
        return Proceso::find($id);
    }

   
    public function update(Request $request, $id)
    {
        $query = Proceso::find($id);
        $query->nombre = $request->nombre;
        $query->descripcion = $request->descripcion;
        $query->save();
    }

   
    public function destroy($id)
    {
        //
    }
}
