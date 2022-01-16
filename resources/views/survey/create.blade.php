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
<section class="content">
	<div class="row">
		<div class="col-md-12">
			@include('message.message_general')
		</div>
	</div>
	<script type="text/javascript" src="{{ url('js/new_add_survey.js') }}"></script>
	{{ Form::model($survey, ['url' => '' , 'id' => 'form_survey' ]) }}
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-body">
					<!-- ÁREA LOCADOR -->
					<div class="col-md-12">
						<a href="#container" class="add" id="" onclick="addUserSurvey('elementOccupant', 'div', 'container', 'remove' , 'locator')" data-toggle="tooltip" data-placement="right" title="Adicionar novo locador a vistoria"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Locador</a>
					</div>

					 @foreach(@$survey_update as $dados)    
                        @if(@$dados->relation_survey_user_type == 'Locador')    
                        <div class="col-md-5">
                            <div class="form-group">
                                {{ Form::hidden('id_user[]' , $dados->id) }}   
                                <label for="">Nome do Locador </label>
                                <input type="text" name="survey_locator_name[]" id="nome_locatario" value="{{ $dados->name }}" placeholder="Nome do Locador" class="form-control">            
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">CPF ou CNPJ</label>
                                <input type="text" name="survey_locator_cpf[]"  value="{{ $dados->relation_survey_user_cpf }}" placeholder="CPF ou CNPJ do Locador" class="form-control" id="cpf_locador">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">E-mail do Locador</label>
                                <div class="input-group">
                                    <input type="text"  name="survey_locator_email[]" id="survey_locator_email" value="{{$dados->email }}" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button"  onclick="deleteUserSurvey({{ $dados->id }},  {{ $id_survey }})" class="btn btn-primary btn-flat"  data-toggle="tooltip" data-placement="top" title="Exclui esse usuário"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
					<div class="container" >						
						<div class='elementOccupant' id='div_1'></div>
					</div>
					<!-- FIM ÁREA LOCADOR -->
					<!-- ÁREA LOCATÁRIO -->
					<div class="col-md-12">
						<hr>
						<a href="#containerLocatario" class="add" id="" onclick="addLocatarioSurvey('elementLocatario', 'divLocatario', 'containerLocatario', 'removeLocatario' , 'occupant')" data-toggle="tooltip" data-placement="right" title="Adicionar novo locatário a vistoria"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Locatário</a>
					</div>
					@foreach(@$survey_update as $dados)  
                    @if(@$dados->relation_survey_user_type == 'Locatário')    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nome do Locatário </label>
                            {{ Form::hidden('id_user_occupant[]' , $dados->id) }}   
                            <input type="text" name="survey_occupant_name[]" id="survey_occupant_name" value="{{ $dados->name }}"  placeholder="Nome do locatário" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">CPF ou CNPJ do Locatário</label>
                            <input type="text" name="survey_occupant_cpf[]" value="{{ $dados->relation_survey_user_cpf }}"  placeholder="CPF ou CNPJ do locatário" class="form-control" id="cpf_locatario" >
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">E-mail do Locatário</label>
                            <div class="input-group">
                                <input type="text"  name="survey_occupant_email[]" id="survey_occupant_email" value="{{$dados->email }}" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button"  onclick="deleteUserSurvey({{ $dados->id }},  {{ $id_survey }})" class="btn btn-primary btn-flat"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    @endif
                    @endforeach
					
					<div class="containerLocatario" >
						<div class='elementLocatario' id='divLocatario_1'></div>
					</div>

					<!--FIM ÁREA LOCATÁRIO-->
					<!-- ÁREA FIADOR -->
					<div class="col-md-12">
						<hr>
						<a href="#containerFiador" class="add" id="" onclick="addLocatarioSurvey('elementFiador', 'divFiador', 'containerFiador', 'removeFiador' , 'guarantor')" data-toggle="tooltip" data-placement="right" title="Adicionar novo fiador a vistoria"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Fiador</a>
					</div>

					 @foreach($survey_update as $dados)    
                @if($dados->relation_survey_user_type == 'Fiador')   
               
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nome do Fiador</label>
                        {{ Form::hidden('id_user_guarantor[]' , $dados->id) }}    
                        <input type="text" name="survey_guarantor_name[]" value="{{ $dados->name }}" id="survey_guarantor_name" placeholder="Nome do locatário" class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">CPF ou CNPJ do Fiador</label>
                        <input type="text" name="survey_guarantor_cpf[]" value="{{ $dados->relation_survey_user_cpf }}" id="survey_guarantor_cpf" placeholder="CPF ou CNPJ do Fiador" class="form-control" id="cpf_locatario">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">E-mail do Fiador</label>
                        <input type="text" name="survey_guarantor_email[]" value="{{ $dados->email }}" id="survey_guarantor_email" placeholder="E-mail do locatário" class="form-control">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="">Excluir</label>
                        <a href="#" onclick="deleteUserSurvey({{ $dados->id }},  {{ $id_survey }})">
                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                        </a> 
                    </div>
                </div>
                @endif

                @endforeach
					<div class="containerFiador" >
						<div class='elementFiador' id='divFiador_1'>
						</div>
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<!--FIM ÁREA FIADOR-->
					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('survey_inspetor_name', 'Nome do vistoriador') }}
							{{ Form::text('survey_inspetor_name' , (!empty( $survey[0]->survey_inspetor_name) ) ? $survey[0]->survey_inspetor_name : $survey->survey_inspetor_name , ['id' => 'survey_inspetor_name' , 'placeholder' => 'Nome do Vistoriador' , 'class' => 'form-control']) }}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('survey_inspetor_cpf', 'CPF ou CNPJ do vistoriador') }}
							{{ Form::text('survey_inspetor_cpf' , (!empty($survey[0]->survey_inspetor_cpf) ) ? $survey[0]->survey_inspetor_cpf : $survey->survey_inspetor_cpf , ['id' => 'cpf_vistoriador' , 'placeholder' => 'CPF do Vistoriador' , 'class' => 'form-control']) }}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('survey_date', 'Data da vistoria') }}
							{{ Form::text('survey_date' , (!empty($survey[0]->survey_date)) ? date('d/m/Y' , strtotime($survey[0]->survey_date)) : date('d/m/Y' , strtotime($survey->survey_date)) , ['id' => 'data_vistoria' , 'class' => 'form-control']) }}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							{{ Form::label('survey_type' , 'Tipo') }}
							{{ Form::select('survey_type', ['Alteração' => 'Alteração', 'Entrada' => 'Entrada' , 'Saída' => 'Saída'], (!empty($survey[0]->survey_type)) ? $survey[0]->survey_type : $survey->survey_type , ['class' => 'form-control' , 'id' => 'survey_type']) }}
						</div>
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


				</div><!-- FIM BOX BODY -->
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Aspectos Gerais
						<small>Descreva os detalhes de todos os ambientes do imóvel
						</small>
					</h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Esconder e Mostrar">
							<i class="fa fa-minus">
							</i>
						</button>
					</div>
					<!-- /. tools -->
				</div>
				<div class="box-body pad">

					<textarea id="editor_aspect" name="survey_general_aspects" rows="10" cols="80">
						@if(empty( $survey_update[0]->survey_general_aspects))
						<p><strong>Caracter&iacute;sticas do im&oacute;vel</strong>: Apartamento com Sala, 3 quartos com arm&aacute;rios (sendo 1 su&iacute;te com box), banheiro social com box, cozinha com arm&aacute;rios, &aacute;rea de servi&ccedil;o. Ambientes: Sala, Quarto 01, Quarto 02, Su&iacute;te, WC Su&iacute;te, WC Social, Cozinha e &Aacute;rea de Servi&ccedil;o.</p>

						<p><strong>Faxinado</strong>: Sim</p>

						<p><strong>Mobiliado</strong>: N&atilde;o, mas com arm&aacute;rios fixos de madeira em todos os quartos, na cozinha e na &aacute;rea de servi&ccedil;o. &nbsp;</p>

						<p><strong>Piso</strong>: Porcelanato branco, exceto nos banheiros que &eacute; cer&acirc;mica.</p>

						<p><strong>Paredes</strong>: Pintura em l&aacute;tex na cor creme, exceto nos banheiros e na cozinha que &eacute; cer&acirc;mica.</p>

						<p><strong>Teto</strong>: Pintura em l&aacute;tex na cor branco neve, exceto no banheiro que s&atilde;o forrados em PVC.</p>

						<p><strong>Portas e Portais</strong>: Entrada da sala com 02 portas e 02 portais, sendo a primeira em alum&iacute;nio e a segunda de madeira, ambas com fechaduras; entrada da cozinha tamb&eacute;m com 02 portas e 02 portais, sendo a primeira em alum&iacute;nio e a segunda de madeira, ambas com fechaduras; portal e porta dos quartos e dos banheiros com porta modelo sanfonada em PVC, todas com trava.</p>

						<p><strong>Instala&ccedil;&atilde;o hidr&aacute;ulica:</strong> Em perfeito funcionamento, sem ressalvas.</p>

						<p><strong>Instala&ccedil;&atilde;o el&eacute;trica:</strong> Em perfeito funcionamento, sem ressalvas.</p>
						@else 
						{!! $survey_update[0]->survey_general_aspects !!}

						@endif
					</textarea>
				</div>
			</div>

		</div>
	</div>
	<!-- /.row aspectos gerais -->
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Ressalvas por Ambientes / Cômodos
					</h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
							<i class="fa fa-minus">
							</i>
						</button>
					</div>
					<!-- /. tools -->
				</div>
				<div class="box-body pad">
					<textarea id="editor_reservation" name="survey_reservation" rows="10" cols="80">
						@if(empty( $survey_update[0]->survey_reservation))
						<p>No imóvel vistoriado foram constatadas as seguintes ressalvas:</p>
						<strong>Sala</strong>
						<ol>
							<li>Fechadura com dificuldade para fechar;</li>
						</ol>

						<strong>Quarto 01</strong>
						<ol>
							<li>Faltando trava da porta sanfonada de PVC;</li>
						</ol>
						<strong>Quarto 02</strong>
						<ol>
							<li>Trava da porta sanfonada de PVC com dificuldade para fechar;</li>
						</ol>

						<strong>Área de serviço</strong>
						<ol>
							<li>Algumas cerâmicas danificadas, conforme registros fotográficos;</li>
							<li>Armário da lavanderia com porta desregulada.</li>
						</ol>
						@else 
						{!! $survey_update[0]->survey_reservation !!}
						@endif
					</textarea>
				</div>
			</div>
		</div>
	</div><!-- /.row Ressalvas por Ambientes / Cômodos-->
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Disposições Gerais
					</h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
							<i class="fa fa-minus">
							</i>
						</button>
					</div>
					<!-- /. tools -->
				</div>
				<div class="box-body pad">
					<textarea id="editor_provisions" name="survey_provisions" rows="10" cols="80">
						@if(empty( $survey_update[0]->survey_provisions))
						<p><strong>VII&nbsp;-&nbsp;</strong>O im&oacute;vel possui condi&ccedil;&otilde;es de uso e habitabilidade, e se encontra em perfeito estado de conserva&ccedil;&atilde;o com tudo funcionando,&nbsp;<ins><strong>ressalvado&nbsp;</strong>eventuais defeitos existentes que est&atilde;o expressos no presente termo.</ins></p>

						<p><strong>VIII - O</strong>&nbsp;Tour Virtual, as imagens comuns e as em 360&ordm; est&atilde;o hospedadas no dom&iacute;nio&nbsp;<a href="http://www.espindolaimobiliaria.com.br/">www.espindolaimobiliaria.com.br</a>,&nbsp;todas publicadas at&eacute; a presente data, s&atilde;o provas digitais aceitas por todas as partes e que servir&atilde;o como fonte para esclarecer d&uacute;vidas que possam surgir ao final da loca&ccedil;&atilde;o.</p>

						<p><strong>IX -&nbsp;</strong>O(s) locat&aacute;rio(s) disp&otilde;e(m) de 05 (cinco) dias &uacute;teis, a partir desta data, para contesta&ccedil;&atilde;o, por e-mail, do presente termo de vistoria, o qual s&oacute; ter&aacute; efeito ap&oacute;s reconhecimento por escrito pelo Locador(a) ou pela sua procuradora (imobili&aacute;ria).</p>

						<p><strong>X -&nbsp;</strong>&Eacute; vedado ao(s) LOCAT&Aacute;RIO(S) realizar(em) qualquer tipo de furo nas cer&acirc;micas do im&oacute;vel, sob pena de ter(em) que substituir as cer&acirc;micas danificadas por novas da mesma cor e modelo.</p>

						<p><strong>XI -&nbsp;</strong>Os locat&aacute;rios declaram que receberam neste ato as chaves e os demais itens m&oacute;veis acima especificados, e que est&atilde;o cientes de que o aluguel e encargos come&ccedil;am a ser cobrados a partir desta data.</p>
						@else 
						{!! $survey_update[0]->survey_provisions !!}
						@endif
					</textarea>
				</div>
			</div>
		</div>
	</div><!-- /.row Disposições Gerais-->
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Chaves 
						<small>(e outros itens móveis)
						</small> 
					</h3>
					<!-- tools box -->
					<div class="pull-right box-tools">
						<button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip" title="Maximizar / Minimizar">
							<i class="fa fa-minus">
							</i>
						</button>
					</div>
					<!-- /. tools -->
				</div>
				<div class="box-body pad">

					<textarea id="editor_keys" name="survey_keys" rows="10" cols="80">
						@if(empty( $survey_update[0]->survey_keys))
						<p>Declaro(amos) ter recebido neste ato as seguintes chaves e acess&oacute;rios do im&oacute;vel:</p>

						<p>- 02 Chaves da porta principal (entrada);</p>

						<p>- 01 chave da su&iacute;te;</p>

						<p>- 01 chave do quarto;</p>

						<p>- 03 tapa ralos de pia;</p>

						<p>- 01 v&aacute;lvula para ralo de pia;</p>

						<p>- 01 interfone da marca IntelBr&aacute;s.</p>
						@else 
							{!! $survey_update[0]->survey_keys !!}
						@endif
					</textarea>
				</div>
			</div>
		</div>
	</div><!-- /.row Chaves-->
	<div class="row">
		<div class="col-md-12">
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

			<div class="box-footer">
				<div class="col-md-6">
					<button type="button"  id="completed_button" class="btn btn-success btn-lg btn-flat pull-left"> 
						<i class="fa fa-check-circle" aria-hidden="true">
						</i> Finalizar Rascunho
					</button>
				</div>

				<div class="col-md-6">
					<button type="button" class="btn btn-primary btn-lg pull-right btn-flat" id="save_button" > 
						<i class="fa fa-save"> Salvar Rascunho </i> 
					</button>
				</div>
				{{ Form::hidden('survey_status' , $survey_update[0]->survey_status, ['id' => 'survey_status']) }}
				<!-- PARAMETROS -->
				@if($title_survey == "Nova-Vistoria")				
				{{ Form::hidden('type_survey' , $title_survey) }}
				@elseif ($title_survey == "Editar-Vistoria")
				{{ Form::hidden('type_survey' , $title_survey) }}
				@elseif ($title_survey == "Replicando-Vistoria")
				{{ Form::hidden('type_survey' , $title_survey) }}				
				@endif
				{{ Form::hidden('survey_id' , $survey_id) }}
			</div>

		</div>
	</div>
</div>
<!-- /.row Upload do ambiente-->
{{ Form::close() }}
<!-- /.row -->
@include('modal.survey_ambience_upload')
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