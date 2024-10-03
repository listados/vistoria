<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;
use EspindolaAdm\Ambience;
use Yajra\Datatables\Datatables;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->adm == 1){
            return view('setting.index');
        }else{
            return redirect('home')->with('error_message', 'Você não tem permissão para Configuração');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function ambience()
    {
        return view('setting.ambience');
    }

    public function aspect()
    {
        return view('setting.aspect');
    }


    public function getAmbience()
    {
        //$ambience = Ambience::where('ambience_code_user', Auth::user()->id)->select(['ambience_id', 'ambience_name']);;
        $ambience = Ambience::select(['ambience_id', 'ambience_name']);
        
        return Datatables::of($ambience)
            ->addColumn('action', function ($ambience) {
                return '<a href="#" onclick="alterAmbience('.$ambience->ambience_id.');" 
                class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Editar</a>';
            })
            ->make();
    }

}
