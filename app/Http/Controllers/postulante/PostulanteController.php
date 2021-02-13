<?php

namespace App\Http\Controllers\postulante;

use App\CapacitacionUser;
use App\DatosUser;
use App\ExperienciaLabUser;
use App\FormacionUser;
use App\GradoFormacion;
use App\Http\Controllers\Controller;
use App\Proceso;
use App\User;
use Illuminate\Http\Request;


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
       

    public function postular()
    {   
        $idproceso =$_GET["idproceso"];
        $proceso = Proceso::where('id',$idproceso)->get();
        $proceso_formacion = Proceso::join("grado_formacions", "grado_formacions.id", "=", "procesos.nivel_acad_convocar")
        ->select("grado_formacions.nombre")
        ->where("procesos.id",$_GET["idproceso"])
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

        return view('postulante.postular',compact('proceso_formacion','datos_formacion','gradoformac','proceso','datos_usuario','datos_capacitacion','datos_experiencia'));
        
    }

    public function actualizar_o_registrar(Request $data){
        
        //$datap =$data->nacionalidad;
        //return response()->json(['dataaa'=>$data->ruc]);
        //$datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        //->select("*")
        //->get();
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

        $datosuser->archivo_dni = "";
        $datosuser->archivo_dni_tipo = "";

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

        $datosuserno->save();
            
        }

       
        return response()->json(['mensaje'=>"Datos guardados con exito!!"]);

    }
   
    public function formacion_data1(){
        $query = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre")
        ->where("formacion_users.user_id",auth()->user()->id)->get();
        //$query = FormacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        return $query;
    }
    
    public function capacitaciones_data1(){
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        
            return $query;
        }
    public function experiencias_data1(){
            $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
            
                return $query;
            }

    public function formacion_data(){

        $query = FormacionUser::where('user_id','2')->select('grado_id','especialidad','centro_estudios','fecha_expedicion')->get();
       // if($query->count()<1)
        //return $this->data_null;
    
        foreach ($query as $dato) {
            
                    $idproceso=$dato->id;
                    $postular = '<a class="btn btn-info waves-effect waves-light" href="'.route("postulante_postular",["idproceso" => $idproceso]).'" type="button"><span class="btn-label"><i class="icon-login"></i></span> Postular</a>';
                    $postular .= '<a class="btn btn-info waves-effect waves-light" href="'.route("postulante_postular",["idproceso" => $idproceso]).'" type="button"><span class="btn-label"><i class="icon-login"></i></span> Postular</a>';
                
            

            
                $data['aaData'][] = [ $dato->grado_id,$dato->especialidad,$dato->centro_estudios,$dato->fecha_expedicion,$postular];
           
            
        }
        return json_encode($data, true);  

}

    public function guardarformacion(Request $data){
        
        //$datap =$data->nacionalidad;
        //return response()->json(['dataaa'=>$data->ruc]);
        
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
        $fu-> archivo ="null";
        $fu->archivo_tipo = "null";
        $fu->save();
    
        $query = FormacionUser::join("grado_formacions", "grado_formacions.id", "=", "formacion_users.grado_id")
        ->select("formacion_users.fecha_expedicion","formacion_users.centro_estudios","formacion_users.especialidad","formacion_users.id","grado_formacions.nombre")
        ->where("formacion_users.user_id",auth()->user()->id)->get()->last();
        //$query = FormacionUser::where('user_id',auth()->user()->id)->get()->last();
        return $query;

    }

    public function eliminarformacion(Request $data){
       
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
        $cu->archivo ="null";
        $cu->archivo_tipo = "null";
        $cu->cantidad_horas = $data->cantidad_horas;
        $cu->nivel = $data->nivel_capa;
        $cu->save();
    
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->get()->last();
        return $query;

    }

    public function eliminarcapacitacion(Request $data){
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
        $el->dias_exp_gen =$data->dias_exp_gen;
        $el->dias_exp_esp = $data->dias_exp_esp;
        
        $el->save();
    
        $query = ExperienciaLabUser::where('user_id',auth()->user()->id)->get()->last();
        return $query;

    }

    public function eliminarexperiencia(Request $data){
        
        $Exper = ExperienciaLabUser::find($data->id);
        $Exper->delete();
        
        return "eliminadoEXPERIENCIA";
    }
    
    public function editarexperiencia(Request $data){
        $query = ExperienciaLabUser::where('id',$data->id)->get();
        return $query;
    }

    public function actualizarexperiencia(Request $data){
        
        $Exper = ExperienciaLabUser::find($data->id);
        
        //$Exper->user_id = $data->user_id_exp;
        $Exper->es_exp_gen = $data->es_exp_gen;
        $Exper->es_exp_esp = $data->es_exp_esp;
        $Exper->centro_laboral = $data->centro_laboral;
        
        $Exper->tipo_institucion = $data->tipo_institucion;
        $Exper->tipo_experiencia = $data->tipo_experiencia;
        $Exper->cargo_funcion = $data->cargo_funcion;
        $Exper->desc_cargo_funcion = $data->desc_cargo_funcion;
        $Exper->fecha_inicio = $data->fecha_inicio;
        $Exper->fecha_fin = $data->fecha_fin;
        $Exper->dias_exp_gen =$data->dias_exp_gen;
        $Exper->dias_exp_esp = $data->dias_exp_esp;
        
        $Exper->save();
        
        $query = ExperienciaLabUser::where('id',$data->id)->get();
        return $query;
    }

    public function datosexpgenyesp(Request $data){

        $suma_expgen = ExperienciaLabUser::select('dias_exp_gen')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_gen');
        $suma_expesp = ExperienciaLabUser::select('dias_exp_esp')
        ->where('user_id',auth()->user()->id)
        ->sum('dias_exp_esp');

        return compact('suma_expgen','suma_expesp');
    }
    
    
}