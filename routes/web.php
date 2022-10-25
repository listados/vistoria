<?php

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

Route::get('/', 'HomeController@index')->name('home');

// Route::get('/user', function () {
//     return view('user.index'); C023990
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {

//COM PREFIXO
    Route::prefix('vistoria')->group(function () {
        Route::get('/' , 'SurveyController@index');
        Route::match(['get', 'post'], 'all-survey',  'SurveyController@getSurvey');
        Route::match('get', 'pesquisar-vistoria',  'SurveyController@searchSurvey');
        Route::get('create' , 'SurveyController@create');
        Route::get('nova-vistoria/{id}' , 'SurveyController@edit');
        Route::post('update' , 'SurveyController@update');
        Route::post('upload' , 'SurveyController@upload');
        Route::get('{id}/editar/{action}/acao' , 'SurveyController@edit');
        Route::post('delete-user' , 'SurveyController@delete_user_survey');
        Route::get('imprimir' , 'SurveyController@print_survey');
        Route::get('{id}/download' , 'SurveyController@download');
        Route::get('replicar/{id}' , 'SurveyController@reply_survey');
        Route::put('arquivar/{id}' , 'SurveyController@filed');
        Route::get('historico/{id}' , 'SurveyController@history');
        Route::post('alter-delete-ambience', 'SurveyController@alter_ambience');
        Route::post('orderBy', 'SurveyController@alter_order_ambience_survey');
    });
    
    /*  ----- ROTA PARA CADASTRO DE IMÃ“VEIS -----  */
    Route::prefix('imovel')->group(function(){
        Route::get('sincronizar/'   , 'ImmobileController@xml');    
        Route::get('imovel-mostra/{code}'   , 'ImmobileController@show');    
        Route::get('all'   , 'ImmobileController@getImmobile');    
       
    });
    Route::resource('imovel' ,'ImmobileController');
    //ARQUIVOS DE AMBIENTE
    Route::get('files_ambience/show/{id}' , 'FilesAmbienceController@show');
    //Route::resource('vistoria' , 'SurveyController');
    Route::prefix('usuario')->group(function(){
        Route::get('/editar/{id}' , 'UserController@edit');
        Route::put('/editar/{id}' , 'UserController@update');
    });
    //DELIVERY
    //Route::resource('delivery' , 'DeliveryController');
    Route::get('delivery' , 'DeliveryController@index');
    Route::get('delivery/all' , 'DeliveryController@show');
    Route::post('delivery/store' , 'DeliveryController@store');

    //CHAVES
    Route::prefix('chave')->group(function(){
        Route::get('/'               , 'KeyController@index');
        Route::get('show'            , 'KeyController@show');
        Route::delete('destroy/{id}' , 'KeyController@destroy');
        Route::post('update-code-key', 'KeyController@updateCode');
        Route::post('store' ,  'KeyController@store');
        Route::get('get/{id}' , 'KeyController@getKey');
        Route::post('verify-phone-client' , 'KeyController@verifyFone');
        Route::post('create-reserve' , 'KeyController@createReserve');
        Route::get('receipt' , 'KeyController@receiptPdf');
        Route::post('search' , 'KeyController@search');
        Route::put('update/{id}' , "KeyController@update");
    });

    //RESERVA
    Route::prefix('reserva')->group(function(){
        //Route::get('/'               , 'KeyController@index');
        //Route::post('search' , 'KeyController@search');
        Route::get('show/{id}' , 'ReserveController@show');
    });
    //Proposta Escolha Azul
    Route::prefix('escolha-azul')->group(function(){    
        Route::get('/proposta-pessoa-fisica'            , 'ProposalPFController@index');
        Route::get('pdf-pf/{id}/{proposta}'             , 'ProposalPFController@showReportPf');
        Route::get('download/{id}/{type}'               , 'ProposalPFController@download');
        Route::get('download-proposal-pf/{id}/{type}'   , 'ProposalPFController@getFilesDonwloadProposalPF');
        Route::get('getProposalPF' , 'ProposalPFController@getProposalPF');
        //Route::get('analise-proposta-pf/{id}' , 'ProposalPFController@showReport');   
        Route::get('cadastro-pessoa-fisica'            , 'GuarantorController@index');
        Route::get('getGuarantorPF', 'GuarantorController@getGuarantorDataTable');
    });
    // ROTA PARA EDIÃ‡ÃƒO DO SITE
    Route::prefix('site')->group(function(){    
        Route::get('equipe' , 'SiteController@team');
        Route::get('equipe/edit/{id}' , 'TeamController@edit');
        Route::post('createPersonTeam' , 'TeamController@store');
        Route::get('office' , 'TeamController@getOffice');
        Route::delete('delete/{id}' ,'TeamController@destroy' );
        Route::post('alterar/{id}', 'TeamController@update');
        //contato
        Route::get('contato', 'ContactController@index');
    });


    
    Route::prefix('admin')->group(function(){
        //CONFIGURAÇÃO 
        Route::get('configuracao/ambiente', 'SettingController@ambience');
        Route::get('configuracao/get-ambiente', 'SettingController@getAmbience');
        Route::resource('configuracao', 'SettingController');     
        Route::put('alter-ambience', 'AmbienceController@update');  
        Route::resource('ambience', 'AmbienceController');     
    }); 
});



Route::get('page-teste' , 'HomeController@widget');