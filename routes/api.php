<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('teamEquipe/{id}' , 'TeamController@show');
Route::put('team/{id}' , 'TeamController@update');
Route::post('team/avatar/{id}' , 'TeamController@uploadAvatar');
Route::get('team' , 'TeamController@getTeamApi');
/**
 * Rota para escolha azul
 */
Route::prefix('escolha-azul')->group(function(){ 
    Route::get('getProposalPF'  , 'ProposalPFController@getProposalPF');
    Route::patch('update/{id}', 'ProposalPFController@update');
});

/**
 * Rota para informar os tipos de imóveis
 */
Route::prefix('survey')->group(function(){ 
    Route::get('type-immobile'  , 'SurveyController@getTypeImmobile');
});


Route::get('contact' , 'ContactController@getContacts');
Route::post('contact/create' , 'ContactController@store');
Route::delete('contact/delete/{id}' , 'ContactController@destroy');
Route::patch('contact/{id}' , 'ContactController@update');
