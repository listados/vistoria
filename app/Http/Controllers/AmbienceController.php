<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;
use EspindolaAdm\Ambience;

class AmbienceController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            try{
                Ambience::create($request->all());
                return response()->json(['success' => 'Sucesso', 'message' => 'Mensagem'], 200);
            }catch(Exception $e){
                return response()->json(['error' => 'Erro', 'message' => 'tamanho de um trem. '.$e->getMessage()], 400);
            }
            
        }
    }

    public function update(Request $request)
    {
       try{
        $ambience = Ambience::where('ambience_id', $request['ambience_id'])
                    ->update(['ambience_name' => $request['ambience_name']]);
        return response()->json(['type' => 'success', 'message' =>'Ambience Altarado com sucesso'],200);            

       }catch(Exception $e)
       {
        return response()->json(['type' => 'error', 'message' =>'erro '.$e->getMessage()],400); 
       }
    }
}
