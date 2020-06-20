@extends('adminlte::page')
@section('title', 'Configurações')
@section('content_header')
<h1>
   Configuração
   <small>Geral</small>
</h1>
<ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-dashboard"></i> Configuração</a></li>
   <li class="active">Configuração do Sistema</li>
</ol>
@stop
@section('content')
<section class="content">
   <div class="row">
      @include('setting.sidebar-menu')
   </div>
</section>
@stop
@section('css')
@stop
@section('js')
@stop