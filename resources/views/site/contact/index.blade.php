@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Contato <small>Contatos da imobiliária</small> </h1>
@stop

@section('content')
    <div class="row">
        <info-contact></info-contact>         
    </div>
    
@stop

@section('css')
    <style>
        .list-group-item{
            cursor: pointer;
            cursor: -webkit-grabbing;
        }
    </style>
@stop

@section('js')
<script src="/js/all.js"></script>

@stop