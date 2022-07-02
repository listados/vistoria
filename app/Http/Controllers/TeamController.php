<?php

namespace EspindolaAdm\Http\Controllers;

use EspindolaAdm\Team;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use EspindolaAdm\Repository\TeamRepository;

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
        $up = $request->fileAvatar->move(public_path('images/team'), $fileName);
        $request['teamSites_photo'] = $fileName;
        try {
           Team::create($request->all());
           return redirect()->back()->with('message', 'Cadastrado com sucesso');
        } catch (\Throwable $th) {
            echo 'error : '.$th->getMessage();
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
        $up = TeamRepository::updateTeam($request, $id);
        try {
            //retornando a instancia
            $team = Team::where('teamSites_id', $id)->get()->first();
            $team->update($up);
            dd($team);
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
                    return '<img src="'.url('images/team/'.$gestor->teamSites_photo).'" width="128" height="96" />';
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
                    return '<a href="#" data-id="'.$gestor->teamSites_id.'" 
                    data-id="'.$gestor->teamSites_id.'"
                    data-name="'.$gestor->teamSites_name.'"
                    data-phone="'.$gestor->teamSites_phoneOne.'"
                    data-office="'.$gestor->teamSites_office.'"
                    data-text="'.$gestor->teamSites_text.'"
                    data-linkedin="'.$gestor->teamSites_linkedin.'"
                    data-photo="'.$gestor->teamSites_photo.'"
                    class="btn " title="Editar Funcionário"
                    data-toggle="modal" data-target="#modalEditTeam"><i class="fa fa-edit" aria-hidden="true"></i></a>'.$status.'
                    <a href="#" class="btn btn-danger" onclick="deleteTeam('.$gestor->teamSites_id.');" title="Excluir Funcionário"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                })
                ->rawColumns(['teamSites_photo', 'action', 'teamSites_linkedin'])
                ->make(true);
    }

   
}
