@extends('adminlte::page')
@section('title', 'Configuração')
@section('content_header')
    <h1>Configuração de Ambiente</h1>
@stop
@section('content')
    <section class="content">
        <div class="row">
            @include('setting.sidebar-menu')
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Aspeecto Geral</h3>
                        <div class="box-tools pull-right">
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <aspect-general></aspect-general>
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
    <script>

    </script>
@stop