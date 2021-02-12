<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('perfil', 'Auth\PerfilController@index')->name('perfil');
 //JOSE AQUI TUS RUTAS
 //Fin Auth


//MAESTRO
Route::group(['prefix' => 'maestro'], function(){
 // Rutas ajustes
    Route::group(['prefix' => 'ajustes'], function(){
        Route::get('/', 'AjustesController@index')->name('maestro.ajustes.index');  
        Route::post('update', 'AjustesController@update')->name('maestro.ajustes.update');  
        Route::get('reset', 'AjustesController@restablecer')->name('maestro.ajustes.restablecer');  
    });   
    Route::group(['prefix' => 'usuarios'], function(){
        Route::get('/', 'maestro\UsuarioController@index')->name('maestro.usuarios.index');  
        Route::post('update/{id}', 'maestro\UsuarioController@update')->where(['id' => '[0-9]+'])->name('maestro.usuarios.update');  
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
    Route::get('en_curso', 'ConvocatoriaController@en_curso')->name('convocatoria.en_curso');
    Route::get('historico', 'ConvocatoriaController@historico')->name('convocatoria.historico');
    
    //CRUD
    Route::get('vigentes/data', 'ConvocatoriaController@vigentes_data')->name('convocatoria.vigentes.data');
    Route::get('en_curso/data', 'ConvocatoriaController@vigentes')->name('convocatoria.en_curso.data'); 
    Route::get('historico/data', 'ConvocatoriaController@vigentes')->name('convocatoria.historico.data'); 
    Route::post('store', 'ConvocatoriaController@store')->name('convocatoria.store');  
    Route::get('edit/{id}', 'ConvocatoriaController@edit')->where(['id' => '[0-9]+'])->name('convocatoria.edit');  
    Route::post('update', 'ConvocatoriaController@update')->name('convocatoria.update');  
    Route::get('listar/{estado?}/{etapa?}', 'AjustesController@restablecer')->name('convocatoria.listar');    
});

//POSTULANTE
Route::group(['prefix' => 'postulante'], function(){
    // Vistas 
    Route::get('postular', 'postulante\PostulanteController@postular')->name('postulante_postular');
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
    Route::post('guardarexperiencia', 'postulante\PostulanteController@guardarexperiencia')->name('guardarexperiencia');
    Route::post('eliminarexperiencia', 'postulante\PostulanteController@eliminarexperiencia')->name('eliminarexperiencia');
    Route::post('editarexperiencia', 'postulante\PostulanteController@editarexperiencia')->name('editarexperiencia');
    Route::post('actualizarexperiencia', 'postulante\PostulanteController@actualizarexperiencia')->name('actualizarexperiencia');
    
    //Route::get('postular', 'postulante\PostulanteController@index')->name('postulante_postular');

        
});

//POSTULANTES
Route::group(['prefix' => 'postulantes'], function(){
        Route::get('/{proceso_id}/{etapa?}/listar', 'PostulantesController@index')
                ->where(['proceso_id' => '[0-9]+'], ['etapa' => '[0-9]+'])->name('postulantes.index');
        Route::get('/{id?}/buscar', 'PostulantesController@buscar')->where(['id' => '[0-9]+'])->name('postulantes.data');  
        
   });

