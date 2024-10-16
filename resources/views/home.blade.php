@extends('adminlte::page')

@section('title', 'EspindolaAdmin - Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <section class="content">
        @include('message.message_general')
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de Vistorias</span>
                        <span class="info-box-number">90</span>
                    </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-hourglass-end"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Vistoria Finalizada</span>
                        <span class="info-box-number">41,410</span>
                    </div>

                </div>

            </div>


            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-file-text-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Vistoria em Rascunho</span>
                        <span class="info-box-number">760</span>
                    </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Vistoria nesse mẽs</span>
                        <span class="info-box-number">2,000</span>
                    </div>

                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Atalhos Imóveis</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <li class="item">

                                <div class="product-info">
                                    <a href="{{ url('imovel/sincronizar') }}" id="sincronizar_imovel_home"
                                        class="product-title">Sincronizar Imóveis
                                        <span class="label label-warning pull-right">Imóveis</span></a>
                                    <span class="product-description">
                                        MENU - Configuração
                                    </span>
                                </div>

                            </li>
                            <!-- /.item -->


                            <li class="item">
                                <div class="product-info">
                                    <a href="{{ 'imoveis' }}" class="product-title">Todos os Imóveis
                                        <span class="label label-warning pull-right">Imóveis</span></a>
                                    <span class="product-description">
                                        MENU - Imóvel
                                    </span>
                                </div>
                            </li>
                            <!-- /.item -->
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">

                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Outros Atalhos</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <div class="col-md-4">
                                <li class="item">
                                    <div class="product-info">
                                        <a href="{{ url('chaves') }}" class="product-title">Chaves
                                            <span class="label label-success pull-right">Controle de chaves</span></a>
                                        <span class="product-description">
                                            MENU - Imóvel
                                        </span>
                                    </div>
                                </li>
                            </div>
                            <!-- /.item -->
                            <div class="col-md-4">
                                <li class="item">
                                    <div class="product-info">
                                        <a href="{{ 'vistoria' }}" class="product-title">Vistorias
                                            <span class="label label-success pull-right">Vistoria</span></a>
                                        <span class="product-description">
                                            MENU - Imóvel
                                        </span>
                                    </div>
                                </li>
                            </div>
                            <div class="col-md-4">
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="product-title">Clientes Interessados
                                            <span class="label label-success pull-right">Interessado</span></a>
                                        <span class="product-description">
                                            MENU - Cliente
                                        </span>
                                    </div>
                                </li>
                            </div>
                            <!-- /.item -->
                        </ul>
                        <ul class="products-list product-list-in-box">
                            <div class="col-md-4">
                                <li class="item">
                                    <div class="product-info">
                                        <a href="{{ url('site/contato') }}" class="product-title">Contato
                                        </a>
                                        <span class="product-description">
                                            MENU - Imóvel
                                        </span>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">

                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box  box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gráfico Anual</h3>
                      
                    </div>
                    <div class="box-body">
                    <canvas id="myChart" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gráfico de Vistorias</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <style type="text/css">
        .products-list .product-info {
            margin-left: 0px;
        }
    </style>
@stop()


@section('js')
    {{ Html::script('/js/all.js') }}
    {{ Html::script('/js/immobile.js') }}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "Projeção Anual",
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0, 10, 5, 2, 20, 30, 45],
                }]
            },

            // Configuration options go here
            options: {}
        });

        var barChartCanvas                   = document.getElementById('barChart').getContext('2d');
        var myBarChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [{
                    label: "Mensalmente",
                    backgroundColor: '#3c8dbc',
                    borderColor: '#3c8dbc',
                    data: [0, 10, 5, 2, 20, 30, 45],
                }]
            },
            options: {}
        });

    </script>
@stop
