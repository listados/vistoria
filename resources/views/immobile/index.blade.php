@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <section class="content-header">
        <h1>
            {{ $page_title or "Imóveis" }}
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li class="active">Imóvel</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        @include('message.message_general')
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Todos Imóveis</h3>
                    <div class="box-tools pull-right">
                        {{-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button> --}}
                        <div class="btn-group">
                            <a type="button" class="btn btn-box-tool" id="Controle de chave" href="{{ url('chaves') }}"><i class="fa fa-key"></i></a>
                            <a href="#create_key" class="btn btn-box-tool" data-toggle="modal" title="Cadastro de Chave"><i class="fa fa-plus-circle"></i></a>
                            <a type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></a>
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-plus"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#create_immobile" data-toggle="modal" title="Cadastrar Imóvel" id="modal_create_key">Cadastrar Imóvel</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped display" id="table_immobile">
                                    <thead>
                                        <tr>
                                            <th>Código Imóvel</th>
                                            <th>Tipo</th>
                                            <th>Endereço</th>
                                            <th>Complemento</th>
                                            <th>Bairro</th>
                                            <th>Condomínio</th>
                                            <th>Locação</th>
                                            <th>Finalidade</th>
                                            <th>Status</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <strong><small id="total_active" class="text-primary">Total Ativos:</small></strong> 
                            {{-- @include('modal.modal_alter_status_immobile') --}}
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>
    @include('modal.modal_details_immobiles')
@stop

@section('css')
{{ Html::style('css/survey.css') }}
{{ Html::style('css/immobile.css') }}
{{ Html::style('css/key.min.css') }}
@stop

@section('js')
{{ Html::script('/js/plugins/jquery.inputmask.js') }}
{{ Html::script('/js/immobile.js') }}

   
<script type="text/javascript">
    $(function () {
        loadTableImmobile();
    });
</script>
@stop