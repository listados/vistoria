<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;

class FilesAmbienceController extends Controller
{
    public function show($id)
    {
    	$files      = DB::table('survey')
                    ->join('files_ambience' ,'files_ambience.files_ambience_id_survey' , '=', 'survey.survey_id')
                    ->join('ambience' , 'ambience_id' , '=' , 'files_ambience.files_ambience_id_ambience')
                    ->where([['survey.survey_id', '=', $id] , ['files_ambience_type' , '=' , 'normal']])->get();

       return response()->json($files);
    }
}
