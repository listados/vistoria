@extends('adminlte::page')

@section('title', 'Vistoria - EspindolaAdmin')

@section('content_header')

<h1>Vistoria
	<small>Painel de vistoria</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
	<li class="active"> Vistoria </li>
    <li class="active"> Pesquisar </li>
</ol>
@stop

@section('content')

<div class="col-md-12 box">
<div class="col-md-12">
	<form id="formSearchSurvey">
		<div class="row">
			<div class="box-header with-border">
				<h3 class="box-title">Pesquisa avançada de vistoria</h3>
				<div class="box-tools pull-right">
					<a href="{{url('vistoria')}}" class="btn pull-right" title="Voltar para vistorias"  style="cursor: pointer;">
						<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
					</a>
				</div>
			</div>	
			<div class="col-md-12">
				<div class="form-group" style="margin-top: 3px;">
					<label for="">Escolha a pesquisa: </label>
					<select name="immobile_type" class="form-control" id="TypeImmobile">
						<option value="select">--Selecione--</option>
						<option value="code">Código</option>
						<option value="type">Tipo de imóvel</option>
						<option value="status">Status da vistoria</option>
						<option value="inspector">Vistoriador</option>
						<option value="porPeriod">Por período</option>
						<option value="address">Pelo endereço</option>
					</select>
				</div>
				<div class="form-group" id="divInfoType" style="background: #efefef; padding: 2px; border: 1px solid #c3c3c3;">
					<label id="labelInfoType"></label>
					<input type="text" name="immobile_search_field" value="955" class="form-control" id="inputInfoType">
				</div>
			</div>
			<div class="col-md-12">
				<br>
			</div>
			<div class="col-md-12"  id="divInfoPeriod">
				<div class="col-md-12">
					<p class="help-block">Pesquisar as vistorias rascunho ou finalizada que estão em um período.</p>
				</div>
				<div class="form-group col-md-6">
					<label for="">De: </label>
					<input type="text" name="immobile_dateStart" class="form-control" id="immobile_dateStart" placeholder="__/__/____">
				</div>
				<div class="form-group col-md-6">
					<label for="">Até: </label>
					<input type="text" name="immobile_dateEnd" class="form-control" id="immobile_dateEnd" placeholder="__/__/____">
				</div>
			</div>
			<div class="col-md-12" id="divInfoAddress">
				<div class="form-group">
					{{-- <label for="">Endereço do Imóvel: </label> --}}
					<input type="text" name="immobile_address" class="form-control" id="immobile_address" placeholder="Ex: Avenida Santos Dummont">
				</div>
			</div>
		</div>
		</form>
		<div class="box-footer clearfix">
			<button type="button" id="btnSearchSurvey" class="btn btn-primary pull-right">
				<i class="fa fa-search"></i> Pesquisar
			</button>
		</div>
</div>

<div class="table table-responsive">
		<table id="table-survey-search" class="table table-striped table-bordered" style="width:100%;">
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



