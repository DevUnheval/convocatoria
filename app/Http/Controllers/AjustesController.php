<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Ajuste;
use DB;
class AjustesController extends Controller
{	public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('admin');
    }

    public function index(){
    	$ajustes=Ajuste::get();
    	return view('maestro.ajustes',compact('ajustes'));
    }
    public function update(Request $r){
		$ajustes = $this->data();
		foreach ($ajustes as $key => $value) {
			$i=$key+1;
			$valor='elemento_'.$i;
			if($value['tipo']=='imagen'){
				if($r->file($valor)){
					$archivo_actual=Ajuste::find($i);
					//Eliminamos el imagen que existía
					Storage::delete($archivo_actual->valor);
					$name= $r->file($valor)->store('public/ajustes/img');
					$query[$i] = DB::table('ajustes')->where('id', $i)->update(['valor' => $name]);
				}

			}else{
				$query[$i] = DB::table('ajustes')->where('id', $i)->update(['valor' => $r->$valor]);
			}
		}
    	   	
    	return redirect()->route('maestro.ajustes.index');
    }

    public function restablecer(){
    	$ajustes = $this->data();
    	$query=[];
    	foreach ($ajustes as $key => $value) {
    		$query[$key+1] = DB::table('ajustes')->where('id', ($key+1))->update(['valor' => $value['valor']]);
    	}
    	Storage::deleteDirectory('public/ajustes/img');
    	return redirect()->route('maestro.ajustes.index');

    }

    public function data(){
    	return [
			['nombre'=>'institucion','valor'=>'Universidad Nacional Hermilio Valdizán','descripcion'=>'Nombre de la institución','tipo'=>'texto'],
			['nombre'=>'título','valor'=>'Convocatoria de Personal','descripcion'=>'Aparecerá en el título del proyecto, aparecerá en los reportes PDF','tipo'=>'texto'],
			['nombre'=>'nombre del año','valor'=>'Año del Bicentenario del Perú: 200 años de independencia','descripcion'=>'Nombre del año actual, aparecerá en los reportes PDF','tipo'=>'texto'],
			['nombre'=>'pie pagina 1','valor'=>'Copyright © 2021 CONVOCATORIA Personal, Todos los derechos Reservados.','descripcion'=>'texto grande','tipo'=>'texto'],
			['nombre'=>'pie pagina 2','valor'=>' Desarrollado por FREDDY VIGILIO ARRATEA','descripcion'=>'texto pequeño','tipo'=>'texto'],
			['nombre'=>'icono','valor'=>'imagenes/ajustes/icono.ico','descripcion'=>'Ícono del proyecto','tipo'=>'imagen'],
			['nombre'=>'logo','valor'=>'imagenes/ajustes/logo.png', 'descripcion'=>'Logo principal, símbolo','tipo'=>'imagen'],
			['nombre'=>'logo texto 1','valor'=>'imagenes/ajustes/logo-light-text.png','descripcion'=>'Logo de texto claro','tipo'=>'imagen'],
			['nombre'=>'logo texto 2','valor'=>'imagenes/ajustes/logo-text.png','descripcion'=>'Logo de texto oscuro, login','tipo'=>'imagen'],
			['nombre'=>'imagen fondo login','valor'=>'imagenes/ajustes/background.jpg','descripcion'=>'Imagen de fondo en la vista login','tipo'=>'imagen'],
			['nombre'=>'manual usuario','valor'=>'https://drive.google.com/file/d/13aQiZQ-lUr8iWDP4Tvf-bEkvYEN2dUl4/view?usp=sharing','descripcion'=>'Manual de usuario','tipo'=>'archivo_ruta'],
			['nombre'=>'manual administrador','valor'=>'https://drive.google.com/file/d/13aQiZQ-lUr8iWDP4Tvf-bEkvYEN2dUl4/view?usp=sharing','descripcion'=>'Manual de uso para el administrador','tipo'=>'archivo_ruta'],
			['nombre'=>'video tutorial usuario','valor'=>'#','descripcion'=>'Video tutorial para usuario','tipo'=>'archivo_ruta'],
			['nombre'=>'video tutorial administrador','valor'=>'#','descripcion'=>'Video tutorial para el administrador','tipo'=>'archivo_ruta'],
			['nombre'=>'confirmación de correo','valor'=>'1','descripcion'=>'¿Para concluir con el registro de una cuenta se debe confirmar el correo electrónico?','tipo'=>'booleano'],
			['nombre'=>'Peso archivo (B)','valor'=>'3145728','descripcion'=>'Peso máximo de los archivos a subir, en Bytes (B). => 1MB = 1048576B','tipo'=>'numero'],
		];
    }
}
