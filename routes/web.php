<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
//use SebastianBergmann\Environment\Console;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () { return view('convocatorias.vigentes.index'); })->name('index');
Route::get('/', 'ConvocatoriaController@vigentes')->name('index'); 

//Rutas AUTH
Auth::routes(['verify' => true]);
Route::get('postulante', 'postulante\PostulanteController@index')->middleware('verified')->name('postulante_inicio');
Route::get('registro', 'UsuarioController@index')->name('registro_usuario');
Route::post('registro_post', 'UsuarioController@registrar')->name('registro_usuario_post');
Route::get('/api_reniec/{dni}/dni','UsuarioController@api_reniec');//camboar a post

Route::get('login', function(){return Auth::check() ? redirect()->route('index') : view('auth.login');})->name('login');
Route::post('validaracceso', 'Auth\LoginController@login')->name('validaracceso');
Route::post('logout', 'Auth\LoginController@logout')->name('logout')->middleware(['auth']);
Route::get('perfil', 'Auth\PerfilController@index')->name('perfil')->middleware(['auth','verified']);
 //JOSE AQUI TUS RUTAS
 //Fin Auth


//MAESTRO
Route::group(['prefix' => 'maestro'], function(){
 // Rutas ajustes
    Route::group(['prefix' => 'ajustes'], function(){
        Route::get('/', 'AjustesController@index')->name('maestro.ajustes.index')->middleware(['auth','Administrador']);  
        Route::post('update', 'AjustesController@update')->name('maestro.ajustes.update')->middleware(['auth','Administrador']);;  
        Route::get('reset', 'AjustesController@restablecer')->name('maestro.ajustes.restablecer')->middleware(['auth','Administrador']);
    });   
    Route::group(['prefix' => 'usuarios'], function(){
        Route::get('/', 'maestro\UsuarioController@index')->name('maestro.usuarios.index')->middleware(['auth','Administrador']);  
        Route::post('update/{id}', 'maestro\UsuarioController@update')->where(['id' => '[0-9]+'])->name('maestro.usuarios.update')->middleware(['auth','Administrador']);  
        Route::get('edit/{id}', 'maestro\UsuarioController@edit')->where(['id' => '[0-9]+'])->name('maestro.usuarios.edit')->middleware(['auth','Administrador']);  
        Route::get('data', 'maestro\UsuarioController@data')->name('maestro.usuarios.data');  
    }); 
    Route::group(['prefix' => 'procesos'], function(){
        Route::get('/', 'maestro\ProcesoController@index')->name('maestro.proceso.index')->middleware(['auth']);
        Route::post('update/{id}', 'maestro\ProcesoController@update')->where(['id' => '[0-9]+'])->name('maestro.proceso.update')->middleware(['auth','Administrador']);  
        Route::post('store', 'maestro\ProcesoController@store')->name('maestro.proceso.store')->middleware(['auth','Comisionado']);  
        Route::get('data', 'maestro\ProcesoController@data')->name('maestro.proceso.data');  
        Route::get('editar/{id}', 'maestro\ProcesoController@edit')->where(['id' => '[0-9]+'])->name('maestro.proceso.editar')->middleware(['auth','Administrador']);  
        
    }); 
    Route::group(['prefix' => 'formacion'], function(){
        Route::get('/', 'maestro\FormacionController@index')->name('maestro.formacion.index')->middleware(['auth']); 
        Route::post('update/{id}', 'maestro\FormacionController@update')->where(['id' => '[0-9]+'])->name('maestro.formacion.update')->middleware(['auth','Administrador']); 
        Route::post('store', 'maestro\FormacionController@store')->name('maestro.formacion.store')->middleware(['auth','Comisionado']);  
        Route::get('data', 'maestro\FormacionController@data')->name('maestro.formacion.data');  
        Route::get('editar/{id}', 'maestro\FormacionController@edit')->where(['id' => '[0-9]+'])->name('maestro.formacion.editar')->middleware(['auth','Administrador']); 
    }); 
});

//CONVOCATORIAS
Route::group(['prefix' => 'convocatorias'], function(){
    // Vistas 
    Route::get('vigentes', 'ConvocatoriaController@vigentes')->name('convocatoria.vigentes'); 
    Route::get('en_curso', 'ConvocatoriaEnCursoController@index')->name('convocatoria.en_curso');
    Route::get('historico/cancelado', 'ConvocatoriaHistoricoController@index_cancelados')->name('convocatorias.historico.cancelados.index');
    Route::get('historico/concluido', 'ConvocatoriaHistoricoController@index_concluidos')->name('convocatorias.historico.concluidos.index');
    
    //CRUD
    Route::get('vigentes/data', 'ConvocatoriaController@vigentes_data')->name('convocatoria.vigentes.data');
    Route::get('en_curso/data', 'ConvocatoriaEnCursoController@data')->name('convocatoria.en_curso.data');   
    Route::get('historico/concluido/data', 'ConvocatoriaHistoricoController@data_concluidos')->name('convocatoria.historico.concluidos.data_concluidos');
    Route::get('historico/cancelado/data', 'ConvocatoriaHistoricoController@data_cancelados')->name('convocatoria.historico.cancelados.data_cancelados');  
    Route::post('store', 'ConvocatoriaController@store')->name('convocatoria.store')->middleware(['auth','Comisionado']);  
    Route::get('edit/{id}', 'ConvocatoriaController@edit')->where(['id' => '[0-9]+'])->name('convocatoria.edit');//->middleware(['auth','Administrador']); 
    Route::post('update', 'ConvocatoriaController@update')->name('convocatoria.update')->middleware(['auth','Administrador']);  
    Route::get('resultado/{id}', 'ConvocatoriaEnCursoController@resultado')->where(['id' => '[0-9]+'])->name('convocatoria.en_curso.resultado')->middleware(['auth']);  
    Route::post('update_resultado', 'ConvocatoriaEnCursoController@update_resultado')->name('convocatoria.en_curso.update_resultado')->middleware(['auth','Administrador']); 

    //Route::get('listar/{estado?}/{etapa?}', 'AjustesController@restablecer')->name('convocatoria.listar');    
    Route::get('show_comunicados/{proceso_id}', 'ConvocatoriaController@show_comunicados')->name('convocatoria.comunicados');//->middleware(['auth']);   
    Route::get('show_evaluacion/{proceso_id}', 'ConvocatoriaEnCursoController@show_evaluacion')->name('convocatoria.en:curso.comunicados')->middleware(['auth']);     
    Route::post('guardar_comunicados', 'ConvocatoriaController@guardar_comunicados')->name('convocatoria.comunicados.guardar')->middleware(['auth','Administrador']);  
    Route::post('guardar_evaluacion', 'ConvocatoriaEnCursoController@guardar_evaluacion')->name('convocatoria.en_curso.guardar_evaluacion')->middleware(['auth','Administrador']);     
    Route::post('eliminar_comunicado/{id}', 'ConvocatoriaController@eliminar_comunicado')->where(['id' => '[0-9]+'])->name('convocatoria.comunicados.eliminar')->middleware(['auth','Administrador']);    
    Route::post('eliminar_evaluacion/{id}', 'ConvocatoriaEnCursoController@eliminar_evaluacion')->where(['id' => '[0-9]+'])->name('convocatoria.en_curso.comunicados.eliminar')->middleware(['auth','Administrador']);
    Route::post('eliminar_convocatoria/{id}', 'ConvocatoriaController@destroy')->where(['id' => '[0-9]+'])->name('convocatoria.procesos.eliminar')->middleware(['auth','Administrador']);    
    Route::post('cancelar_convocatoria/{id}', 'ConvocatoriaController@cancelar_convocatoria')->where(['id' => '[0-9]+'])->name('convocatoria.procesos.cancelar')->middleware(['auth','Administrador']);
    Route::post('concluir_convocatoria/{id}', 'ConvocatoriaEnCursoController@concluir_convocatoria')->where(['id' => '[0-9]+'])->name('convocatoria.procesos.concluir')->middleware(['auth','Administrador']);
});

//POSTULANTE
Route::group(['prefix' => 'postulante'], function(){
    // Vistas 
    Route::get('postular/{idproceso}', 'postulante\PostulanteController@postular')->where(['idproceso' => '[0-9]+'])->name('postulante_postular')->middleware(['auth','verified','Postulante']);
    Route::get('datosuser/data1', 'postulante\PostulanteController@datosuser_data1')->name('datosuser_data1')->middleware(['auth']);
    Route::get('formacion/data1', 'postulante\PostulanteController@formacion_data1')->name('formacion_data1')->middleware(['auth']);
    //Route::get('formacion/data', 'postulante\PostulanteController@formacion_data')->name('formacion_data')->middleware(['auth','Postulante']);
    Route::post('actualizardatos', 'postulante\PostulanteController@actualizar_o_registrar')->name('actualizardatos')->middleware(['auth','verified','Postulante']); 
    Route::post('guardarformacion', 'postulante\PostulanteController@guardarformacion')->name('guardarformacion')->middleware(['auth','verified','Postulante']); 
    Route::post('eliminarformacion', 'postulante\PostulanteController@eliminarformacion')->name('eliminarformacion')->middleware(['auth','verified','Postulante']);
    Route::get('capacitaciones/data1', 'postulante\PostulanteController@capacitaciones_data1')->name('capacitaciones_data1')->middleware(['auth']);
    Route::post('guardarcapacitacion', 'postulante\PostulanteController@guardarcapacitacion')->name('guardarcapacitacion')->middleware(['auth','verified','Postulante']);
    Route::post('eliminarcapacitacion', 'postulante\PostulanteController@eliminarcapacitacion')->name('eliminarcapacitacion')->middleware(['auth','verified','Postulante']);
    Route::get('experiencias/data1', 'postulante\PostulanteController@experiencias_data1')->name('experiencias_data1')->middleware(['auth','Postulante']);
    Route::get('experiencias/data1/perfil', 'postulante\PostulanteController@experiencias_data1_perfil')->name('experiencias_data1_perfil')->middleware(['auth']);
    Route::post('guardarexperiencia', 'postulante\PostulanteController@guardarexperiencia')->name('guardarexperiencia')->middleware(['auth','verified','Postulante']);
    Route::post('perfil/guardarexperiencia', 'Auth\PerfilController@guardarexperiencia')->name('guardarexperiencia_perfil')->middleware(['auth','verified','Postulante']);
    Route::post('eliminarexperiencia', 'postulante\PostulanteController@eliminarexperiencia')->name('eliminarexperiencia')->middleware(['auth','verified','Postulante']);

    Route::post('perfil/eliminarexperiencia', 'Auth\PerfilController@eliminarexperiencia')->name('eliminarexperiencia_perfil')->middleware(['auth','verified','Postulante']);
    Route::post('editarexperiencia', 'postulante\PostulanteController@editarexperiencia')->name('editarexperiencia')->middleware(['auth','verified','Postulante']);
    Route::post('actualizarexperiencia', 'postulante\PostulanteController@actualizarexperiencia')->name('actualizarexperiencia')->middleware(['auth','verified','Postulante']);
    Route::post('perfil/actualizarexperiencia', 'Auth\PerfilController@actualizarexperiencia')->name('actualizarexperiencia_perfil')->middleware(['auth','verified','Postulante']);
    
    Route::get('datosexpgenyesp', 'postulante\PostulanteController@datosexpgenyesp')->name('datosexpgenyesp')->middleware(['auth']);
    //Route::get('datosexpgenyesp_proceso', 'postulante\PostulanteController@datosexpgenyesp_proceso')->name('datosexpgenyesp_proceso')->middleware(['auth','Postulante']);
    Route::post('datosformacion_general', 'postulante\PostulanteController@datosformacion_general')->name('datosformacion_general')->middleware(['auth','verified','Postulante']);
    Route::post('editarformacion', 'postulante\PostulanteController@editarformacion')->name('editarformacion')->middleware(['auth','verified','Postulante']);
    Route::post('actualizar_formac_data', 'postulante\PostulanteController@actualizar_formac_data')->name('actualizar_formac_data')->middleware(['auth','verified','Postulante']);
    Route::post('editarcapacitacion', 'postulante\PostulanteController@editarcapacitacion')->name('editarcapacitacion')->middleware(['auth','verified','Postulante']);
    Route::post('actualizarcapacitacion_data', 'postulante\PostulanteController@actualizarcapacitacion_data')->name('actualizarcapacitacion_data')->middleware(['auth','verified','Postulante']);
    Route::post('declaracionjurada', 'postulante\PostulanteController@declaracionjurada')->name('declaracionjurada')->middleware(['auth','verified','Postulante']);
    Route::post('registrofinal', 'postulante\PostulanteController@registrofinal')->name('registrofinal')->middleware(['auth','verified','Postulante']);
    Route::get('datosuser/recuperar_ubigeo', 'postulante\PostulanteController@recuperar_ubigeo')->name('recuperar_ubigeo')->middleware(['auth']);
    Route::get('datosuser/cargar_resumen_postulante', 'postulante\PostulanteController@cargar_resumen_postulante')->name('cargar_resumen_postulante')->middleware(['auth','Postulante']);
    Route::post('perfil/update_fotografia', 'Auth\PerfilController@update_fotografia')->name('update_fotografia')->middleware(['auth']);
    Route::post('perfil/cambiocorreo', 'Auth\PerfilController@cambiocorreo')->name('cambiocorreo')->middleware(['auth']);
    Route::get('{idproceso}/registro', 'postulante\PostulanteController@registro_postular')->where(['idproceso' => '[0-9]+'])->name('registro_postular')->middleware(['auth','Postulante']);//no tocar
    Route::post('perfil/update_password', 'Auth\PerfilController@update_password')->name('update_passwordd')->middleware(['auth']);
    
});
    
    
    //MIS POSTULACIONES
    Route::group(['prefix' => 'mispostulaciones'], function(){
    Route::get('/', 'postulante\mispostulacionesController@index')->name('mispostulaciones')->middleware(['auth','verified','Postulante']);
    Route::get('datatabla', 'postulante\mispostulacionesController@datatabla')->name('datatabla')->middleware(['auth','verified','Postulante']);;
    });
    //POSTULANTES
    Route::group(['prefix' => 'postulantes'], function(){
        Route::get('/{proceso_id}/{etapa?}/{vista?}/listar', 'PostulantesController@index')
                ->where(['proceso_id'=>'[0-9]+'],['etapa'=>'[0-9]+'],['vista'=>'[0-9]+'])->name('postulantes.index')->middleware(['auth','Comisionado']);
        Route::get('/{proceso_id}/{etapa?}/{vista}/listar/data', 'PostulantesController@data')
                ->where(['proceso_id' => '[0-9]+'],['etapa' => '[0-9]+'],['vista' => '[1-2]'])->name('postulantes.data')->middleware(['auth','Comisionado']);
        Route::get('/{id?}/buscar', 'PostulantesController@buscar')->where(['id' => '[0-9]+'])->name('postulantes.search')->middleware(['auth','Comisionado']);  
        Route::get('postulantes_evaluados/{proceso_id}/{etapa}/{ev_con}', 'PostulantesController@postulantes_evaluados')
                ->where(['proceso_id' => '[0-9]+'],['etapa' => '[0-9]+'],['ev_con' => '[0-1]+'])->name('postulantes.postulantes_evaluados')->middleware(['auth','Comisionado']);  
        Route::post('actualizar_evaluacion/{proceso_id}/{etapa}/{ev_con}', 'PostulantesController@actualizar_evaluacion')
                ->where(['proceso_id' => '[0-9]+'],['etapa' => '[0-9]+'],['ev_con' => '[0-1]+'])->name('postulantes.actualizar_evaluacion')->middleware(['auth','Comisionado']);
        Route::get('datosuser/cargar_cv/{postulanteid}/{userid}', 'PostulantesController@cargar_cv')->name('cargar_cv')->middleware(['auth','Comisionado']);      
        Route::get('datosuserexp/{idbtn}/{valor_validacion}/guardar_validacion', 'PostulantesController@guardar_validacion_exp')->name('guardar_validacion_exp')->middleware(['auth','Comisionado']);
        Route::get('datosusercapa/{idbtn}/{valor_validacion}/guardar_validacion', 'PostulantesController@guardar_validacion_capa')->name('guardar_validacion_capa')->middleware(['auth','Comisionado']);
        Route::get('datosuserform/{idbtn}/{valor_validacion}/guardar_validacion', 'PostulantesController@guardar_validacion_form')->name('guardar_validacion_form')->middleware(['auth','Comisionado']);
        Route::get('ver_mas/{idpostulante}', 'PostulantesController@ver_mas')->middleware(['auth','Comisionado']);
    });

   Route::get("buscar_ubigeo_reniec",function(Request $r){
       $search = $r->search;
        $q = \App\Ubigeo::select( 'cod_ubigeo_reniec as id', DB::raw("CONCAT(desc_ubigeo_reniec,' - ', desc_prov_reniec,' - ', desc_dep_reniec) AS text"))
        ->where("cod_ubigeo_reniec","<>","NA")
        //->where("desc_ubigeo_reniec","LIKE","%$search%")
        ->where(DB::raw("CONCAT(desc_ubigeo_reniec,' - ', desc_prov_reniec,' - ', desc_dep_reniec)"),"like","%$search%")
        //->where(DB::raw("CONCAT(`nvp`, ' ', `vpv`)"), 'LIKE', "%".$this->searchNeedle."%");
        ->get();
       
        return response()->json($q);
   })->middleware(['auth']);

Route::group(['prefix' => 'reportes'], function(){
    Route::get('preliminar/{id}/{tipo}', 'ReportesController@preliminar')->where(['id'=>'[0-9]+'])->name('reportes.preliminar');
    Route::get('/{id}/{etapa}/pdf', 'ReportesController@pdf')->where(['id'=>'[0-9]+'])->where(['etapa'=>'[0-9]+'])->name('reportes.pdf');
    Route::get('/{id}/{etapa}/excel', 'ReportesController@excel')->where(['id'=>'[0-9]+'])->where(['etapa'=>'[0-9]+'])->name('reportes.excel');   
    Route::get('cv/{id_postulante}', 'ReportesController@cv')->where(['id_postulante'=>'[0-9]+'])->middleware(['auth','Comisionado']);
    Route::get('postulantes/{id_proceso}', 'ReportesController@descargar_postulantes')->name('reporte.postulantes')->where(['id_proceso'=>'[0-9]+'])->middleware(['auth','Comisionado']);
    Route::get('postulantes/{id_proceso}/view', 'ReportesController@descargar_postulantes_view')->name('reporte.postulantes.view')->where(['id_proceso'=>'[0-9]+'])->middleware(['auth','Comisionado']);
});
Route::get('preliminar/{id}/{tipo}', 'ReportesController@preliminar')->where(['id'=>'[0-9]+'])->name('reportes.preliminar');

Route::post("ruta_temporal/{proceso_id}",function($proceso_id){
    session()->put('ruta_temporal', route("postulante_postular",$proceso_id) );
});

//rutas px verificación
Route::get("actualizar_estados","ConvocatoriaController@actualizar_estados_vigentes_y_enCruso");
Route::get("redirect",function(Request $r){
    if(!$r->ruta) $r->ruta = 'index';
    if(!$r->color) $r->color = 'rojo';
    if(!$r->mensaje) $r->mensaje = 'Algo salió mal';
    return redirect()->route($r->ruta)->with($r->color, $r->mensaje);
});



