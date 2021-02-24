<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postulante;
use App\Proceso;
use Carbon\Carbon;

class PostulantesController extends Controller
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

    public function index($proceso_id=null, $etapa=null, $vista=1){

        if($proceso_id<1){
            return back();
        }
        if( (int)$vista<1) $vista =1;
        $etapa = (int) $etapa;
        $proceso =  Proceso::find($proceso_id);      
        //enlistamos las etapas, 1: curricular, 2: entrevista, a menos que se habilite 'conocimentos' y entrevista corre a 3
        $etapas = $this->etapas_evaluacion($proceso->evaluar_conocimientos);
        //si manda una etapa no válida (mayor que el número de etapas disponibles) retorna a la ruta anterior
        if( $etapa > count($etapas) ){
            return back();
        }
        //Si no manda una etapa o la etapa es ==0, entonces hereda la "etapa actual" del proceso
        if($etapa<1 || $etapa == null){
            $etapa = (int) $proceso->etapa_evaluacion;
        }
        $etapa_a_buscar = $etapa-1; //-1 porque los índices o pociones empiezan en 0, y obtendremos los datos desde un array
        $calificacion_etapa_actual = $etapas[$etapa_a_buscar]['desc_bd'];//TEXTO/NOMBRE de la CALIFICACION ACTUAL; p.e cal_curricular, cal_entrevista 
        $etapa_actual = $etapas[$etapa_a_buscar];
        return view('postulantes.index',compact('proceso','vista','calificacion_etapa_actual','etapa','etapas','etapa_actual'));
    }

    private function etapas_evaluacion($evaluar_conocimientos){
        $etapa = 1;
        $etapas[] = ['etapa'=>$etapa,'desc_bd'=>'cal_curricular','desc2_bd'=>'ev_curricular', 'desc3_bd'=>'pje_min_cv','descripcion'=>'Curricular']; $etapa++;
        if((boolean) $evaluar_conocimientos){
            $etapas[] = ['etapa'=>$etapa,'desc_bd'=>'cal_conocimientos','desc2_bd'=>'ev_conocimiento','desc3_bd'=>'pje_min_conoc','descripcion'=>'Conocimientos']; $etapa++;
        }
        $etapas[] = ['etapa'=>$etapa,'desc_bd'=>'cal_entrevista','desc2_bd'=>'ev_entrevista','desc3_bd'=>'pje_min_entrev','descripcion'=>'Entrevista'];
        return $etapas;
    }

    private function estado(){
        return [
            ['nombre'=>'No califica','clase'=>'note-no-califica','array'=>'noCalifica'],
            ['nombre'=>'Califica','clase'=>'note-califica','array'=>'califica']
        ];
    }

    public function data($proceso_id=null, $etapa=null, $vista){
        if($vista==1){
            return $this->get_data_table($proceso_id, $etapa, $vista);
        }else if($vista==2){
            return $this->get_data_tarjeta($proceso_id, $etapa);
        }else{
            return back();
        }
    }
    private function get_data_table($proceso_id, $etapa,$vista){
        $api = $this->get_data($proceso_id, $etapa);
        if($etapa < 1) $etapa=$api["etapa_actual"]["etapa"];
        
        //return "data";
        if(count($api["postulantes"])<1)
           return $this->data_null;
        $bd_califica = $api["etapa_actual"]["desc_bd"];
        foreach ( $api["postulantes"] as $p) {
           $nombres=$p->user->apellido_paterno." ".$p->user->apellido_materno." ".$p->user->nombres;
           $cv = "<button class='btn btn-info btn-circle'><span> <i class='fas fa-id-card'></i></span></button>";
           $ev_entrevista = (int) $p->ev_entrevista;
           $ev_curricular = (int) $p->ev_curricular;
           
           $total = $p->ev_entrevista + $p->ev_curricular + $p->ev_conocimiento;
           $ev_conocimiento = $p->ev_conocimiento;
           $bonificacion = $total*10/100;
           switch($p->$bd_califica){
               case "0"   : $estado = "No califica"; break;
               case "1"   : $estado = "Califica"; break;
               default  : $estado = "Pendiente"; break;
           }
           //pintar la columna
           
           if($api["proceso"]->evaluar_conocimientos){
            return $etapa;
                $total = $p->ev_entrevista + $p->ev_curricular + $p->ev_conocimiento;
                $ev_conocimiento = (int) $p->ev_conocimiento;
                $bonificacion = $total*10/100;
                switch($etapa){
                    case "1": $ev_curricular = "<label class='btn btn-outline-danger btn-block' onclick='modal_evaluar_todos($etapa,$proceso_id,1,$vista)' title='clic para editar'>$ev_curricular<label>"; break;
                    case "2": $ev_conocimiento = "<label class='btn btn-outline-danger btn-block' onclick='modal_evaluar_todos($etapa,$proceso_id,1,$vista)' title='clic para editar'>$ev_conocimiento<label>"; break;
                    case "3": $ev_entrevista = "<label class='btn btn-outline-danger btn-block' onclick='modal_evaluar_todos($etapa,$proceso_id,1,$vista)' title='clic para editar'>$ev_entrevista<label>"; break;
                }
                $data['aaData'][] = [ $estado, $p->user->dni, $nombres,	$cv, $ev_curricular,$ev_conocimiento,$ev_entrevista,$bonificacion,$total];
           }else{
                switch($etapa){
                    case "1": $ev_curricular = "<label class='btn btn-outline-danger btn-block' onclick='modal_evaluar_todos($etapa,$proceso_id,0,$vista)' title='clic para editar'>$ev_curricular<label>"; break;
                    case "2": $ev_entrevista = "<label class='btn btn-outline-danger btn-block' onclick='modal_evaluar_todos($etapa,$proceso_id,0,$vista)' title='clic para editar'>$ev_entrevista<label>"; break;
                }
                $data['aaData'][] = [ $estado, $p->user->dni, $nombres,	$cv, $ev_curricular,$ev_entrevista,$bonificacion,$total];
           }
            unset($nombres); unset($ev_entrevista); unset($ev_curricular); unset($cv);
        }
        return json_encode($data, true);          
    }

    private function get_data_tarjeta($proceso_id, $etapa){
        $api = $this->get_data($proceso_id, $etapa);
        $estado = $this->estado();
        $grupo = ['total'=>0, 'pendientes' => 0, 'califica' => 0, 'noCalifica' => 0];
        $postulantes=[];
        foreach($api["postulantes"] as $p){
            $calificacion_etapa_actual = $api["etapa_actual"]["desc_bd"];
            $grupo['total']++;
            if( array_key_exists($p->$calificacion_etapa_actual, $estado ) ){
                $estado_nombre  =  $estado[$p->$calificacion_etapa_actual]['nombre'];
                $estado_clase   =  $estado[$p->$calificacion_etapa_actual]['clase'];
                $grupo[$estado[$p->$calificacion_etapa_actual]['array']]++;
            }
            else{
                $estado_nombre = 'Pendiente';
                $estado_clase = 'note-pendiente';
                $grupo['pendientes']++;
            }

            $nombres=$p->user->nombres." ".$p->user->apellido_paterno." ".$p->user->apellido_materno;
            $formacion ="";$img ="";
            $edad = Carbon::createFromDate("2001-01-01")->age;  
            if($p->formacion_postulante->count() > 0){
                $formacion = $p->formacion_postulante->especialidad;
                $edad =Carbon::createFromDate($p->datos_postulantes->fecha_nacimiento)->age;
                $img =$p->user->img;
            }
            $postulantes[] = [ 
                                'postulante_id'=>$p->id,
                                'estado_nombre'=>$estado_nombre, 
                                'estado_clase'=>$estado_clase, 
                                'dni'=>$p->user->dni, 
                                'nombres'=> $nombres,
                                'formacion'=>$formacion,
                                'edad'=>$edad,
                                'img'=>$img,
                            ];
            //limpiar
            unset($estado_nombre); unset($estado_clase); unset($nombres); unset($formacion); unset($edad); unset($img);
        }
        //return $api["postulantes"]->where("cal_curricular","1")->get();
       // return $grupo 


        
        return [
                    'postulantes' => $postulantes,
                    'etapa_actual'=> $api['etapa_actual'],
                    'grupos' => $grupo,
                    'etapas' => $api['etapas'],
                    'evaluar_conocimientos' => $api['proceso']->evaluar_conocimientos,
                ];
    }

    private function get_data($proceso_id, $etapa){
        $etapa_id = (int) $etapa;
        $proceso =  Proceso::find($proceso_id);      
        
        //enlistamos las etapas, 1: curricular, 2: entrevista, a menos que se habilite 'conocimentos' y entrevista corre a 3
        $etapas = $this->etapas_evaluacion($proceso->evaluar_conocimientos);
        //si manda una etapa no válida (mayor que el número de etapas disponibles) retorna a la ruta anterior
        if( $etapa_id > count($etapas) ){
            return back();
        }
        //Si no manda una etapa o la etapa es ==0, entonces hereda la "etapa actual" del proceso
        if($etapa_id<1 || $etapa == null){
            $etapa_id = (int) $proceso->etapa_evaluacion;
        }
        //le restamos 1 a la etapa, cómo te explico... 
        //cuando estemos evaluando la etapa 3, nos mostrará todos los que aprobaron en la etapa 2 
        //cuando evaluemos la etapa  2, nos deve mostrar los que aprobaron en la etapa 1
        //y cuando mostremos la etapa 1, nos debe mostrar todos los postulantes inscritos, es decir, 0 en el WHEN
        $etapa_a_buscar = $etapa_id-1; //-1 porque los índices o posiciones empiezan en 0, y obtendremos los datos desde un array
        $calificacion_etapa_actual = $etapas[$etapa_a_buscar]['desc_bd'];//TEXTO/NOMBRE de la CALIFICACION ACTUAL; p.e cal_curricular, cal_entrevista 
        $calificacion_etapa_anterior = $etapas[$etapa_a_buscar]['desc_bd']; // por defecto la etapa anterior será la misma que la actual, xq no existe array de indice/posición <0 (...==>)
        $query = Postulante::where('proceso_id',$proceso_id); //hasta aquí estamos de acuerdo, que muestre el proceso seleccionado 
        if($etapa_a_buscar>0){ //si es cero, mostrará a todos, caso contrario filtrará por etapas
            $calificacion_etapa_anterior = $etapas[$etapa_a_buscar-1]['desc_bd'];// (...=>) Pero en caso estemos en la etapa 2,3,..n; la etapa anterior será actual -1
            $query = $query->where($calificacion_etapa_anterior,1); //los que aprobaron en la etapa anterior se mostrará en esta vista        
        }
        $postulantes = $query->get();
        $etapa_actual = $etapas[$etapa_a_buscar];
        return [
                    'proceso'   =>  $proceso,
                    'postulantes'=> $postulantes,
                    'etapa_actual'=> $etapa_actual,
                    'etapas'      => $etapas,
                ];
    }

    public function postulantes_evaluados($proceso_id,$etapa,$ev_con){//mostrar tabla en modal
        $api  = $this->get_data($proceso_id, $etapa);
        $postulantes = $api["postulantes"];
        $filas ="";
        //return $etapa;
        $etapa_bd = $this->etapas_evaluacion($ev_con)[(int)$etapa-1]["desc2_bd"];
        
        foreach($postulantes as $key => $p){

            $filas .= "<tr>";
                $nombres = $p->user->apellido_paterno." ".$p->user->apellido_materno." ".$p->user->nombres;
                $value=(int) $p->$etapa_bd;
            $filas .= "<td>".($key+1)."</td> <td>".$p->user->dni."</td> <td>".$nombres."</td> <td><input type='number' name='evaluacion[".$p->id."]' value='$value' class='form-control'></td>";
            $filas .= "</tr>";
                unset($value);unset($nombres);
        }
        return $filas;
    }

    public function actualizar_evaluacion(Request $r,$proceso_id,$etapa,$ev_con){

        $campo_pje_min = $this->etapas_evaluacion( (int)$ev_con)[$etapa-1]["desc3_bd"];
        $campo_evaluacion = $this->etapas_evaluacion( (int)$ev_con)[$etapa-1]["desc2_bd"];
        $campo_calificacion = $this->etapas_evaluacion( (int)$ev_con)[$etapa-1]["desc_bd"];
        $api =  $this->get_data($proceso_id, $etapa);
        $proceso = $api["proceso"];

        foreach($r->evaluacion as $key => $valor){
            $q = Postulante::where("proceso_id",$proceso_id)->where("user_id",$key)->first();
            $q->$campo_evaluacion = $valor;
            if( (int) $valor > 0 && (int) $valor < (int) $proceso->$campo_pje_min ){
                $q->$campo_calificacion = 0;
            }else if( $valor >= (int) $proceso->$campo_pje_min ){
                $q->$campo_calificacion = 1;
            }
            $q->save();
            unset($q);
        }
         return $this->actualizar_etapa_evaluacion($campo_calificacion,$proceso_id,$etapa); //mueva etapa, esto lo compararaemos
                 
    }
    private function actualizar_etapa_evaluacion($campo_calificacion, $proceso_id,$etapa){
       $postulantes =  $this->get_data($proceso_id, ($etapa-1) )["postulantes"]; //consultamos nuevamente
       $sensor = true;
       foreach($postulantes as $p){
            //$evaluacion = (int) $p->$fila_evaluacion;
            if( is_null($p->$campo_calificacion) ){
                
                $sensor = false;
                break;
            }
       }
            $query = Proceso::find($proceso_id);
       if($sensor){
            $nueva_etapa =  (int) $etapa + 1;
            $query->etapa_evaluacion = $nueva_etapa;
            $query->save();
       }
       return $query->etapa_evaluacion;
    }
    


}
