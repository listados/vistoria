<?php

namespace EspindolaAdm\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use EspindolaAdm\User;
use EspindolaAdm\ProposalPF;

class ProposalPFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atendent = User::where('receive_proposal', 1)->get()->pluck('name','id');
        $atendents = [];
        foreach ($atendent as $key => $value) {
            // dump($value.' - '.$key);
            array_push($atendents, ['value' => $key, 'label' => $value]);
        };
        // dd($atendents);
        return view('proposal.proposal-pf.index', compact('atendents'));
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
        try {
            $proposal = ProposalPF::where('proposal_id', $id);
            $proposal->update($request->all());
            return response()->json(['message' => 'Alterado com sucesso'], 200);
        } catch (\Throwable $th) {
            dump($th->getMessage());
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

    public function getProposalPF()
    {
        # code...
        $proposal = ProposalPF::join('users' ,'proposal_id_user', '=', 'users.id')
        ->select(
            'proposal_id', 
            'proposal_completed',
            'proposal_name',
            'proposal_id_user',
            'proposal_email',
            'proposal_status',
            'users.*',
        )
        ->orderBy('proposal_id', 'desc')
        ->get();

        
        return response()->json($proposal);
        // return Datatables::of($proposal)
        //     ->addColumn('action', function ($proposals) {
        //     $count_files = DB::table('files')->where('files_id_proposal' , $proposals->proposal_id)->count();
        //     return '<a href="'.url('escolha-azul/pdf-pf/'.$proposals->proposal_id).'/proposta" class="btn btn-xs proposal_ancora_info title="visualizar Proposta" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
        //     <a href="'.url('escolha-azul/pdf-pf/'.$proposals->proposal_id).'/analise" class="btn btn-xs" target="_blank" data-toggle="tooltip" title="Análise de Proposta"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
        //     <a href="'.url('escolha-azul/download/'.$proposals->proposal_id.'/proposta-pf').'" class="btn" target="_blank" data-toggle="tooltip" title="Enviado '.$count_files.' arquivos">
        //         <i class="fa fa-download" aria-hidden="true"></i>
        //         <span class="badge bg-green">'.$count_files.'</span></a>';
        //     })
        //     ->editColumn('proposal_completed', function($proposals) {
        //         if($proposals->proposal_status == 'Incompleta'){
        //             return "---";    
        //         }
        //         return date('d/m/Y' , strtotime($proposals->proposal_completed));
        //     })
        //     ->editColumn('proposal_id_user', function($proposals) {
        //         //CHAMANDO FUNÇÃO PARA NOME DO ATENDENTE
        //         $atend_converter = User::getNameAtendente($proposals->proposal_id_user);
        //         //PREENCHENDO VARIÁVEL SE FOR VAZIO
        //         if(empty($atend_converter)){ $atend_converter = "Não informado";}
        //         return $atend_converter.' <a href="#modal_alter_functionary" title="Alterar Atendente" 
        //         data-toggle="modal" data-id="'.$proposals->proposal_id.'" >
        //         <small class="label label-info btn-xs"> 
        //         <i class="fa fa-edit"></i></small> </a>';
        //     })
        //     ->rawColumns(['proposal_id_user', 'action'])
        //     ->make(true);
    }

    /*
    @id = Id da proposta
    @type = tipo para proposta ou análise

     */
    public function showReportPf($id, $type)
    {
        ini_set('memory_limit', '128M');
        ob_start();
        $proposta = ProposalPF::where('proposal_id' , $id)->get();
        $name_atendent = User::getNameAtendente($proposta[0]['proposal_id_user']);//nome do(a) atendente

        if($type == "proposta"){
            $titulo_proposta = 'Proposta Pessoa Física';
            //return view('proposal.proposal-pf.report.proposal-pf',compact('proposta' , 'titulo_proposta' , 'name_atendent')); 
            $pdf = PDF::loadView('proposal.proposal-pf.report.proposal-pf',
            compact('proposta' , 'titulo_proposta' , 'name_atendent'))->setOptions(['defaultFont' => 'sans-serif']); 
        }else{
            $titulo_proposta = 'Análise Cadastral (PF)';
            // return view('proposal.proposal-pf.report.analyze_pf',compact('proposta' , 'titulo_proposta' , 'name_atendent'));
            $pdf = PDF::loadView('proposal.proposal-pf.report.analyze_pf',
            compact('proposta' , 'titulo_proposta' , 'name_atendent'))->setOptions(['defaultFont' => 'sans-serif']); 
        }
        
        $pdf->setPaper('A4', 'report');  
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf ->get_canvas();
        // page_text(pos_horizontal,pos_vertical , texto , null , tamanho, cor_em_rgb)               
        $canvas->page_text(500, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));        
        return $pdf->stream();     

    }

    public function download($id, $type)
    {
        $id_survey = $id;
        return view('proposal.download',compact('files' , 'title', 'proposta' , 'campo', 'type', 'dominio_pdf_externo' , 'id_survey'));
    }

    public function getFilesDonwloadProposalPF($id, $type)
    {
        switch ($type) {
			case 'proposta-pf':
				$profile = 'Inquilino';
				$table = 'proposal';
				$campo = 'proposal_id';
				$abr_profile = 'pf';
				break;
			case 'proposta-pj':
				$profile = 'Juridico';
				$table = 'legal';
				$campo = 'legal_id';
				$abr_profile = 'pj';
				break;
			case 'cadastro-pf':
				$profile = 'Fiador';
				$table = 'guarantor';
				$campo = 'guarantor_id';
				$abr_profile = 'pf';
				break;
			case 'cadastro-pj':
				$profile = 'Fiador Juridico';
				$table = 'guarantor_legal';
				$campo = 'guarantor_legal_id';
				$abr_profile = 'pj';
				break;	
			default:
				$profile = 'Inquilino';
				$table = 'proposal';
				$campo = 'proposal_id';
				$abr_profile = 'pf';
				break;
        }
        $id_survey = $id;
		$files = DB::table('files')->where([
			['files_id_proposal' , $id],
			['files_profile', $profile]
            ]);
          
        if(empty($files)){
            return dump('vazio');
        }else{
             //return dump('nao esta vazio');
            return Datatables::of($files)
                ->editColumn('files_name', function($files ) {
                    //$document_root = dirname(dirname($_SERVER['DOCUMENT_ROOT'])); 
                    $extensao = '.pdf'; 
                    $dominio_pdf_externo = "https://espindolaimobiliaria.com.br/escolhaazul";                   
                    if(strripos($files->files_name, $extensao) == true){
                        return '<iframe src="'.$dominio_pdf_externo.'/public/img/upload/'.$files->files_name.'" 
                        frameborder="0" width="128" height="128"></iframe>';
                    }
                    return  '<a href="'.$dominio_pdf_externo.'/public/img/upload/'.$files->files_name.'" data-toggle="lightbox" data-title="Imagem" data-footer="'.$files->files_name.'" > 
                                <img  src="'.$dominio_pdf_externo.'/public/img/upload/'.$files->files_name.'" class="img-fluid" height="20%" >
                            </a>';
                    })
                ->addColumn('action', function ($files) {
                    $dominio_pdf_externo = "https://espindolaimobiliaria.com.br/escolhaazul";
                    return '<a href="'.$dominio_pdf_externo.'/public/img/upload/'.$files->files_name.'" download="'.$files->files_name.'" class="btn" title="Fazer download desse arquivo" >
                                <i class="fa fa-download"></i>
                            </a>';
                })
                ->rawColumns(['files_name', 'action'])->make(true);		
            
        }    
    }
}
