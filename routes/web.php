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

Route::get('/home/', 'HomeController@index')->name('home');
Route::post('guardar-video', 'GuardarVideoController@guardarVideo');
Route::post('save-project', 'ProyectController@store');
Route::get('get-project/user/{id_user}', 'ProyectController@index');
Route::get('get-project', 'ProyectController@project');
Route::get('{id_proyect}/get-character', 'CharacterController@index');
Route::get('user/{id_user}/character/{id_character}/get-character-audition', 'CharacterController@characterSpesific');
Route::post('save-character', 'CharacterController@store');
Route::post('save-questions', 'QuestionProyectController@store');
Route::post('add-audition-scene', 'VauditionController@store');
Route::get('{id}/get-user-vaudition', 'ProyectController@getUserVaudition');