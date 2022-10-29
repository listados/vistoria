<?php
namespace EspindolaAdm\Repository;

use Carbon\Carbon;
use EspindolaAdm\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SurveyRepository
{
    static  function search($request)
    {
        $fieldSearch = '';
        $operation = '';
        switch ($request['params']) {
            case 'codigo':
                $fieldSearch = 'survey_code';
                $operation  =  'like';
                $value = '%'.$request['value'].'%';
                break;
            case 'tipo':
                # code...
                break;
            case 'status':
                # code...
                break;
            case 'vistoriador':
                # code...
                break;
            case 'endereco':
                $fieldSearch = 'survey_address_immobile';
                $operation  =  'like';
                $value = '%'.$request['value'].'%';
                break;    
            default:
                # code...
                break;
        }
        try {
            $carbon = new Carbon();
            // $survey[$key]['survey_date'] = Carbon::parse($value->survey_date)->format('d/m/Y');
            $survey = Survey::where($fieldSearch, $operation, $value)
            ->select(
                'survey_type_immobile',
                'survey_id',
                'survey.survey_status',
                'survey_inspetor_cpf',
                'survey_inspetor_name',
                'survey_address_immobile',
                'survey_code',
                DB::raw('DATE_FORMAT(survey_date, "%d/%m/%Y") as dateSurvey')
                )
            ->get();
            return ['message' => $survey, 'status' => 200];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage(), 'status' => 400];
        }
    }
}