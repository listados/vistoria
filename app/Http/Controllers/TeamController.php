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
        $request->validate([
            'teamSites_name' => 'required|max:50',
            'teamSites_phoneOne' => 'required',
        ], [],
        [
            'teamSites_name' => 'Nome',
            'teamSites_phoneOne' => 'Fone de contato'
        ]);
       
        $fileName = time().'_avatar'.'.'.$request->fileAvatar->getClientOriginalExtension();
        $up = $request->fileAvatar->move(public_path('images'), $fileName);
        $request['teamSites_photo'] = $fileName;
        try {
           Team::create($request->all());
           return redirect()->back()->with('message', 'Cadastrado com sucesso');
        } catch (\Throwable $th) {
            echo 'error';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::findOrFail($id)->toArray();
        return response()->json($team);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $team = Team::where('id',$id)->get();
       return view('site.team.edit' , compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EspindolaAdm\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        try {
            $team->update($request->all());
            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()] , 401);
        }
        
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
            $userOffice = Team::find($id);
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
                    return '<img src="'.url('images/'.$gestor->teamSites_photo).'" width="128" height="96" />';
                })
                ->editColumn('teamSites_linkedin', function ($gestor) {
                    return '<a href="'.$gestor->teamSites_linkedin.'" target="_blank" />Link</a>';
                })
                
                ->addColumn('action', function($gestor) {
                    if($gestor->teamSites_status == 1){
                        $status = '<a href="#" class="btn" onclick="showModalStatus('.$gestor->teamSites_status.','.$gestor->id.')" title="Funcionário ativo"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    } else {
                        $status = '<a href="#" class="btn" onclick="showModalStatus('.$gestor->teamSites_status.','.$gestor->id.')" title="Funcionário desativado"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>';
                    }
                    return '<a href="'.url('site/equipe/edit/'.$gestor->id).'" class="btn " onclick="" title="Editar Funcionário"><i class="fa fa-edit" aria-hidden="true"></i></a>'.$status.'
                    <a href="#" class="btn btn-danger" onclick="deleteTeam('.$gestor->id.');" title="Excluir Funcionário"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                })
                ->rawColumns(['teamSites_photo', 'action', 'teamSites_linkedin'])
                ->make(true);
    }

    public function uploadAvatar(Request $request, $id)
    {
        $fileName = time().'_avatar'.'.'.$request->file->getClientOriginalExtension();
        $team = Team::findOrFail($id);
        try {
            $team->update(['teamSites_photo' => $fileName]);
            $request->file->move(public_path('images'), $fileName);
            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error'], 401);
        }
    }
}
