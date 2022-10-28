@extends('adminlte::page')

@section('title', 'Vistoria - EspindolaAdmin')

@section('content_header')

<h1>Vistoria
	<small>Painel de vistoria</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
	<li class="active"> Vistoria </li>
</ol>
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<a href="{{ 'vistoria/create' }}" class="btn bg-olive btn-flat pull-right load-modal"  tabindex="0"  data-toggle="popover" data-trigger="hover" data-content="Você criará uma nova vistoria" data-placement="left" style="margin: 10px;"> 
					<i class="fa fa-plus"></i>  Nova Vistoria
				</a>
				<a href="{{url('vistoria/pesquisar-vistoria')}}" class="btn bg-navy btn-flat pull-left"  tabindex="0" title="Pesquisar mais vistorias" style="margin: 10px;">
					<i class="fa fa-search"></i> Pesquisa avançada
				</a>
			</div>
			<div class="box-body">
				<list-survey></list-survey>
			</div>
			<div class="box-footer">
				Footer
			</div>
		</div>
	</div>
</div>

@stop

@section('css')
   {{ Html::style('css/survey.css') }}
@stop


@section('js')
{{ Html::script('/js/all.js') }}
{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
{{ Html::script('/js/survey.js') }}

    <script type="text/javascript">
		$(".load-modal").click(function(event) {
			$("#load-modal").modal('show');
		});	
		
	</script>



@stop



