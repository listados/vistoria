<?php
namespace EspindolaAdm\Repository;

use EspindolaAdm\Team;
use Illuminate\Http\Request;

class TeamRepository
{
    static public function updateTeam(Request $request, $id)
    {
        //retornando a instancia
        $team = Team::where('teamSites_id', $id)->get()->first();
        //nome da foto atual caso exista
        $photo = $team->teamSites_photo;
        //verificando se tem envio de arquivo
        if(isset($request['fileAvatar']))
        {
            //upload do arquivo
           $up = self::uploadAvatar($request, $id, $team);
           //caso haja o upload, altera o nome da foto
           $photo = $up['photo'];
        }
        //mantando os dados para inserir
        $insert = [
            'teamSites_id' => $id,
            'teamSites_office' => $request['teamSites_office'],
            'teamSites_name' => $request['teamSites_name'],
            'teamSites_phoneOne' => $request['teamSites_phoneOne'],
            'teamSites_phoneTwo' => $request['teamSites_phoneTwo'],
            'teamSites_text' => $request['teamSites_text'],
            'teamSites_linkedin' => $request['teamSites_linkedin'],
            'teamSites_photo' => $photo,
        ];
        return $insert;
    }

    static public function uploadAvatar(Request $request, $id, $team)
    {
       
        //caso seja via ajax
        if($request->ajax()){            
            $teamUp = Team::findOrFail($id);
            try {
                $fileName = time().'_avatar'.'.'.$request->file->getClientOriginalExtension();
                $teamUp->update(['teamSites_photo' => $fileName]);
                $request->file->move(public_path('images/team'), $fileName);
                return response()->json(['message' => 'success'], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => 'error'], 401);
            }
        }else{
            try {
                $fileName = time().'_avatar'.'.'.$request->fileAvatar->getClientOriginalExtension();
                $request->fileAvatar->move(public_path('images/team'), $fileName);
                $team->teamSites_photo = $fileName;
                $team->save();
                return ['return' => true, 'photo' => $fileName];
            } catch (\Throwable $th) {
                return false;
            }       
           
        }    
    }
}