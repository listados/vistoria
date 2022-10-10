<?php

namespace EspindolaAdm\Http\Controllers;

use EspindolaAdm\Site;
use Illuminate\Http\Request;
use EspindolaAdm\Team;
use DB;

class SiteController extends Controller
{
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
     * @param  \EspindolaAdm\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EspindolaAdm\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EspindolaAdm\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EspindolaAdm\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }

     /**
     * Página de time do site
     */
    public function team()
    {
        return view('site.team');
    }

    public function createPersonTeam(Request $request)
    {
        //Para upload da foto do funcionario
        // $imageName = time().'.'.request()->image->getClientOriginalExtension();
        // request()->image->move(public_path('images/team'), $imageName);
        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName);
        $create = Team::create($request->all());
        dump($create);
    }

    public function contact()
    {
        $contact = DB::table('contacts')->get(); 
        return response()->json($contact[0], 200);
    }
}
