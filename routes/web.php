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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/save-audition', 'AuditionController@store');
Route::get('/{id_proyect}/get-audition', 'AuditionController@index');
Route::post('/save-scene', 'SceneController@store');
Route::get('/get-scene', 'SceneController@index');
Route::get('/get-audition-specific/{id}', 'AuditionController@getauditionspecific');
Route::post('guardar-video', 'GuardarVideoController@guardarVideo');
Route::post('save-project', 'ProyectController@store');
Route::get('get-project', 'ProyectController@index');

