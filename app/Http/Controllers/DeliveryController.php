<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;

use EspindolaAdm\Http\Requests;
use EspindolaAdm\Http\Controllers\Controller;
use Exception, DB;
use EspindolaAdm\Delivery;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class DeliveryController extends Controller
{
    //
    public function index()
    {
        //create 2017-09-09 by Excellence Soft
       return view('delivery.index');
   	}

   	public function show()
   	{
   		$delivery = Delivery::select(['deliveries_id', 'deliveries_name', 'deliveries_phone', 'deliveries_mobile' , 'deliveries_cpf']);
       // return Datatables::of($delivery)->make();
        
        return Datatables::of($delivery)
        ->addColumn('action', function ($delivery) {
            
            return '<a href="#" onclick="edit_delivery('.$delivery->deliveries_id.')" class="btn btn-xs btn-primary" title="Editar Despachante"><i class="glyphicon glyphicon-edit"></i></a>
              <a href="#" onclick="modal_delete_ajax('.$delivery->deliveries_id.')" class="btn btn-xs btn-danger" title="Excluir Despachante">
              <i class="glyphicon glyphicon-trash"></i></a>';
        })->make(true);
   	}

    public function store(Request $request)
    {
        //create 2017-09-09 by Excellence Soft
      try {
          Delivery::create($request->all());
          return back()->with('success' , 'Despachante cadastrado com sucesso');
      } catch (Exception $e) {
          return  back()->with('error_message' , 'Ocorreu um errro: '.$e->getMessage());
      }
    }  
}
