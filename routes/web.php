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
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('perfil', 'Auth\PerfilController@index')->name('perfil')->middleware(['auth']);
 //JOSE AQUI TUS RUTAS
 //Fin Auth


//MAESTRO
Route::group(['prefix' => 'maestro'], function(){
 // Rutas ajustes
    Route::group(['prefix' => 'ajustes'], function(){
        Route::get('/', 'AjustesController@index')->name('maestro.ajustes.index')->middleware(['auth','Administrador']);  
        Route::post('update', 'AjustesController@update')->name('maestro.ajustes.update');  
        Route::get('reset', 'AjustesController@restablecer')->name('maestro.ajustes.restablecer');  
    });   
    Route::group(['prefix' => 'usuarios'], function(){
        Route::get('/', 'maestro\UsuarioController@index')->name('maestro.usuarios.index')->middleware(['auth','Administrador']);  
        Route::post('update/{id}', 'maestro\UsuarioController@update')->where(['id' => '[0-9]+'])->name('maestro.usuarios.update')->middleware(['auth','Administrador']);  
        Route::get('edit/{id}', 'maestro\UsuarioController@edit')->where(['id' => '[0-9]+'])->name('maestro.usuarios.edit');  
        Route::get('data', 'maestro\UsuarioController@data')->name('maestro.usuarios.data');  
    }); 
    Route::group(['prefix' => 'procesos'], function(){
        Route::get('/', 'maestro\ProcesoController@index')->name('maestro.proceso.index');  
        Route::post('update/{id}', 'maestro\ProcesoController@update')->where(['id' => '[0-9]+'])->name('maestro.proceso.update');  
        Route::post('store', 'maestro\ProcesoController@store')->name('maestro.proceso.store');  
        Route::get('data', 'maestro\ProcesoController@data')->name('maestro.proceso.data');  
        Route::get('editar/{id}', 'maestro\ProcesoController@edit')->where(['id' => '[0-9]+'])->name('maestro.proceso.editar');  
        
    }); 
    Route::group(['prefix' => 'formacion'], function(){
        Route::get('/', 'maestro\FormacionController@index')->name('maestro.formacion.index');  
        Route::post('update/{id}', 'maestro\FormacionController@update')->where(['id' => '[0-9]+'])->name('maestro.formacion.update');  
        Route::post('store', 'maestro\FormacionController@store')->name('maestro.formacion.store');  
        Route::get('data', 'maestro\FormacionController@data')->name('maestro.formacion.data');  
        Route::get('editar/{id}', 'maestro\FormacionController@edit')->where(['id' => '[0-9]+'])->name('maestro.formacion.editar');  
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
    Route::get('edit/{id}', 'ConvocatoriaController@edit')->where(['id' => '[0-9]+'])->name('convocatoria.edit'); 
    Route::post('update', 'ConvocatoriaController@update')->name('convocatoria.update');  
    Route::get('resultado/{id}', 'ConvocatoriaEnCursoController@resultado')->where(['id' => '[0-9]+'])->name('convocatoria.en_curso.resultado');  
    Route::post('update_resultado', 'ConvocatoriaEnCursoController@update_resultado')->name('convocatoria.en_curso.update_resultado'); 

    //Route::get('listar/{estado?}/{etapa?}', 'AjustesController@restablecer')->name('convocatoria.listar');    
    Route::get('show_comunicados/{proceso_id}', 'ConvocatoriaController@show_comunicados')->name('convocatoria.comunicados');   
    Route::get('show_evaluacion/{proceso_id}', 'ConvocatoriaEnCursoController@show_evaluacion')->name('convocatoria.en:curso.comunicados');     
    Route::post('guardar_comunicados', 'ConvocatoriaController@guardar_comunicados')->name('convocatoria.comunicados.guardar');  
    Route::post('guardar_evaluacion', 'ConvocatoriaEnCursoController@guardar_evaluacion')->name('convocatoria.en_curso.guardar_evaluacion');     
    Route::post('eliminar_comunicado/{id}', 'ConvocatoriaController@eliminar_comunicado')->where(['id' => '[0-9]+'])->name('convocatoria.comunicados.eliminar');    
    Route::post('eliminar_evaluacion/{id}', 'ConvocatoriaEnCursoController@eliminar_evaluacion')->where(['id' => '[0-9]+'])->name('convocatoria.en_curso.comunicados.eliminar');
    Route::post('eliminar_convocatoria/{id}', 'ConvocatoriaController@destroy')->where(['id' => '[0-9]+'])->name('convocatoria.procesos.eliminar');    
    Route::post('cancelar_convocatoria/{id}', 'ConvocatoriaController@cancelar_convocatoria')->where(['id' => '[0-9]+'])->name('convocatoria.procesos.cancelar');
    Route::post('concluir_convocatoria/{id}', 'ConvocatoriaEnCursoController@concluir_convocatoria')->where(['id' => '[0-9]+'])->name('convocatoria.procesos.concluir');
});

//POSTULANTE
Route::group(['prefix' => 'postulante'], function(){
    // Vistas 
    Route::get('postular/{idproceso}', 'postulante\PostulanteController@postular')->where(['idproceso' => '[0-9]+'])->name('postulante_postular');
    Route::get('datosuser/data1', 'postulante\PostulanteController@datosuser_data1')->name('datosuser_data1');
    Route::get('formacion/data1', 'postulante\PostulanteController@formacion_data1')->name('formacion_data1');
    Route::get('formacion/data', 'postulante\PostulanteController@formacion_data')->name('formacion_data');
    Route::post('actualizardatos', 'postulante\PostulanteController@actualizar_o_registrar')->name('actualizardatos'); 
    Route::post('guardarformacion', 'postulante\PostulanteController@guardarformacion')->name('guardarformacion'); 
    Route::post('eliminarformacion', 'postulante\PostulanteController@eliminarformacion')->name('eliminarformacion');
    Route::get('capacitaciones/data1', 'postulante\PostulanteController@capacitaciones_data1')->name('capacitaciones_data1');
    Route::post('guardarcapacitacion', 'postulante\PostulanteController@guardarcapacitacion')->name('guardarcapacitacion');
    Route::post('eliminarcapacitacion', 'postulante\PostulanteController@eliminarcapacitacion')->name('eliminarcapacitacion');
    Route::get('experiencias/data1', 'postulante\PostulanteController@experiencias_data1')->name('experiencias_data1');
    Route::get('experiencias/data1/perfil', 'postulante\PostulanteController@experiencias_data1_perfil')->name('experiencias_data1_perfil');
    Route::post('guardarexperiencia', 'postulante\PostulanteController@guardarexperiencia')->name('guardarexperiencia');
    Route::post('eliminarexperiencia', 'postulante\PostulanteController@eliminarexperiencia')->name('eliminarexperiencia');
    Route::post('editarexperiencia', 'postulante\PostulanteController@editarexperiencia')->name('editarexperiencia');
    Route::post('actualizarexperiencia', 'postulante\PostulanteController@actualizarexperiencia')->name('actualizarexperiencia');
    Route::get('datosexpgenyesp', 'postulante\PostulanteController@datosexpgenyesp')->name('datosexpgenyesp');
    Route::get('datosexpgenyesp_proceso', 'postulante\PostulanteController@datosexpgenyesp_proceso')->name('datosexpgenyesp_proceso');
    Route::get('datosformacion_general', 'postulante\PostulanteController@datosformacion_general')->name('datosformacion_general');
    Route::post('editarformacion', 'postulante\PostulanteController@editarformacion')->name('editarformacion');
    Route::post('actualizar_formac_data', 'postulante\PostulanteController@actualizar_formac_data')->name('actualizar_formac_data');
    Route::post('editarcapacitacion', 'postulante\PostulanteController@editarcapacitacion')->name('editarcapacitacion');
    Route::post('actualizarcapacitacion_data', 'postulante\PostulanteController@actualizarcapacitacion_data')->name('actualizarcapacitacion_data');
    Route::post('declaracionjurada', 'postulante\PostulanteController@declaracionjurada')->name('declaracionjurada');
    Route::post('registrofinal', 'postulante\PostulanteController@registrofinal')->name('registrofinal');
    Route::get('datosuser/recuperar_ubigeo', 'postulante\PostulanteController@recuperar_ubigeo')->name('recuperar_ubigeo');
    Route::get('datosuser/cargar_resumen_postulante', 'postulante\PostulanteController@cargar_resumen_postulante')->name('cargar_resumen_postulante');
    
    });
    Route::get('postulante/{idproceso}/storage/', 'postulante\PostulanteController@registro_postular')->where(['idproceso' => '[0-9]+'])->name('registro_postular');
    
    //MIS POSTULACIONES
    Route::group(['prefix' => 'mispostulaciones'], function(){
    Route::get('/', 'postulante\mispostulacionesController@index')->name('mispostulaciones');
    Route::get('datatabla', 'postulante\mispostulacionesController@datatabla')->name('datatabla');
    });
    //POSTULANTES
    Route::group(['prefix' => 'postulantes'], function(){
        Route::get('/{proceso_id}/{etapa?}/{vista?}/listar', 'PostulantesController@index')
                ->where(['proceso_id'=>'[0-9]+'],['etapa'=>'[0-9]+'],['vista'=>'[0-9]+'])->name('postulantes.index');
        Route::get('/{proceso_id}/{etapa?}/{vista}/listar/data', 'PostulantesController@data')
                ->where(['proceso_id' => '[0-9]+'],['etapa' => '[0-9]+'],['vista' => '[1-2]'])->name('postulantes.data'); 
        Route::get('/{id?}/buscar', 'PostulantesController@buscar')->where(['id' => '[0-9]+'])->name('postulantes.search');  
        Route::get('postulantes_evaluados/{proceso_id}/{etapa}/{ev_con}', 'PostulantesController@postulantes_evaluados')
                ->where(['proceso_id' => '[0-9]+'],['etapa' => '[0-9]+'],['ev_con' => '[0-1]+'])->name('postulantes.postulantes_evaluados');  
        Route::get('actualizar_evaluacion/{proceso_id}/{etapa}/{ev_con}', 'PostulantesController@actualizar_evaluacion')
                ->where(['proceso_id' => '[0-9]+'],['etapa' => '[0-9]+'],['ev_con' => '[0-1]+'])->name('postulantes.actualizar_evaluacion');
        Route::get('datosuser/cargar_cv/{postulanteid}/{userid}', 'PostulantesController@cargar_cv')->name('cargar_cv');        
        
    });

   Route::get("/buscar_ubigeo_reniec",function(Request $r){
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
    Route::get('/{id}/pdf', 'ReportesController@pdf')->where(['id'=>'[0-9]+'])->name('reportes.pdf');
    Route::get('/{id}/excel', 'ReportesController@excel')->where(['id'=>'[0-9]+'])->name('reportes.excel');   
    
});

