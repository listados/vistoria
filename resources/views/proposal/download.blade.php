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
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Encontrado  
                    <label class="label label-primary" style="margin-left: 5px; margin-right: 5px;">
                        {{$files->count() }} 
                    </label>
                     arquivo(s).</h3>
                <div class="box-tools pull-right">
                    <div class="btn-group">
                        <el-dropdown>
                            <span class="el-dropdown-link">
                            Ações <i class="el-icon-arrow-down el-icon--right"></i>
                            </span>
                            <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item>Incluir arquivos</el-dropdown-item>
                            <el-dropdown-item>Download dos arquivos</el-dropdown-item>
                            <el-dropdown-item>Atualizar dados</el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                    </div>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>   
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body">
                        <download :id-proposal={{$id}} :type={{  json_encode($type) }}></download>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
{{ Html::script('js/files.js') }}
{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
<script>
</script>
@stop