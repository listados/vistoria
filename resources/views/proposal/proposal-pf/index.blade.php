@extends('adminlte::page')

@section('title', 'Proposta PF - Espindola Admin')

@section('content_header')
	<h1>Proposta Pessoa Física</h1>
@stop

@section('content')

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Todas as propostas PF</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">

		<proposal-pf :atendent="{{ json_encode($atendents) }}"></proposal-pf>
	</div>
	<!-- /.box-body -->
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