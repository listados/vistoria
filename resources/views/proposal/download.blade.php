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
{{-- <div class="col-md-12 box">
    <div class="box-body">
        <div class="col-md-3 col-xs-12">
            <label for="" class="text-danger">Baixar todos os arquivos</label>a
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
</div> --}}

<div class="col-md-12 box">
    <div class="box-header with-border">
        <h3 class="box-title">Ações</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <div class="btn-group">
            <el-dropdown>
                <span class="el-dropdown-link">
                  Dropdown List<i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item>Action 1</el-dropdown-item>
                  <el-dropdown-item>Action 2</el-dropdown-item>
                  <el-dropdown-item>Action 3</el-dropdown-item>
                  <el-dropdown-item disabled>Action 4</el-dropdown-item>
                  <el-dropdown-item divided>Action 5</el-dropdown-item>
                </el-dropdown-menu>
              </el-dropdown>
        </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
    <div class="box-body">
        <div class="row">
            <download :id-proposal={{$id}} :type={{  json_encode($type) }}></download>
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