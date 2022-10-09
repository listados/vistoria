<?php

namespace EspindolaAdm\Http\Controllers;

use EspindolaAdm\Contact;
use Illuminate\Http\Request;
use EspindolaAdm\DataGrid\contactGrid;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::all();
        return view('site.contact.index');
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
        if(empty($request['address']) || $request['address'] == null) {
            return response()->json(['message' => 'O endereço é obrigatório' ], 400);
        }
        try {
            Contact::create($request->all());
            return response()->json(['message' => 'Contato cadastrado com sucesso'], 200);
        } catch (\Throwable $th) {
            //throw $th
            return response()->json(['errors' => $th->getMessage()], 400);
        }
        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \EspindolaAdm\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EspindolaAdm\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EspindolaAdm\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->update($request->all());
        return response()->json(['message' => 'Contato alterado com sucesso'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro inesperado. '.$th->getMessage()] , 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EspindolaAdm\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        try {
            $contact = Contact::find($id);
            $contact->delete();
            return response()->json(
                ['message' => 'Contato excluído com sucesso',200]
            );
        } catch (\Throwable $th) {
            return response()->json(['error: ' => $th->getMessage(),400]);
        }
    }

    public function getContacts()
    {
        $contact = Contact::all();
        return response()->json($contact,200);
    }


}
