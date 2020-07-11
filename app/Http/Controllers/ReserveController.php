<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;

use EspindolaAdm\Http\Requests;
use EspindolaAdm\Http\Controllers\Controller;
use EspindolaAdm\Reserve;
use Carbon\Carbon;
use EspindolaAdm\Delivery;
use DB;
use Datatables;

class ReserveController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Fortaleza');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserve =DB::table('reserve')
            ->join('keys', 'reserve.reserves_id_key', '=', 'keys.keys_id')
            ->join('users', 'reserve.reserves_id_user' , '=' , 'users.id')
            ->where('reserve.reserves_id' , '=' , $id)
            ->get();

        return response()->json($reserve);
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
}
