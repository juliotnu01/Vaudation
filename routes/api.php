<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::post('/save-project', 'ProyectController@store');
    Route::get('/get-project/user/{id_user?}', 'ProyectController@project');
    Route::get('/{id}/get-user-vaudition', 'ProyectController@getUserVaudition');
    Route::get('/user/{id_user}/character/{id_character}/get-character-audition', 'CharacterController@characterSpesific');
    Route::get('{id_proyect}/get-character', 'CharacterController@index');
    Route::post('/guardar-video', 'GuardarVideoController@guardarVideo');
    Route::post('/add-audition-scene', 'VauditionController@store');
    Route::post('/save-questions', 'QuestionProyectController@store');
    Route::post('/save-character', 'CharacterController@store');
    Route::get('/user/{id}/activate-user-login', 'ActivateUSerMailController@activate');
    Route::post('/activate-account', 'ActivateUSerMailController@activateAccount');
    Route::get('{id}/get-all-user-vaudition', 'ProyectController@getUserVauditionAll');
    Route::put('{id}/change-status-user-vaudition', 'ProyectController@changeStatusUser');
    Route::put('/desactivate-invitation-vaudition', 'InvitationController@desactiveInvitation');
