<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proceso;
use App\TipoProceso;
use App\GradoFormacion;
use App\EvaluacionProceso;
use Illuminate\Support\Facades\Storage;

class ConvocatoriaHistoricoController extends Controller{

    public function __construct()
    {
        $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

    public function index_concluidos(){
        $datos = [
            'tipos_proc'=>TipoProceso::pluck('nombre','id'),
            'grado_formacion'=>GradoFormacion::pluck('nombre','id')
        ];
        return view("convocatorias.historico.concluidos.index",compact('datos'));
    }

    
 
    public function data_concluidos(){
        $query = Proceso::where("estado","3")->orderBy("id","desc")->get();
        if($query->count()<1)
        return $this->data_null;

       
        foreach ($query as $dato) {
        
            $postulantes = '<a class="btn btn-info waves-effect waves-light btn-xs" href="'.route("reporte.postulantes",[$dato->id]).'"><span class="btn-label"><i class=" fas fa-users"></i></span> Postulantes</a>';        
            $comunicados = ""; 
            if($dato->comunicados->count() > 0 ){
                $texto = date_format(date_create($dato->ultimo_comunicado()->created_at),"d/m/Y"); 
                $comunicados = "<button class='btn btn-outline-danger waves-effect waves-light btn-xs' onclick='ver_comunicados($dato->id)'><span class='btn-label'><i class='ti-comment'></i></span> Comunicado <br> $texto </button>";
            }                
            $convocatoria_all = '<b><i class="fa fa-address-book"></i></b> '.$dato->tipoproceso->nombre.'<br><b><i class="fa fa-briefcase"></i></b> '.$dato->nombre.'<br><b><i class="fa fa-home"></i> </b><small> '.$dato->oficina.'<small>';
            $evaluaciones="";//$dato->evaluaciones; 
            if($dato->evaluacionprocesos->count() > 0 ){
                foreach($dato->evaluacionprocesos as $ev){
                    $evaluaciones .= '<a href="'.Storage::url($ev->archivo).'" target="_blank" class="btn btn-outline-info btn-block waves-effect waves-light btn-xs my-1"><span class"btn-label"><i class="fa fa-file"></i></span> '.$ev->nombre.'</a>';
                }
               
            } 
            $resultados="";  
            if($dato->archivo_resultado != '' ){
                if($dato->archivo_resultado_tipo=="web"){
                    $href = $dato->archivo_resultado;
                }
                else{
                    $href=Storage::url($dato->archivo_resultado);
                }
                $resultados .= '<a href="'.$href.'" target="_blank" class="btn btn-outline-info btn-block waves-effect waves-light btn-xs"><span class"btn-label"><i class="fa fa-file"></i></span> Resultado</a>';
                
               
            }                      
         
            if(auth()->check() && auth()->user()->hasRoles(['Administrador'])){
                $data['aaData'][] = [$dato->cod,$convocatoria_all,$comunicados,$evaluaciones,$postulantes,$resultados];
            }
            else{
                $data['aaData'][] = [$dato->cod,$convocatoria_all,$comunicados,$evaluaciones,$postulantes,$resultados];    
            }

        }
        return json_encode($data, true);        
                
            
                
    }

    public function index_cancelados(){

        $datos = [
            'tipos_proc'=>TipoProceso::pluck('nombre','id'),
            'grado_formacion'=>GradoFormacion::pluck('nombre','id')
        ];
        return view("convocatorias.historico.cancelados.index",compact('datos'));
    }
        

       
    public function data_cancelados(){

        $query = Proceso::where("estado","4")->orderBy("id","desc")->get();
        if($query->count()<1)
        return $this->data_null;
        foreach ($query as $dato) {
            $comunicados = ""; 
            if($dato->comunicados->count() > 0 ){
                $texto = date_format(date_create($dato->ultimo_comunicado()->created_at),"d/m/Y"); 
                $comunicados = "<button class='btn btn-outline-danger waves-effect waves-light btn-xs' onclick='ver_comunicados($dato->id)'><span class='btn-label'><i class='ti-comment'></i></span> Comunicado <br> $texto </button>";
            }                
            $convocatoria_all = '<b><i class="fa fa-address-book"></i></b> '.$dato->tipoproceso->nombre.'<br><b><i class="fa fa-briefcase"></i></b> '.$dato->nombre.'<br><b><i class="fa fa-home"></i> </b><small> '.$dato->oficina.'<small>';
            $evaluaciones="";//$dato->evaluaciones; 
            if($dato->evaluacionprocesos->count() > 0 ){
                foreach($dato->evaluacionprocesos as $ev){
                    $evaluaciones .= '<a href="'.Storage::url($ev->archivo).'" target="_blank" class="btn btn-outline-info btn-block waves-effect waves-light btn-xs my-1"><span class"btn-label"><i class="fa fa-file"></i></span> '.$ev->nombre.'</a>';
                }
            } 
            $resultados="";  
            if($dato->archivo_resultado != '' ){
                if($dato->archivo_resultado_tipo=="web"){
                    $href = $dato->archivo_resultado;
                }
                else{
                    $href=Storage::url($dato->archivo_resultado);
                }
                $resultados .= '<a href="'.$href.'" target="_blank" class="btn btn-outline-info btn-block waves-effect waves-light btn-xs"><span class"btn-label"><i class="fa fa-file"></i></span> Resultado</a>';
                
               
            }                      
         
            if(auth()->check() && auth()->user()->hasRoles(['Administrador'])){
                $data['aaData'][] = [$dato->cod,$convocatoria_all,$comunicados,$evaluaciones,$resultados];
            }
            else{
                $data['aaData'][] = [$dato->cod,$convocatoria_all,$comunicados,$evaluaciones,$resultados];    
            }

        }
        return json_encode($data, true);              
    }
        
    
}
