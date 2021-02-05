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
        Route::get('/', 'UsuarioController@vista_usuarios')->name('maestro.usuarios.index');  
        Route::post('update', 'UsuarioController@update')->name('maestro.usuarios.update');  
        Route::get('edit/{id}', 'UsuarioController@edit')->where(['id' => '[0-9]+'])->name('maestro.usuarios.edit');  
        Route::get('data', 'UsuarioController@data_usuarios')->name('maestro.usuarios.data');  
    }); 
    Route::group(['prefix' => 'tipoprocesos'], function(){
        Route::get('/', 'TipoProcesoController@vista_tipoprocesos')->name('maestro.tipoprocesos.index');  
        Route::post('update', 'TipoProcesoController@update')->name('maestro.tipoprocesos.update');  
        Route::get('data', 'TipoProcesoController@data_tipoprocesos')->name('maestro.tipoprocesos.data');  
    }); 
});

//CONVOCATORIAS
Route::group(['prefix' => 'convocatorias'], function(){
    // Vistas 
    Route::get('vigentes', 'ConvocatoriaController@vigentes')->name('convocatoria.vigentes'); 
    Route::get('en_curso', 'ConvocatoriaController@en_curso')->name('convocatoria.en_curso');
    Route::get('historico', 'ConvocatoriaController@historico')->name('convocatoria.historico');
    Route::get('usuarios', 'UsuarioController@historico')->name('convocatoria.maestro');
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
    Route::post('actualizardatos', 'postulante\PostulanteController@actualizar')->name('actualizardatos'); 
    //Route::get('postular', 'postulante\PostulanteController@index')->name('postulante_postular');

        
});

//POSTULANTES
Route::group(['prefix' => 'postulantes'], function(){
        Route::get('/{cas?}/{etapa?}/listar', 'PostulantesController@index')
                ->where(['cas' => '[0-9]+'], ['etapa' => '[0-9]+'])->name('postulantes.index');
        Route::get('/{id?}/buscar', 'PostulantesController@buscar')->where(['id' => '[0-9]+'])->name('postulantes.data');  
        
   });

