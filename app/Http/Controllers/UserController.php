<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;
use EspindolaAdm\User;
use Exception, Redirect, Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
        $user = User::findOrFail($id);
        return view('user.edit' , compact('user'));
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
        $user_adm = Auth::user()->adm;

        $user = User::find($request['id']);
 
       //SE VINHAR DADOS NO ARRAY ENTAO CRIPTOGRAFA, CASO NÃO.... EXCLUIR A POSIÇÃO DO ARRAY
        if(!empty($request['password'])){
            $user->password = bcrypt($request['password']);
        }else{
          unset($request['password']);
       }
 
        if($user->status == 1){
          $user->status = 1;
        }else{
          $user->status = 0;
        } 
      
        $user->name 	   = $request['name'];
        $user->email 	   = $request['email'];
        $user->cpf         = $request['cpf'];
        $user->id_profile  = $request['id_profile'];

        try{
            $user->save();
            return redirect('usuario/editar/'.$user->id)->with('success','Usuário alterado com sucesso');
        }catch(Exception $e){
            return redirect('usuario/editar/'.$user->id)->with('success','Usuário alterado com sucesso');
        }
        
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
