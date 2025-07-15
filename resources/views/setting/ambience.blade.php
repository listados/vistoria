@extends('adminlte::page')
@section('title', 'Configuração')
@section('content_header')
<h1>Configuração de Ambiente</h1>
@stop
@section('content')
<section class="content">
    <div class="row">
        @include('setting.sidebar-menu')
        <ambience />
    </div>
</section>
@stop
@section('css')
@stop
@section('js')

@stop