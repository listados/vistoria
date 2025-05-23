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
				<div class="col-md-12 text-center">
					@include('message.message_general')
				</div>
				<search-survey :type-immobile="{{ json_encode($typeImmobiles) }}" :type-inspector="{{ json_encode($inspect) }}"></search-survey>
			</div>
			<div class="box-body">
				<list-survey></list-survey>
			</div>
		</div>
	</div>
</div>

@stop

@section('css')
   {{ Html::style('css/survey.css') }}
@stop


@section('js')

{{ Html::script('/js/manifest.js') }}
{{ Html::script('/js/vendor.js') }}
{{ Html::script('/js/survey.js') }}

    <script type="text/javascript">
		$(".load-modal").click(function(event) {
			$("#load-modal").modal('show');
		});	
		
	</script>



@stop



