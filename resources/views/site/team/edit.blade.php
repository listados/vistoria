@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar</h1>
@stop

@section('content')
    <p>Edição de funcionário</p>
    
    <edit-team user-team="{{$team[0]->id}}"></edit-team>
@stop

@section('css')

@stop

@section('js')
<script src="/js/app.js"></script>
@stop