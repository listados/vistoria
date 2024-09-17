<?php

namespace EspindolaAdm\Http\Controllers;

use DB;
use PDF;
use Auth;
use Carbon\Carbon;
use EspindolaAdm\User;
use EspindolaAdm\Survey;
use EspindolaAdm\Ambience;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use EspindolaAdm\FunctionAll;
use EspindolaAdm\FilesAmbience;
use EspindolaAdm\RelSurveyUser;
use Yajra\Datatables\Datatables;
use Illuminate\Http\JsonResponse;
use PhpParser\Node\Expr\FuncCall;
use EspindolaAdm\Widgets\RecentNews;
use EspindolaAdm\OrderAmbienceSurvey;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\Validator;
use EspindolaAdm\Http\Requests\SurveyFields;
use EspindolaAdm\Http\Requests\SurveyRequest;
use EspindolaAdm\Repository\SurveyRepository;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class SurveyController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeImmobile = Survey::getTypeImmobile();
        $typeImmobile->pluck('survey_type_immobile','survey_type_immobile');
        $typeImmobiles = [];
        foreach ($typeImmobile as $key => $value) {
            array_push($typeImmobiles, ['value' => $value->survey_type_immobile, 'label' => $value->survey_type_immobile]);
        };

        $inspect = Survey::getInspector();
        return view('survey.index', compact('typeImmobiles', 'inspect'));
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

            return redirect('vistoria/' . base64_encode($nova) . '/editar/Nova-Vistoria/acao');
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', 'Ocorreu um erro, (' . $e . ') tente novamente');
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

        $locators = self::getUser($id_survey, 'Locador');
      
        return view('survey.create', compact('locators', 'ambience', 
        'title_survey', 'survey', 'survey_update', 'id_survey', 'tit_small_survey'));
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
        //SE TIVER LOCADOR NA VISTORIA
        if (isset($request['survey_locator_name'])) {
            //VERIFICAÇÃO PARA NOME DO LOCADOR
            $veri_locator = Survey::verifyUserExist($request['survey_locator_name']);
            if ($veri_locator['status'] == '400') {
                return response()->json(['messagem' => 'O LOCADOR precisa está com o nome preenchido.', 'status' => 400], 400);
            }
        }

        if (isset($request['survey_occupant_name'])) {
            //VERIFICAÇÃO PARA NOME DO LOCATARIO
            $veri_occupen = Survey::verifyUserExist($request['survey_occupant_name']);
            if ($veri_occupen['status'] == '400') {
                return response()->json(['mensagem' => 'O LOCATÁRIO precisa está com o nome preenchido.', 'status' => 400], 400);
            }
        }

        if (is_array($request['survey_occupant_cpf']) && isset($request['survey_occupant_cpf'])) {
            //VERIFICAÇÃO PAR NOME DO LOCATÁRIO 
            $veri_occupant = Survey::verifyUserExist($request['survey_occupant_cpf']);
            if ($veri_occupant['status'] == '400') {
                return response()->json(['mensagem' => 'O LOCATÁRIO precisa está com o CPF preenchido.', 'status' => 400], 400);
            }
        }

        if (isset($request['survey_guarantor_name'])) {
            //VERIFICAÇÃO PAR NOME DO FIADOR
            $veri_guarant = Survey::verifyUserExist($request['survey_guarantor_name']);
            if ($veri_guarant['status'] == '400') {
                return response()->json(['mensagem' => 'O FIADOR precisa está com o nome preenchido.', 'status' => 400], 400);
            }
        }

        if (is_array($request['survey_guarantor_cpf']) && isset($request['survey_guarantor_cpf'])) {
            //VERIFICAÇÃO PAR NOME DO FIADOR            
            $veri_occupant = Survey::verifyUserExist($request['survey_guarantor_cpf']);
            if ($veri_occupant['status'] == '400') {
                return response()->json(['mensagem' => 'O FIADOR precisa está com o CPF preenchido.', 'status' => 400], 400);
            }
        }

        if ($request['type_survey'] == 'Replicando-Vistoria') {
            DB::table('relation_survey_user')->where('relation_survey_user_id_survey', '=', $request['survey_id'])
                ->where('relation_survey_user_type', 'Locatário')
                ->delete();
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
                    for ($i = 0; $i < count($request['survey_locator_name']); $i++) {
                        $campo_user = array($request->survey_locator_name[$i], $request->survey_locator_email[$i], $request->survey_locator_cpf[$i]);

                        Survey::cadastra_usuario($campo_user, $id, $request->survey_locator_cpf[$i], 'Locador');
                    }
                }
                if ($request['survey_occupant_name'][0] == '') {
                    unset($request['survey_occupant_name']);
                } else {
                    for ($i = 0; $i < count($request['survey_occupant_name']); $i++) {
                        $campo_user = array($request->survey_occupant_name[$i], $request->survey_occupant_email[$i], $request->survey_occupant_cpf[$i]);
                        Survey::cadastra_usuario($campo_user, $id, $request->survey_occupant_cpf[$i], 'Locatário');
                    }
                }
                if ($request['survey_guarantor_name'][0] == '') {
                    unset($request['survey_guarantor_name']);
                } else {
                    for ($i = 0; $i < count($request['survey_guarantor_name']); $i++) {
                        $campo_user = array($request->survey_guarantor_name[$i], $request->survey_guarantor_email[$i], $request->survey_guarantor_cpf[$i]);
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
                    $totalLocator = count($request['survey_locator_name']);
                }
                //calculando a diferença dos dois arrays
                $dif = ($totalLocator - $total_idUser);

                /*É FEITO A VERIFICAÇÃO NO ARRAY ID_USER PARA CONSTATAR QUE NAO TEM CAMPOS NO ARRAY PARA FAZER UM NOVO CADASTRO*/

                if ($total_idUser == 0) {
                    //DARÁ O LOOP DO TOTAL DE CAMPO ADICIONADO
                    for ($i = 0; $i < $totalLocator; $i++) {
                        # code...
                        $campo_user = array($request->survey_locator_name[$i], $request->survey_locator_email[$i], $request->survey_locator_cpf[$i]);
                        $surv_new   = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_locator_cpf[$i], 'Locador');
                    }
                } else {
                    //VERIFICANDO SE ARRAY ID_USER É MENOR QUE NOME LOCADOR

                    if ($total_idUser < $totalLocator) {
                        $tot = 0;
                        for ($i = 0; $i < $total_idUser; $i++) {
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_upd = User::find($request->id_user[$i]);

                            $user_where = DB::table('users')->where('id', '=', $user_upd->id)->update([
                                'name' => $request->survey_locator_name[$i],
                                'email' => $request->survey_locator_email[$i]
                            ]);
                            DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]);
                            $tot = ($tot + 1);
                        }

                        //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                        for ($i = 0; $i < $dif; $i++) {
                            # code...
                            $campo_user = array($request->survey_locator_name[$tot], $request->survey_locator_email[$tot], $request->survey_locator_cpf[$tot]);
                            $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_locator_cpf[$tot], 'Locador');
                        }

                        //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                    } elseif ($total_idUser == $totalLocator) {
                        for ($i = 0; $i < $total_idUser; $i++) {
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_upd = User::find($request->id_user[$i]);
                            DB::table('users')->where('id', '=', $user_upd->id)->update([
                                'name' => $request->survey_locator_name[$i],
                                'email' => $request->survey_locator_email[$i]
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
                $totalOcupant = 0;
                if ($request['id_user_occupant'] == null) {
                    $totalOcupant = 0;
                } else {
                    $totalOcupant = count($request['id_user_occupant']);
                }

                //toal de posição do array nome locador
                $total_nameOccupant = 0;
                if ($request['survey_occupant_name'] == null) {
                    $total_nameOccupant = 0;
                } else {
                    $total_nameOccupant = count($request['survey_occupant_name']);
                }
                //calculando a diferença dos dois arrays
                $dif_occupant = ($total_nameOccupant - $totalOcupant);

                //VERIFICANDO SE ARRAY ID_USER É MENOR QUE NOME LOCADOR


                if ($totalOcupant == 0) {
                    for ($i = 0; $i < $total_nameOccupant; $i++) {
                        # code...
                        $campo_user = array($request->survey_occupant_name[$i], $request->survey_occupant_email[$i], $request->survey_occupant_cpf[$i]);
                        $surv_new_ocu = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_occupant_cpf[$i], 'Locatário');
                    }
                } else {
                    if ($totalOcupant < $total_nameOccupant) {
                        $tot_occupant = 0;
                        for ($i = 0; $i < $totalOcupant; $i++) {
                            $userFields = [
                                $request->survey_occupant_name[$i],
                                $request->survey_occupant_email[$i],
                            ];
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_occ = User::find($request->id_user_occupant[$i]);
                            //dd($request->all());
                            if ($user_occ->id !== intval($request->id_user_occupant[$i])) {
                                Survey::cadastra_usuario($userFields, $id, $request->survey_occupant_cpf[$i], 'Locatário');
                            } else {
                                $user_where_occ = DB::table('users')->where('id', '=', $user_occ->id)->update([
                                    'name' => $request->survey_occupant_name[$i],
                                    'email' => $request->survey_occupant_email[$i]
                                ]);
                                DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_occ->id)->update(['relation_survey_user_cpf' => $request->survey_occupant_cpf[$i]]);
                                $tot_occupant = ($tot_occupant + 1);
                            }
                        }
                        //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS
                        for ($i = 0; $i < $dif_occupant; $i++) {
                            $campo_user = array($request->survey_occupant_name[$tot_occupant], $request->survey_occupant_email[$tot_occupant], $request->survey_occupant_cpf[$tot_occupant]);
                            $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_occupant_cpf[$tot_occupant], 'Locatário');
                        }

                        //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                    } elseif ($totalOcupant == $total_nameOccupant) {
                        for ($i = 0; $i < $totalOcupant; $i++) {
                            $userFields = [
                                $request->survey_occupant_name[$i],
                                $request->survey_occupant_email[$i],
                            ];
                            # code...
                            //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                            $user_occ = User::find($request->id_user_occupant[$i]);
                            // dd($request->all());
                            if ($user_occ->id !== intval($request->id_user_occupant[$i])) {
                                Survey::cadastra_usuario($userFields, $request['survey_id'], $request->survey_occupant_cpf[$i], 'Locatário');
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
                $total_nameGuarantor    = count($request['survey_guarantor_name']);
            }
            $difGuarantor   = ($total_nameGuarantor - $total_idUserGuarantor);
            //dd($request['survey_guarantor_name']);
            if ($total_idUserGuarantor == 0) {
                for ($i = 0; $i < $total_nameGuarantor; $i++) {
                    $campo_user = array($request->survey_guarantor_name[$i], $request->survey_guarantor_email[$i], $request->survey_guarantor_cpf[$i]);
                    $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_guarantor_cpf[$i], 'Fiador');
                }
            } else {
                if ($total_idUserGuarantor < $total_nameGuarantor) {
                    $tot_guarantor = 0;
                    for ($i = 0; $i < $total_idUserGuarantor; $i++) {
                        # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_gua = User::find($request->id_user_guarantor[$i]);

                        $user_where_gua = DB::table('users')->where('id', '=', $user_gua->id)->update([
                            'name' => $request->survey_guarantor_name[$i],
                            'email' => $request->survey_guarantor_email[$i]
                        ]);
                        DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_gua->id)->update(['relation_survey_user_cpf' => $request->survey_guarantor_cpf[$i]]);
                        $tot_guarantor = ($tot_guarantor + 1);
                    }

                    //DARÁ O LOOP NO VALOR DA DIFIRENÇA DOS DOIS ARRAYS

                    for ($i = 0; $i < $difGuarantor; $i++) {
                        # code...
                        $campo_user = array($request->survey_guarantor_name[$tot_guarantor], $request->survey_guarantor_email[$tot_guarantor], $request->survey_guarantor_cpf[$tot_guarantor]);
                        $surv = Survey::cadastra_usuario($campo_user, $request['survey_id'], $request->survey_guarantor_cpf[$tot_guarantor], 'Fiador');
                    }


                    //VERIFICANDO SE O TOTAL DE ARRAY ID_USER É O MESMO TOTAL DO NOMES LOCADOR, CASO SENDO ATUALIZA
                } elseif ($total_idUserGuarantor == $total_nameGuarantor) {
                    for ($i = 0; $i < $total_idUserGuarantor; $i++) {
                        # code...
                        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
                        $user_gua = User::find($request->id_user_guarantor[$i]);
                        //dd($request['id_user_occupant']);
                        $user_where_gua = DB::table('users')->where('id', '=', $user_gua->id)->update([
                            'name' => $request->survey_guarantor_name[$i],
                            'email' => $request->survey_guarantor_email[$i]
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
                    'survey_inspetor_name'      => $request['survey_inspetor_name'],
                    'survey_inspetor_cpf'       => $request['survey_inspetor_cpf'],
                    'survey_date'               => $request['survey_date'],
                    'survey_type'               => $request['survey_type'],
                    'survey_address_immobile'   => $request['survey_address_immobile'],
                    'survey_type_immobile'      => $request['survey_type_immobile'],
                    'survey_energy_meter'       => $request['survey_energy_meter'],
                    'survey_energy_load'        => $request['survey_energy_load'],
                    'survey_water_meter'        => $request['survey_water_meter'],
                    'survey_water_load'         => $request['survey_water_load'],
                    'survey_gas_meter'          => $request['survey_gas_meter'],
                    'survey_gas_load'           => $request['survey_gas_load'],
                    'survey_general_aspects'    => $request['survey_general_aspects'],
                    'survey_reservation'        => $request['survey_reservation'],
                    'survey_keys'               => $request['survey_keys'],
                    'survey_status'             => $request['survey_status'],
                    'created_at'                => Carbon::now(),
                    'survey_date_register'      => Carbon::now(),
                    'survey_code'               => $id . '/' . date("y"),
                    'survey_link_tour'          => $request['survey_link_tour'],
                    'survey_provisions'         => $request['survey_provisions']
                ]);
                //  //notificando a todos os usuarios
                //Helpers::reg_not_all(null, Auth::user()->nick. $content_not .$id);

                DB::table('history_survey')->insert(['history_survey_id_user' => Auth::user()->id, 'history_survey_action' => $content_not, 'history_survey_id_survey' => $id, 
                'history_survey_date' => Carbon::now(), 'history_survey_updated' => Carbon::now(), 'history_survey_created' => Carbon::now()]);

                return response()->json(['mensagem' => 'success']);
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
        try {
            $survey = Survey::where('survey_id' , $id);
            $survey->delete();
            return response()->json(['message' => 'Vistoria Excluída com sucesso'], 200);    
        } catch (\Throwable $e) {
            return response()->json(['message' => FunctionAll::error($e)], 400);
        }
    }

    public function getSurvey(Request $request)
    {
        // DB::enableQueryLog();
        $is_post = false; //PARA ALTERAR DEPOIS SE CASO FOR METODO POST
        foreach ($request->server as $key => $value) {
            // dump($key.' - '.$value);
            if ($key == 'REQUEST_METHOD' && $value == 'POST') {
                $is_post = true;
            }
        }
        //dd($request->all());
        
        //SE REQUEST_METHOD FOR TIPO GET
        if (!$is_post) {
            $survey = Survey::where(['survey_filed' => 0])->orderBy('survey_id', 'desc')->take(50);

            // $query = DB::getQueryLog();
            return Datatables::of($survey)
                ->editColumn('survey_date_register', function ($survey) {
                    return $survey->survey_date_register ? with(new Carbon($survey->survey_date_register))->format('d/m/Y') : '';
                })
                ->editColumn('survey_address_immobile', function ($survey) {
                    return  substr($survey->survey_address_immobile, 0, 50) . '...';
                })
                ->editColumn('survey_inspetor_name', function ($survey) {
                    return  substr($survey->survey_inspetor_name, 0, 17) . '...';
                })
                ->addColumn('action', function ($survey) {
                    $class_enable = "enabled";
                    if ($survey->survey_status == "Finalizada") {
                        $class_enable = "disabled";
                    }
                    return '<a href="' . url('vistoria/' . base64_encode($survey->survey_id) . '/editar/Editar-Vistoria/acao') . '" class="btn ' . $class_enable . '" data-toggle="tooltip" data-placement="left" title="Editar Vistsoria ' . $survey->survey_id . '"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="' . url('vistoria/imprimir?id_survey=' . $survey->survey_id . '&imprimir_com_foto=true') . '" class="btn" target="_blank" title="Imprmir Vistoria ' . $survey->survey_id . '"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <a href="#" class="btn" onclick="repli(' . $survey->survey_id . ');" title="Replicar Vistoria ' . $survey->survey_id . '"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                            <a href="' . url('vistoria/' . base64_encode($survey->survey_id) . '/download') . '" class="btn ' . $class_enable . '" title="Visualizar e Download da Vistoria ' . $survey->survey_id . '"><span class="badge-noti">' . Survey::countImage($survey->survey_id) . '</span><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                            <a href="#" class="btn text-danger ' . $class_enable . '" onclick="delete_survey(' . $survey->survey_id . ')" title="Excluir vistoria -' . $survey->survey_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="' . url('vistoria/historico/' . $survey->survey_id) . '" class="btn " onclick="" title=Historico da vistoria -' . $survey->survey_id . '"><i class="fa fa-history" aria-hidden="true"></i></a>';
                })      //<a href="#" class="btn" data-toggle="tooltip" data-placement="left" title="Visualizar em 360 '.$survey->survey_id.'"><i class="fa fa-street-view" aria-hidden="true"></i></a>
                ->make(true);
        } else {
            
            $survey = Survey::searchSurvey($request->all());
            // $query = DB::getQueryLog();
            return Datatables::of($survey)
                ->editColumn('survey_date_register', function ($survey) {
                    return $survey->survey_date_register ? with(new Carbon($survey->survey_date_register))->format('d/m/Y') : '';
                })
                ->editColumn('survey_address_immobile', function ($survey) {
                    return  substr($survey->survey_address_immobile, 0, 50) . '...';
                })
                ->editColumn('survey_inspetor_name', function ($survey) {
                    return  substr($survey->survey_inspetor_name, 0, 17) . '...';
                })
                ->addColumn('action', function ($survey) {
                    $class_enable = "enabled";
                    if ($survey->survey_status == "Finalizada") {
                        $class_enable = "disabled";
                    }
                    return '<a href="' . url('vistoria/' . base64_encode($survey->survey_id) . '/editar/Editar-Vistoria/acao') . '" class="btn ' . $class_enable . '" data-toggle="tooltip" data-placement="left" title="Editar Vistsoria ' . $survey->survey_id . '"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="' . url('vistoria/imprimir?id_survey=' . $survey->survey_id . '&imprimir_com_foto=true') . '" class="btn" target="_blank" title="Imprmir Vistoria ' . $survey->survey_id . '"><i class="fa fa-print" aria-hidden="true"></i></a>
                            <a href="#" class="btn" onclick="repli(' . $survey->survey_id . ');" title="Replicar Vistoria ' . $survey->survey_id . '"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                            <a href="' . url('vistoria/' . base64_encode($survey->survey_id) . '/download') . '" class="btn ' . $class_enable . '" title="Visualizar e Download da Vistoria ' . $survey->survey_id . '"><span class="badge-noti">' . Survey::countImage($survey->survey_id) . '</span><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                            <a href="#" class="btn text-danger ' . $class_enable . '" onclick="delete_survey(' . $survey->survey_id . ')" title="Excluir vistoria -' . $survey->survey_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="' . url('vistoria/historico/' . $survey->survey_id) . '" class="btn " onclick="" title=Historico da vistoria -' . $survey->survey_id . '"><i class="fa fa-history" aria-hidden="true"></i></a>';
                })      //<a href="#" class="btn" data-toggle="tooltip" data-placement="left" title="Visualizar em 360 '.$survey->survey_id.'"><i class="fa fa-street-view" aria-hidden="true"></i></a>
                ->make(true);
        }

        //return Datatables::of(Survey::get()->make(true);
    }

    public function searchSurvey() {
        return view('survey.search');
    }

    public function delete_user_survey($id)
    {
        # code...

        //$id_user, $id_survey
        try {
            $user = DB::table('relation_survey_user')
            ->where('relation_survey_user_id', '=', $id);
            $user->delete();
            return response()->json(['message' => 'Excluído com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => FunctionAll::error($e)], 400);
        }
    }

    public function upload(Request $request)
    {
        # //Created in 2016-07-26 20:02 by Junior Oliveira
        global $ambience, $id_survey, $tmp_name;
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
            for ($i = 0; $i < $tot_array; $i++) {
                $tmp_name = $_FILES["img_photo"]["tmp_name"][$i];
                // //PEGANDO A EXTENSAO DA CADA IMAGEM
                $exp = explode(".", $_FILES["img_photo"]["name"][$i]);
                $extension = end($exp);
                // // //RENOMIANDO O ARQUIVO
                $name =  time() . '_' . Str::random(20) . '.' . $extension;
                if ($tipo == 'normal') {
                    //REDIMENSIONANDO IMAGEM
                    //$image = Image::make($tmp_name)->resize(300,300)->save('public/dist/img/upload/vistoria/'. $name);
                    $uploadFile = 'dist/img/upload/vistoria/' . basename($name);
                    move_uploaded_file($tmp_name, $uploadFile);
                    Survey::addFilesAmbience($ambience, $name, $id_survey, $tipo);
                } elseif ($tipo == '360') {
                    //echo "arquivo ".$cont." - ".$name."<br>";
                    $uploadFile = 'dist/img/upload/vistoria/' . basename($name);
                    move_uploaded_file($tmp_name, $uploadFile);
                    list($width, $height, $type, $attr) = getimagesize(url('dist/img/upload/vistoria/' . $name));
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
                ->orderByRaw("FIELD(ambience_id," . $order_ambience[0]->order_ambience_survey_list_order . ")")->get();
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
            // dd($users   );
        //PARA AS RUBRICAS DO LOCADOR(S)
        $countLocador = 0;
        foreach ($users as $userLocador) {
            # code...
            if ($userLocador->relation_survey_user_type == 'Locador') {
                $countLocador++;
            }
        }         //PARA AS RUBRICAS DOS LOCATÃRIOS
        $countLocatario = 0;
        foreach ($users as $userLocatario) {
            # code...
            if ($userLocatario->relation_survey_user_type == 'Locatário') {
                $countLocatario++;
            }
        }
        //PARA AS RUBRICAS DO(S) FIADOR(ES)
        $countFiador = 0;
        foreach ($users as $userFiador) {
            # code...
            if ($userFiador->relation_survey_user_type == 'Fiador') {
                $countFiador++;
            }
        }
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        //DATA POR EXTENSO
        if ($survey[0]->survey_status == "Rascunho") {
            $dtSurvey = Carbon::parse($survey[0]->survey_date_register);
            $data_extenso = FunctionAll::data_extenso($dtSurvey->day, $dtSurvey->month, $dtSurvey->year);
        } else { // SE FINALIZADO
            $dtSurvey = Carbon::parse($survey[0]->survey_finalized_date);
            $data_extenso = FunctionAll::data_extenso($dtSurvey->day, $dtSurvey->month, $dtSurvey->year);
        }
        $settings = DB::table('settings')->get();

        //VARIÃVEIS COM AS FOTOS NORMAIS
        $survey_normal = $survey;

        //$survey_normal ESTÃ NESSE MOMENTO COM AS FOTOS CONVENCIONAIS
        $survey_update = [];
        foreach ($survey_normal as $item) {
            //$suvey_update = $survey ALTERADO SOM OS INDICES 360
            //SERÃ FEITO O LOOP DELE PRIMEIRAMENTE MOSTRANDO AS FOTOS
            //ESTÃ PREENCHENDO O INDICE CONCATENENDO O ITEM
            $survey_update[$item->ambience_id][] = $item;
        }

        $survey_update_360 = [];
        $pdf = PDF::loadView(
            'survey.report.view_survey',
            [
                'survey' => $survey,
                'survey_update' => $survey_update,
                'survey_update_360' => $survey_update_360,
                'settings' => $settings, 'users' => $users,
                'data_extenso' => $data_extenso,
                'photo_ambience' => $photo_ambience,
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

        return $pdf->stream("Vistoria_" . $request['id_survey'] . ".pdf");
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
        // DB::enableQueryLog();
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
        //OBTENDO O STATUS DA VISTORIA
        $status = Survey::where('survey_id', $id_survey)->first()->survey_status;
        return view('survey.download', 
            compact('status','title_survey', 'id_survey', 'ambience', 'files_ambience', 'name_ambience', 'disabled', 'name_order_actual'));
    }

    public function reply_survey($id_survey)
    {
        //decodifica id da vistoria
        $id = base64_decode($id_survey);

        $carbon = Carbon::now();
        $title_survey  =  'Replicando Vistoria';
        //NOVO REGISTRO
        $survey_reply = Survey::find($id)->replicate();
        $survey_reply->survey_status = 'Rascunho';
        $survey_reply->survey_code = $survey_reply->survey_id . '/' . date('y');
        $survey_reply->save();

        //BUSCANDO A VISTORIA REPLICADA
        Survey::where('survey_id', $survey_reply->survey_id)->get();

        DB::table('ambience')->get();

        //MESMA ROTINA PARA UPDATE - RELACIONA AS TABELAS VISTORIA, USUARIO NA TABELA RELAÇAO
        // DB::enableQueryLog();
        $survey = DB::table('relation_survey_user')
            ->join('survey', 'survey.survey_id', '=', 'relation_survey_user.relation_survey_user_id_survey')
            ->join('users', 'users.id', '=', 'relation_survey_user.relation_survey_user_id_user')
            ->where('relation_survey_user.relation_survey_user_id_survey', $id)->get();
        //return DB::getQueryLog();
        $photo = DB::table('files_ambience')->where('files_ambience_id_survey', '=', $id)->get();
        Survey::addOrderAmbienceSurvey($id);

        global $new_photo;
        $new_photo = [];
        foreach ($photo as $value) {
            // echo $value->files_ambience_description_file."<br>";
            //echo $survey_reply->survey_id;
            $new_files = DB::table('files_ambience')->insert(
                [
                    'files_ambience_description_file' => $value->files_ambience_description_file,
                    'files_ambience_id_survey' => $survey_reply->survey_id,
                    'files_ambience_type' => $value->files_ambience_type,
                    'created_at' => $carbon,
                    'updated_at' => $carbon,
                    'files_ambience_id_ambience' => $value->files_ambience_id_ambience
                ]
            );
        }
        # code / DUPLICANDO REGISTRO RELATION_SURVEY_USER COM O ID DA VISTORIA DUPLICADA
        $new_rel = [];
        foreach ($survey as $id_rel) {
            //METODO REPLICATE SÓ FUNCIONOU COM O MODEL E METODO FIND
            $new_rel = RelSurveyUser::find($id_rel->relation_survey_user_id)->replicate();

            //ALTERANDO O ID DA VISTORIA PARA O ID DA NOVA VISTORIA REPLICADA
            $new_rel->relation_survey_user_id_survey = $survey_reply->survey_id;
            $new_rel->save();

            //VERFICANDO CADA USUARIO REPLICADO SE ELE É LOCATARIO OU FIADOR
            //SENDO, OS MESMOS SERA EXCLUIDO E VISTORIA GERADA SOMENTE COM LOCADOR
            if ($new_rel->relation_survey_user_type == 'Locatário' || $new_rel->relation_survey_user_type == 'Fiador') {
                RelSurveyUser::find($new_rel->relation_survey_user_id)->delete();
            }
        }
        $id_survey =  $survey_reply->survey_id;

        DB::table('survey')
            ->where('survey_id', $id_survey)
            ->update(['survey_code' => $id_survey . '/' . date('y')]);
        /*ENVIANDO O OBJETO JA EXISTENTE PARA PREENCHER TODOS OS CAMPOS
        ENVIANDO O OBJETO RECEM CADASTRADO
        ENVIADO O TITULO PARA MUDAR O VALOR DO CAMPO
        */
        $history    = DB::table('history_survey')->insert(
            [
                'history_survey_id_user' => Auth::user()->id, 'history_survey_action' => 'Replicou a vistoria ' . $id,
                'history_survey_created' => Carbon::now(), 'history_survey_id_survey' =>  $survey_reply->survey_id,
                'history_survey_updated' => Carbon::now(), 'history_survey_date' => Carbon::now()
            ]
        );

        //notificando a todos os usuarios
        //Helpers::reg_not_all(null, Auth::user()->nick. " replicou a vistoria nº ".$id);
        $tit_small_survey = 'Replicando-Vistoria';

        return redirect('vistoria/' . base64_encode($survey_reply->survey_id) . '/editar/Replicando-Vistoria/acao');
    }

    public function filed($id)
    {
        try {
            Survey::where('survey_id', $id)->update(['survey_filed' => 1]);
            return response()->json(['message' => 'success', 'description' => 'Vistoria Arquivada com sucesso']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error', 'description' => 'Ocorreu o erro: ' . $e->getMessage()]);
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
                return back()->with('error_message', 'Não foi possível fazer a exclusão. Erro: ' . $e->getMessage());
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

    /**
     * order_ambience_survey_list_order - lista do id dos ambientes, Ex: 2,142,
     * order_ambience_survey_id_survey - id da Vistoria 1455
     *
     * @param Request $request
     * @return void
     */
    public function alter_order_ambience_survey(Request $request)
    {
        $request['order_ambience_survey_order'] = 1;
        $string_id =  substr_replace($request['order_ambience_survey_list_order'], '', -1);
        $request['order_ambience_survey_list_order'] = $string_id;

        try {
            OrderAmbienceSurvey::where('order_ambience_survey_id_survey', $request['order_ambience_survey_id_survey'])->update($request->all());
            return response()->json(['message' => 'success.', 'status' => 200], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'erro' . $e->getMessage(), 'status' => 400], 400);
        }
    }

    public function getTypeImmobile()
    {
        $survey = Survey::getTypeImmobile();
        return $survey;
    }

    /**
     * Retorna uma lista de 50 vistorias com campos ja formatados.
     *
     * @return object
     */
    public function allSurvey()
    {
        $sortBy = null;
        $survey = Survey::select(
            'survey_type_immobile',
            'survey_id',
            'survey.survey_date',
            'survey.survey_status',
            'survey_inspetor_cpf',
            'survey_inspetor_name',
            'survey_address_immobile',
            'survey_code')
        ->orderBy('survey_id', 'desc')
        ->offset(0)->limit(50)->get();
        //formatando codigo da vistoria e data para formato brasileiro    
        foreach ($survey as $key => $value) {
            //formatando datas
            if(!is_null($survey[$key]['survey_date']))
            {
                $survey[$key]['survey_date'] = Carbon::parse($value->survey_date)->format('d/m/Y');
            }
        }
        return response()->json($survey);
    }

    /**
     * 
     */
    public function search(Request $request)
    {
        $surveys = SurveyRepository::search($request->all());

        return response()->json(['message' => $surveys['message']]);
    }

    /**
     * 
    */
    public function getUser($idSurvey, $type)
    {
        return DB::table('relation_survey_user')
        ->join('users', 'relation_survey_user_id_user' , '=', 'users.id')
        ->where([
            ['relation_survey_user_id_survey', $idSurvey],
            ['relation_survey_user_type', $type]
        ])
        ->select('users.id', 'users.name', 'users.email', 'users.cpf','relation_survey_user_id')
        ->get();
    }

    /**
     * 
     */
    public function addUserSurvey(Request $request)
    {
        // dump($request->all());
            $verify = Survey::consulta_relacao_usuario(
                $request->relation_survey_user_id_survey, 
                $request->relation_survey_user_id_user);

            if(count($verify) == 0){
                Survey::cadastra_usuario($request->all());
            }else{
               Survey::atualiza_usuario_vistoria($request->all(), $verify->first());
            }    
        // Survey::cadastra_usuario($campo_user, $id_survey, $type_relation);
    }

    public function addUser(Request $request)
    {
        try {
            Survey::cadastra_usuario($request->all());
            return response()->json(['message' => 'Cadastrado'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => FunctionAll::error($th)],400);
        }
    }

    public function content($idSurvey, $content)
    {
        $survey = Survey::where('survey_id', $idSurvey)
        ->select('survey_id', $content)->get();
        return response()->json($survey[0], 200);
    }

    public function alterContent(Request $request)
    {
        try {
            $survey = Survey::where('survey_id', $request['survey_id'])->first();
            $survey->update($request->all());
            return response()->json(['message' => 'Sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => FunctionAll::error($th)], 400);
        }
    }

    public function alterSurveyor(SurveyFields $request)
    {
        $dtSurvey = "";
        //ADD DATA STRING PARA DATE
        if (array_key_exists("survey_date", $request->all())) {
            $dtSurvey = Carbon::parse($request->survey_date);
            $request['survey_date'] = $dtSurvey;
        }

        try {
            $survey = Survey::where('survey_id', $request->survey_id)->first();
            $survey->update($request->all());
            return response()->json(['message' => 'success']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function newSurvey(){
        $setting = DB::table('settings')->first();
       
        $nova = DB::table('survey')->insertGetId([
            'survey_inspetor_name' => Auth::user()->name,
            'survey_inspetor_cpf' =>  isset(Auth::user()->cpf) ? Auth::user()->cpf : '',
            'survey_date_register' => Carbon::now(),
            'survey_date' => Carbon::now(),
            'survey_status' => 'Rascunho',
            'survey_link_tour' => '',
            'survey_general_aspects' => $setting->settings_aspect_general,
            'survey_reservation' => $setting->settings_reservation,
            'survey_provisions' => $setting->settings_provisions,
            'survey_keys' => $setting->settings_keys
        ]);
        
        Survey::addOrderAmbienceSurvey($nova);
        //data atual
        $year = Carbon::now();
        //passando somente o ano e obtendo os 2 ultimos numeros
        $strYear = substr($year->year, 2, 4);
        //convertendo para string
        $code =  strval($nova);
        //instancia da vistoria criada
        $surveyCreate = Survey::findOrfail($nova);
        //atualizando com codigo da vistoria
        $surveyCreate->update(['survey_code' => $code.'/'.$strYear ]);
        return redirect('vistoria/' . base64_encode($nova) . '/editar/Nova-Vistoria/acao');
    }
}
