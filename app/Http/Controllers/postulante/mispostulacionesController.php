<?php

namespace App\Http\Controllers\postulante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postulante;
use App\Proceso;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class mispostulacionesController extends Controller
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
    public function index()
    {
        return view('postulante.mispostulaciones');
    }

    public function datatabla()
    {
        $ids_procesos = Postulante::join("procesos","procesos.id","=","postulantes.proceso_id")
                 ->where("postulantes.user_id",auth()->user()->id )->pluck('procesos.id');

        $query = Proceso::whereIn('id',$ids_procesos)->orderBy("id","desc")->get();
         if($query->count()<1)
            return $this->data_null;
    
        foreach ($query as $dato) {
            $convocatoria_all = '<b><i class="fa fa-address-book"></i></b> '.$dato->tipoproceso->nombre.'<br><b><i class="fa fa-briefcase"></i></b> '.$dato->nombre.'<br><b><i class="fa fa-home"></i> </b><small> '.$dato->oficina.'<small>';
            $inscripcion= date_format(date_create($dato->fecha_inscripcion_inicio),"d/m/Y").' <br> '. date_format(date_create($dato->fecha_inscripcion_fin),"d/m/Y H:m");
            //$bases = "<button type='button' class='btn btn-outline-warning btn-rounded btn-xs' title='Ver detalles' onclick='ver_detalles($dato->id)'><i class='fa fa-info'></i> </button> ";
            $bases = "";
            if($dato->archivo_bases != ""){ 
                $href="#";
                if($dato->archivo_bases_tipo =="local"){
                    $href=Storage::url($dato->archivo_bases);
                }
                else if($dato->archivo_bases_tipo =="web"){
                    $href=$dato->archivo_bases;
                }
                $bases.= "<a href='$href' target='_blank' class='btn btn-outline-info btn-rounded btn-xs'><i class='fa fa-file'></i> Bases</a>";
            }
            $comunicados = ""; 
            if($dato->comunicados->count() > 0 ){
                $texto = date_format(date_create($dato->ultimo_comunicado()->created_at),"d/m/Y"); 
                $comunicados = "<button class='btn btn-outline-danger waves-effect waves-light btn-xs' onclick='ver_comunicados($dato->id)'><span class='btn-label'><i class='ti-comment'></i></span> Comunicado <br> $texto </button>";
            }

            $evaluaciones="";//$dato->evaluaciones;
            $fecha_hoy1 = Carbon::now(); 
            if($dato->evaluacionprocesos->count() > 0 ){
                foreach($dato->evaluacionprocesos as $ev){
                    $fecha_inicio1 = Carbon::parse($ev->fecha_publicacion); 
                    if($fecha_hoy1 >= $fecha_inicio1) {
                        $evaluaciones .= '<a href="'.Storage::url($ev->archivo).'" target="_blank" class="btn btn-outline-info btn-block waves-effect waves-light btn-xs my-1"><span class"btn-label"><i class="fa fa-file"></i></span> '.$ev->nombre.'</a>';
                    }
                }
               
            } 
             
            $resultados="";
            $fecha_hoy = Carbon::now(); 
            $fecha_inicio = Carbon::parse($dato->fecha_resultados); 
            if($dato->archivo_resultado != '' && $fecha_hoy >= $fecha_inicio){
                if($dato->archivo_resultado_tipo=="web"){
                    $href = $dato->archivo_resultado;
                }
                else{
                    $href=Storage::url($dato->archivo_resultado);
                }
                $resultados .= '<a href="'.$href.'" target="_blank" class="btn btn-outline-info btn-block waves-effect waves-light btn-xs"><span class"btn-label"><i class="fa fa-file"></i></span> Resultado</a><br>';
            }  
            
            switch($dato->estado){
                case "1": $estado="Vigente (inscripción)"; break;
                case "2": $estado="En curso (evaluación)"; break;
                case "3": $estado="Concluido"; break;
                case "4": $estado="Cancelado"; break;
                default: $estado="Desconocido"; break;
            }

            $data['aaData'][] = [$dato->cod, $convocatoria_all, $dato->n_plazas,$inscripcion, $bases, $comunicados,$evaluaciones,$resultados,$estado];
        }
        return json_encode($data, true);        
    }
}
