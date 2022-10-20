<?php

namespace EspindolaAdm\Http\Controllers;

use EspindolaAdm\Guarantor;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('proposal.cadastre-pf.index');
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
     * @param  \EspindolaAdm\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function show(Guarantor $guarantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \EspindolaAdm\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function edit(Guarantor $guarantor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \EspindolaAdm\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guarantor $guarantor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \EspindolaAdm\Guarantor  $guarantor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guarantor $guarantor)
    {
        //
    }


    /**
     * Retorna os dados de fiador em formato DataTable
     *
     * @param  null
     * @return \Illuminate\Http\Response
     */
    public function getGuarantorDataTable()
    {
        // $guarantor = Guarantor::orderBy('guarantor_id', 'desc');
        $guarantor = [
            ['date' => '2016-05-03', 'name' => 'Tom', 'state' => 'California', 'city' => 'Los Angeles', 'address' => 'No. 189, Grove St, Los Angeles', 'zip' => 'CA 90036', 'tag' => 'Home' ],
            ['date' => '1984-11-05', 'name' => 'Junior', 'state' => 'New York', 'city' => 'Los Angeles', 'address' => 'No. 189, Grove St, Los Angeles', 'zip' => 'CA 90036', 'tag' => 'Home' ],
            ['date' => '2016-05-03', 'name' => 'Paul', 'state' => 'California', 'city' => 'Los Angeles', 'address' => 'No. 189, Grove St, Los Angeles', 'zip' => 'CA 90036', 'tag' => 'Home' ]
        ];
        return response()->json($guarantor);
    }


}
