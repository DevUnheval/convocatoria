<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ProcesosExport;
use App\Proceso;

use PDF; 
use App\Postulante;
use DB;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->api= app(\App\Http\Controllers\PostulantesController::class);
    }
    public function pdf ($id,$etapa){
        if($etapa=="0"){
            $data = $this->data_resultado($id,$etapa);
            $pdf = PDF::loadView('reportes.pdf.resultado',compact('data'))->setPaper('a4', 'landscape');
            return $pdf->stream($data['proceso']->cod.'.pdf'); //download
        }
        $data = $this->data_etapa($id,$etapa);
        $pdf = PDF::loadView('reportes.pdf.procesos',compact('data'));
        return $pdf->stream($data['proceso']->cod.'.pdf'); //download
    }

    public function excel($id,$etapa){
        if($etapa=="0"){
            $data = $this->data_resultado($id,$etapa);
            $data["ruta"] = "reportes.excel.resultado";
            return (new ProcesosExport($data))->download($data['proceso']->cod.'.xlsx');
        }
            $data = $this->data_etapa($id,$etapa);
            $data["ruta"] = "reportes.excel.etapa";
            return (new ProcesosExport($data))->download($data['proceso']->cod.'.xlsx');
            //return (new ProcesosExport)->view();
        
    }

    private function data_etapa($proceso_id, $etapa){
        $etapa_id = (int) $etapa;
        $proceso =  Proceso::find($proceso_id);      
        
        $etapas = $this->api->etapas_evaluacion($proceso->evaluar_conocimientos);
       
        if( $etapa_id > count($etapas) ){
            return back();
        }
        if($etapa_id<1 || $etapa == null){
            $etapa_id = (int) $proceso->etapa_evaluacion;
        }
        $etapa_a_buscar = $etapa_id-1; //-1 porque los índices o posiciones empiezan en 0, y obtendremos los datos desde un array
        $calificacion_etapa_actual = $etapas[$etapa_a_buscar]['desc_bd'];//TEXTO/NOMBRE de la CALIFICACION ACTUAL; p.e cal_curricular, cal_entrevista 
        $calificacion_etapa_anterior = $etapas[$etapa_a_buscar]['desc_bd']; // por defecto la etapa anterior será la misma que la actual, xq no existe array de indice/posición <0 (...==>)
        $evaluacion_etapa_actual = $etapas[$etapa_a_buscar]['desc2_bd'];
        $query = Postulante::select( "proceso_id", "dni",
                                     DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"),
                                     "user_id",
                                     $calificacion_etapa_actual." as calificacion",
                                     $evaluacion_etapa_actual." as evaluacion"
                                    )
                            ->join("users","users.id","=","postulantes.user_id")
                            ->where('proceso_id',$proceso_id); //hasta aquí estamos de acuerdo, que muestre el proceso seleccionado 
        if($etapa_a_buscar>0){ //si es cero, mostrará a todos, caso contrario filtrará por etapas
            $calificacion_etapa_anterior = $etapas[$etapa_a_buscar-1]['desc_bd'];// (...=>) Pero en caso estemos en la etapa 2,3,..n; la etapa anterior será actual -1
            $query = $query->where($calificacion_etapa_anterior,1); //los que aprobaron en la etapa anterior se mostrará en esta vista        
        }
        $postulantes = $query->orderBy($evaluacion_etapa_actual,"desc")->get();
        $etapa_actual = $etapas[$etapa_a_buscar];
        return [
                    'proceso'       => $proceso,
                    'postulantes'   => $postulantes,
                    'etapa_actual'  => $etapa_actual,
                    'etapas'        => $etapas,
                ];
    }
    private function data_resultado($proceso_id){
        $proceso =  Proceso::find($proceso_id);      
        $etapas = $this->api->etapas_evaluacion($proceso->evaluar_conocimientos);
        $etapa_id = count($etapas);
        $etapa_a_buscar = $etapa_id-1; //-1 porque los índices o posiciones empiezan en 0, y obtendremos los datos desde un array
        $calificacion_etapa_actual = $etapas[$etapa_a_buscar]['desc_bd'];//TEXTO/NOMBRE de la CALIFICACION ACTUAL; p.e cal_curricular, cal_entrevista 
        $calificacion_etapa_anterior = $etapas[$etapa_a_buscar]['desc_bd']; // por defecto la etapa anterior será la misma que la actual, xq no existe array de indice/posición <0 (...==>)
        $evaluacion_etapa_actual = $etapas[$etapa_a_buscar]['desc2_bd'];
        $query = Postulante::select("dni", DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"),
                                     "postulantes.*"
                                    )
                            ->join("users","users.id","=","postulantes.user_id")
                            ->where('proceso_id',$proceso_id); //hasta aquí estamos de acuerdo, que muestre el proceso seleccionado 
        if($etapa_a_buscar>0){ //si es cero, mostrará a todos, caso contrario filtrará por etapas
            $calificacion_etapa_anterior = $etapas[$etapa_a_buscar-1]['desc_bd'];// (...=>) Pero en caso estemos en la etapa 2,3,..n; la etapa anterior será actual -1
            $query = $query->where($calificacion_etapa_anterior,1); //los que aprobaron en la etapa anterior se mostrará en esta vista        
        }
        $postulantes = $query->orderBy($evaluacion_etapa_actual,"desc")->get();
        $etapa_actual = $etapas[$etapa_a_buscar];
        return [
                    'proceso'       => $proceso,
                    'postulantes'   => $postulantes,
                    'etapa_actual'  => $etapa_actual,
                    'etapas'        => $etapas,
                ];
    }
    public function preliminar($id,$tipo){
        $data = Postulante::select( "dni",DB::raw("concat(apellido_paterno,' ',apellido_materno,' ',nombres) as nombres"))
            ->join("users","users.id","=","postulantes.user_id")->where('proceso_id',$id)
            ->orderBy("apellido_paterno")->get();
            $proceso = Proceso::find($id);

        if($tipo=="pdf"){
            $pdf = PDF::loadView('reportes.pdf.preliminar',compact('data','proceso'));
            return $pdf->stream("PRELIMINAR".'.pdf'); //download

        }
        if($tipo=="excel"){
            $data["ruta"] = "reportes.excel.preliminar";
            return (new ProcesosExport($data))->download($data['proceso']->cod.'.xlsx');

        }

    }
}
