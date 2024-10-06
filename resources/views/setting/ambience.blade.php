@extends('adminlte::page')
@section('title', 'Configuração')
@section('content_header')
<h1>Configuração de Ambiente</h1>
@stop
@section('content')
<section class="content">
    <div class="row">
        {{-- @include('setting.sidebar-menu') --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ambiente</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn" >
                            <i class="fa fa-arrow-circle-left"></i> Voltar
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label for="">Cadastrar um ambiente</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="ambience_name" id="ambience_name">
                                <span class="input-group-btn">
                                <button type="button" id="btn-save-ambience" class="btn btn-success btn-flat" title="Salva um novo ambiente"> 
                                    <i class="fa fa-save"></i> Salvar
                                </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4><i class="fa fa-info-circle"></i> Aviso!</h4>                
                                <p>Quando editar um ambiente, todas os laudos que usam o ambiente será alterado.</p>
                               
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table id="table-ambience" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
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
</section>
@stop
@section('css')
@stop
@section('js')
{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
{{ Html::script('js/all.js') }}
{{ Html::script('js/ambience.js') }}

@stop