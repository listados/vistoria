@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
<h1>Controle de Chave</h1>
@stop
@section('content')
<div class="row">
    @if (session('erro_chave'))
    <div class="col-md-12">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </button>
                <strong>Algo errado!</strong> {{ session('erro_chave') }}
            </div>
                
        </div>
        <div class="col-md-2"></div>
    </div>
    @endif

</div>
<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Reserva</h3>
                <div class="box-tools pull-right">
                    <a href="#create_key" data-toggle="modal" class="btn btn-primary" title="Cadastrar Chave" id="modal_create_key">
                    <i class="fa fa-key"></i> Cadastrar Chaves
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#chaves" aria-controls="chaves" role="tab" data-toggle="tab">Chaves</a></li>
                            <li role="presentation"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab">Histórico</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="chaves">
                                <div class="col-md-12">
                                    <div class="table table-responsive margin">
                                        <table id="key_control" class="table display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Cód. Chave</th>
                                                    <th>Ref. Imóvel</th>
                                                    <th>Status</th>
                                                    <th>Ação.</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        {{--  @include('modal.modal_create_key')
                                        @include('modal.modal_create_immobile') --}}
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="historico">
                                <div class="box-header ui-sortable-handle" style="cursor: move;">
                                    <i class="fa fa-history"></i>
                                    <h3 class="box-title">Pesquisar Histórico do imóvel</h3>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input class="form-control" name="code_key_immobile" id="code_key_immobile" placeholder="Codigo do Imóvel ou da Chave">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-success" id="search_key_immobile"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="history_key_immobile">
                                                <thead>
                                                    <tr>
                                                        <th>Cod Chave</th>
                                                        <th>Cod Imóvel</th>
                                                        <th>Data Retirada</th>
                                                        <th>Data Dev. Prevista</th>
                                                        <th>Visitante</th>
                                                        <th>Status</th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal.modal_reserve_key')
@include('modal.modal_update_code_key')
@include('modal.modal_confirm_print')
@include('modal.modal_edit_key')
@stop
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
{{ Html::style('/css/plugins/jquery-ui-timepicker-addon.min.css') }}   
{{ Html::style('/css/plugins/animate.css') }}    
@stop
@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
{{ Html::script('/js/plugins/jquery.inputmask.js') }}
{{ Html::script('/js/plugins/jquery.inputmask.date.extensions.js') }}
{{ Html::script('/js/plugins/jquery.inputmask.extensions.js') }}
{{ Html::script('/js/plugins/jquery.serializejson.min.js')}}
<script src="http://espindolaimobiliaria.com.br/admin/public/dist/js/moment.min.js"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.js"></script>
{{ Html::script('/js/plugins/jquery-ui-timepicker-addon.js') }}
{{ Html::script('/js/all.js') }}
{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
{{ Html::script('/js/key.js') }}
@stop