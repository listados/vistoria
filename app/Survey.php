<?php

namespace EspindolaAdm;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Carbon\Carbon;
use EspindolaAdm\OrderAmbienceSurvey;

class Survey extends Model
{
    protected $table = 'survey';

    protected $primaryKey = 'survey_id';

    protected $fillable =
    [
        'survey_date', 'survey_type', 'survey_address_immobile' , 
        'survey_type_immobile' , 'survey_energy_meter' , 'survey_energy_load' , 
        'survey_water_meter',  'survey_water_load' , 'survey_gas_meter' , 
        'survey_gas_load', 'survey_keys', 'survey_code', 
        'survey_link_tour', 'survey_provisions', 'survey_date_register' , 
        'survey_inspetor_cpf' , 'survey_inspetor_name', 'survey_reservation',
        'survey_general_aspects', 'survey_keys'
    ];


    //OBRIGATORIAMENTE O PRIMEIRO CAMPO DO ARRAY TEM QUE SER O NOME DO USUARIO E O SEGUNDO O EMAIL
    public static function cadastra_usuario($request)
    {
        // dd($request);
        //criando array com valores de criação
        $user = [
            'name' => isset($request['survey_inspetor_name']) ? $request['survey_inspetor_name'] : 'user', 
            'email' => isset($request['survey_inspetor_email']) ? $request['survey_inspetor_email'] : str_replace(' ','',substr(md5(microtime()),rand(0,26),10)).'@mail.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'adm' => 0,
            'status' => 0,
            'id_profile' => 14  ,
            'password' => bcrypt(Carbon::now()),
            'cpf' => isset($request['survey_inspetor_cpf']) ? $request['survey_inspetor_cpf'] : null
        ];
        //verifica o parametro para add o valor 
        if(isset($request['params']))
        {
            switch ($request['params']) {
                case 'name':
                    $user[$request['params']] = $request['survey_inspetor_name'];
                    break;
                case 'cpf':
                    $user[$request['params']] = $request['survey_inspetor_cpf'];
                    break;
                case 'email':
                    $user[$request['params']] = $request['survey_inspetor_email'];
                    break;
            }
        }
          try {
            //CADASTRANDO USUARIO
            $user_locator = User::create($user);
            //GRAVANDO DADOS NA TABELA DE RELACIONAMENTO
            DB::table('relation_survey_user')->insert(
                ['relation_survey_user_id_survey' => $request['relation_survey_user_id_survey'], 
                'relation_survey_user_id_user' => $user_locator->id , 
                'relation_survey_user_type' => $request['relation_survey_user_type'] , 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now() ]
            );
                return response()->json(['message' => 'Usuário cadastrado'],200);
          } catch (\Throwable $th) {
                return response()->json(['message' => FunctionAll::error($th)],400);
          }
    }


    /* FUNCAO PARA A PÁGINA UPDATE DA VISTORIA, CASO SEJA PARA ALTERAR O CAMPO VEM PREENCHIDO, SE FOR UMA NOVA VISTORIA O CAMPO VAZIO
        Created in 2016-07-28 10:11 by Junior Oliveira
        alterado em 17/08/2016
    */
    public static function atualiza_usuario_vistoria($request, $relation)
    {
    //$type_relation, $id_survey, $campo = array()
        //BUSCANDO ID DO USUÁRIO
        // $usuario = DB::table('relation_survey_user')
        // ->where($relation->relation_survey_user_id)
        // ->first();
        // dd($relation);
        // dd($relation->relation_survey_user_id_user);
        try {
        DB::table('users')
        ->where('id', $relation->relation_survey_user_id_user)
        ->update(['name' => isset($request['survey_inspetor_name']) ? $request['survey_inspetor_name'] : $relation->name, 
                'email' =>  isset($request['survey_inspetor_email']) ? $request['survey_inspetor_email'] : $relation->email, 
                'cpf' =>  isset($request['survey_inspetor_cpf']) ? $request['survey_inspetor_cpf'] : $relation->cpf, 
                'updated_at' => Carbon::now()
        ]);
        return response()->json(['message' => 'Usuario criado'],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => FunctionAll::error($th)],400);
        }
        
    }


    public static function consulta_relacao_usuario($id_survey, $type)
    {
        # created in 2016-08-17 by Junior Oliveira
        $survey_relation_user = DB::table('relation_survey_user')
                        ->join('survey', 'survey.survey_id', '=', 'relation_survey_user.relation_survey_user_id_survey')
                        ->join('users', 'users.id', '=', 'relation_survey_user.relation_survey_user_id_user')
                        ->where([
                            ['relation_survey_user.relation_survey_user_id_survey' , '=', $id_survey],
                            ['relation_survey_user.relation_survey_user_id_user' , '=' , $type]
                        ])->get();

        return $survey_relation_user;
    }

    public static function update_survey_user($array_id_user, $array_type_name, $array_type_email, $array_type_cpf)
    {
        # code created 2016-11-15 14:39 by Junior Oliveira
        //CONSULTANDO USUARIO E ALTERANDO AS TABELAS USERS E RELATION_SERVEY_USER
        $user_upd = User::find($request->id_user[$i]);

        $user_where = DB::table('users')->where('id', '=', $user_upd->id)->update([
                                                        'name' => $request->survey_locator_name[$i] ,
                                                        'email'=> $request->survey_locator_email[$i]
                                                        ]);
        DB::table('relation_survey_user')->where('relation_survey_user_id_user', '=', $user_upd->id)->update(['relation_survey_user_cpf' => $request->survey_locator_cpf[$i]]);
    }



    /*

    PARA REGISTRAR OS ARQUIVOS DO AMBIENCE E RETORNANDO O ID DO AMBIENTE

     */
    public static function addFilesAmbience($ambience, $name, $id_survey, $tipo)
    {
        //created 2017-12-07
        $files_ambience =   DB::table('files_ambience')->insertGetId([
                        'files_ambience_id_ambience' => $ambience,
                        'files_ambience_description_file' => $name ,
                        'files_ambience_id_survey' => $id_survey ,
                        'files_ambience_type' => $tipo ,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

        return $files_ambience;
    }

    public static function addConfigFiles($width, $height, $files_ambience)
    {
        //created 2017-12-07
        $size_photo = DB::table('configuration_image')->insert([
                        'configuration_image_width' => $width,
                        'configuration_image_height'=> $height,
                        'configuration_image_id_files_ambience' => $files_ambience,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                        ]);
    }

    public static function countImage($survey_id)
    {
        $noti_nor = DB::table('files_ambience')->where([
                      ['files_ambience_id_survey' , $survey_id],
                      ['files_ambience_type' , 'normal']
                      ])->count();

        return $noti_nor;
    }

    /**
     * PASSAR SOMENTE O NOME DO CAMPO REQUEST COMO PARAMETROS
     *
     * VERIFICANDO SE ESTÁ VINDO UM CAMPO USER VAZIO
     */
    public static function verifyUserExist($array_user)
    {
        //JÁ TEM A INDICAÇÃO QUE EM GERAL O ARRAY_USER JA VEM PREENCHIDO
        $return_verify 	= [];
        $type_user 		= "";
        foreach ($array_user as $verify_indice => $verify_name) {
            if (empty($verify_name)) {
                $return_verify = ['boolean' => false,'message' => 'Inválido', 'status' => '400'];
            } else {
                $return_verify = ['boolean' => true,'message' => 'Validado', 'status' => '200'];
            }
        }
        return $return_verify;
    }

    public static function addOrderAmbienceSurvey($id_survey)
    {
        $order_ambience['order_ambience_survey_id_survey']  = $id_survey;
        $order_ambience['order_ambience_survey_order']      = '0';
        $order_ambience['order_ambience_survey_list_order'] = "0";
        OrderAmbienceSurvey::create($order_ambience);
    }

    public static function getOrderAmbienceSurvey($list)
    {
        $list_id = []; //PARA CRIAR UM ARRAY
        $string_id = ""; // PARA CRIAR UMA STRING
        //FOREACH PARA PREENCHER O ARRAY E A STRING
        foreach ($list as $key => $value) {
            array_push($list_id, $value->files_ambience_id_ambience);//PREENCHENDO UM ARRAY
        $string_id = $string_id . $value->files_ambience_id_ambience . ",";//CONTATENANDO OS IDS
        }
        //DB::enableQueryLog();
        $string_id =  substr_replace($string_id, '', -1);//SUBSTUINDO A VIRGULA POR SEM ESPAÇO
        //FAZENDO A PESQUISA EXATAMENTE NA ORDEM PASSADA NO ARRAY
        $name_ambience  = Ambience::whereIn('ambience_id', $list_id)->orderByRaw("FIELD(ambience_id, $string_id)")->get();

        return $name_ambience;
    }

    public static function converterOrdertoString($list)
    {
        $list_id = []; //PARA CRIAR UM ARRAY
        foreach ($list as $key => $value) {
            array_push($list_id, $value->files_ambience_id_ambience);//PREENCHENDO UM ARRAY
        }

        return $list_id;
    }

    public static function getTypeImmobile()
    {
        $survey = Survey::where('survey_type_immobile','<>', '')->select('survey_type_immobile')->distinct()->get();
        return $survey;
    }

    /**
     * Método para fazer uma pesquisa para retornar o imovel de acordo com a pesquisa
     * (DEPREATED)
     */
    public static function searchSurvey($request)
    {
        $survey = [];
        switch ($request['immobile_type']) {
            case 'code':
                $survey = Survey::where('survey_code','like', '%'.$request['immobile_search_field'].'%')->get();
                break;
            case 'type':
                $survey = Survey::where('survey_type_immobile', $request['immobile_search_field'])->get();
                break;
            case 'status':
                $survey = Survey::where('survey_status','like', '%'.$request['immobile_search_field'].'%')->get();
                break;
            case 'inspector':
                $survey = Survey::where('survey_inspetor_name','like', '%'.$request['immobile_search_field'].'%')->get();
                break;
            case 'porPeriod':
                //$survey = Survey::where('survey_code','like', '%'.$request['immobile_search_field'].'%')->get();
                break;
            case 'address':
                $survey = Survey::where('survey_address_immobile','like', '%'.$request['immobile_search_field'].'%')->get();
                break;
            
            default:
                # code...
                break;
        }
        return $survey;

    }

    static function getInspector()
    {
        $inspectors = Survey::where('survey_inspetor_name','<>', '')->select('survey_inspetor_name')->distinct()->get();
        $inspector = [];
        foreach ($inspectors as $key => $value) {
            array_push($inspector, ['value' => $value->survey_inspetor_name, 'label' => $value->survey_inspetor_name]);
        };

        return $inspector;
    }


}
