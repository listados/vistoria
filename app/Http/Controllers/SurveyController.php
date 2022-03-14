<?php
namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;

use EspindolaAdm\Survey;
use EspindolaAdm\FunctionAll;
use EspindolaAdm\FilesAmbience;
use EspindolaAdm\RelSurveyUser;
use DB;
use Auth;
use PDF;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use EspindolaAdm\User;
use Illuminate\Http\RedirectResponse;
use EspindolaAdm\Widgets\RecentNews;
use EspindolaAdm\Ambience;
use EspindolaAdm\Http\Requests\SurveyRequest;
use EspindolaAdm\OrderAmbienceSurvey;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class SurveyController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('survey.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         # //Created in 2016-07-22 16:48 by Junior Oliveira
        /*NA PÁGINA DE VISTORIA TEM UM BUTÃO QUE MANDA UMA REQUISIÇÃO  VIA POST E DEVOLVO PARA OUTRA ROTA COM ID */
        try {
            $request['survey_inspetor_cpf'] = '   .   .   -  ';

            $request['survey_date'] = Carbon::now();
            $nova                   = DB::table('survey')->insertGetId([
                                        'survey_inspetor_name' => Auth::user()->name,
                                        'survey_date_register' => Carbon::now(),
                                        'survey_date' => Carbon::now(),
                                        'survey_status' => 'Rascunho',
                                        'survey_link_tour' => ''
                                    ]);
            // $history                = DB::table('history_survey')->insert(
            //                             ['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => 'Criou essa vistoria', 'history_survey_created' => Carbon::now(), 'history_survey_id_survey' => $nova]);
            Survey::addOrderAmbienceSurvey($nova);

            return redirect('vistoria/'.base64_encode($nova).'/editar/Nova-Vistoria/acao');
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', 'Ocorreu um erro, ('.$e.') tente novamente');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $action)
    {
        //RETIRANDO O HIFEN
        $tit_small_survey = explode('-', $action);
        $id_survey = base64_decode($id);


        $query_survey = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id', '=', 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users', 'users.id', '=', 'relation_survey_user.relation_survey_user_id_user')
                        ->where('relation_survey_user.relation_survey_user_id_survey', $id_survey)->get();


        if (count($query_survey) > 0) {
            $survey_update = $query_survey;
        } else {
            $survey_update = Survey::findOrFail($id_survey)->get();
        }
        $survey = Survey::find($id_survey);

        $ambience       = DB::table('ambience')->orderBy('ambience_name')->get();

        $title_survey   = $action;

        return view('survey.create', compact('ambience', 'title_survey', 'survey', 'survey_update', 'id_survey', 'tit_small_survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (isset($request['survey_locator_name'])) {
            $veri_locator = Survey::verifyUserExist($request['survey_locator_name']);//VERIFICAÇÃO PARA NOME DO LOCADOR
            if ($veri_locator['status'] == '400') {
                return response()->json(['messagem' => 'O LOCADOR precisa está com o nome preenchido.', 'status' => 400], 400);
            }
        }

        if (isset($request['survey_occupant_name'])) {
            $veri_occupen = Survey::verifyUserExist($request['survey_occupant_name']);//VERIFICAÇÃO PARA NOME DO LOCATARIO
            if ($veri_occupen['status'] == '400') {
                return response()->json(['message' =>'O LOCATÁRIO precisa está com o nome preenchido.', 'status' => 400], 400);
            }
        }
        if (isset($request['survey_guarantor_name'])) {
            $veri_guarant = Survey::verifyUserExist($request['survey_guarantor_name']);//VERIFICAÇÃO PAR NOME DO FIADOR
            if ($veri_guarant['status'] == '400') {
                return response()->json(['message' => 'O FIADOR precisa está com o nome preenchido.', 'status' => 400], 400);
            }
        }


        if (isset($request['survey_occupant_cpf'])) {
            $veri_occupant = Survey::verifyUserExist($request['survey_occupant_cpf']);//VERIFICAÇÃO PAR NOME DO FIADOR
            if ($veri_occupant['status'] == '400') {
                return response()->json(['message' => 'O LOCATÁRIO precisa está com o CPF preenchido.', 'status' => 400], 400);
            }
        }

        # //Created in 2016-07-22 23:39 by Junior Oliveira
        //adaptação em 28/04/20118
        //UPDATE 27/09/2018
        if ($request->ajax()) {
            // //ESTOU PASSANDO ambience_id PARA BUSCAR A VISTORIA POR QUE $request['survey_id'] NAO ESTA VINDO O ID DA VISTORIA
            //ID DA VISTORIA
            $id = $request['survey_id'];
            /*VERIFICANDO SE A VISTORIA É UMA NOVA VISTORIA
                CASO SEJA, CADASTRA OS USUÁRIOS SE FOR EDIÇÃO FAZ UM UPDATE NOS USUÁRIOS
            */
            if ($request['type_survey'] == 'Nova-Vistoria') {
                //VERIFICANDO EM TODOS OS ARRAYS SE A PRIMEIRA POSIÇÃO É VAZIA
                //CASO, SEJA, EXCLUI O ARRAY, SE NAO, REALIZA O CADASTRO NORMAL

                if ($request['survey_locator_name'][0] == '') {
                    unset($request['survey_locator_name']);
                } else {
                    for ($i=0; $i < count($request['survey_locator_name']); $i++) {
                        $campo_user = array($request->survey_locator_name[$i] , $request->survey_locator_email[$i], $request->survey_locator_cpf[$i]);

                        Survey::cadastra_usuario($campo_user, $id, $request->survey_locator_cpf[$i], 'Locador');
                    }
                }
                if ($request['survey_occupant_name'][0] == '') {
                    unset($request['survey_occupant_name']);
                } else {
                    for ($i=0; $i < count($request['survey_occupant_name']); $i++) {
                        $campo_user = array($request->survey_occupant_name[$i] , $request->survey_occupant_email[$i], $request->survey_occupant_cpf[$i]);
                        Survey::cadastra_usuario($campo_user, $id, $request->survey_occupant_cpf[$i], 'Locatário');
                    }
                }
                if ($request['survey_guarantor_name'][0] == '') {
                    unset($request['survey_guarantor_name']);
                } else {
                    for ($i=0; $i < count($request['survey_guarantor_name']); $i++) {
                        $campo_user = array($request->survey_guarantor_name[$i] , $request->survey_guarantor_email[$i], $request->survey_guarantor_cpf[$i]);
                        Survey::cadastra_usuario($campo_user, $id, $request->survey_guarantor_cpf[$i], 'Fiador');
                    }
                }
            } elseif (($request['type_survey'] == 'Editar-Vistoria') || $request['type_survey'] == 'Replicando-Vistoria') {
                /* PARA EDIÇÃO DE MULTIPLOS USUARIO EU TENHO QUE COLHER O ARRAY ENVIADO DESSA FORMA $request->variavel
                ESSE PARAMETRO VARIAVEL É O MESMO NOME QUE ESTA NO INPUT DO FORMULARIO variavel[]
                ENTÃO EU TENHO QUE SABER QUANTAS POSIÇÕES SÃO PARA PODER DÁ FAZER UM LOOP
                CONSULTO O USUARIO PELO ID ENVIADO E FAÇO O UPDATE PASSANDO O NOVO NOME
                */
                /* ----  LOCADOR  --- */
                //total de posição do array id_user
                $total_idUser = 0;
                if ($request['id_user'] == null) {
                    $total_idUser = 0;
                } else {
                    $total_idUser = count($request['id_user']);
                }

                //toal de posição do array nome locador
                $totalLocator = 0;
                if ($request['survey_locator_name'] == null) {
                    $total_idUser = 0;
                } else {
                    $totalLocator = count($request['survey_locator_name']) ;
                }
                //calculando a diferença dos dois arrays
                $dif = ($totalLocator - $total_idUser);
                //dd($request->all());
                /*É FEITO A VERIFICAÇÃO NO ARRAY ID_USER PARA CONSTATAR QUE NAO TEM CAMPOS NO ARRAY PARA FAZER UM NOVO CADASTRO*/
                if ($total_idUser == 0) {
                    //DARÁ O LOOP DO TOTAL DE CAMPO ADICIONADO
                    for ($i=0; $i < $totalLocator; $i++) {
                        # code...
                        $campo_user = array($request->survey_locator_name[$i] , $request->survey_locator_email[$i], $request->survey_locator_cpf[$i]);
                        $surv_new   = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_locator_cpf[$i], 'Locador');
                    }
                } else {
                    //VERIFICANDO SE ARRAY ID_USER É MENOR QUE NOME LOCADOR
                    if ($total_idUser < $totalLocator) {
                        $tot = 0;
                        for ($i=0; $i < $total_idUser; $i++) {
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_upd = User::find($request->id_user[$i]);

                            $user_where = DB::table('users')->where('id', '=', $user_upd->id)->update([
                                                                            'name' => $request->survey_locator_name[$i] ,
                                                                            'email'=> $request->survey_locator_email[$i]
                                                                            ]);
                            DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]);
                            $tot = ($tot + 1);
                        }

                        //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                        for ($i=0; $i < $dif; $i++) {
                            # code...
                            $campo_user = array($request->survey_locator_name[$tot] , $request->survey_locator_email[$tot], $request->survey_locator_cpf[$tot]);
                            $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_locator_cpf[$tot], 'Locador');
                        }

                        //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                    } elseif ($total_idUser == $totalLocator) {
                        for ($i=0; $i < $total_idUser; $i++) {
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_upd = User::find($request->id_user[$i]);



                            $user_where = DB::table('users')->where('id', '=', $user_upd->id)->update([
                                                                            'name' => $request->survey_locator_name[$i] ,
                                                                            'email'=> $request->survey_locator_email[$i]
                                                                            ]);
                            DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]);
                        }
                    }
                }

                /* ----  LOCATÁRIO  --- */
                //total de posição do array id_user

                // deixar o cpf obrigatório - ok
                // se cpf bater, faz update, se não, faz create do usuario
                // Verificar se ao excluir um usuario da vistoria, se ele foi excluido da anterior



                $total_idUserOccupant = 0;
                if ($request['id_user_occupant'] == null) {
                    $total_idUserOccupant = 0;
                } else {
                    $total_idUserOccupant = count($request['id_user_occupant']);
                }
                //toal de posição do array nome locador
                $total_nameOccupant = 0;
                if ($request['survey_occupant_name'] == null) {
                    $total_nameOccupant = 0;
                } else {
                    $total_nameOccupant = count($request['survey_occupant_name']) ;
                }
                //calculando a diferença dos dois arrays
                $dif_occupant = ($total_nameOccupant - $total_idUserOccupant);
                //VERIFICANDO SE ARRAY ID_USER É MENOR QUE NOME LOCADOR
                //dd($request->all());
                if ($total_idUserOccupant == 0) {
                    for ($i=0; $i < $total_nameOccupant; $i++) {                             # code...
                        $campo_user = array($request->survey_occupant_name[$i] , $request->survey_occupant_email[$i], $request->survey_occupant_cpf[$i]);
                        $surv_new_ocu = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_occupant_cpf[$i], 'Locatário');
                    }
                } else {
                    if ($total_idUserOccupant < $total_nameOccupant) {
                        $tot_occupant = 0;



                        for ($i=0; $i < $total_idUserOccupant; $i++) {
                            $userFields = [
                                $request->survey_occupant_name[$i],
                                $$request->survey_occupant_email[$i],
                            ];
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_occ = User::find($request->id_user_occupant[$i]);

                            if ($user_occ->cpf !== $request->survey_occupant_cpf[$i]) {
                                Survey::cadastra_usuario($userFields, $id, $request->survey_occupant_cpf[$i], 'Locatário');
                            } else {
                                $user_where_occ = DB::table('users')->where('id', '=', $user_occ->id)->update([
                                    'name' => $request->survey_occupant_name[$i] ,
                                    'email'=> $request->survey_occupant_email[$i]
                                    ]);
                                DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_occ->id)->update(['relation_survey_user_cpf' => $request->survey_occupant_cpf[$i]]);
                                $tot_occupant = ($tot_occupant + 1);
                            }
                        }
                        //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                        for ($i=0; $i < $dif_occupant; $i++) {
                            $campo_user = array($request->survey_occupant_name[$tot_occupant] , $request->survey_occupant_email[$tot_occupant], $request->survey_occupant_cpf[$tot_occupant]);
                            $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_occupant_cpf[$tot_occupant], 'Locatário');
                        }

                        //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                    } elseif ($total_idUserOccupant == $total_nameOccupant) {
                        for ($i=0; $i < $total_idUserOccupant; $i++) {
                            $userFields = [
                                $request->survey_occupant_name[$i],
                                $request->survey_occupant_email[$i],
                            ];
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_occ = User::find($request->id_user_occupant[$i]);


                            if ($user_occ->cpf !== $request->survey_occupant_cpf[$i]) {
                                Survey::cadastra_usuario($userFields, $id, $request->survey_occupant_cpf[$i], 'Locatário');
                            } else {
                                $user_where_occ = DB::table('users')->where('id', '=', $user_occ->id)->update([
                                    'name' => $request->survey_occupant_name[$i],
                                    'email' => $request->survey_occupant_email[$i]
                                ]);
                                DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_occ->id)->update(['relation_survey_user_cpf' => $request->survey_occupant_cpf[$i]]);
                            }
                        }
                    }
                }
            }

            /* ----  FIADOR Guarantor --- */
            $total_idUserGuarantor = 0;
            if ($request['id_user_guarantor'] == null) {
                $total_idUserGuarantor = 0;
            } else {
                $total_idUserGuarantor  = count($request['id_user_guarantor']);
            }
            $total_nameGuarantor = 0;
            if ($request['survey_guarantor_name'] == null) {
                $total_nameGuarantor = 0;
            } else {
                $total_nameGuarantor    = count($request['survey_guarantor_name']) ;
            }
            $difGuarantor   = ($total_nameGuarantor - $total_idUserGuarantor);
            //dd($request['survey_guarantor_name']);
            if ($total_idUserGuarantor == 0) {
                for ($i=0; $i < $total_nameGuarantor; $i++) {
                    $campo_user = array($request->survey_guarantor_name[$i] , $request->survey_guarantor_email[$i], $request->survey_guarantor_cpf[$i]);
                    $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_guarantor_cpf[$i], 'Fiador');
                }
            } else {
                if ($total_idUserGuarantor < $total_nameGuarantor) {
                    $tot_guarantor = 0;
                    for ($i=0; $i < $total_idUserGuarantor; $i++) {
                        # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_gua = User::find($request->id_user_guarantor[$i]);

                        $user_where_gua = DB::table('users')->where('id', '=', $user_gua->id)->update([
                                                                        'name' => $request->survey_guarantor_name[$i] ,
                                                                        'email'=> $request->survey_guarantor_email[$i]
                                                                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_gua->id)->update(['relation_survey_user_cpf' => $request->survey_guarantor_cpf[$i]]);
                        $tot_guarantor = ($tot_guarantor + 1);
                    }

                    //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS

                    for ($i=0; $i < $difGuarantor; $i++) {
                        # code...
                        $campo_user = array($request->survey_guarantor_name[$tot_guarantor] , $request->survey_guarantor_email[$tot_guarantor], $request->survey_guarantor_cpf[$tot_guarantor]);
                        $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_guarantor_cpf[$tot_guarantor], 'Fiador');
                    }


                    //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                } elseif ($total_idUserGuarantor == $total_nameGuarantor) {
                    for ($i=0; $i < $total_idUserGuarantor; $i++) {
                        # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_gua = User::find($request->id_user_guarantor[$i]);
                        //dd($request['id_user_occupant']);
                        $user_where_gua = DB::table('users')->where('id', '=', $user_gua->id)->update([
                                                                        'name' => $request->survey_guarantor_name[$i] ,
                                                                        'email'=> $request->survey_guarantor_email[$i]
                                                                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_gua->id)->update(['relation_survey_user_cpf' => $request->survey_guarantor_cpf[$i]]);
                    }
                }
            }
            $survey = Survey::find($id);

            $request['survey_date'] = FunctionAll::DataBRtoMySQL($request['survey_date']);

            //PARA DEFINIR NO HISTORICO SE FOR SALVO O RASCUNHO OU FINALIZADO
            if ($request['survey_status'] == "Finalizada") {
                $content_not = " Finalizou a vistoria ";
            } else {
                $content_not = "Alterou e salvou o rascunho da vistoria.";
            }

            $year = Carbon::now();

            try {
                Survey::where('survey_id', $id)->update([
                            'survey_inspetor_name'      => $request['survey_inspetor_name'] ,
                            'survey_inspetor_cpf'       => $request['survey_inspetor_cpf']  ,
                            'survey_date'               => $request['survey_date']  ,
                            'survey_type'               => $request['survey_type']  ,
                            'survey_address_immobile'   => $request['survey_address_immobile']  ,
                            'survey_type_immobile'      => $request['survey_type_immobile']  ,
                            'survey_energy_meter'       => $request['survey_energy_meter']  ,
                            'survey_energy_load'        => $request['survey_energy_load']  ,
                            'survey_water_meter'        => $request['survey_water_meter']  ,
                            'survey_water_load'         => $request['survey_water_load']  ,
                            'survey_gas_meter'          => $request['survey_gas_meter']  ,
                            'survey_gas_load'           => $request['survey_gas_load']  ,
                            'survey_general_aspects'    => $request['survey_general_aspects']  ,
                            'survey_reservation'        => $request['survey_reservation']  ,
                            'survey_keys'               => $request['survey_keys'] ,
                            'survey_status'             => $request['survey_status'],
                            'created_at'                => Carbon::now(),
                            'survey_date_register'      => Carbon::now(),
                            'survey_code'               => $id.'/'.date("y"),
                            'survey_link_tour'          => $request['survey_link_tour'],
                            'survey_provisions'         => $request['survey_provisions']
                        ]);
                //  //notificando a todos os usuarios
                //Helpers::reg_not_all(null, Auth::user()->nick. $content_not .$id);

                DB::table('history_survey')->insert(['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => $content_not , 'history_survey_id_survey' => $id , 'history_survey_date' => Carbon::now() , 'history_survey_updated' => Carbon::now(), 'history_survey_created' => Carbon::now()]);

                return response()->json(['mensagem' => 'success' ]);
            } catch (Exception $e) {
                return response($e->getMessage());
            }
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSurvey()
    {
        // DB::enableQueryLog();
        $survey = Survey::where(['survey_filed' => 0])->orderBy('survey_id', 'desc');

        // $query = DB::getQueryLog();
        return Datatables::of($survey)
                ->editColumn('survey_date_register', function ($survey) {
                    return $survey->survey_date_register ? with(new Carbon($survey->survey_date_register))->format('d/m/Y') : '';
                })
                ->editColumn('survey_address_immobile', function ($survey) {
                    return  substr($survey->survey_address_immobile, 0, 50).'...' ;
                })
                ->editColumn('survey_inspetor_name', function ($survey) {
                    return  substr($survey->survey_inspetor_name, 0, 17).'...' ;
                })
                ->addColumn('action', function ($survey) {
                    $class_enable = "enabled";
                    if ($survey->survey_status == "Finalizada") {
                        $class_enable = "disabled";
                    }
                    return '<a href="'.url('vistoria/'.base64_encode($survey->survey_id).'/editar/Editar-Vistoria/acao').'" class="btn '.$class_enable.'" data-toggle="tooltip" data-placement="left" title="Editar Vistsoria '.$survey->survey_id.'"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a href="'.url('vistoria/imprimir?id_survey='.$survey->survey_id.'&imprimir_com_foto=true').'" class="btn" target="_blank" title="Imprmir Vistoria '.$survey->survey_id.'"><i class="fa fa-print" aria-hidden="true"></i></a>
                        <a href="#" class="btn" onclick="repli('.$survey->survey_id.');" title="Replicar Vistoria '.$survey->survey_id.'"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                        <a href="'.url('vistoria/'.base64_encode($survey->survey_id).'/download').'" class="btn '.$class_enable.'" title="Visualizar e Download da Vistoria '.$survey->survey_id.'"><span class="badge-noti">'.Survey::countImage($survey->survey_id).'</span><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                        <a href="#" class="btn text-danger '.$class_enable.'" onclick="delete_survey('.$survey->survey_id.')" title="Excluir vistoria -'.$survey->survey_id.'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a href="'.url('vistoria/historico/'.$survey->survey_id).'" class="btn " onclick="" title=Historico da vistoria -'.$survey->survey_id.'"><i class="fa fa-history" aria-hidden="true"></i></a>';
                })      //<a href="#" class="btn" data-toggle="tooltip" data-placement="left" title="Visualizar em 360 '.$survey->survey_id.'"><i class="fa fa-street-view" aria-hidden="true"></i></a>
                ->make(true);

        //return Datatables::of(Survey::get()->make(true);
    }

    public function delete_user_survey(Request $request)
    {
        # code...

        //$id_user, $id_survey
        try {
            User::destroy($request['id']);
            DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $request['id'])->delete();
            return response()->json(['messagem' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Erro: '.$g->getMessage()]);
        }
    }

    public function upload(Request $request)
    {
        # //Created in 2016-07-26 20:02 by Junior Oliveira
        global $ambience , $id_survey, $tmp_name;
        //id vistoria
        $id_survey     = $request['ambience_id'];
        //ambiente escolhido - ID
        $ambience       = $request['ambience'];
        if ($request['foto'] == 'normal') {
            $tipo = 'normal';
        } elseif ($request['foto'] == '360') {
            $tipo = '360';
            //CRIANDO UMA VARIAVEL PARA PREENCHELA COM O NOME DOS ARQUIVOS 360 PARA ENVIAR VIA EMAIL
            $files = array();
        }
        //Survey::addRelationSurveyAmbienceOrder($ambience, $id_survey);
        //CONTANDO O TOTAL
        try {
            $tot_array = count($_FILES["img_photo"]["name"]);
            for ($i=0; $i < $tot_array; $i++) {
                $tmp_name = $_FILES["img_photo"]["tmp_name"][$i];
                // //PEGANDO A EXTENSAO DA CADA IMAGEM
                $exp = explode(".", $_FILES["img_photo"]["name"][$i]);
                $extension = end($exp);
                // // //RENOMIANDO O ARQUIVO
                $name =  time(). '_'.Str::random(20).'.'.$extension;
                if ($tipo == 'normal') {
                    //REDIMENSIONANDO IMAGEM
                    //$image = Image::make($tmp_name)->resize(300,300)->save('public/dist/img/upload/vistoria/'. $name);
                    $uploadFile = 'dist/img/upload/vistoria/'. basename($name);
                    move_uploaded_file($tmp_name, $uploadFile);
                    Survey::addFilesAmbience($ambience, $name, $id_survey, $tipo);
                } elseif ($tipo == '360') {
                    //echo "arquivo ".$cont." - ".$name."<br>";
                    $uploadFile = 'dist/img/upload/vistoria/'. basename($name);
                    move_uploaded_file($tmp_name, $uploadFile);
                    list($width, $height, $type, $attr) = getimagesize(url('dist/img/upload/vistoria/'.$name));
                    //CADASTRANDO AS INFORMAÇÕES SOBRE O ARQUIVO
                    $files_ambience = Survey::addFilesAmbience($ambience, $name, $id_survey, $tipo);
                    //REGISTRANDO O TAMANHO ORIGINAL
                    Survey::addConfigFiles($width, $height, $files_ambience);
                }
            }
            //notificando a todos os usuarios
            // Helpers::reg_not_all(null, Auth::user()->nick. " adicionou novas imagens na vistoria ".$id_survey);
            return response()->json(['mensagem' => 'success']);
        } catch (Intervention\Image\Exception\NotReadableException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        // return response()->json(['mensagem' => $name]);
    }

    public function print_survey(Request $request)
    {
        ini_set('memory_limit', '128M');
        ob_start();
        //ini_set('max_execution_time', 300);
        $id = $request['id_survey'];
        $order_ambience = DB::table('order_ambience_survey')->where('order_ambience_survey_id_survey', $id)->get();

        if (count($order_ambience) == 0) {
            Survey::addOrderAmbienceSurvey($id);
            $order_ambience = DB::table('order_ambience_survey')->where('order_ambience_survey_id_survey', $id)->get();
        }

        //PARA ORDENAR O AMBIENTE
        if ($order_ambience[0]->order_ambience_survey_order == 0) {
            $survey = DB::table('files_ambience')
            ->join('survey', 'survey.survey_id', '=', 'files_ambience.files_ambience_id_survey')
            ->join('ambience', 'ambience.ambience_id', '=', 'files_ambience.files_ambience_id_ambience')
            ->where('survey_id', $id)
            ->get();
        } else {
            $survey = DB::table('files_ambience')
            ->join('survey', 'survey.survey_id', '=', 'files_ambience.files_ambience_id_survey')
            ->join('ambience', 'ambience.ambience_id', '=', 'files_ambience.files_ambience_id_ambience')
            ->where('survey_id', $id)
            ->orderByRaw("FIELD(ambience_id,".$order_ambience[0]->order_ambience_survey_list_order.")")->get();
        }

        if ($survey->count() == 0) {
            $survey = Survey::where('survey_id', $id)->get();
            $photo_ambience = false;
        } else {
            $photo_ambience = true;
        }

        $users = DB::table('relation_survey_user')
                    ->join('survey', 'survey.survey_id', '=', 'relation_survey_user.relation_survey_user_id_survey')
                    ->join('users', 'users.id', '=', 'relation_survey_user.relation_survey_user_id_user')
                    ->where('relation_survey_user.relation_survey_user_id_survey', $id)->get();
        //PARA AS RUBRICAS DO LOCADOR(S)
        $countLocador = 0;
        foreach ($users as $userLocador) {
            # code...
            if ($userLocador->relation_survey_user_type == 'Locador') {
                $countLocador ++;
            }
        }         //PARA AS RUBRICAS DOS LOCATÁRIOS
        $countLocatario = 0;
        foreach ($users as $userLocatario) {
            # code...
            if ($userLocatario->relation_survey_user_type == 'Locatário') {
                $countLocatario ++;
            }
        }
        //PARA AS RUBRICAS DO(S) FIADOR(ES)
        $countFiador = 0;
        foreach ($users as $userFiador) {
            # code...
            if ($userFiador->relation_survey_user_type == 'Fiador') {
                $countFiador ++;
            }
        }

        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        //DATA POR EXTENSO
        if ($survey[0]->survey_status == "Rascunho") {
            $dtSurvey = Carbon::parse($survey[0]->survey_date_register);
            $data_extenso = FunctionAll::data_extenso($dtSurvey->day, $dtSurvey->month, $dtSurvey->year);
        } else {// SE FINALIZADO
            $dtSurvey = Carbon::parse($survey[0]->survey_finalized_date);
            $data_extenso = FunctionAll::data_extenso($dtSurvey->day, $dtSurvey->month, $dtSurvey->year);
        }
        $settings = DB::table('settings')->get();


        //FILTRANDO O ARRAY COM TIPO 360
        //     $survey_type = FALSE;
        //     foreach ($survey as $key => $value) {
        //         //echo "key ".$key.' - '.$value;
        //         if(isset($value->files_ambience_id))
        //         {
        //             $survey_type = TRUE;
        //         }
        //     }//fim
        //    dump($survey_type);
        //    dd($survey->count());
        //     if($survey_type == TRUE)
        //     {

        //        $survey_360 = array_filter(
        //             $survey,
        //             function($item)
        //             {
        //                 if ( $item->files_ambience_type == '360' )
        //                     return TRUE;

        //                 return FALSE;
        //             }
        //         );
        //     }else{
        //         $survey_360 = [];
        //     }

        //VARIÁVEIS COM AS FOTOS NORMAIS
        $survey_normal = $survey;
        //LOOP RETIRANDO OS INDICES COM O TIPO 360
        // foreach ($survey_360 as $key => $value)
        // {
        //     unset( $survey_normal[$key] );
        // }
        //$survey_normal ESTÁ NESSE MOMENTO COM AS FOTOS CONVENCIONAIS
        $survey_update = [];
        foreach ($survey_normal as $item) {
            //$suvey_update = $survey ALTERADO SOM OS INDICES 360
            //SERÁ FEITO O LOOP DELE PRIMEIRAMENTE MOSTRANDO AS FOTOS
            //ESTÁ PREENCHENDO O INDICE CONCATENENDO O ITEM
            $survey_update[ $item->ambience_id ][] = $item;
        }

        $survey_update_360 = [];
        // foreach ( $survey_360 as $item )
        // {
        //     $survey_update_360[ $item->ambience_id ][] = $item;
        // }
        //dd($survey);
        // return view('survey.report.view_survey',['survey' => $survey , 'survey_update' => $survey_update , 'survey_update_360' => $survey_update_360 , 'settings' => $settings , 'users' => $users, 'data_extenso' => $data_extenso , 'photo_ambience' => $photo_ambience ]);
        $pdf = PDF::loadView(
            'survey.report.view_survey',
            ['survey' => $survey ,
            'survey_update' => $survey_update ,
            'survey_update_360' => $survey_update_360 ,
            'settings' => $settings , 'users' => $users,
            'data_extenso' => $data_extenso ,
            'photo_ambience' => $photo_ambience ,
            'countLocador' => $countLocador,
            'countLocatario' => $countLocatario,
            'countFiador' => $countFiador
        ]
        );
        ob_clean();
        $pdf->setPaper('A4', 'report');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf->get_canvas();
        // page_text(pos_horizontal,pos_vertical , texto , null , tamanho, cor_em_rgb)

        $canvas->page_text(510, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream("Vistoria_".$request['id_survey'].".pdf");
    }

    public function download($id)
    {
        # Created 2016-08-22 12:35 by Junior Oliveira
        //PARA UPLOAD DE AMBIENTE
        $id_survey  = base64_decode($id);
        //PARA MODAL DE AMBIENTE
        $ambience       = DB::table('ambience')->orderBy('ambience_name')->get();
        $title_survey   =  'Editar-Vistoria';
        $disabled       = 'disabled';
        $files_ambience = FilesAmbience::where('files_ambience_id_survey', $id_survey)->get();
        //RECEBENDO TODOS OS ARQUIVOS
        DB::enableQueryLog();
        $list = FilesAmbience::where('files_ambience_id_survey', $id_survey)->distinct()->get(['files_ambience_id_ambience']);
        $list->sortByDesc('files_ambience_id');
        if (count($list) > 0) {
            $name_ambience = Survey::getOrderAmbienceSurvey($list);
            $disabled = '';
        } else {
            $name_ambience = [];
        }
        $order_actual = OrderAmbienceSurvey::where('order_ambience_survey_id_survey', $id_survey)->get();

        $array_list_order = Survey::converterOrdertoString($list);
        if (count($order_actual) > 0) {
            $itens = $order_actual[0]->order_ambience_survey_list_order;
            $name_order_actual = Ambience::whereIn('ambience_id', $array_list_order)->orderByRaw("FIELD(ambience_id, $itens)")->get();
        } else {
            $name_order_actual = [];
        }


        return view('survey.download', compact('title_survey', 'id_survey', 'ambience', 'files_ambience', 'name_ambience', 'disabled', 'name_order_actual'));
    }

    public function reply_survey($id_survey)
    {
        $id = base64_decode($id_survey);

        $carbon = Carbon::now();
        $title_survey  =  'Replicando Vistoria';
        //NOVO REGISTRO
        $survey_reply = Survey::find($id)->replicate();
        $survey_reply->survey_status = 'Rascunho';
        $survey_reply->survey_code = $survey_reply->survey_id.'/'.date('y');
        $survey_reply->save();

        //BUSCANDO A VISTORIA REPLICADA
        $survey_update = Survey::where('survey_id', $survey_reply->survey_id)->get();

        $ambience       = DB::table('ambience')->get();

        //MESMA ROTINA PARA UPDATE - RELACIONA AS TABELAS VISTORIA, USUARIO NA TABELA RELAÇAO
        // DB::enableQueryLog();
        $survey = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id', '=', 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users', 'users.id', '=', 'relation_survey_user.relation_survey_user_id_user')
                        ->where('relation_survey_user.relation_survey_user_id_survey', $id)->get();
        // dump($survey_reply->survey_id);
        //return DB::getQueryLog();
        $photo = DB::table('files_ambience')->where('files_ambience_id_survey', '=', $id)->get();
        Survey::addOrderAmbienceSurvey($id);

        global $new_photo;
        $new_photo = [];
        foreach ($photo as $value) {
            // echo $value->files_ambience_description_file."<br>";
            //echo $survey_reply->survey_id;
            $new_files = DB::table('files_ambience')->insert(
                ['files_ambience_description_file' => $value->files_ambience_description_file,
                            'files_ambience_id_survey' => $survey_reply->survey_id,
                            'files_ambience_type' => $value->files_ambience_type ,
                            'created_at' => $carbon,
                            'updated_at' => $carbon,
                            'files_ambience_id_ambience' => $value->files_ambience_id_ambience]
            );
        }
        # code / DUPLICANDO REGISTRO RELATION_SURVEY_USER COM O ID DA VISTORIA DUPLICADA
        foreach ($survey as $id_rel) {
            # code...
            //METODO REPLICATE SÓ FUNCIONOU COM O MODEL E METODO FIND
            $new_rel = RelSurveyUser::find($id_rel->relation_survey_user_id)->replicate();
            //ALTERANDO O ID DA VISTORIA PARA O ID DA NOVA VISTORIA REPLICADA
            $new_rel->relation_survey_user_id_survey = $survey_reply->survey_id;
            $new_rel->save();
        }
        $id_survey =  $survey_reply->survey_id;

        DB::table('survey')
            ->where('survey_id', $id_survey)
            ->update(['survey_code' => $id_survey.'/'.date('y')]);
        /*ENVIANDO O OBJETO JA EXISTENTE PARA PREENCHER TODOS OS CAMPOS
        ENVIANDO O OBJETO RECEM CADASTRADO
        ENVIADO O TITULO PARA MUDAR O VALOR DO CAMPO
        */
        $history    = DB::table('history_survey')->insert(
            ['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => 'Replicou a vistoria '.$id,
                            'history_survey_created' => Carbon::now(), 'history_survey_id_survey' =>  $survey_reply->survey_id ,
                            'history_survey_updated' => Carbon::now() , 'history_survey_date' => Carbon::now()]
        );

        //notificando a todos os usuarios
        //Helpers::reg_not_all(null, Auth::user()->nick. " replicou a vistoria nº ".$id);
        $tit_small_survey = 'Replicando-Vistoria';

        return redirect('vistoria/'.base64_encode($survey_reply->survey_id).'/editar/Replicando-Vistoria/acao');
    }

    public function filed($id)
    {
        try {
            Survey::where('survey_id', $id)->update(['survey_filed' => 1]);
            return response()->json(['message' => 'success', 'description' => 'Vistoria Arquivada com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error' , 'description' => 'Ocorreu o erro: '.$e->getMessage()]);
        }
    }

    public function history($id)
    {
        if (isset($id)) {
            $history = DB::table('history_survey')
                        ->join('users', 'users.id', '=', 'history_survey.history_survey_id_user')
                        ->where('history_survey.history_survey_id_survey', $id)
                        ->orderBy('history_survey_date', 'desc')->get();

            if (empty($history)) {
                return redirect('vistoria')->with('error_message', 'Não há histórico para essa vistoria');
            } else {
                return view('survey.history', compact('history'));
            }

            return response()->json($history);
        }
    }

    public function alter_ambience(Request $request)
    {
        //dd($request->all());
        //PARA EXCLUSÃO - VERIFICA SE TEM O ARRAY DE EXCLUIR
        if (isset($request['surveyDelete'])) {
            try {
                FilesAmbience::whereIn('files_ambience_id', $request['surveyDelete'])->delete();
                return back()->with('success', 'Imagens excluida com sucesso');
            } catch (Exception $e) {
                return back()->with('error_message', 'Não foi possível fazer a exclusão. Erro: '.$e->getMessage());
            }
            //CASO NÃO TENHA O ARRAY VAI VERIFICAR SE O ARRAY DE ALTERAR TEM ALGUMA COISA
        } elseif (!isset($request['surveyAlter'])) {
            return back()->with('error_message', 'Não está selecionado nenhuma imagem, por favor selecionar para fazer a alteração');
        //SE TIVER ARRAY DE ALTERAR, FAZ A ALTERAÇÃO
        } else {
            FilesAmbience::whereIn('files_ambience_id', $request['surveyAlter'])->update(['files_ambience_id_ambience' => $request['files_ambience_id_ambience']]);
            return back()->with('success', 'Ambiente alterado com sucesso');
        }
    }

    public function alter_order_ambience_survey(Request $request)
    {
        $request['order_ambience_survey_order'] = 1;
        $string_id =  substr_replace($request['order_ambience_survey_list_order'], '', -1);
        $request['order_ambience_survey_list_order'] = $string_id;

        try {
            OrderAmbienceSurvey::where('order_ambience_survey_id_survey', $request['order_ambience_survey_id_survey'])->update($request->all());
            return response()->json(['message' =>'success.', 'status' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['message' =>'erro'.$e->getMessage(), 'status' => 400], 400);
        }
    }
}
