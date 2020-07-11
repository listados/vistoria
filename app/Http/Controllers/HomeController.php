<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;
use EspindolaAdm\Survey;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $survey = Survey::whereYear('survey_date_register' , 2018)->get();
        $br = "<br>"; $jan = 0; $fev = 0;$mar = 0;$abr = 0;$mai = 0;$jun = 0;$jul = 0;$set = 0;
        $out = 0;$nov = 0;$dez = 0;$ago = 0;
        // Survey::whereMonth('survey_date_register',$dt->month)->get(); 
        foreach ($survey as $key => $value) {
            $dt = Carbon::parse($value->survey_date_register);
           
            " Data= ". $dt->month."<br>";
            switch ($dt->month) {
                case '1':
                    $jan = ($jan + 1); 
                    break;
                case '2':
                    $fev = ($fev + 1);  
                    break;
                case '3':
                    $mar = ($mar + 1); 
                    break;
                case '4':
                    $abr = ($abr + 1); 
                    break;
                case '5':
                    $mai = ($mai + 1); 
                    break;
                case '6':
                    $jun = ($jun + 1);
                    break;
                case '7':
                    $jul = ($jul + 1);
                    break;
                case '8':
                    $ago = ($ago + 1);
                    break;
                case '9':
                    $set = ($set + 1); 
                    break;
                case '10':
                    $out = ($out + 1); 
                    break;
                case '11':
                    $nov = ($nov + 1); 
                    break;
                case '12':
                    $dez = ($dez + 1);   
                       
                    break;
            }

        }
        $array_month[1] = $jan;
        $array_month[2] = $fev;
        $array_month[3] = $mar;
        $array_month[4] = $abr;
        $array_month[5] = $mai;
        $array_month[6] = $jun;
        $array_month[7] = $jul;
        $array_month[8] = $ago;
        $array_month[9] = $set;
        $array_month[10] = $out;
        $array_month[11] = $nov;
        $array_month[12] = $dez;
        foreach ($array_month as $indice => $mes) {
           "mes ".$indice ." total = ".$mes;
           
        }

        
        //Survey::whereMonth('','')->get();    
        return view('home', compact('array_month'));
    }

    public function widget()
    {
        return view('page-test');
    }
}
