<?php

namespace EspindolaAdm\Http\Controllers;

use EspindolaAdm\Team;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TeamController extends Controller
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
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            $userOffice = Team::where('teamSites_id' , $id);
            $userOffice->delete();
            return response()->json(['messagem' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erro: '.$th->getMessage()]);
        }
    }

    public function getOffice()
    {
        $gestor = Team::get();
       // dd($gestor);
        return Datatables::of($gestor)
                ->editColumn('teamSites_photo', function ($gestor) {
                    return '<img src="'.$gestor->teamSites_photo.'" width="128" height="96" />';
                })
                ->editColumn('teamSites_linkedin', function ($gestor) {
                    return '<a href="'.$gestor->teamSites_linkedin.'" target="_blank" />Link</a>';
                })
                ->addColumn('action', function($gestor) {
                    return '<a href="#" class="btn " onclick="" title="Editar Funcionário"><i class="fa fa-edit" aria-hidden="true"></i></a>
                    <a href="#" class="btn" onclick="" title="Retirar do site"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-danger" onclick="deleteTeam('.$gestor->teamSites_id.');" title="Excluir Funcionário"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                })
                ->rawColumns(['teamSites_photo', 'action', 'teamSites_linkedin'])
                ->make(true);
    }
}
