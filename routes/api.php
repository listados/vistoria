<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui ficam todas as rotas da API. As rotas são divididas entre públicas 
| (sem autenticação) e privadas (com middleware 'auth').
|
*/

// =========================
// ROTAS PÚBLICAS
// =========================

Route::prefix('survey')->group(function () {
    Route::get('all', 'SurveyController@allSurvey');
});

Route::prefix('team')->group(function () {
    Route::get('/', 'TeamController@getTeamApi');
    Route::get('equipe/{id}', 'TeamController@show');
});

Route::prefix('ambience')->group(function () {
    Route::get('all', 'AmbienceController@all');
});

Route::prefix('files_ambience')->group(function () {
    Route::get('show/{id}', 'FilesAmbienceController@show');
});

Route::prefix('setting')->group(function () {
    Route::get('/', 'SettingController@getSetting');
});

Route::prefix('contact')->group(function () {
    Route::get('/', 'ContactController@getContacts');
});

// =========================
// ROTAS PRIVADAS (AUTENTICADAS)
// =========================

Route::middleware(['web', 'auth'])->group(function () {

    // Usuário autenticado
    Route::get('/user', function (Request $request) {
        return response()->json([
            'user' => $request->user(),
            'message' => 'Usuário autenticado com sucesso.'
        ]);
    });

    // Team
    Route::put('team/{id}', 'TeamController@update');
    Route::post('team/avatar/{id}', 'TeamController@uploadAvatar');

    // Escolha Azul (Propostas PF)
    Route::prefix('escolha-azul')->group(function () {
        Route::get('getProposalPF', 'ProposalPFController@getProposalPF');
        Route::patch('update/{id}', 'ProposalPFController@update');
        Route::get('getCadastrePF', 'GuarantorController@getGuarantorDataTable');
        Route::post('alter-agent', 'ProposalPFController@alterAtendent');
        Route::delete('delete-proposal-pf/{id}', 'ProposalPFController@destroy');
        Route::get('download/{id}/type/{type}', 'ProposalPFController@getFiles');
    });

    // Survey
    Route::prefix('survey')->group(function () {
        Route::get('type-immobile', 'SurveyController@getTypeImmobile');
        Route::delete('destroy/{id}', 'SurveyController@destroy');
        Route::post('search', 'SurveyController@search');
        Route::get('user-survey/{id}/{type}', 'SurveyController@getUser');
        Route::delete('delete-user/{id}', 'SurveyController@delete_user_survey');
        Route::post('up-user', 'SurveyController@addUserSurvey');
        Route::post('add-user', 'SurveyController@addUser');
        Route::get('content/id/{id}/field/{content}', 'SurveyController@content');
        Route::put('content', 'SurveyController@alterContent');
        Route::put('alter-field', 'SurveyController@alterSurveyor');
        Route::post('alter-order', 'SurveyController@alter_order_ambience_survey');
    });

    Route::post('alter-delete-ambience', 'SurveyController@alter_ambience');

    // Setting
    Route::prefix('setting')->group(function () {
        Route::put('/', 'SettingController@edit');
    });

    // Contact
    Route::prefix('contact')->group(function () {
        Route::post('create', 'ContactController@store');
        Route::delete('delete/{id}', 'ContactController@destroy');
        Route::patch('{id}', 'ContactController@update');
    });
});
