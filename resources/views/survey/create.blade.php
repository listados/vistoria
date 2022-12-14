@extends('adminlte::page')

@section('title', 'Vistoria - EspindolaAdmin')

@section('content_header')
@php $survey_id = base64_decode(\Request::segment(2) );//pegando o parametro desejado 
@endphp
<h1>Vistoria
	<small>{{ $tit_small_survey[0] }} {{  $tit_small_survey[1] .' | ' }} <b class="label label-success">{{ $id_survey }}</b> </small>
</h1>

<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
	<li class="active"> <a href="{{ url('vistoria') }}"> Vistoria </a> </li>
</ol>
@stop

@section('content')

<!-- Main content -->

@section('content')
    <div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Editar Vistoria</h3>
				</div>
				<div class="box-body">
					<!-- ÁREA LOCADOR -->
					<create-user 
						:type-survey="{{ json_encode('Locador') }}"
						:id-survey="{{ json_encode($id_survey) }}">
					</create-user>
					<!-- FIM ÁREA LOCADOR -->
					<div class="col-md-12">
						<hr>
					</div>
					<!-- ÁREA LOCATÁRIO -->
					<create-user 
						:type-survey="{{ json_encode('Locatario') }}"
						:id-survey="{{ json_encode($id_survey) }}">
					</create-user>
					<!--FIM ÁREA LOCATÁRIO-->

					<!-- ÁREA FIADOR -->
					<div class="col-md-12">
						<hr>
					</div>
					<create-user 
					:type-survey="{{ json_encode('Fiador') }}"
					:id-survey="{{ json_encode($id_survey) }}">
					</create-user>
					<!-- FIM ÁREA FIADOR -->
					<div class="col-md-12">
						<hr>
						
						<survey-surveyor
							:id-survey="{{ json_encode($id_survey) }}"
							:survey="{{ json_encode($survey)  }}"
						></survey-surveyor>
					</div>
					<div class="col-md-12">
						<div class="box-header with-border">
							<h3 class="box-title">Dados do imóvel</h3>
						</div>		
					</div>
					<div class="col-md-9">
						<div class="form-group">
							{{ Form::label('survey_address_immobile' , 'Endereço do imóvel') }}
							{{ Form::text('survey_address_immobile', (!empty($survey[0]->survey_address_immobile)) ? $survey[0]->survey_address_immobile : $survey->survey_address_immobile, ['class' => 'form-control' , 'id' => 'survey_address_immobile' , 'placeholder' => 'Endereço do imóvel'])  }} 
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('survey_type_immobile' , 'Tipo do imóvel') }}
							<select class="form-control" name="survey_type_immobile" id="survey_type_immobile">                 
								@if(empty($survey->survey_type_immobile))
								<option value="Não informado" selected="selected">--Selecione-- </option>
								@include('survey.type_immobile')
								@else
								<option value="{{ $survey->survey_type_immobile }}">{{ $survey->survey_type_immobile }}</option>
								@include('survey.type_immobile')
								@endif	
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							
							{{ Form::label('survey_energy_meter' , 'Medidor de energia') }}
							{{ Form::text('survey_energy_meter', (!empty($survey[0]->survey_energy_meter)) ? $survey[0]->survey_energy_meter :$survey->survey_energy_meter, ['class' => 'form-control' , 'id' => 'survey_energy_meter' , 'placeholder' => 'Medidor de energia'])  }}
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('survey_energy_load' , 'Leitura de Energia') }}
							{{ Form::text('survey_energy_load', (!empty($survey[0]->survey_energy_load)) ? $survey[0]->survey_energy_load: $survey->survey_energy_load, ['class' => 'form-control' , 'id' => 'survey_energy_load' , 'placeholder' => 'Leitura de Energia'])  }} 
							</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('survey_water_meter' , 'Medidor de água') }}
							{{ Form::text('survey_water_meter', (!empty($survey[0]->survey_water_meter)) ? $survey[0]->survey_water_meter: $survey->survey_water_meter, ['class' => 'form-control' , 'id' => 'survey_water_meter' , 'placeholder' => 'Medidor de água'])  }} 
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('survey_water_load' , 'Leitura de água') }}
							{{ Form::text('survey_water_load', (!empty($survey[0]->survey_water_load)) ? $survey[0]->survey_water_load:$survey->survey_water_load, ['class' => 'form-control' , 'id' => 'survey_water_load' , 'placeholder' => 'Leitura de água'])  }} 
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('survey_gas_meter' , 'Medidor de gás') }}
							{{ Form::text('survey_gas_meter', (!empty($survey[0]->survey_gas_meter)) ? $survey[0]->survey_gas_meter : $survey->survey_gas_meter, ['class' => 'form-control' , 'id' => 'survey_gas_meter' , 'placeholder' => 'Medidor de gás'])  }} 
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							{{ Form::label('survey_gas_load' , 'Leitura do gás') }}
							{{ Form::text('survey_gas_load', (!empty($survey[0]->survey_gas_load)) ? $survey[0]->survey_gas_load : $survey->survey_gas_load, ['class' => 'form-control' , 'id' => 'survey_gas_load' , 'placeholder' => 'Leitura do gás'])  }} 
						</div>
					</div>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Aspectos Gerais
						<small>Descreva os detalhes de todos os ambientes do imóvel</small>
					</h3>
				</div>
				<div class="box-body pad">
					<survey-content :id-survey="{{ json_encode($id_survey) }}" :context="{{ json_encode('survey_general_aspects') }}"></survey-content>
				</div>	
			</div>			
			
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Ressalvas por Ambientes / Cômodos</h3>
				</div>
				<div class="box-body pad">
					<survey-content :id-survey="{{ json_encode($id_survey) }}" :context="{{ json_encode('survey_provisions') }}"></survey-content>
				</div>	
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Disposições Gerais</h3>
				</div>
				<div class="box-body pad">
					<survey-content :id-survey="{{ json_encode($id_survey) }}" :context="{{ json_encode('survey_reservation') }}"></survey-content>
				</div>	
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Chaves
						<small>(e outros itens móveis)</small>
					</h3>
				</div>
				<div class="box-body pad">
					<survey-content :id-survey="{{ json_encode($id_survey) }}" :context="{{ json_encode('survey_keys') }}"></survey-content>
				</div>	
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Upload do ambiente
					</h3>
				</div>
				<div class="box-body">
					<div class="pull-left">
							<button type="button" class="btn btn-primary" data-toggle="modal" 
							data-target="#modal_ambience">
							<i class="fa fa-upload" aria-hidden="true">
							</i> Fotos Gerais 
							</button>
							@include('modal.survey_ambience_upload')
					</div>
				<div class="col-md-12">
					<hr>
					<div class="form-group">
						<label for="">Link do tour
						</label>
						<input type="text" name="survey_link_tour" value="{!! $survey_update[0]->survey_link_tour !!}" placeholder="Digite o link do tour virtual já feito" class="form-control">
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

<!-- /Main content -->

@include('modal.modal_load')
</section>

@stop

@section('css')
{{ Html::style('css/survey.css') }}
{{ Html::style('css/plugins/dropzone/dropzone.css') }}

@stop


@section('js')


<script type="text/javascript">
	var id_survey_dec = '{{ $survey_id }}';
	var id_survey_enc = '{{ base64_encode($survey_id) }}';
</script>

{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
{{ Html::script('/js/all.js') }}
{{ Html::script('/js/survey.js') }}
{{ Html::script('/js/plugins/dropzone.js') }}
{{ Html::script('/js/upload_ambience.js') }}
@stop