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
Route::get('{id_proyect}/get-character', 'CharacterController@index');
Route::get('user/{id_user}/{id_character}/get-character-audition', 'CharacterController@characterSpesific');
Route::post('save-character', 'CharacterController@store');
// Route::post('/save-audition', 'AuditionController@store');
// Route::get('get-audition', 'AuditionController@index');
// Route::post('/save-scene', 'SceneController@store');
// Route::get('/get-scene', 'SceneController@index');
// Route::get('{id_audition}/get-scene', 'SceneController@SceneSpesific');
// Route::get('project/{id_project}/get-audition-specific/{id_audition}', 'AuditionController@getauditionspecific');
// Route::post('send-invitation', 'InvitationController@sendInvitations');
Route::post('save-questions', 'QuestionProyectController@store');
// Route::get('/{id_audition}/get-scene-of-audition', 'SceneController@AuditionSpecificWithScenes');
Route::post('add-audition-scene', 'AuditionSceneController@store');


