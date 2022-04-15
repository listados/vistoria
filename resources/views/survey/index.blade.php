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


<div class="col-md-12 box">
<a href="{{ 'vistoria/create' }}" class="btn bg-olive btn-flat pull-right load-modal"  tabindex="0"  data-toggle="popover" data-trigger="hover" data-content="Você criará uma nova vistoria" data-placement="left" style="margin: 10px;"> <i class="fa fa-plus"></i>  Nova Vistoria</a>	
<a href="#" class="btn bg-navy btn-flat pull-left"  tabindex="0"  data-toggle="modal" data-target="#modalSearchSurvey" data-content="Pesquisar mais vistorias" data-placement="left" style="margin: 10px;"> <i class="fa fa-search"></i>  Pesquisar Vistoria</a>	
@include('modal.modal_load')
@include('modal.modal_search_survey')

<div class="table table-responsive">
		<table id="table-survey" class="table table-striped table-bordered" style="width:100%;">
		<thead>
			<tr>
				<th>Código</th>
				<th>Imóvel</th>
				<th>Data</th>
				<th>Tipo</th>
				<th>Vistorador</th>
				<th>Status</th>
				<th>Ação</th>
			</tr>
		</thead>
	</table>
</div>	
	@include('modal.survey_print')	
	@include('modal.modal_load')
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



