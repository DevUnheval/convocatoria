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
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostulanteController extends Controller
{
    public function __construct()
    {
       /* $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';*/
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
    public function datosuser_data1(){
        
        if(DatosUser::where('user_id',auth()->user()->id)->exists()){
            $query = DatosUser::where('user_id', auth()->user()->id)->get();
            return $query;
        }else{
            return response()->json(['valor'=>"0"]);
        }


    }
       

    public function postular($idproceso)
    {
        
        $proceso = Proceso::where('id',$idproceso)->first();
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

        return view('postulante.postular',compact('proceso_formacion','datos_formacion','gradoformac','proceso','datos_usuario','datos_capacitacion','datos_experiencia','ubigeos'));
        
    }

    public function actualizar_o_registrar(Request $data){
        
        if(DatosUser::where('user_id',auth()->user()->id)->exists()){
        
          $idDatosUser = DatosUser::where('user_id',auth()->user()->id)->select('id')->get();

                  
        $datosuser = DatosUser::find($idDatosUser[0]->id);
        $datosuser->telefono_celular = $data->celular;
        $datosuser->telefono_fijo = $data->telfijo;
        $datosuser->ruc = $data->ruc;
        $datosuser->domicilio = $data->domicilio;
        $datosuser->ubigeo_nacimiento = $data->ubigeodni;
        $datosuser->ubigeo_domicilio = $data->ubigeo_domicilio;
        $datosuser->es_pers_disc = $data->dicapacidad;
        $datosuser->es_lic_ffaa = $data->ffaa;
        $datosuser->es_deportista = $data->deportista;
        $datosuser->nacionalidad = $data->nacionalidad;
        $datosuser->fecha_nacimiento = $data->fechanac;
       
        //$name= $data->file('archivo_bases')->store('public/procesos/bases');
        //archivo discapacidad
        $datosuser->archivo_dni = "";
        $datosuser->archivo_dni_tipo = "";

        if($data->file('archivo_discapacidad')){
            $p= DatosUser::find($idDatosUser[0]->id);
            Storage::delete($p->archivo_disc); //eliminar archivo ya cargado
            $datosuser->archivo_disc = $data->file('archivo_discapacidad')->store('public/procesos/arch_discapacidad');
            $datosuser->archivo_disc_tipo = "local";
            }else{$datosuser->archivo_disc = NULL; $datosuser->archivo_disc_tipo = NULL; }
            //archivo discapacidad
            if($data->file('archivo_ffaa')){
                $q= DatosUser::find($idDatosUser[0]->id);
                Storage::delete($q->archivo_ffaa); //eliminar archivo ya cargado
                $datosuser->archivo_ffaa = $data->file('archivo_ffaa')->store('public/procesos/arch_ffaa');
                $datosuser->archivo_ffaa_tipo = "local";
                }else{$datosuser->archivo_ffaa = NULL; $datosuser->archivo_ffaa_tipo = NULL; }
            //archivo discapacidad
            if($data->file('archivo_deport')){
                $r= DatosUser::find($idDatosUser[0]->id);
                Storage::delete($r->archivo_deport); //eliminar archivo ya cargado
                $datosuser->archivo_deport = $data->file('archivo_deport')->store('public/procesos/arch_deportista');
                $datosuser->archivo_deport_tipo = "local";
                }else{$datosuser->archivo_deport = NULL; $datosuser->archivo_deport_tipo = NULL; }
        
        
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
        
        $datosuserno->archivo_dni = "";
        $datosuserno->archivo_dni_tipo = "";

        //archivo discapacidad
        if($data->file('archivo_discapacidad')){
        $datosuserno->archivo_disc = $data->file('archivo_discapacidad')->store('public/procesos/arch_discapacidad');
        $datosuserno->archivo_disc_tipo = "local";
        }else{$datosuserno->archivo_disc = NULL; $datosuserno->archivo_disc_tipo = NULL; }
        //archivo discapacidad
        if($data->file('archivo_ffaa')){
            $datosuserno->archivo_ffaa = $data->file('archivo_ffaa')->store('public/procesos/arch_ffaa');
            $datosuserno->archivo_ffaa_tipo = "local";
            }else{$datosuserno->archivo_ffaa = NULL; $datosuserno->archivo_ffaa_tipo = NULL; }
        //archivo discapacidad
        if($data->file('archivo_deport')){
            $datosuserno->archivo_deport = $data->file('archivo_deport')->store('public/procesos/arch_deportista');
            $datosuserno->archivo_deport_tipo = "local";
            }else{$datosuserno->archivo_deport = NULL; $datosuserno->archivo_deport_tipo = NULL; }
                

        $datosuserno->save();
            
        }

   
        return response()->json(['mensaje'=>"Datos guardados con exito!!"]);

    }
   
    public function formacion_data1(){
        $query = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.archivo","formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre")
        ->where("formacion_users.user_id",auth()->user()->id)->get();
        //$query = FormacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        return $query;
    }
    
    public function capacitaciones_data1(){
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        
            return $query;
        }
    public function experiencias_data1(Request $data){
            $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
            $proceso = Proceso::select('consid_prac_preprof','consid_prac_prof','anios_exp_lab_gen','anios_exp_lab_esp')->where('id',$data->idproceso)->get();
                return compact('query','proceso'); //REVISAR CÓDIGO DESPUÉS
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
        
        $fu->archivo = $data->file('archivo_formacion')->store('public/procesos/arch_formacion');
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
        //return response()->json(['dataaa'=>$data->ruc]);
        
       $cu = new CapacitacionUser();
        
        $cu->user_id = auth()->user()->id;
        $cu->es_curso_espec = $data->es_curso_espec;
        $cu->es_ofimatica = $data->es_ofimatica;
        $cu->es_idioma = $data->es_idioma;
        
        $cu->centro_estudios = $data->centro_estudios;
        $cu->especialidad = $data->especialidad;
        $cu->ciudad = $data->ciudad;
        $cu->pais = $data->pais;
        $cu->fecha_inicio = $data->fechainicio_capac;
        $cu->fecha_fin = $data->fechafin_capac;
        $cu->archivo = $data->file('archivo_capacitacion')->store('public/procesos/arch_capacitacion');
        $cu->archivo_tipo = "local";
        $cu->cantidad_horas = $data->cantidad_horas;
        $cu->nivel = $data->nivel_capa;
        $cu->save();
    
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
        $el->num_pag = $data->num_pag;
        $el->dias_exp_gen =$data->dias_exp_gen;
        $el->dias_exp_esp = $data->dias_exp_esp;

        $el->archivo = $data->file('archivo_experiencia')->store('public/procesos/arch_exper');
        $el->archivo_tipo = "local";
        
        $el->save();
    
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->get()->last();
        $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');


        return compact('query','suma_expgen','suma_expesp');

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

        return compact('suma_expgen','suma_expesp');
            
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
            $fu->archivo = $data->file('archivo_formacion')->store('public/procesos/arch_formacion');
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
            $cu->archivo = $data->file('archivo_capacitacion')->store('public/procesos/arch_capacitacion');
            $cu->archivo_tipo = "local";
        }
                        
        $cu->user_id = auth()->user()->id;
        $cu->es_curso_espec = $data->es_curso_espec;
        $cu->es_ofimatica = $data->es_ofimatica;
        $cu->es_idioma = $data->es_idioma;
                
        $cu->centro_estudios = $data->centro_estudios;
        $cu->especialidad = $data->especialidad;
        $cu->ciudad = $data->ciudad;
        $cu->pais = $data->pais;
        $cu->fecha_inicio = $data->fechainicio_capac;
        $cu->fecha_fin = $data->fechafin_capac;
        $cu->cantidad_horas = $data->cantidad_horas;
        $cu->nivel = $data->nivel_capa;

        $cu->save();
    
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
            $Exper->archivo = $data->file('archivo_experiencia')->store('public/procesos/arch_exper');
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
        $Exper->num_pag = $data->num_pag;
        $Exper->dias_exp_gen =$data->dias_exp_gen;
        $Exper->dias_exp_esp = $data->dias_exp_esp;
        
        $Exper->save();
        
        $query = ExperienciaLabUser::where('id',$data->id)->get();
        $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');


        return compact('query','suma_expgen','suma_expesp');
    }

    public function datosexpgenyesp(Request $data){

        $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');
        $proceso = Proceso::where('id',$data->idproceso)->get();
        $min_expgen = $proceso[0]->anios_exp_lab_gen;
        $min_expesp = $proceso[0]->anios_exp_lab_esp;

       return compact('suma_expgen','suma_expesp','min_expgen','min_expesp');
       
    }
    public function datosformacion_general(Request $data){

        $miformacion_max=FormacionUser::select('grado_id')
        ->where('user_id',auth()->user()->id)
        ->max('grado_id');
        $proceso = Proceso::where('id',$data->idproceso)->get();
        $form_nivel_requerido = $proceso[0]->nivel_acad_convocar;
       
        
       return compact('form_nivel_requerido','miformacion_max');
       
    }

    public function registrofinal(Request $data){
        
        //REgistro de la declaración jurada
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
        $datosuser->dj9 = $data->dj9;
        $datosuser->save();

        //Registro la postulacion
        $pos = new Postulante;
        $pos->user_id = auth()->user()->id;
        $pos->proceso_id = $data->idproceso;
        $pos->save();

        
         //Almacena los datos de usuario a postulante
         $datos_usuario = DatosUser::where('user_id',auth()->user()->id)->get();
         unset($datos_usuario[0]->id); 
         unset($datos_usuario[0]->user_id);
         $datos_usuario[0]->postulante_id = $pos->id;
         DatosPostulante::create($datos_usuario[0]->toArray()); 
   
         //Almacenar formacion de usuario a postulante
         $cant1 = FormacionUser::where("user_id",auth()->user()->id)->get()->count();
         $datos_formacion = FormacionUser::where("user_id",auth()->user()->id)->get();
         
         for($i=0 ; $i<$cant1 ; $i++){
             unset($datos_formacion[$i]->id); 
             unset($datos_formacion[$i]->user_id);
             $datos_formacion[$i]->postulante_id = $pos->id;
             FormacionPostulante::create($datos_formacion[$i]->toArray());
         }
        
         //Almacenar capacitaciones de usuario a postulante
         $cant2 = CapacitacionUser::where("user_id",auth()->user()->id)->get()->count();
         $datos_capacitacion = CapacitacionUser::where("user_id",auth()->user()->id)->get();
         
         for($i=0 ; $i<$cant2 ; $i++){
             unset($datos_capacitacion[$i]->id); 
             unset($datos_capacitacion[$i]->user_id);
             $datos_capacitacion[$i]->postulante_id = $pos->id;
             CapacitacionPostulante::create($datos_capacitacion[$i]->toArray());
         }
     
         //Almacenar experiencias de usuario a postulante
         $cant3 = ExperienciaLabUser::where("user_id",auth()->user()->id)->get()->count();
         $datos_experiencia = ExperienciaLabUser::where("user_id",auth()->user()->id)->get();
         
         for($i=0 ; $i<$cant3 ; $i++){
             unset($datos_experiencia[$i]->id); 
             unset($datos_experiencia[$i]->user_id);
             $datos_experiencia[$i]->postulante_id = $pos->id;
             ExperienciaLabPostulante::create($datos_experiencia[$i]->toArray());
         }
             
         return "Registro de convocatoria con exito = ID = ";//.$pos->id;
     }
    
     public function registro_postular($idproceso){

        // PARA QUE SE ENVÍE EL CORREO ES NECESARIO VERIFICAR 
        // QUE EL USUARIO TIENE UNA POSTULACIÓN AL PROCESO ACTUAL
        // DE LO CONTRARIO NO SE ENVIARÁ
        // FALTA INCLUIR CONDICIONAL.
        
        $proceso = Proceso::where('id',$idproceso)->first();
        $datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        ->select("*")
        ->where("datos_users.user_id", "=", auth()->user()->id)
        ->first();
        //$datos_usuario = DatosUser::where('user_id',auth()->user()->id)->get();
       
       //Envio de constancia al correo electronico
        $correo = new ConstPostulacionMailable($proceso, $datos_usuario);
        Mail::to($datos_usuario->email)->send($correo);


        return view('postulante.finpostular',compact('proceso','datos_usuario'));
     }
  
    
}