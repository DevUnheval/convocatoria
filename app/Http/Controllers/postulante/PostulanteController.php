<?php

namespace App\Http\Controllers\postulante;

use App\CapacitacionUser;
use App\DatosUser;
use App\FormacionUser;
use App\GradoFormacion;
use App\Http\Controllers\Controller;
use App\Proceso;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostulanteController extends Controller
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
        
    }

    public function formacion_data_prueba(){
        $dataform=FormacionUser::where('user_id',2)->get();
        //return datatables()->of($dataform)->toJson();
        return json_encode($dataform, true);
    }

    public function postular()
    {   
        $idproceso =$_GET["idproceso"];
        $proceso = Proceso::where('id',$idproceso)->get();
        
       // $datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        //->select("*")
        //->get();
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

        return view('postulante.postular',compact('datos_formacion','gradoformac','proceso','datos_usuario','datos_capacitacion','datos_experiencia'));
        //return dd(compact('datos_usuario','datos_formacion','datos_capacitacion','datos_experiencia'));
       // return view('postulante.postular',compact('proceso','proceso'));
       // return view('postulante.postular',compact('procesoseleccionado'));
    }

    public function actualizar(Request $data){
        
        //$datap =$data->nacionalidad;
        //return response()->json(['dataaa'=>$data->ruc]);
        //$datos_usuario = User::join("datos_users", "datos_users.user_id", "=", "users.id")
        //->select("*")
        //->get();
        $datosuser = DatosUser::find($data->id);
        $datosuser->telefono_celular = $data->celular;
        $datosuser->telefono_fijo = $data->telfijo;
        $datosuser->ruc = $data->ruc;
        $datosuser->domicilio = $data->domicilio;
        $datosuser->ubigeo = $data->ubigeodni;
        $datosuser->es_pers_disc = $data->dicapacidad;
        $datosuser->es_lic_ffaa = $data->ffaa;
        $datosuser->es_deportista = $data->deportista;
        $datosuser->save();

        $datosuser2 = User::find(auth()->user()->id);
        $datosuser2->nacionalidad = $data->nacionalidad;
        $datosuser2->fecha_nacimiento = $data->fechanac;
        $datosuser2->save();
        
        return response()->json(['mensaje'=>"correcto"]);

    }
   
    public function formacion_data1(){
        $query = FormacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        return $query;
    }
    
    public function capacitaciones_data1(){
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->orderBy('id','DESC')->get();
        if($query->isEmpty()){
            return true;
        }else{
            return $query;
        }
        
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

       // $query = FormacionUser::where('user_id','2')->select('grado_id','especialidad','centro_estudios','fecha_expedicion')->get();
        //return datatables()->of($query)->toJson();
        
        /*
       if($request->ajax()){
        $query = FormacionUser::where('user_id','2')->get();
       // if($query->count()<1)
        //return $this->data_null;

        return DataTables::of($query)
            ->addColumn('action',function($query){
        $acciones = '<a href="" class="btn btn-info btn-sm">Editar</a>';
        $acciones .= '<button type="button" name="btneliminarform" id="btneliminarform" class="btn btn-danger btn-sm">Eliminar </button>';
                return $acciones;
            })
            ->rawColumns(['action'])
            ->make(true);

            

    }
     return view('postulante.postular');   
   */
}

    public function guardarformacion(Request $data){
        
        //$datap =$data->nacionalidad;
        //return response()->json(['dataaa'=>$data->ruc]);
        
       $fu = new FormacionUser;
        
        $fu->user_id = $data->user_id;
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
    
        $query = FormacionUser::where('user_id',auth()->user()->id)->get()->last();
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
        $cu->archivo ="null";
        $cu->archivo_tipo = "null";
        $cu->cantidad_horas = $data->cantidad_horas;
        $cu->nivel = $data->nivel_capa;
        $cu->save();
    
        $query = CapacitacionUser::where('user_id',auth()->user()->id)->get()->last();
        return $query;

    }

    public function eliminarcapacitacion(Request $data){
        
        $Capac = CapacitacionUser::find($data->id);
        $Capac->delete();
        
        return "eliminadoCApac";
    }

    
    
}