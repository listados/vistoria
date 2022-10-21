@extends('adminlte::page')

@section('title', 'Cadastro PF - Espindola Admin')

@section('content_header')
@component('components.header-breadcrumb')
    @slot('title')
        Cadastro Pessoa Física
    @endslot
    @slot('subTitle')
        Todas os cadastros de fiadores Pessoa Física
    @endslot
    @slot('links')
        <li><a href="#"><i class="fa fa-dashboard"></i> Escolha Azul</a></li>
        <li class="active">Cadastro Pessoa Física</li>
    @endslot
@endcomponent
@stop

@section('content')

<div class="box box-primary">
    <cadastre-pf></cadastre-pf>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- 
{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }} --}}
{{ Html::script('js/proposal_pf.js') }}
@stop