<?php

namespace App\Http\Controllers;

use App\CapacitacionPostulante;
use App\DatosPostulante;
use App\DatosUser;
use App\ExperienciaLabPostulante;
use App\FormacionPostulante;
use Illuminate\Http\Request;
use App\Postulante;
use App\Proceso;
use App\Ubigeo;
use App\User;
//use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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
        $estado = Proceso::find($proceso_id)->estado;
        if($estado>2){
            return redirect("/reportes/postulantes/".$proceso_id);
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

    public function etapas_evaluacion($evaluar_conocimientos){//debe ser public xq lo usamos desde otro controlador
        $etapa = 1;
        $etapas[] = 
                    [   'etapa'=>$etapa,
                        'desc_bd'=>'cal_curricular',
                        'desc2_bd'=>'ev_curricular', 
                        'desc3_bd'=>'pje_min_cv',
                        'puntaje_max_bd'=>'pje_max_cv',
                        'observacion_bd' => 'obs_curricular',
                        'peso_bd'=>'peso_cv',
                        'descripcion'=>'Curricular'
                    ]; 
                    $etapa++;
        if((boolean) $evaluar_conocimientos){
            $etapas[] = [
                            'etapa'=>$etapa,
                            'desc_bd'=>'cal_conocimientos',
                            'desc2_bd'=>'ev_conocimiento',
                            'desc3_bd'=>'pje_min_conoc',
                            'puntaje_max_bd'=>'pje_max_conoc',
                            'observacion_bd' => 'obs_conocimientos',
                            'peso_bd'=>'peso_conoc',
                            'descripcion'=>'Conocimientos'
                        ]; 
                            $etapa++;
        }
        $etapas[] = [
                        'etapa'=>$etapa,
                        'desc_bd'=>'cal_entrevista',
                        'desc2_bd'=>'ev_entrevista',
                        'desc3_bd'=>'pje_min_entrev',
                        'peso_bd'=>'peso_entrev',
                        'puntaje_max_bd'=>'pje_max_entrev',
                        'observacion_bd' => 'obs_entrevista',
                        'descripcion'=>'Entrevista'
                    ];
        return $etapas;
    }

    private function estado(){
        return [
            ['nombre'=>'No califica','clase'=>'note-no-califica','array'=>'noCalifica'],
            ['nombre'=>'Califica','clase'=>'note-califica','array'=>'califica'],
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
        $se_evalua_conocimiento = (int) $api["proceso"]->evaluar_conocimientos;
        if($etapa < 1) $etapa=$api["etapa_actual"]["etapa"];
        
        //return "data";
        if(count($api["postulantes"])<1)
           return $this->data_null;
        $bd_califica = $api["etapa_actual"]["desc_bd"];
        $observacion_bd = $api["etapa_actual"]["observacion_bd"];
        // $evaluacion_bd = $api["etapa_actual"]["desc2_bd"];
        foreach ( $api["postulantes"] as $p) {
           $nombres=$p->user->apellido_paterno." ".$p->user->apellido_materno." ".$p->user->nombres;
           $cv = "<button class='btn btn-primary btn-circle' onclick='mostrar_modalcv($p->id,$p->user_id,$etapa,$proceso_id,$se_evalua_conocimiento,$vista)'><span> <i class='fas fa-id-card'></i></span></button>";
           $ev_entrevista = (int) $p->ev_entrevista;
           $ev_curricular = (int) $p->ev_curricular;
           $dni = $p->user->dni;
           $foto = "";$bon_dep = 0; $bon_dep_val=(float)$p->bonific_deportista;
           if($p->datos_postulante){
                $foto = asset(str_replace('public/','storage/',$p->datos_postulante->archivo_foto));
                if( ((boolean)$p->datos_postulante->es_deportista ) && $etapa==count($api['etapas'])){
                    $bon_dep = 1;
                    // $bon_dep_val=;
                }
                
           }
           
           $total = (float) $p->total;
           $final = (float) $p->final;
           $ev_conocimiento = $p->ev_conocimiento;
           switch($p->$bd_califica){
               case "0"   : $estado = "No califica"; break;
               case "1"   : $estado = "Califica"; break;
               default  : $estado = "Pendiente"; break;
           }
           //pintar la columna
           $btn_mas = "<button class='btn btn-outline-primary btn-block' onclick='modal_mas($p->id)'><i class='fa fa-plus'></i></button>";
           
           
           if($se_evalua_conocimiento){
                $ev_conocimiento = (int) $p->ev_conocimiento;
                switch($etapa){
                    case "1": $ev_curricular = "<label class='btn btn-outline-primary btn-block' onclick='modal_evaluar_individual($p->id, \"$dni\", \"$nombres\", \"$foto\" ,\"$observacion_bd\",$ev_curricular,\"$p->obs_curricular\",$etapa,$proceso_id,1,$vista,0,0)' title='clic para editar'>$ev_curricular<label>"; break;
                    case "2": $ev_conocimiento = "<label class='btn btn-outline-primary btn-block' onclick='modal_evaluar_individual($p->id, \"$dni\", \"$nombres\", \"$foto\",\"$observacion_bd\",$ev_conocimiento,\"$p->obs_conocimientos\",$etapa,$proceso_id,1,$vista,0,0)' title='clic para editar'>$ev_conocimiento<label>"; break;
                    case "3": $ev_entrevista = "<label class='btn btn-outline-primary btn-block' onclick='modal_evaluar_individual($p->id, \"$dni\", \"$nombres\", \"$foto\",\"$observacion_bd\",$ev_entrevista,\"$p->obs_entrevista\",$etapa,$proceso_id,1,$vista,$bon_dep,\"$bon_dep_val\")' title='clic para editar'>$ev_entrevista<label>"; break;
                }
                $data['aaData'][] = [ $estado, $dni, $nombres,	$cv, $ev_curricular,$ev_conocimiento,$ev_entrevista,$total,$final,$btn_mas];
           }else{
                switch($etapa){
                    case "1": $ev_curricular = "<label class='btn btn-outline-primary btn-block' onclick='modal_evaluar_individual($p->id, \"$dni\", \"$nombres\", \"$foto\",\"$observacion_bd\",$ev_curricular,\"$p->obs_curricular\",$etapa,$proceso_id,0,$vista,0,0)' title='clic para editar'>$ev_curricular<label>"; break;
                    case "2": $ev_entrevista = "<label class='btn btn-outline-primary btn-block' onclick='modal_evaluar_individual($p->id, \"$dni\", \"$nombres\", \"$foto\",\"$observacion_bd\",$ev_entrevista,\"$p->obs_entrevista\",$etapa,$proceso_id,0,$vista,$bon_dep,\"$bon_dep_val\")' title='clic para editar'>$ev_entrevista<label>"; break;
                }
                $data['aaData'][] = [ $estado, $dni, $nombres,	$cv, $ev_curricular,$ev_entrevista,$total,$final,$btn_mas];
           }
            unset($nombres); unset($ev_entrevista); unset($ev_curricular); unset($cv);
        }
        return json_encode($data, true);          
    }

    private function get_data_tarjeta($proceso_id, $etapa){
        
        $api = $this->get_data($proceso_id, $etapa);
        $estado = $this->estado();
        $grupo = ['total'=>0, 'pendientes' => 0, 'califica' => 0, 'noCalifica' => 0];
        $obs_actual = $api['etapa_actual']['observacion_bd'];
        $ev_actual  = $api['etapa_actual']['desc2_bd'];
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

            $nombres=$p->user->apellido_paterno." ".$p->user->apellido_materno." ".$p->user->nombres;
            $formacion ="";$img ="";
            $edad = Carbon::createFromDate("2001-01-01")->age;  
            
            
            if($p->formacion_postulante->count() > 0){
                $formacion =$p->get_especialidad();
               
            }
            if($p->datos_postulante){
                $edad =Carbon::createFromDate($p->datos_postulante->fecha_nacimiento)->age;
                $img = Storage::url($p->datos_postulante->archivo_foto);
                if( ((boolean)$p->datos_postulante->es_deportista ) && $etapa==count($api['etapas'])){
                    $bon_dep = 1;
                }
            }
            

            $postulantes[] = [ 
                                'postulante_id'=>$p->id,
                                'user_id'=>$p->user_id,
                                'estado_nombre'=>$estado_nombre, 
                                'estado_clase'=>$estado_clase, 
                                'dni'=>$p->user->dni, 
                                'nombres'=> $nombres,
                                'formacion'=>$formacion,
                                'edad'=>$edad,
                                'foto'=>$img,
                                'bon_dep'=> (int)$bon_dep,
                                'bon_dep_val'=> $p->bonific_deportista,
                                'ev_actual'=>$p->$ev_actual,
                                'obs_actual'=> (string) $p->$obs_actual,
                                'obs_actual_bd'=>$obs_actual,
                                'ev_curricular'=> (int) $p->ev_curricular,
                                'ev_conocimiento'=> (int) $p->ev_conocimiento,
                                'ev_entrevista'=> (int)$p->ev_entrevista,
                                'total'=>$p->total,
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
                    'evaluar_conocimientos' => (int)$api['proceso']->evaluar_conocimientos,
                ];
    }
    public function ver_mas($idpostulante){
        $postulante = Postulante::find($idpostulante);
        return view('postulantes.datos_modal_mas',compact('postulante'));
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
        $campo_max_bd = $api["etapa_actual"]['puntaje_max_bd'];
        $campo_observacion = $api["etapa_actual"]['observacion_bd'];
        $max = $api['proceso']->$campo_max_bd;
        foreach($postulantes as $key => $p){

            $filas .= "<tr>";
                $nombres = $p->user->apellido_paterno." ".$p->user->apellido_materno." ".$p->user->nombres;
                $value=(int) $p->$etapa_bd;
                $observacion=$p->$campo_observacion;
            $filas .= "<td>".($key+1)."</td>";
            $filas .= "<td>".$p->user->dni."</td>"; 
            $filas .= "<td>".$nombres."</td>";
            $filas .= "<td><input type='number' name='evaluacion[".$p->id."]' value='$value' min='0' max='$max' class='form-control'></td>";
            $filas .= "<td><textarea class='form-control' name='observacion[".$p->id."][".$api["etapa_actual"]['observacion_bd']."]' >$observacion</textarea></td>";
            $filas .= "</tr>";
                unset($value);unset($nombres);
        }
        return $filas;
    }

    public function actualizar_evaluacion(Request $r,$proceso_id,$etapa,$ev_con){
        // if(isset($r->bonific_deportista)){
        //     return $r->bonific_deportista;
        // }else{
        //     return "FALSE";
        // }
        $campo_pje_min = $this->etapas_evaluacion( (int)$ev_con)[$etapa-1]["desc3_bd"];
        $campo_evaluacion = $this->etapas_evaluacion( (int)$ev_con)[$etapa-1]["desc2_bd"];
        $campo_calificacion = $this->etapas_evaluacion( (int)$ev_con)[$etapa-1]["desc_bd"];
        $api =  $this->get_data($proceso_id, $etapa);
        $proceso = $api["proceso"];
        //return $r->evaluacion;
        //return Postulante::where("proceso_id",$proceso_id)->where("id",1)->first();
        foreach($r->evaluacion as $key => $valor){
            //cargar puntaje
            $q = Postulante::find($key);
            $q->$campo_evaluacion =  $valor;
            if( (int) $valor > 0 && (int) $valor < (int) $proceso->$campo_pje_min ){
                $q->$campo_calificacion = 0;
            }else if( $valor >= (int) $proceso->$campo_pje_min ){
                $q->$campo_calificacion = 1;
            }
            
            //cargar OBSERVACIÓN
            foreach($r->observacion[$key] as $campo_observacion => $valor_observacion ){
                $q->$campo_observacion =  $valor_observacion;
            }
            $q->save();
            //Calcular puntaje TOTAL
            $sum_evaluaciones =[];
            foreach($api["etapas"]   as $e){
                $ev_etapa=$e['desc2_bd'];
                $peso_bd =$e['peso_bd'];
                $sum_evaluaciones[]= $q->$ev_etapa*($proceso->$peso_bd);
            }
            $q->total = array_sum($sum_evaluaciones);
            $q->save();
            unset($q);
        }
         return $this->actualizar_etapa_evaluacion($campo_calificacion,$proceso_id,$etapa,$r); //retorna la nueva etapa o (string) "final", y esto lo compararemos en el JS
                 
    }
    private function actualizar_etapa_evaluacion($campo_calificacion, $proceso_id,$etapa,$r){
       $api = $this->get_data($proceso_id, $etapa );
       $postulantes =  $api["postulantes"]; //consultamos nuevamente
       $n_etapas = count($api["etapas"]);
       $sensor = true;
       foreach($postulantes as $p){
            //Si alguna fila no se ha calificado, interrumpimos el proceso 
            if( is_null($p->$campo_calificacion) ){
                $sensor = false;
                break;
            }
       }
        $query = Proceso::find($proceso_id);
       if($sensor){
           if( $etapa<$n_etapas ){
                $nueva_etapa =  (int) $etapa + 1;
                $query->etapa_evaluacion = $nueva_etapa;
                $query->save();
           }
           else if($etapa==$n_etapas){
                $this->calcular_puntaje_final($query,$r);
                return "final";
           }
       }
       return $query->etapa_evaluacion;
       
    }

    private function calcular_puntaje_final($proceso,$r){
        $postulantes = Postulante::where("proceso_id",$proceso->id)->where("cal_entrevista","1")->get();
        //Calcular Final 
        $array_id=[];
        foreach($postulantes as $key => $p){
            //$query = Postulante::find($p->id);
            $p->final = (float) $p->total + (float) $this->calcular_bonificaciones($p->id,$proceso,$r);  
                                                          //retorna la suma de las bonificaciones
            $p->save();
            $array_id[]=$p->id;
            //unset($query);
        }
        //Situación
        $query = Postulante::wherein("id",$array_id)->orderBy("final","desc")->get();
        unset($array_id);
        $temp_p=1;
        foreach($query as $key => $p){
            if( $temp_p <= $proceso->n_plazas){
                $p->condicion = "GANADOR";
            }else{
                $p->condicion = "ACCESITARIO";
            }
            $temp_p++;
            $p->save();
        }
    }

    private function calcular_bonificaciones($postulante_id,$proceso,$r){
        $datos = DatosPostulante::where("postulante_id",$postulante_id)->first();
        $postulante = Postulante::find($postulante_id);
        $bonificacion = 0;
        if(!$datos) return $bonificacion;
        if($datos->es_pers_disc){
            $temporal_bon = (float) $proceso->bon_pers_disc*$postulante->ev_entrevista;
            $postulante->bonific_pers_disc = $temporal_bon;
            $bonificacion +=$temporal_bon;
            unset($temporal_bon);
        }
        if($datos->es_lic_ffaa){
            $temporal_bon = (float) $proceso->bon_ffaa*$postulante->ev_entrevista;
            $postulante->bonific_ffaa = $temporal_bon;
            $bonificacion +=$temporal_bon;
            unset($temporal_bon);
        }
        if($datos->es_deportista){
            if(isset($r->bonific_deportista)){
                $temporal_bon = (float) $r->bonific_deportista; 
                $postulante->bonific_deportista = $temporal_bon;
                $bonificacion +=$temporal_bon;
                unset($temporal_bon);
            }
        }
        $postulante->save();
        return $bonificacion;
    }
    
    public function cargar_cv($postulanteid,$userid){
    //________________________________ubigeo_______________________________________________________
    if(DatosPostulante::select('nacionalidad','ubigeo_nacimiento','ubigeo_domicilio')->where('postulante_id',$postulanteid)->exists()){
    $du = DatosPostulante::select('nacionalidad','ubigeo_nacimiento','ubigeo_domicilio')->where('postulante_id',$postulanteid)->first();
        $nacionalidad = $du->nacionalidad;
        if($nacionalidad == "Peruano(a)"){
            $cod_nac = $du->ubigeo_nacimiento;
            $u_nac = Ubigeo::select('desc_dep_reniec','desc_prov_reniec','desc_ubigeo_reniec')->where('cod_ubigeo_reniec',intval($du->ubigeo_nacimiento))->first();
            $desc_u_nac = $u_nac->desc_ubigeo_reniec.' - '.$u_nac->desc_prov_reniec.' - '.$u_nac->desc_dep_reniec;
        }else if($du->nacionalidad == "Extranjero(a)"){
            $cod_nac = $du->ubigeo_nacimiento;
            $desc_u_nac = null;
        }

        $cod_dom= $du->ubigeo_domicilio;
        $u_dom = Ubigeo::select('desc_dep_reniec','desc_prov_reniec','desc_ubigeo_reniec')->where('cod_ubigeo_reniec',intval($du->ubigeo_domicilio))->first();
        $desc_u_dom = $u_dom->desc_ubigeo_reniec.' - '.$u_dom->desc_prov_reniec.' - '.$u_dom->desc_dep_reniec;
    }else{
        $nacionalidad="";
        $desc_u_nac="";
        $desc_u_dom="";
        $cod_nac="";
        $cod_dom="";
    }
        //return compact('nacionalidad','desc_u_nac','desc_u_dom','cod_nac','cod_dom');
        
    
    //______________________________fin ubigeo_______________________________________________________
    //Experiencia
    $qexp = ExperienciaLabPostulante::select('id','desc_cargo_funcion','validacion','tipo_experiencia','es_exp_gen','es_exp_esp','centro_laboral','cargo_funcion','fecha_inicio','fecha_fin','dias_exp_gen','dias_exp_esp','archivo')
    ->where('postulante_id',$postulanteid)->get();

    //CApacitaciones
    $qcapa= CapacitacionPostulante::select('id','validacion','es_curso_espec','es_ofimatica','es_especializacion','es_diplomado','es_idioma','especialidad','centro_estudios','cantidad_horas','archivo')
    ->where('postulante_id',$postulanteid)->get();
    
    //Datospersonales
    $qdatos = DatosPostulante::select('archivo_colegiatura','colegiatura','archivo_foto','archivo_disc','archivo_ffaa','archivo_deport','archivo_dni','fecha_nacimiento','ubigeo_nacimiento','telefono_celular','telefono_fijo','ruc','domicilio','ubigeo_domicilio','nacionalidad','es_pers_disc','es_lic_ffaa','es_deportista')
    ->where('postulante_id',$postulanteid)->first();
    
    //Datos usuario
    $quser = User::select('dni','nombres','apellido_paterno','apellido_materno','email','img')
    ->where('id',$userid)->first();
    
    //Formacion 
    $qform = FormacionPostulante::join("grado_formacions", "grado_formacions.id", "=", "formacion_postulantes.grado_id")
    ->select("formacion_postulantes.id","formacion_postulantes.validacion","formacion_postulantes.archivo","formacion_postulantes.fecha_expedicion","formacion_postulantes.centro_estudios","formacion_postulantes.especialidad","formacion_postulantes.id","grado_formacions.nombre")
    ->where("formacion_postulantes.postulante_id",$postulanteid)->get();
    $postulante = Postulante::find($postulanteid);
    $proceso =$postulante->proceso;
    return compact('qexp','qform','qdatos','qcapa','proceso','postulante','quser','nacionalidad','desc_u_nac','desc_u_dom','cod_nac','cod_dom');

    }

    public function guardar_validacion_exp($idexp,$valor_validacion){
        
        $val = ExperienciaLabPostulante::find($idexp);

        $idpostulante = $val->postulante_id;

        $val->validacion = $valor_validacion;
        $val->save();

        //____________________inicio interseccion fechas_______________
        $query_inter = ExperienciaLabPostulante::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')
        ->where('postulante_id',$idpostulante)
        ->where('validacion',1)
        ->orderBy('id','DESC')
        ->get();
       //____________________fin interseccion fechas_______________

        return compact('query_inter','idpostulante');
    } 
    public function guardar_validacion_capa($idcapa,$valor_validacion){
        
        $val = CapacitacionPostulante::find($idcapa);
        $val->validacion = $valor_validacion;
        $val->save();
        return "validacion ok";
    } 

    public function guardar_validacion_form($idcapa,$valor_validacion){
        $val = FormacionPostulante::find($idcapa);
        $val->validacion = $valor_validacion;
        $val->save();
        return "validacion ok";
    } 

}
