<?php

namespace EspindolaAdm\Http\Controllers;

use EspindolaAdm\Http\Requests\SettingRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use EspindolaAdm\Ambience;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Auth;
use function response;
use function view;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.index');
        
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
     * @param  SettingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingRequest $request)
    {
        $validated = $request->validated();
        if($validated) {
            try {
                $idSetting = DB::table('settings')->first();
                DB::table('settings')
                    ->where(['settings' => $idSetting->settings])
                    ->update([$request['field'] => $validated['value']]);
                return response()->json(['message' => 'Dados salvo com sucesso!'], 200);
            }catch (\Exception $e) {
                return response()->json(['message' => 'Ocorreu um erro inexperado'], 400);
            }
        }
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

    public function aspect()
    {
        return view('setting.aspect');
    }

    public function getSetting()
    {
        $settings = DB::table('settings')->first();
        return response()->json($settings);
    }

    public function reservation()
    {
        return view('setting.reservation');
    }

}
