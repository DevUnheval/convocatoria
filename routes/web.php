<?php

use Illuminate\Support\Facades\Route;

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

// Ruta Admin    
Route::get('/admin',function(){
    return view('modulo_admi.nuevo');   
});

Route::get('/', function () {
    return view('convocatorias.vigentes.index');
})->name('index');


//Rutas AUTH
Route::get('login', function(){
    // When user is already logged redirect to home
    return Illuminate\Support\Facades\Auth::check() ? redirect()->route('index') : view('auth.login');
 })->name('login');
 Route::post('validaracceso', 'Auth\LoginController@login')->name('validaracceso');
 Route::post('logout', 'Auth\LoginController@logout')->name('logout');
 //Fin Auth


//MAESTRO
Route::group(['prefix' => 'maestro'], function(){
 // Rutas ajustes
    Route::group(['prefix' => 'ajustes'], function(){
        Route::get('/', 'AjustesController@index')->name('maestro.ajustes.index');  
        Route::post('update', 'AjustesController@update')->name('maestro.ajustes.update');  
        Route::get('reset', 'AjustesController@restablecer')->name('maestro.ajustes.restablecer');  
    });    
});

//CONVOCATORIAS
Route::group(['prefix' => 'convocatorias'], function(){
    // Vistas
    Route::get('vigentes', 'ConvocatoriaController@vigentes')->name('convocatoria.vigentes'); 
    Route::get('en_curso', 'ConvocatoriaController@en_curso')->name('convocatoria.en_curso');
    Route::get('historico', 'ConvocatoriaController@historico')->name('convocatoria.historico');
    //CRUD
    Route::post('store', 'ConvocatoriaController@store')->name('convocatoria.store');  
    Route::post('update', 'ConvocatoriaController@update')->name('convocatoria.update');  
    Route::get('listar/{estado?}/{etapa?}', 'AjustesController@restablecer')->name('convocatoria.listar');    
});

