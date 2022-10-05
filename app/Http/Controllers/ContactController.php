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
        try {
            Contact::create($request->all());
            return response()->json(['message' => 'Sucesso'], 200);
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
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EspindolaAdm\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dump($id);
        try {
            Contact::find($id);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getContacts()
    {
        $contact = Contact::all();
        return response()->json($contact,200);
    }


}
