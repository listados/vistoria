@extends('adminlte::page')

@section('title', 'Delivery - EspindolaAdmin')

@section('content_header')
<h1>Delivery</h1>

<ol class="breadcrumb">
    <li>
        <a href="#">
            <i class="fa fa-dashboard">
            </i> Menu
        </a>
    </li>

    <li class="active">Delivery</li>
</ol>

@stop

@section('content')

<section class="content">
    @include('message.message_general')
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Registro dos deliveres</h3>
                 {!! Html::decode(link_to('#','<i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Delivery',['data-toggle' => 'modal' , 'data-target' => '#add_delivery', 'class' => 'btn pull-right btn-primary' ,'title' => 'Cadastra um novo Delivery'])) !!}

                          
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <table class="table table-bordered display" id="delivery-table">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nome</th>
                                <th>Fone</th>
                                <th>Celuar</th>
                                <th>CPF</th>
                                <th>Ação</th>
                            </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div>      

    </div>

</section>
@include('modal.modal_create_delivery')
@stop

@section('js')

{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
{{ Html::script('/js/delivery.js') }}


@stop
