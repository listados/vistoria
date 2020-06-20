@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Arquivos e Download</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
        <li>Escolha Azul</li>
        <li>Pessoa Física</li>
        <li class="active">Download de Arquivos </li>
    </ol>
@stop

@section('content')
<div class="col-md-12 box">
    <div class="box-body">
        <div class="col-md-3 col-xs-12">
            <label for="" class="text-danger">Baixar todos os arquivos</label>
        </div>
        <div class="col-md-3 col-xs-12">
            {{ Form::label('upload','Fazer Upload') }}
            <!-- Button trigger modal -->
            <a href="#upload" class="btn btn-default"  title="Fazer upload de novos arquivos" data-toggle="modal">
            <i class="fa fa-upload" aria-hidden="true"></i>
            </a>
        </div>
        <div class="col-md-3 col-xs-12">
            {{ Form::label('upload','Atualizar') }}
            <!-- Button trigger modal -->
            
        </div>
    </div>
</div>

<div class="col-md-12 box">
    <div class="box-body">
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped" id="table-download-proposal-pf" >
                    <thead>
                        <tr>
                           
                            <th>Data Envio</th>
                            <th>N. Proposta</th>
                            <th>Imagem</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                   
                </table>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
{{Html::style('https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css')}}
@stop

@section('js')
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js')}}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js.map')}}
{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
<script>
    $(function() {        
        
    });
    $(document).ready(function() {
        id_proposal = '{{$id_survey}}';
        console.log("survey ="+id_proposal);
        $('#table-download-proposal-pf').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! url("escolha-azul/download-proposal-pf/'+id_proposal+'/proposta-pf") !!}',
            columns: [
               
                { data: 'files_date', name: 'files_date' },
                { data: 'files_id_proposal', name: 'files_id_proposal' },
                { data: 'files_name', name: 'files_name' },
                { data: 'action', name: 'action',  orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop