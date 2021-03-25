<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Proceso;
use App\TipoProceso;
use App\GradoFormacion;
use App\Comunicado;
use App\Postulante;

class ConvocatoriaController extends Controller
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

    //vistas
    public function vigentes()
    {
       $this->actualizar_estados_vigentes_y_enCruso();
       $pesoMaxArchivo = \App\Ajuste::where('nombre','Peso archivo (B)')->first();
       $datos = [
            'tipos_proc'=>TipoProceso::pluck('nombre','id'),
            'grado_formacion'=>GradoFormacion::pluck('nombre','id'),
            'pesoMaxArchivo'=>$pesoMaxArchivo->valor,
        ];
        return view('convocatorias.vigentes.index',compact('datos') );
    }
    
    public function vigentes_data(){
        $this->actualizar_estados_vigentes_y_enCruso();
        $query = Proceso::where("estado","1")->orderBy('id','desc')->get();
        if($query->count()<1)
        return $this->data_null;
    
        foreach ($query as $dato) {
            if(!$dato->file){
                $config = ' <div class="btn-group">';
                $config.= ' <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>';
                $config.= "     <div class='dropdown-menu animated slideInUp' x-placement='bottom-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);'>
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='ver_comunicados($dato->id)'><i class='ti-comment-alt'></i> Comunicar</a>
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='editar($dato->id)'><i class='ti-pencil-alt'></i> Editar</a>
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='eliminar_convocatoria($dato->id)'><i class='fa fa-trash'></i> Eliminar</a><hr  class='my-0'>
                                    <a class='dropdown-item text-danger' href='javascript:void(0)' onclick='cancelar_convocatoria(".$dato->id.",\"".$dato->cod."\")'><i class='icon-close'></i> Cancelar</a>
                                </div>
                            </div>";
                $bases = "<button type='button' class='btn btn-outline-warning btn-rounded btn-xs' title='Ver detalles' onclick='ver_detalles($dato->id)'><i class='fa fa-info'></i> </button> ";
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
                $convocatoria_all = '<b><i class="fa fa-address-book"></i></b> '.$dato->tipoproceso->nombre.'<br><b><i class="fa fa-briefcase"></i></b> '.$dato->nombre.'<br><b><i class="fa fa-home"></i> </b><small> '.$dato->oficina.'<small>';
                $inscripcion= date_format(date_create($dato->fecha_inscripcion_inicio),"d/m/Y").' <br> '. date_format(date_create($dato->fecha_inscripcion_fin),"d/m/Y H:m");
                $idproceso=$dato->id;
                if(auth()->check() && auth()->user()->hasRoles(['Comisionado','Administrador'])){
                    $postular = '<a class="btn btn-info waves-effect waves-light btn-xs" href="'.route("postulantes.index",[$dato->id,0,1]).'"><span class="btn-label"><i class=" fas fa-users"></i></span> Postulantes</a>';
                }else if(auth()->check() && auth()->user()->hasRoles(['Postulante'])){
                    
                    $postular = '<a class="btn btn-info waves-effect waves-light" href="'.route("postulante_postular",["idproceso" => $idproceso]).'" type="button"><span class="btn-label"><i class="icon-login"></i></span> Postular</a>';
                }else{
                    $postular = "<button class='btn btn-info waves-effect waves-light' type='button' onclick='iniciar_sesion($idproceso)'><span class='btn-label'><i class='icon-login'></i></span> Postular</button>";
                }
            }

            if(auth()->check() && auth()->user()->hasRoles(['Comisionado','Administrador'])){
                $data['aaData'][] = [$config,  $dato->cod, $convocatoria_all, $dato->n_plazas,$inscripcion, $comunicados,$bases,$postular];
            }
            else{
                $data['aaData'][] = [$dato->cod, $convocatoria_all, $dato->n_plazas,$inscripcion, $comunicados,$bases,$postular];
            }
            
        }
        return json_encode($data, true);        

    }

    public function en_curso()
    {
        $this->actualizar_estados_vigentes_y_enCruso();
        return view('convocatorias.en_curso.index');
    }
     public function showme($id)
    {
        return Proceso::find($id);
    }

    //CRUD
    
    public function store(Request $r)
    {
        
        $q = Proceso::create($r->all());
        if($r->file('archivo_bases')){
            $name= $r->file('archivo_bases')->store('public/procesos/bases');
            $q->archivo_bases=$name;
            $q->save(); 
        }   
        if($r->file('archivo_resolucion')){
            $name= $r->file('archivo_resolucion')->store('public/procesos/resolucion');
            $q->archivo_resolucion=$name;
            $q->save(); 
        }   
        return $r;
    }

    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        return Proceso::find($id);
    }

  
    public function update(Request $r)
    {   $p= Proceso::find($r->id);
        $q=Proceso::where('id', $r->id)    
                ->update($r->all());
        if($r->hay_bon_pers_disc) $p->bon_pers_disc="0.15";
        else  $p->bon_pers_disc=0;

        if($r->hay_bon_ffaa) $p->bon_ffaa="0.1";
        else  $p->bon_ffaa=0;

        // if($r->hay_bon_deport) $p->bon_deport="0.1";
        // else  $p->bon_deport=0;

        $p->save();
                
        if($r->file('archivo_bases')){
            Storage::delete($p->archivo_bases);//primero eliminamos el archivo anterior
            $name= $r->file('archivo_bases')->store('public/procesos/bases');
            $p->archivo_bases=$name;
            $p->save(); 
        }  
        if($r->file('archivo_resolucion')){
            Storage::delete($p->archivo_resolucion);//primero eliminamos el archivo anterior
            $name= $r->file('archivo_resolucion')->store('public/procesos/resolucion');
            $p->archivo_resolucion=$name;
            $p->save(); 
        }

    }

    public function show_comunicados($proceso_id){
        $comunicados = Comunicado::where("proceso_id",$proceso_id)->orderBy("id","desc")->get();
        $filas = "";
        if($comunicados->count() > 0){
           foreach($comunicados as $c){
                $filas.="<tr>
                                <td >". date_format(date_create($c->created_at),"d/m/Y  h:i A")."</td>
                                <td>".$c->nombre."</td>
                                <td><a href='".Storage::url($c->archivo)."' target='_blank' class='btn btn-outline-danger btn-rounded btn-xs'><i class='fa fa-download'></i> Descargar</button></td>";
                    if(auth()->check() && auth()->user()->hasRoles(['Comisionado','Administrador'])){
                        $filas.="<td>
                                    <button type='button' class='btn btn-outline-danger btn-rounded btn-xs' onclick='eliminar_comunicado($c->id,$proceso_id)'><i class='fa fa-trash'></i> Eliminar</button>
                                </td>";
                    }    
                $filas.= "</tr>";
                // <button type='button' class='btn btn-outline-info btn-rounded btn-xs'><i class='fa fa-edit'></i> Editar</button>
            }
        }
        
        return $filas;
    }
    public function guardar_comunicados(Request $r){
        $query = new Comunicado;
        $query->proceso_id=$r->proceso_id;
        $query->nombre=$r->nombre;
        //$query->archivo="rarchivo";
        if($r->file('archivo')){
            $name= $r->file('archivo')->store('public/procesos/comunicados');
            $query->archivo=$name;
        }
        $query->save();
        //Comunicado::create($r->all());
    } 
    public function eliminar_comunicado($id){
        $c=Comunicado::find($id);
        Storage::delete($c->archivo);
        Comunicado::destroy($id);
    }   
    
    public function destroy($id)
    {
        $postulante = Postulante::where("proceso_id",$id)->first();

        if(!$postulante){//verificamos si hay postulante
            $query = Proceso::find($id);
            Storage::delete($query->archivo_bases);
            Storage::delete($query->archivo_resolucion);
            Proceso::destroy($id);
            return "exito";
        }
        return "error";
        
    }
    public function cancelar_convocatoria($id){
        $query = Proceso::find($id);
        $query->estado = '4';
        $query->save();
    }

    public function actualizar_estados_vigentes_y_enCruso(){
        $paraEnCurso=Proceso::where("estado","1")->where("fecha_inscripcion_fin","<",date('Y-m-d H:i:s'))->get();
        $paraEnvigentes = Proceso::where("estado","2")->where("fecha_inscripcion_fin",">=",date('Y-m-d H:i:s'))->get();
        
        $aProceso =0;
        foreach($paraEnCurso as $pe){
            Proceso::where('id', $pe->id)    
                ->update(["estado"=>"2"]);
            $aProceso++;
        }
        $aVigentes =0;
        foreach($paraEnvigentes as $pv){
            Proceso::where('id', $pv->id)    
                ->update(["estado"=>"1"]);
            $aVigentes++;
        }
        return "(".date('Y-m-d H:i:s').")=> Se actualizaron: \n A vigentes: ".$aVigentes."\n A en proceso: \n".$aProceso;
       
    }
}
