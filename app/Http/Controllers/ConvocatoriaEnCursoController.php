<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Proceso;
use App\TipoProceso;
use App\GradoFormacion;
use App\Comunicado;
use App\EvaluacionProceso;
use App\Postulante;
use Carbon\Carbon;

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
        $this->actualizar= app(\App\Http\Controllers\ConvocatoriaController::class);
       
    }

    public function index(){
        $this->actualizar->actualizar_estados_vigentes_y_enCruso();
        $pesoMaxArchivo = \App\Ajuste::where('nombre','Peso archivo (B)')->first();
        $datos = [
            'tipos_proc'=>TipoProceso::pluck('nombre','id'),
            'grado_formacion'=>GradoFormacion::pluck('nombre','id'),
            'pesoMaxArchivo'=>$pesoMaxArchivo->valor,
        ];
        return view("convocatorias.en_curso.index",compact('datos'));
    }

    
    public function data(){
        $this->actualizar->actualizar_estados_vigentes_y_enCruso();
        $query = Proceso::where("estado","2")->orderBy("id","desc")->get();
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
                            <a class='dropdown-item' href='javascript:void(0)' onclick='ver_evaluacion($dato->id)'><i class='fa fa-calculator'></i> Evaluacion</a>
                            <a class='dropdown-item' href='javascript:void(0)' onclick='resultado($dato->id)'><i class='icon-trophy'></i> Resultados</a><hr  class='my-0'>";
            if($dato->archivo_resultado){
                $config.=   "<a class='dropdown-item text-success' href='javascript:void(0)' onclick='concluir_convocatoria(".$dato->id.",\"".$dato->cod."\")'><i class='icon-check'></i> Concluir</a>";   
            }else{
                $config.=   "<a class='dropdown-item text-danger' href='javascript:void(0)' onclick='cancelar_convocatoria(".$dato->id.",\"".$dato->cod."\")'><i class='icon-close'></i> Cancelar </a>";
            }
                           
            $config.=  " </div>
                            </div>";//no existe esa funcion
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
                $bases.= "<a href='$href' target='_blank' class='btn btn-outline-info btn-rounded btn-sm'><i class='fa fa-file'></i> Bases</a>";
            }
            $comunicados = ""; 
            if($dato->comunicados->count() > 0 ){
                $texto = date_format(date_create($dato->ultimo_comunicado()->created_at),"d/m/Y"); 
                $comunicados = "<button class='btn btn-outline-danger waves-effect waves-light btn-xs' onclick='ver_comunicados($dato->id)'><span class='btn-label'><i class='ti-comment'></i></span> Comunicado <br> $texto </button>";
            }                
            $convocatoria_all = '<b><i class="fa fa-address-book"></i></b> '.$dato->tipoproceso->nombre.'<br><b><i class="fa fa-briefcase"></i></b> '.$dato->nombre.'<br><b><i class="fa fa-home"></i> </b><small> '.$dato->oficina.'<small>';
            $evaluaciones="";//$dato->evaluaciones; 
            $fecha_hoy1 = Carbon::now();
            //$fecha_inicio1 = Carbon::parse($dato->evaluacionprocesos->fecha_publicacion);
            if($dato->evaluacionprocesos->count() > 0){
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
            if(auth()->check() && auth()->user()->hasRoles(['Administrador','Comisionado'])){
                $postular = '<a class="btn btn-info waves-effect waves-light btn-xs" href="'.route("postulantes.index",[$dato->id,0,1]).'"><span class="btn-label"><i class=" fas fa-users"></i></span> Postulantes</a>';
            }else if(auth()->check() && auth()->user()->hasRoles(['Postulante'])){
                $idproceso=$dato->id;
                $postular = '<a class="btn btn-info waves-effect waves-light" href="'.route("postulante_postular",["idproceso" => $idproceso]).'" type="button"><span class="btn-label"><i class="icon-login"></i></span> Postular</a>';
            }else{
                $postular = '<button class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#modal_invitado" type="button"><span class="btn-label"><i class="icon-login"></i></span> Postular</button>';
            }                   
         
            if(auth()->check() && auth()->user()->hasRoles(['Administrador'])){
                $data['aaData'][] = [$config,$dato->cod,$convocatoria_all,$bases,$comunicados,$evaluaciones,$resultados,$postular];
            }
            else{
                $data['aaData'][] = [$dato->cod,$convocatoria_all,$bases,$comunicados,$evaluaciones,$resultados];    
            }

        }
        return json_encode($data, true);        
                
            
                
    }

     
 
    public function guardar_evaluacion(Request $r){
        $query = new EvaluacionProceso;
        $query->proceso_id=$r->proceso_id;
        $query->nombre=$r->nombre;
        $query->fecha_publicacion=$r->fecha_publicacion;
        //$query->archivo="rarchivo";
        if($r->file('archivo')){
            $name= $r->file('archivo')->store('public/procesos/evaluaciones');
            $query->archivo=$name;
        }
        $query->save();
        //Comunicado::create($r->all());
    }

  
    public function show_evaluacion($proceso_id){
        $evaluacion = EvaluacionProceso::where("proceso_id",$proceso_id)->orderBy("id","desc")->get();
        $filas = "";
        if($evaluacion->count() > 0){
           foreach($evaluacion as $c){
                $filas.="<tr>
                                <td >". date_format(date_create($c->created_at),"d/m/Y  h:i A")."</td>
                                <td>".$c->nombre."</td>
                                <td><a href='".Storage::url($c->archivo)."' target='_blank' class='btn btn-outline-danger btn-rounded btn-xs'><i class='fa fa-download'></i> Descargar</button></td>";
                    if(auth()->check() && auth()->user()->hasRoles(['Comisionado','Administrador'])){
                        $filas.="<td>
                                    <button type='button' class='btn btn-outline-danger btn-rounded btn-xs' onclick='eliminar_evaluacion($c->id,$proceso_id)'><i class='fa fa-trash'></i> Eliminar</button>
                                </td>";
                    }    
                $filas.= "</tr>";
                
            }
        }
        
        return $filas;
    } 

    public function eliminar_evaluacion($id){
        $c=EvaluacionProceso::find($id);
        Storage::delete($c->archivo);
        EvaluacionProceso::destroy($id);
    } 
     
    public function resultados($id)
    {
        return Proceso::find($id);
    }
    public function update_resultado(Request $r)
    {   
        $p= Proceso::find($r->id);
        //dd($r->fecha_publicacion_resultado);
        if($r->resultado_archivo_tipo=="web"){
            Storage::delete($p->archivo_resultado);
            $p->archivo_resultado = $r->archivo_resultado;
            $p->archivo_resultado_tipo = $r->resultado_archivo_tipo;
            $p->fecha_resultados = $r->fecha_publicacion_resultado;
            $p->save();
        }
        else{
            if($r->file('archivo_resultado')){
                Storage::delete($p->archivo_resultado);//primero eliminamos el archivo anterior
                $name= $r->file('archivo_resultado')->store('public/procesos/resultado');
                $p->archivo_resultado=$name;
                $p->fecha_resultados=$r->fecha_publicacion_resultado;
                $p->save(); 
            }
        }
   
    }

    
    public function guardar_resultado(Request $r){
        if($r)
         $query = find::Proceso($r->id);
         $query->tipo_id=$r->tipo_id;
         $query->nombre=$r->nombre;
         //$query->archivo="rarchivo";
         if($r->file('archivo')){
            $name= $r->file('archivo')->store('public/procesos/resultados');
             $query->archivo=$name;
         }
         $query->save();
         //Comunicado::create($r->all());
    }

    public function concluir_convocatoria($id){
        $query = Proceso::find($id);
        if($query->archivo_resultado){            
            $query->estado = '3';
            $query->save();
        }
            
    }

  
     
  }

  