<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postulante;
use App\Proceso;

class PostulantesController extends Controller
{
    public function index($proceso_id=null, $etapa=null){

        if($proceso_id<1){
            return back();
        }
        $etapa = (int) $etapa;
        $proceso =  Proceso::find($proceso_id);      
        //enlistamos las etapas, 1: curricular, 2: entrevista, a menos que se habilite 'conocimentos' y entrevista corre a 3
        $etapas = $this->etapas_evaluacion($proceso);
        //si manda una etapa no válida (mayor que el número de etapas disponibles) retorna a la ruta anterior
        if( $etapa > count($etapas) ){
            return back();
        }
        //Si no manda una etapa o la etapa es ==0, entonces hereda la "etapa actual" del proceso
        if($etapa<1 || $etapa == null){
            $etapa = (int) $proceso->etapa_evaluacion;
        }
        //le restamos 1 a la etapa, cómo te explico... 
        //cuando estemos evaluando la etapa 3, nos mostrará todos los que aprobaron en la etapa 2 
        //cuando evaluemos la etapa  2, nos deve mostrar los que aprobaron en la etapa 1
        //y cuando mostremos la etapa 1, nos debe mostrar todos los postulantes inscritos, es decir, 0 en el WHEN
        $etapa_a_buscar = $etapa-1; //-1 porque los índices o pociones empiezan en 0, y obtendremos los datos desde un array
        $calificacion_etapa_actual = $etapas[$etapa_a_buscar]['desc_bd'];//TEXTO/NOMBRE de la CALIFICACION ACTUAL; p.e cal_curricular, cal_entrevista 
        $calificacion_etapa_anterior = $etapas[$etapa_a_buscar]['desc_bd']; // por defecto la etapa anterior será la misma que la actual, xq no existe array de indice/posición <0 (...==>)
        $query = Postulante::where('proceso_id',$proceso_id); //hasta aquí estamos de acuerdo, que muestre el proceso seleccionado 
        if($etapa_a_buscar>0){ //si es cero, mostrará a todos, caso contrario filtrará por etapas
            $calificacion_etapa_anterior = $etapas[$etapa_a_buscar-1]['desc_bd'];// (...=>) Pero en caso estemos en la etapa 2,3,..n; la etapa anterior será actual -1
            $query = $query->where($calificacion_etapa_anterior,1); //los que aprobaron en la etapa anterior se mostrará en esta vista        
        }
        $postulantes = $query->orderby('id','desc')->get();
        
        //$pendientes =  $query->whereNull($calificacion_etapa_actual)->count(); NO se puede reutilizar el $query-> xq se acumula los where, hace un filtro del filtro anterior
        $pendientes = $query->whereNull($calificacion_etapa_actual)->count();
        $aptos =  Postulante::where('proceso_id',$proceso_id)->where($calificacion_etapa_anterior,1)->where($calificacion_etapa_actual,1)->count();
        $noAptos =  Postulante::where('proceso_id',$proceso_id)->where($calificacion_etapa_anterior,1)->where($calificacion_etapa_actual,0)->count();
        $estado = $this->estado();
        return $grupos = [
            'total' => count($postulantes),
            'pendientes' => $pendientes,
            'aptos' => $aptos,
            'noAptos' => $noAptos
        ];
        return view('postulantes.index',compact('postulantes','calificacion_etapa_actual','estado'));
    }

    private function etapas_evaluacion($proceso){
        $etapa = 1;
        $etapas[] = ['etapa'=>$etapa,'desc_bd'=>'cal_curricular', 'descripcion'=>'Curricular']; $etapa++;
        if((boolean) $proceso->evaluar_conocimientos){
            $etapas[] = ['etapa'=>$etapa,'desc_bd'=>'cal_conocimientos','descripcion'=>'Conocimientos']; $etapa++;
        }
        $etapas[] = ['etapa'=>$etapa,'desc_bd'=>'cal_entrevista','descripcion'=>'Entrevista'];
        return $etapas;
    }

    private function estado(){
        return [
            ['nombre'=>'No califica','clase'=>'note-no-califica'],
            ['nombre'=>'Califica','clase'=>'note-califica']
        ];
    }

}
