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
    Route::get('getCadastrePF' , 'GuarantorController@getGuarantorDataTable');
    Route::post('alter-agent', 'ProposalPFController@alterAtendent');
    Route::delete('delete-proposal-pf/{id}' , 'ProposalPFController@destroy');
    Route::get('download/{id}/type/{type}', 'ProposalPFController@getFiles');
});

/**
 * Rota para informar os tipos de imóveis
 */
Route::prefix('survey')->group(function(){ 
    Route::get('type-immobile'  , 'SurveyController@getTypeImmobile');
    Route::get('all' , 'SurveyController@allSurvey');
    Route::delete('destroy/{id}', 'SurveyController@destroy');
    Route::post('search', 'SurveyController@search');
    Route::get('user-survey/{id}/{type}', 'SurveyController@getUser');
    Route::delete('delete-user/{id}' , 'SurveyController@delete_user_survey');
    Route::post('up-user' , 'SurveyController@addUserSurvey');
    Route::post('add-user' , 'SurveyController@addUser') ;
    Route::get('content/id/{id}/field/{content}' , 'SurveyController@content');
    Route::put('content', 'SurveyController@alterContent');
    Route::put('alter-field', 'SurveyController@alterSurveyor');
    Route::post('alter-order', 'SurveyController@alter_order_ambience_survey');
});


Route::get('contact' , 'ContactController@getContacts');
Route::post('contact/create' , 'ContactController@store');
Route::delete('contact/delete/{id}' , 'ContactController@destroy');
Route::patch('contact/{id}' , 'ContactController@update');
