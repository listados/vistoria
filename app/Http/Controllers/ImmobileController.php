<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use EspindolaAdm\Immobile;
use Exception, Auth;
use DB, SimpleXMLElement;
use EspindolaAdm\Helpers;
use EspindolaAdm\PhotoImmobile;
use EspindolaAdm\LeaseGuarantee;
use EspindolaAdm\Key;
//use EspindolaAdm\PhotoImmobile;
use EspindolaAdm\Delivery;
use Yajra\Datatables\Datatables;
//


class ImmobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //atualização em 13/11/2018 por Junior Oliveira
        $immobile = Immobile::where('immobiles_status' , 'Ativo')->pluck('immobiles_code','immobiles_code');
        $delivery = Delivery::all()->pluck('deliveries_name','deliveries_id');
        $carbon = Carbon::now();

        return view('immobile.index' , compact('immobile' , 'delivery' , 'carbon'));
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
    public function show($id){
        $immobile = Immobile::where('immobiles_code' ,$id )->get();
        $immobile[0]['totalPacote'] = ($immobile[0]['immobiles_iptu_price'] + $immobile[0]['immobiles_rental_price'] + $immobile[0]['immobiles_condominium_price']);
        $immobile[0]['immobiles_iptu_price']        = number_format($immobile[0]['immobiles_iptu_price'], 2 ,',','.');
        $immobile[0]['immobiles_rental_price']      = number_format($immobile[0]['immobiles_rental_price'], 2 ,',','.');
        $immobile[0]['immobiles_selling_price']     = number_format($immobile[0]['immobiles_selling_price'], 2 ,',','.');
        $immobile[0]['immobiles_condominium_price'] = number_format($immobile[0]['immobiles_condominium_price'], 2 ,',','.');
        $immobile[0]['totalPacote'] = number_format($immobile[0]['totalPacote'], 2 ,',','.');
        
        return response()->json($immobile);
    }


    public function getImmobile()
    {
        //ATUALIZAÇÃO EM 13/11/2018 DE JUNIOR OLIVEIRA        
        $immobile = Immobile::where('immobiles_status', '=' , 'Ativo');

        return Datatables::of($immobile)->addColumn('action', function ($immobile) {

         $key = Key::where('keys_cod_immobile', '=' , $immobile->immobiles_code )->get();
         if(count($key) == 0){
            $key = '';
        }else{
            $key = $key[0]->keys_code;
        }
        return '<a href="#" onclick="modalReserveKey('."'".$immobile->immobiles_code."'".');" class="btn btn-xs btn-danger" title="Reservar Chaves"><i class="fa fa-key" aria-hidden="true"></i></a>
        <a href="#" onclick="alterStatusImmobile('.$immobile->immobiles_id.')" class="btn btn-xs btn-info" title="Mudar Status"><i class="glyphicon glyphicon-edit"></i></a>';
    })
        ->editColumn('immobiles_address', function ($immobile){
            return '<small>'.$immobile->immobiles_address.', Nº '.$immobile->immobiles_number.'</small>' ;

        })
        ->editColumn('immobiles_code', function ($immobile) {       

         return '<a href="#" onclick="getImmobile('."'".$immobile->immobiles_code."'".')"  title="Mais detalhes">'.$immobile->immobiles_code.'</a>';
     })
        ->editColumn('immobiles_rental_price', function ($immobile){
            return '<small class="label label-success">'.number_format($immobile->immobiles_rental_price, 2 , ',' , '.').'</small>';

        })
        ->rawColumns(['immobiles_code', 'immobiles_address', 'immobiles_rental_price' , 'action'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

  public function xml()
  {

        $carbon = Carbon::now();
        $url = "http://www.valuegaia.com.br/integra/midia.ashx?midia=GaiaWebServiceImovel&p=5n9UCbUpZaPJa4ffzP%2bSZQdXvGH%2bBktSruRMsJ6O1aw%3d";     
        $xml = simplexml_load_file($url);
       
        $br = "<br/>";
       
        //APAGANDO TODOS OS REGISTROS
        DB::table('immobiles')->delete();//limpando imoveis
        DB::table('photo_immobiles')->delete();//limpando fotos dos imoveis
        DB::table('relation_guarantee_immobile')->delete();//limpando relação de imovel e garantias
        $imovel = [];
        //VARIÁVEL PARA SOMAR O TOTAL DE NÓS DO XML
        $totalImmobile = 0;
        echo "<p>Aguarde um momento...</p>";

        try {
            foreach ($xml->Imoveis->Imovel as $value) {
              $totalImmobile = ($totalImmobile + 1);


        //     // echo "Cod: ".$xml->Imoveis->Imovel->CodigoImovel;
        //     // echo $br;
             // foreach ($value->corretor as $dataCorretor) {
             //     echo "NOme do corretor: ".$dataCorretor->nome;
             //     echo $br;
             //     echo "telefone do corretor: ".$dataCorretor->telefone;
             //     echo $br;
             //     echo "celular do corretor: ".$dataCorretor->celular;
             //     echo $br;
             //     echo "email do corretor: ".$dataCorretor->email;
             //     echo $br;
             //     echo "foto do corretor: ".$dataCorretor->foto;
             //     echo $br;
             // }
            Immobile::insert(
                [
                    'immobiles_cep' => $value->CEP, 
                    'immobiles_address' => $value->Endereco , 
                    'immobiles_number' => $value->Numero , 
                    'immobiles_complement' => $value->ComplementoEndereco , 
                    'immobiles_district' => $value->Bairro , 
                    'immobiles_city' => $value->Cidade , 
                    'immobiles_state' => $value->Estado , 
                    'immobiles_reference_point' => $value->PontoReferenciaEndereco , 
                    'immobiles_code' => $value->CodigoImovel , 
                    'immobiles_status' => "Ativo" ,
                    'immobiles_date_register' => Helpers::DataBRtoMySQL( $value->DataCadastro ), 
                    'immobiles_date_update' => Helpers::DataBRtoMySQL( $value->DataAtualizacao ), 
                    'immobiles_property_title' => $value->TituloImovel ,
                    'immobiles_finality' => $value->Finalidade , 
                    'immobiles_publish' => $value->Publicar , 
                    'immobiles_type_publication' => $value->PublicaValores,
                    'immobiles_name_condo' => $value->NomeCondominio , 
                    'immobiles_business_status' => $value->StatusComercial , 
                    'immobiles_type_offer' => $value->TipoOferta , 
                    'immobiles_selling_price' => Helpers::setValueSynchronize($value->PrecoVenda), 
                    'immobiles_type_rental' => $value->TipoLocacao , 
                    'immobiles_rental_price' => Helpers::setValueSynchronize($value->PrecoLocacao) , 
                    'immobiles_rental_warranty' => $value->GarantiaLocacao , 
                    'immobiles_board_on_site' => $value->PlacaNoLocal , 
                    'immobiles_useful_area' => $value->AreaUtil, 
                    'immobiles_total_area' => $value->AreaTotal, 
                    'immobiles_metrica_unit' => $value->UnidadeMetrica, 
                    'immobiles_property_default' => $value->PadraoImovel , 
                    'immobiles_property_localization' => $value->PadraoLocalizacao , 
                    'immobiles_ocupacion' => $value->Ocupacao , 
                    'immobiles_accept_negotiation' => $value->AceitaNegociacao , 
                    'immobiles_face_immobile' => $value->FaceImovel , 
                    'immobiles_qtd_dormitory' => $value->QtdDormitorios , 
                    'immobiles_qtd_suite' => $value->QtdSuites , 
                    'immobiles_qtd_toilet' => $value->QtdBanheiros , 
                    'immobiles_qtd_uncovered_jobs'=> $value->QtdVagas , 
                    'immobiles_ps' => $value->Observacao ,
                    'immobiles_latitude' => $value->latitude, 
                    'immobiles_longitude'=> $value->longitude,  
                    'immobiles_iptu_price'=> Helpers::setValueSynchronize($value->PrecoIptu),
                    'immobiles_condominium_price' => Helpers::setValueSynchronize($value->PrecoCondominio),
                    'immobiles_type_immobiles' => $value->TipoImovel,
                    'immobiles_tour_virtual' => $value->TourVirtual,
                    'created_at' => $carbon->now() , 'updated_at' => $carbon->now()
                ]
            );
              $count_gaarantia = count($value->GarantiaLocacao->Garantia);
            for ($i=0; $i < $count_gaarantia; $i++) { 
              
                LeaseGuarantee::createLeaseGuarantee($value->CodigoImovel, $value->GarantiaLocacao->Garantia[$i]);                 
            }             

            foreach ($value->Fotos->Foto as $photo) {
              
                PhotoImmobile::insert([
                    'photo_immobiles_name'          => $photo->NomeArquivo,
                    'photo_immobiles_type'          => $photo->FotoTipo,
                    'photo_immobiles_url'           => $photo->URLArquivo,
                    'photo_immobiles_principal'     => $photo->Principal,
                    'photo_immobiles_code_immobile' => $value->CodigoImovel
                ]);                         
            }
                  
        }

        DB::table('settings')->update(['settings_date_last_sync' => $carbon->now() , 'settings_total_immobile_sync' => $totalImmobile , 'settings_id_user_sync' => Auth::user()->id ]);
       return redirect()->back()->with('success' , 'Imóveis Sincronizados');
    } catch (Exception $e) {
        return redirect()->back()->with('error_message' , 'Ocorreu um erro: '.$e->getMessage());
    }
  
  }
}
