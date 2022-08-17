@extends('adminlte::page')

@section('title', 'EspindolaAdmin - Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
   <section class="content">
    @include('message.message_general')
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Atalhos Imóveis</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <li class="item">
                      
                      <div class="product-info">
                        <a href="{{ url('imovel/sincronizar') }}" id="sincronizar_imovel_home" class="product-title">Sincronizar Imóveis 
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
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
    			<div class="box">
    				<canvas id="myChart" width="400" height="200"></canvas>
    			</div>
    		</div>		
    		<div class="col-md-6">
    			<div class="box">
    				<canvas id="chartjs-1" width="400" height="200"></canvas>
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

<script type="text/javascript">

	var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho" , "Agosto" , "Setembro", "Outubro"],
        datasets: [{
            label: '# Vistorias',
            data: ['{{$array_month[1]}}', '{{$array_month[2]}}', '{{$array_month[3]}}', '{{$array_month[4]}}', 
            '{{$array_month[5]}}', '{{$array_month[6]}}', '{{$array_month[7]}}', '{{$array_month[8]}}',
            '{{$array_month[9]}}', '{{$array_month[10]}}'],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
<script>new Chart(document.getElementById("chartjs-1"),{"type":"bar","data":{"labels":["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho"],"datasets":[{"label":"Propostas recebidas","data":[65,59,80,81,0,0,0],"fill":false,"backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],"borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],"borderWidth":1}]},"options":{"scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}}});</script>
@stop