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
