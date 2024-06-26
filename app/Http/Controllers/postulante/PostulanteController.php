<?php

namespace App\Http\Controllers\postulante;

use App\CapacitacionPostulante;
use App\CapacitacionUser;
use App\DatosPostulante;
use App\DatosUser;
use App\ExperienciaLabPostulante;
use App\ExperienciaLabUser;
use App\FormacionPostulante;
use App\FormacionUser;
use App\GradoFormacion;
use App\Http\Controllers\Controller;
use App\Mail\ConstPostulacionMailable;
use App\Postulante;
use App\Proceso;
use App\Ubigeo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class PostulanteController extends Controller
{
    public function __construct()
    {
      
    }
   
    public function index()
    {
        return view('convocatorias.vigentes.index');
    }
/*
    public function formacion_data_prueba(){
        $dataform=FormacionUser::where('user_id',2)->get();
        //return datatables()->of($dataform)->toJson();
        return json_encode($dataform, true);
    }
*/
    public function recuperar_ubigeo(){

        if(DatosUser::select('nacionalidad','ubigeo_nacimiento','ubigeo_domicilio')->where('user_id',auth()->user()->id)->exists()){
            $du = DatosUser::select('nacionalidad','ubigeo_nacimiento','ubigeo_domicilio')->where('user_id',auth()->user()->id)->first();
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
        
        return compact('nacionalidad','desc_u_nac','desc_u_dom','cod_nac','cod_dom');
    }

    public function datosuser_data1(){
        
        if(DatosUser::where('user_id',auth()->user()->id)->exists()){
            $query = DatosUser::where('user_id', auth()->user()->id)->get();
            return $query;
        }else{
            return response()->json(['valor'=>"0"]);
        }


    }
       
    private function check_si_ya_postula(){
       $q = Proceso::select('procesos.id as id')
            ->join('postulantes','postulantes.proceso_id','=','procesos.id')
            ->where('postulantes.user_id',auth()->user()->id)
            ->whereIn('procesos.estado',['1','2'])
            ->first();
        if($q){
            return ['estado'=>true, 'dato'=>$q->id];
        }else{
            return ['estado'=>false];
        }
    }
    private function check_estado($proceso_id){
        app(\App\Http\Controllers\ConvocatoriaController::class)->actualizar_estados_vigentes_y_enCruso();
        $q = Proceso::where('id',$proceso_id)->where('estado','<>','1')->first();
        if($q)  return ['estado'=>true, 'dato'=>$q];
        else return ['estado'=>false];
        

    }
    public function postular($idproceso)
    {// 0: pre-cargado, 1: publicado, 2: en curso, 3: concluido, 4: cancelado 
      /*  $data = Postulante::join("procesos","procesos.id","=","postulantes.proceso_id")
        ->select("procesos.estado")
        ->where("postulantes.user_id",2)
        ->where("postulantes.proceso_id",10)
        ->first();
*/

        if($this->check_si_ya_postula()['estado']){
            return redirect()->route('registro_postular',['idproceso' => $this->check_si_ya_postula()['dato'] ]); 
        } 
       
        app(\App\Http\Controllers\ConvocatoriaController::class)->actualizar_estados_vigentes_y_enCruso();
        $qr = Proceso::where('id',$idproceso)->where('estado','<>','1')->first();
        
        if( $this->check_estado($idproceso)['estado'] ){
            $mensaje = 'NO SE REGISTRÓ SU POSTULACIÓN. El proceso '.$this->check_estado($idproceso)['dato']->cod.' cerró el '.date_format(date_create($this->check_estado($idproceso)['dato']->fecha_inscripcion_fin),"d/m/Y H:i");
            return redirect('/redirect?mensaje='.$mensaje.'&color=naranja'); 
        } 
        
        //___________________
       /* if(Postulante::where('user_id',auth()->user()->id)->where('proceso_id',$idproceso)->exists()){
            return redirect()->route('registro_postular',['idproceso' => $idproceso]);               
            } */
        
        $proceso = Proceso::where('id',$idproceso)->first();
        
                if( $proceso->estado != 1){ //si el proceso ya culminó o ha sido cancelado no me permite seguir con la postulacion
                    return redirect()->route('index');
                }

        $proceso_formacion = Proceso::join("grado_formacions", "grado_formacions.id", "=", "procesos.nivel_acad_convocar")
        ->select("grado_formacions.nombre","procesos.especialidad")
        ->where("procesos.id",$idproceso)
        ->get();
        $gradoformac = GradoFormacion::get();
        
        $datos_usuario = DatosUser::where('user_id',auth()->user()->id)->get();
        $datos_formacion = User::join("formacion_users", "formacion_users.user_id", "=", "users.id")
        ->select("*")
        ->where("formacion_users.user_id", "=", auth()->user()->id)
        ->get();
        $datos_capacitacion = User::join("capacitacion_users", "capacitacion_users.user_id", "=", "users.id")
        ->select("*")
        ->where("capacitacion_users.user_id", "=", auth()->user()->id)
        ->get();
        $datos_experiencia = User::join("experiencia_lab_users", "experiencia_lab_users.user_id", "=", "users.id")
        ->select("*")
        ->where("experiencia_lab_users.user_id", "=", auth()->user()->id)
        ->get();

        $ubigeos = \App\Ubigeo::select(DB::raw("CONCAT(desc_ubigeo_reniec,' - ', desc_prov_reniec,' - ', desc_dep_reniec) AS descripcion"), 'cod_ubigeo_reniec as ubigeo')
        ->where("cod_ubigeo_reniec","<>","NA") 
        ->pluck('descripcion','ubigeo');

        $pesoMaxArchivo = \App\Ajuste::where('nombre','Peso archivo (B)')->first()->valor;
        $pesoMaxArchivo_c = number_format(($pesoMaxArchivo / 1048576), 1, '.', "");
        
        return view('postulante.postular',compact('proceso_formacion','datos_formacion','gradoformac','proceso','datos_usuario','datos_capacitacion','datos_experiencia','ubigeos','pesoMaxArchivo','pesoMaxArchivo_c'));
        
    }

    public function actualizar_o_registrar(Request $data){
        
        if(DatosUser::where('user_id',auth()->user()->id)->exists()){
        
          $idDatosUser = DatosUser::where('user_id',auth()->user()->id)->select('id')->get();

                  
        $datosuser = DatosUser::find($idDatosUser[0]->id);
        $datosuser->telefono_celular = $data->celular;
        $datosuser->telefono_fijo = $data->telfijo;
        $datosuser->ruc = $data->ruc;
        $datosuser->domicilio = $data->domicilio;
        $datosuser->es_pers_disc = $data->dicapacidad;
        $datosuser->ubigeo_nacimiento = $data->ubigeodni;
        $datosuser->ubigeo_domicilio = $data->ubigeo_domicilio;
        $datosuser->es_lic_ffaa = $data->ffaa;
        $datosuser->es_deportista = $data->deportista;
        $datosuser->nacionalidad = $data->nacionalidad;
        $datosuser->fecha_nacimiento = $data->fechanac;
       
       //archivo DNI
        if($data->file('archivo_dni')){
            $s= DatosUser::find($idDatosUser[0]->id);
            Storage::delete($s->archivo_dni); //eliminar archivo ya cargado
            $datosuser->archivo_dni = $data->file('archivo_dni')->store('public/procesos/users/'.auth()->user()->dni.'/dni');
            $datosuser->archivo_dni_tipo = "local";
            }//else{$datosuser->archivo_dni = NULL; $datosuser->archivo_dni_tipo = NULL; }
    
        //archivo discapacidad
        if($data->file('archivo_discapacidad')){
            $p= DatosUser::find($idDatosUser[0]->id);
            Storage::delete($p->archivo_disc); //eliminar archivo ya cargado
            $datosuser->archivo_disc = $data->file('archivo_discapacidad')->store('public/procesos/users/'.auth()->user()->dni.'/arch_discapacidad');
            $datosuser->archivo_disc_tipo = "local";
            }else if($data->dicapacidad == 0){
                $pp= DatosUser::find($idDatosUser[0]->id);
                Storage::delete($pp->archivo_disc); //eliminar archivo ya cargado
                $datosuser->archivo_disc = NULL;
                $datosuser->archivo_disc_tipo = NULL;
            }
          
            if($data->file('archivo_ffaa')){
                $q= DatosUser::find($idDatosUser[0]->id);
                Storage::delete($q->archivo_ffaa); //eliminar archivo ya cargado
                $datosuser->archivo_ffaa = $data->file('archivo_ffaa')->store('public/procesos/users/'.auth()->user()->dni.'/arch_ffaa');
                $datosuser->archivo_ffaa_tipo = "local";
                }else if($data->ffaa == 0){
                    $qq= DatosUser::find($idDatosUser[0]->id);
                    Storage::delete($qq->archivo_ffaa); //eliminar archivo ya cargado
                    $datosuser->archivo_ffaa = NULL;
                    $datosuser->archivo_ffaa_tipo = NULL;
                }

            if($data->file('archivo_deport')){
                $r= DatosUser::find($idDatosUser[0]->id);
                Storage::delete($r->archivo_deport); //eliminar archivo ya cargado
                $datosuser->archivo_deport = $data->file('archivo_deport')->store('public/procesos/users/'.auth()->user()->dni.'/arch_deportista');
                $datosuser->archivo_deport_tipo = "local";
                }else if($data->deportista == 0){
                    $r= DatosUser::find($idDatosUser[0]->id);
                Storage::delete($r->archivo_deport); //eliminar archivo ya cargado
                $datosuser->archivo_deport = NULL;
                $datosuser->archivo_deport_tipo = NULL;
                }
        
        $datosuser->save();
            
           
        }else{
        $datosuserno =new DatosUser;
        $datosuserno->user_id = auth()->user()->id;
        $datosuserno->telefono_celular = $data->celular;
        $datosuserno->telefono_fijo = $data->telfijo;
        $datosuserno->ruc = $data->ruc;
        $datosuserno->domicilio = $data->domicilio;
        $datosuserno->ubigeo_nacimiento = $data->ubigeodni;
        $datosuserno->ubigeo_domicilio = $data->ubigeo_domicilio;
        $datosuserno->es_pers_disc = $data->dicapacidad;
        $datosuserno->es_lic_ffaa = $data->ffaa;
        $datosuserno->es_deportista = $data->deportista;
        $datosuserno->nacionalidad = $data->nacionalidad;
        $datosuserno->fecha_nacimiento = $data->fechanac;
        
        //archivo DNI
        if($data->file('archivo_dni')){
            $datosuserno->archivo_dni = $data->file('archivo_dni')->store('public/procesos/users/'.auth()->user()->dni.'/dni');
            $datosuserno->archivo_dni_tipo = "local";
            }//else{$datosuserno->archivo_dni = NULL; $datosuserno->archivo_dni_tipo = NULL; }
        
        //archivo discapacidad
        if($data->file('archivo_discapacidad')){
        $datosuserno->archivo_disc = $data->file('archivo_discapacidad')->store('public/procesos/users/'.auth()->user()->dni.'/arch_discapacidad');
        $datosuserno->archivo_disc_tipo = "local";
        }//else{$datosuserno->archivo_disc = NULL; $datosuserno->archivo_disc_tipo = NULL; }
        //archivo discapacidad
        if($data->file('archivo_ffaa')){
            $datosuserno->archivo_ffaa = $data->file('archivo_ffaa')->store('public/procesos/users/'.auth()->user()->dni.'/arch_ffaa');
            $datosuserno->archivo_ffaa_tipo = "local";
            }//else{$datosuserno->archivo_ffaa = NULL; $datosuserno->archivo_ffaa_tipo = NULL; }
        //archivo discapacidad
        if($data->file('archivo_deport')){
            $datosuserno->archivo_deport = $data->file('archivo_deport')->store('public/procesos/users/'.auth()->user()->dni.'/arch_deportista');
            $datosuserno->archivo_deport_tipo = "local";
            }//else{$datosuserno->archivo_deport = NULL; $datosuserno->archivo_deport_tipo = NULL; }
                

        $datosuserno->save();
            
        }

        $query = DatosUser::where('user_id',auth()->user()->id)->first();
        return $query;

    }
   
    public function formacion_data1(){
        $query = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.archivo","formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre")
        ->where("formacion_users.user_id",auth()->user()->id)->get();
        //$query = FormacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        return $query;
    }
    
    /*public function capacitaciones_data1(){
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();

            return $query;
        }*/
    public function capacitaciones_data1(Request $data){
        //$query = CapacitacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
            if($data->hora_requerido){
        $a= CapacitacionUser::where("user_id",auth()->user()->id)->where('cantidad_horas','>=',$data->hora_requerido);
        $b= CapacitacionUser::where("user_id",auth()->user()->id)->where('es_certificado','=','1');
        $query= CapacitacionUser::where("user_id",auth()->user()->id)->where('es_licencia','=','1')->union($a)->union($b)->get();

            return $query;
        }else {
            $query = CapacitacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
            return $query;
        }
    }



    public function experiencias_data1(Request $data){
        //$proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
        //$query = ExperienciaLabUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
       
       if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       }else if($proceso[0]->consid_prac_preprof == 1){
         $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->orderBy('id','DESC')->get();  
       }else if($proceso[0]->consid_prac_prof == 1){
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->orderBy('id','DESC')->get();   
       }else{
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->orderBy('id','DESC')->get();    
       }
       
       //$query = ExperienciaLabUser::where('user_id',2)->whereIn('tipo_experiencia',[2])->orderBy('id','DESC')->get();
                return compact('query','proceso'); //REVISAR CÓDIGO DESPUÉS de PERFIL
            }
    
    public function experiencias_data1_perfil(Request $data){
        //$proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       
                return compact('query'); //REVISAR CÓDIGO DESPUÉS de PERFIL
            }


    public function guardarformacion(Request $data){
        
       $fu = new FormacionUser;
        
        $fu->user_id = auth()->user()->id;
        $fu->grado_id = $data->grado_id;
        $fu->fecha_inicio = $data->fecha_inicio;
        $fu->fecha_fin = $data->fecha_fin;
        $fu->fecha_expedicion = $data->fecha_expedicion;
        $fu->centro_estudios = $data->centro_estudios;
        $fu->especialidad = $data->especialidad;
        $fu->ciudad = $data->ciudad;
        $fu->pais = $data->pais;
        
        $fu->archivo = $data->file('archivo_formacion')->store('public/procesos/users/'.auth()->user()->dni.'/arch_formacion');
        $fu->archivo_tipo = "local"; 
        
        $fu->save();
    
        $query = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre","formacion_users.archivo")
        ->where("formacion_users.user_id",auth()->user()->id)->get()->last();
        //$query = FormacionUser::where('user_id',auth()->user()->id)->get()->last();
        return $query;

    }

    public function eliminarformacion(Request $data){
       
        $q= FormacionUser::find($data->id);
        Storage::delete($q->archivo); 

        $form = FormacionUser::find($data->id);
        $form->delete();
        return "eliminado";

    }

    public function guardarcapacitacion(Request $data){
        
        //$datap =$data->nacionalidad;
        //return response()->json(['data'=>$data->fechainicio_capac]);
        
        $cu = new CapacitacionUser();
        
        $cu->user_id = auth()->user()->id;
        $cu->es_curso_espec = $data->es_curso_espec;
        $cu->es_especializacion = $data->es_especializacion;
        $cu->es_diplomado = $data->es_diplomado;
        $cu->es_ofimatica = $data->es_ofimatica;
        $cu->es_idioma = $data->es_idioma;
        $cu->es_certificado = $data->es_certificado;
        $cu->es_licencia = $data->es_licencia;
        
        $cu->centro_estudios = $data->centro_estudios;
        $cu->especialidad = $data->especialidad;
        $cu->ciudad = $data->ciudad;
        $cu->pais = $data->pais;
        $cu->fecha_inicio = $data->fechainicio_capac;
        $cu->fecha_fin = $data->fechafin_capac;
        $cu->archivo = $data->file('archivo_capacitacion')->store('public/procesos/users/'.auth()->user()->dni.'/arch_capacitacion');
        $cu->archivo_tipo = "local";
        $cu->cantidad_horas = $data->cantidad_horas;
        $cu->nivel = $data->nivel_capa;
        $cu->save();

        try{
            $cu->save(); // returns false
            }
        catch(\Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
        
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->get()->last();
        return $query;

    }

    public function eliminarcapacitacion(Request $data){
        $q= CapacitacionUser::find($data->id);
        Storage::delete($q->archivo); 
        
        $query = CapacitacionUser::where('id',$data->id)->get();
        $Capac = CapacitacionUser::find($data->id);
        $Capac->delete();
        
        return $query;
    }
    
    public function guardarexperiencia(Request $data){
      
       $el = new ExperienciaLabUser();
        
        $el->user_id = auth()->user()->id;
        $el->es_exp_gen = $data->es_exp_gen;
        $el->es_exp_esp = $data->es_exp_esp;
        $el->centro_laboral = $data->centro_laboral;
        
        $el->tipo_institucion = $data->tipo_institucion;
        $el->tipo_experiencia = $data->tipo_experiencia;
        $el->cargo_funcion = $data->cargo_funcion;
        $el->desc_cargo_funcion = $data->desc_cargo_funcion;
        $el->fecha_inicio = $data->fecha_inicio;
        $el->fecha_fin = $data->fecha_fin;
        //$el->num_pag = $data->num_pag;
        $el->dias_exp_gen =$data->dias_exp_gen;
        $el->dias_exp_esp = $data->dias_exp_esp;

        $el->archivo = $data->file('archivo_experiencia')->store('public/procesos/users/'.auth()->user()->dni.'/arch_exper');
        $el->archivo_tipo = "local";
        
        $el->save();
    
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->get()->last();
        $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');

        //____________________inicio interseccion fechas_______________

        $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
       
       if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       }else if($proceso[0]->consid_prac_preprof == 1){
         $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->orderBy('id','DESC')->get();  
       }else if($proceso[0]->consid_prac_prof == 1){
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->orderBy('id','DESC')->get();   
       }else{
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->orderBy('id','DESC')->get();    
       }
       //____________________fin interseccion fechas_______________

        return compact('query','suma_expgen','suma_expesp','query_inter');

    }

    public function eliminarexperiencia(Request $data){
        
        $q= ExperienciaLabUser::find($data->id);
        Storage::delete($q->archivo);   
        
        $Exper = ExperienciaLabUser::find($data->id);
        $Exper->delete();
        $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');

        //____________________inicio interseccion fechas_______________

        $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
       
       if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       }else if($proceso[0]->consid_prac_preprof == 1){
         $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->orderBy('id','DESC')->get();  
       }else if($proceso[0]->consid_prac_prof == 1){
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->orderBy('id','DESC')->get();   
       }else{
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->orderBy('id','DESC')->get();    
       }
       //____________________fin interseccion fechas_______________

        return compact('suma_expgen','suma_expesp','query_inter');
            
    }
    
    public function editarformacion(Request $data){
        $query = FormacionUser::where('id',$data->id)->get();
        return $query;
    }

    public function editarcapacitacion(Request $data){
        $query = CapacitacionUser::where('id',$data->id)->get();
        return $query;
    }

    public function actualizar_formac_data(Request $data){
        
        //primero eliminar el archivo de formacion_academica
       

        $fu = FormacionUser::find($data->id); 
           
        if($data->file('archivo_formacion')){
            $q= FormacionUser::find($data->id);
            Storage::delete($q->archivo); 
            $fu->archivo = $data->file('archivo_formacion')->store('public/procesos/users/'.auth()->user()->dni.'/arch_formacion');
            $fu->archivo_tipo = "local";
        }

        $fu->user_id = auth()->user()->id;
        $fu->grado_id = $data->grado_id;
        $fu->fecha_inicio = $data->fecha_inicio;
        $fu->fecha_fin = $data->fecha_fin;
        $fu->fecha_expedicion = $data->fecha_expedicion;
        $fu->centro_estudios = $data->centro_estudios;
        $fu->especialidad = $data->especialidad;
        $fu->ciudad = $data->ciudad;
        $fu->pais = $data->pais;
       
        $fu->save();


        $query = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.archivo","formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre")
        ->where("formacion_users.id",$data->id)->get();
        //$query = FormacionUser::where('id',$data->id)->get();
        return $query;

    }
    
    public function actualizarcapacitacion_data(Request $data){
        
        $cu = CapacitacionUser::find($data->id); 

        if($data->file('archivo_capacitacion')){
            $q= CapacitacionUser::find($data->id);
            Storage::delete($q->archivo); //eliminar archivo ya cargado
            $cu->archivo = $data->file('archivo_capacitacion')->store('public/procesos/users/'.auth()->user()->dni.'/arch_capacitacion');
            $cu->archivo_tipo = "local";
        }
                        
        $cu->user_id = auth()->user()->id;
        $cu->es_curso_espec = $data->es_curso_espec;
        $cu->es_especializacion = $data->es_especializacion;
        $cu->es_diplomado = $data->es_diplomado;
        $cu->es_ofimatica = $data->es_ofimatica;
        $cu->es_idioma = $data->es_idioma;
        $cu->es_certificado = $data->es_certificado;
        $cu->es_licencia = $data->es_licencia;
                
        $cu->centro_estudios = $data->centro_estudios;
        $cu->especialidad = $data->especialidad;
        $cu->ciudad = $data->ciudad;
        $cu->pais = $data->pais;
        $cu->fecha_inicio = $data->fechainicio_capac;
        $cu->fecha_fin = $data->fechafin_capac;
        $cu->cantidad_horas = $data->cantidad_horas;
        $cu->nivel = $data->nivel_capa;

        $cu->save();
        try{
            $cu->save(); // returns false
            }
        catch(\Exception $e){
           // do task when error
           echo $e->getMessage();   // insert query
        }
    
        $query = CapacitacionUser::where('id',$data->id)->get();
        return $query;

    }
    

    public function editarexperiencia(Request $data){
        $query = ExperienciaLabUser::where('id',$data->id)->get();
        return $query;
    }

    public function actualizarexperiencia(Request $data){
        
        $Exper = ExperienciaLabUser::find($data->id);
        
        if($data->file('archivo_experiencia')){
            $q= ExperienciaLabUser::find($data->id);
            Storage::delete($q->archivo); //eliminar archivo ya cargado
            $Exper->archivo = $data->file('archivo_experiencia')->store('public/procesos/users/'.auth()->user()->dni.'/arch_exper');
            $Exper->archivo_tipo = "local";
        }

        $Exper->es_exp_gen = $data->es_exp_gen;
        $Exper->es_exp_esp = $data->es_exp_esp;
        $Exper->centro_laboral = $data->centro_laboral;
        
        $Exper->tipo_institucion = $data->tipo_institucion;
        $Exper->tipo_experiencia = $data->tipo_experiencia;
        $Exper->cargo_funcion = $data->cargo_funcion;
        $Exper->desc_cargo_funcion = $data->desc_cargo_funcion;
        $Exper->fecha_inicio = $data->fecha_inicio;
        $Exper->fecha_fin = $data->fecha_fin;
        //$Exper->num_pag = $data->num_pag;
        $Exper->dias_exp_gen =$data->dias_exp_gen;
        $Exper->dias_exp_esp = $data->dias_exp_esp;
        
        $Exper->save();
        
       $query = ExperienciaLabUser::where('id',$data->id)->get();
       /* $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');*/

        //____________________inicio interseccion fechas_______________

        $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
       
       if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
       }else if($proceso[0]->consid_prac_preprof == 1){
         $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->orderBy('id','DESC')->get();  
       }else if($proceso[0]->consid_prac_prof == 1){
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->orderBy('id','DESC')->get();   
       }else{
        $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->orderBy('id','DESC')->get();    
       }
       //____________________fin interseccion fechas_______________

        return compact('query','query_inter');
    }

    public function datosexpgenyesp(Request $data){

        
      $proceso_simple = Proceso::where('id',$data->idproceso)->get();
      //codigo agregado
      $tipo = Proceso::select('tipo_id')
                   ->where('id',$data->idproceso)->get();
      $tipo_proc = $tipo[0]->tipo_id;   
        
        //____________________inicio interseccion fechas_______________
        
        $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
        $min_expgen = $proceso[0]->dias_exp_lab_gen;
        $min_expesp = $proceso[0]->dias_exp_lab_esp;

            if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
            $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
            
           }else if($proceso[0]->consid_prac_preprof == 1){
            $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->orderBy('id','DESC')->get();  
            
           }else if($proceso[0]->consid_prac_prof == 1){
            $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->orderBy('id','DESC')->get();   
           
           }else{
            $query_inter = ExperienciaLabUser::select('fecha_inicio','fecha_fin','es_exp_gen','es_exp_esp')->where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->orderBy('id','DESC')->get();    
           
           }
       
         //____________________fin interseccion fechas_______________


       //return compact('min_expgen','min_expesp','query_inter');
       return compact('min_expgen','min_expesp','query_inter','tipo_proc');
       
    }

    public function datosformacion_general(Request $data){
        //___________colegiatura inicio_________
        
        $idDatosUser = DatosUser::where('user_id',auth()->user()->id)->select('id')->first();
        $du = DatosUser::find($idDatosUser->id);
        $src_colegiatura=null;
        if($data->colegiatura != ""){
            $du->colegiatura = $data->colegiatura;
            if($data->file('archivo_colegiatura')){
               $r= DatosUser::find($idDatosUser->id,'archivo_colegiatura');
                Storage::delete($r->archivo_colegiatura); //eliminar archivo ya cargado
                $du->archivo_colegiatura = $data->file('archivo_colegiatura')->store('public/procesos/users/'.auth()->user()->dni.'/colegiatura');
                $src_colegiatura = $du->archivo_colegiatura;     
            }
        }else{
            $du->colegiatura = NULL;
            $du->archivo_colegiatura = NULL;
            $r = DatosUser::find($idDatosUser->id,'archivo_colegiatura');
                Storage::delete($r->archivo_colegiatura);
        }
        $du->save();
        
       // DatosUser::where('user_id',auth()->user()->id)->update(['colegiatura' => $colegiatura]);
        //___________colegiatura fin______________

        $miformacion_max=FormacionUser::select('grado_id')
        ->where('user_id',auth()->user()->id)
        ->max('grado_id');
       
        $proceso = Proceso::find($data->idproceso,'nivel_acad_convocar');
        $form_nivel_requerido = $proceso->nivel_acad_convocar;

      /*  $archivo_colegiatura = DatosUser::find($idDatosUser,'archivo_colegiatura');
        */      
       return compact('form_nivel_requerido','miformacion_max','src_colegiatura'); 
     
      }

     public function declaracionjurada(Request $data){
        //Primero registramos la declaración jurada
       $idDatosUser = DatosUser::where('user_id',auth()->user()->id)->select('id')->get();
       $datosuser = DatosUser::find($idDatosUser[0]->id);
       $datosuser->dj1 = $data->dj1;
       $datosuser->dj2 = $data->dj2;
       $datosuser->dj3 = $data->dj3;
       $datosuser->dj4 = $data->dj4;
       $datosuser->dj5 = $data->dj5;
       $datosuser->dj6 = $data->dj6;
       $datosuser->dj7 = $data->dj7;
       $datosuser->dj8 = $data->dj8;
       //$datosuser->dj9 = $data->dj9;
       $datosuser->save();
       return "realizado";
     }

     public function cargar_resumen_postulante(Request $data){
      
        $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof')->where('id',$data->idproceso)->get();
       
        //Experiencia
        if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
         $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        }else if($proceso[0]->consid_prac_preprof == 1){
          $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->orderBy('id','DESC')->get();  
        }else if($proceso[0]->consid_prac_prof == 1){
         $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->orderBy('id','DESC')->get();   
        }else{
         $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->orderBy('id','DESC')->get();    
        }
        //CApacitaciones
        $hrs_min_cap_ind = Proceso::select('horas_cap_ind')->where('id',$data->idproceso)->first();
        $hrs_ind = intval($hrs_min_cap_ind['horas_cap_ind']);

        //$qcapa= CapacitacionUser::where("user_id",auth()->user()->id)->where('cantidad_horas','>=',$hrs_ind)->orWhere('es_certificado','=','1')->orWhere('es_licencia','=','1')->get();
        $a= CapacitacionUser::where("user_id",auth()->user()->id)->where('cantidad_horas','>=',$hrs_ind);
        $b= CapacitacionUser::where("user_id",auth()->user()->id)->where('es_certificado','=','1');
        $qcapa= CapacitacionUser::where("user_id",auth()->user()->id)->where('es_licencia','=','1')->union($a)->union($b)->get();

        //$qcapa->union($b,$c)->get();
        
        //Datospersonales
        $qdatos = DatosUser::where('user_id', auth()->user()->id)->first();

        //________________________________ubigeo_______________________________________________________
        if(DatosUser::select('nacionalidad','ubigeo_nacimiento','ubigeo_domicilio')->where('user_id',auth()->user()->id)->exists()){
            $du = DatosUser::select('nacionalidad','ubigeo_nacimiento','ubigeo_domicilio')->where('user_id',auth()->user()->id)->first();
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
        
        
        //Formacion
        $qform = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.archivo","formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre")
        ->where("formacion_users.user_id",auth()->user()->id)->get();
        
        return compact('qexp','qform','qdatos','qcapa','proceso','nacionalidad','desc_u_nac','desc_u_dom','cod_nac','cod_dom');
    }

    public function registrofinal(Request $data){
        $filtro_1 = $this->check_estado($data->idproceso);
        if($filtro_1['estado'] ){//preguntar  si el proceso aun está vigente
            return ['estado'=>false,'color'=>'rojo','mensaje'=>'NO SE REGISTRÓ SU POSTULACIÓN. El proceso '.$filtro_1['dato']->cod.' cerró el '.date_format(date_create($filtro_1['dato']->fecha_inscripcion_fin),"d/m/Y H:i")];
        }

        if($this->check_si_ya_postula()['estado']){  // preguntar si está postulando en algun proceso actualemnte
            return ['estado'=>false,'color'=>'naranja','mensaje'=>'Hemos detectado que ya se encuentra postulando a un proceso. Verifique su postulación ingresando a "Mis postulaciones"'];
        } 

        
        //Registro la postulacion
        $pos = new Postulante;
        $pos->user_id = auth()->user()->id;
        $pos->proceso_id = $data->idproceso;
        $pos->email = auth()->user()->email;
        $pos->save();

        
         //Almacena los datos de usuario a postulante
         $urlfoto_postulante = "";
         if(auth()->user()->img =='/imagenes/users/user.png'){
            $urlfoto_postulante = NULL;
         }else{
           $urlfoto_postulante = str_replace('foto_users/','foto_postulantes/'.$pos->id.'/',auth()->user()->img);
           Storage::copy(auth()->user()->img,$urlfoto_postulante);
         }
         
         $datos_usuario = DatosUser::where('user_id',auth()->user()->id)->get();
         $url_dni = "";
         $url_discap = "";
         $url_ffaa = "";
         $url_depor = "";
         unset($datos_usuario[0]->id); 
         unset($datos_usuario[0]->user_id);
         
            if($datos_usuario[0]->archivo_dni != NULL){
                $url_dni = str_replace('users/','postulantes/'.$pos->id.'/',$datos_usuario[0]->archivo_dni);
                Storage::copy($datos_usuario[0]->archivo_dni,$url_dni);
                $datos_usuario[0]->archivo_dni = $url_dni;
            }
            if($datos_usuario[0]->es_pers_disc == 1){
                $url_discap = str_replace('users/','postulantes/'.$pos->id.'/',$datos_usuario[0]->archivo_disc);
                Storage::copy($datos_usuario[0]->archivo_disc,$url_discap);
                $datos_usuario[0]->archivo_disc = $url_discap;
            }
            if($datos_usuario[0]->es_lic_ffaa == 1){
                $url_ffaa = str_replace('users/','postulantes/'.$pos->id.'/',$datos_usuario[0]->archivo_ffaa);
                Storage::copy($datos_usuario[0]->archivo_ffaa,$url_ffaa);
                $datos_usuario[0]->archivo_ffaa = $url_ffaa;
            }
            if($datos_usuario[0]->es_deportista == 1){
                $url_depor = str_replace('users/','postulantes/'.$pos->id.'/',$datos_usuario[0]->archivo_deport);
                Storage::copy($datos_usuario[0]->archivo_deport,$url_depor);
                $datos_usuario[0]->archivo_deport = $url_depor;
            }
            if($datos_usuario[0]->archivo_colegiatura != NULL){
                $url_coleg = str_replace('users/','postulantes/'.$pos->id.'/',$datos_usuario[0]->archivo_colegiatura);
                Storage::copy($datos_usuario[0]->archivo_colegiatura,$url_coleg);
                $datos_usuario[0]->archivo_colegiatura = $url_coleg;
            }

         $datos_usuario[0]->postulante_id = $pos->id;
         $datos_usuario[0]->archivo_foto = $urlfoto_postulante;
         DatosPostulante::create($datos_usuario[0]->toArray()); 

         //Almacenar formacion de usuario a postulante
         $cant1 = FormacionUser::where("user_id",auth()->user()->id)->get()->count();
         $datos_formacion = FormacionUser::where("user_id",auth()->user()->id)->get();
         for($i=0 ; $i<$cant1 ; $i++){
             $url_archivo="";
             unset($datos_formacion[$i]->id); 
             unset($datos_formacion[$i]->user_id);
             $url_archivo = str_replace('users/','postulantes/'.$pos->id.'/',$datos_formacion[$i]->archivo);
             Storage::copy($datos_formacion[$i]->archivo,$url_archivo);
             $datos_formacion[$i]->archivo = $url_archivo;
             $datos_formacion[$i]->postulante_id = $pos->id;
             FormacionPostulante::create($datos_formacion[$i]->toArray());
         }
        
         //Almacenar capacitaciones de usuario a postulante
         $hrs_min_cap_ind = Proceso::select('horas_cap_ind')->where('id',$data->idproceso)->first();
         $hrs_ind = intval($hrs_min_cap_ind['horas_cap_ind']);

         //$cant2 = CapacitacionUser::where("user_id",auth()->user()->id)->get()->count();
         //$datos_capacitacion = CapacitacionUser::where("user_id",auth()->user()->id)->get();
         $a= CapacitacionUser::where("user_id",auth()->user()->id)->where('cantidad_horas','>=',$hrs_ind);
         $b= CapacitacionUser::where("user_id",auth()->user()->id)->where('es_certificado','=','1');
         $cant2 = CapacitacionUser::where("user_id",auth()->user()->id)->where('es_licencia','=','1')->union($a)->union($b)->get()->count();
         $datos_capacitacion= CapacitacionUser::where("user_id",auth()->user()->id)->where('es_licencia','=','1')->union($a)->union($b)->get();
         
         for($i=0 ; $i<$cant2 ; $i++){
            $url_archivo="";
            //if(intval($datos_capacitacion[$i]->cantidad_horas) >= $hrs_ind){
             unset($datos_capacitacion[$i]->id); 
             unset($datos_capacitacion[$i]->user_id);
             $url_archivo = str_replace('users/','postulantes/'.$pos->id.'/',$datos_capacitacion[$i]->archivo);
             Storage::copy($datos_capacitacion[$i]->archivo,$url_archivo);
             $datos_capacitacion[$i]->archivo = $url_archivo;
             $datos_capacitacion[$i]->postulante_id = $pos->id;
             CapacitacionPostulante::create($datos_capacitacion[$i]->toArray());
            //}
         }
     
         //Almacenar experiencias de usuario a postulante CORREGIDO CON FILTRO DE PRACTICAS PRE Y PRO FESIONALES
         $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','dias_exp_lab_gen','dias_exp_lab_esp')->where('id',$data->idproceso)->get();
         if($proceso[0]->consid_prac_preprof == 1 && $proceso[0]->consid_prac_prof == 1){
             $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->get();
           }else if($proceso[0]->consid_prac_preprof == 1){
             $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,2])->get();  
           }else if($proceso[0]->consid_prac_prof == 1){
            $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1,3])->get();   
           }else{
            $qexp = ExperienciaLabUser::where('user_id',auth()->user()->id)->whereIn('tipo_experiencia',[1])->get();    
           }
        
           $cant3 = $qexp->count();
         //$cant3 = ExperienciaLabUser::where("user_id",auth()->user()->id)->get()->count();
         $datos_experiencia = $qexp;
        // $datos_experiencia = ExperienciaLabUser::where("user_id",auth()->user()->id)->get();
         
         for($i=0 ; $i<$cant3 ; $i++){
             $url_archivo="";
             unset($datos_experiencia[$i]->id); 
             unset($datos_experiencia[$i]->user_id);
             $url_archivo = str_replace('users/','postulantes/'.$pos->id.'/',$datos_experiencia[$i]->archivo);
             Storage::copy($datos_experiencia[$i]->archivo,$url_archivo);
             $datos_experiencia[$i]->archivo = $url_archivo;
             $datos_experiencia[$i]->postulante_id = $pos->id;
             ExperienciaLabPostulante::create($datos_experiencia[$i]->toArray());
         }
          
         
        return ['estado'=>true];//$urlfoto_postulante;
        
    }
    
     public function registro_postular(Request $data){
        
        $proceso = Proceso::where('id',$data->idproceso)->first();
        if($proceso->estado == 3 || $proceso->estado == 4){
            return redirect()->route('index');
        }

        
        $mensaje = "";
        $postulante = "";
        $datos_postulante = "";
        $desc_u_nac = "";
        $desc_u_dom = "";
        if(Postulante::where('user_id',auth()->user()->id)->where('proceso_id',$data->idproceso)->exists()){
            $pos = Postulante::select('id','estado_pos','email','created_at')->where('user_id',auth()->user()->id)->where('proceso_id',$data->idproceso)->first();
            
            $datos_postulante = DatosPostulante::select("ruc","telefono_celular","domicilio","ubigeo_domicilio","fecha_nacimiento","ubigeo_nacimiento","nacionalidad")
            ->where("postulante_id", "=", $pos->id)
            ->first();

            //_______________________inicoio __-ubigeo_____________________________
            if($datos_postulante['nacionalidad'] == "Peruano(a)"){
               // $cod_nac = $du->ubigeo_nacimiento;
                $u_nac = Ubigeo::select('desc_dep_reniec','desc_prov_reniec','desc_ubigeo_reniec')->where('cod_ubigeo_reniec',intval($datos_postulante['ubigeo_nacimiento']))->first();
                $desc_u_nac = $u_nac->desc_ubigeo_reniec.' - '.$u_nac->desc_prov_reniec.' - '.$u_nac->desc_dep_reniec;
            }else if($datos_postulante['nacionalidad'] == "Extranjero(a)"){
               // $cod_nac = $du->ubigeo_nacimiento;
                $desc_u_nac =$datos_postulante['ubigeo_nacimiento'];
            }
    
            //$cod_dom= $du->ubigeo_domicilio;
            $u_dom = Ubigeo::select('desc_dep_reniec','desc_prov_reniec','desc_ubigeo_reniec')->where('cod_ubigeo_reniec',intval($datos_postulante['ubigeo_domicilio']))->first();
            $desc_u_dom = $u_dom->desc_ubigeo_reniec.' - '.$u_dom->desc_prov_reniec.' - '.$u_dom->desc_dep_reniec;
            //_______________________-ubigeo fin_____________________________

           // $fechapos= Postulante::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
            //$horapos=Postulante::whereTime('created_at', '=', Carbon::now()->format('H:i'))->get();
            $postulante = Postulante::find($pos->id);
            if($pos['estado_pos'] == 0){
                $pp = Postulante::find($pos['id']);
                $pp->estado_pos = 1;
                $pp->save();
                //Envio de constancia al correo electronico
                $correo = new ConstPostulacionMailable($proceso, $datos_postulante, $pos,$desc_u_nac, $desc_u_dom );
                Mail::to(auth()->user()->email)->send($correo);

                
            } else{
                 
               $mensaje = "Usted ya se encuentra postulando al proceso ".$proceso->cod." - ".$proceso->nombre;
            }
            
        }else{
       return redirect()->route('postulante_postular',['idproceso' => $data->idproceso]);
        } 
     return view('postulante.finpostular',compact('proceso','datos_postulante','mensaje','pos','desc_u_nac','desc_u_dom'));
    
}

}