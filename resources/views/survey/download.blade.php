@extends('adminlte::page')
@section('title', 'Imagens da Vistoria ' . $id_survey)
@section('content_header')
    <h1>Vistoria
        <small>Imagens de Ambiente <b class="label label-success"> {{ $id_survey }} </b></small>
    </h1>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
        <li class="active"> <a href="{{ url('vistoria') }}"> Vistoria </a> </li>
        <li><a href="#"><i class="fa fa-picture-o"></i> Download </a></li>
    </ol>
@stop
@section('content')

    <section class="content">
        @include('message.message_general')
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left col-md-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        @if ($status == 'Finalizada') {{ 'disabled' }} @endif
                        title="Adiciona novas imagens a essa vistoria" data-target="#modal_ambience">
                        <i class="fa fa-upload" aria-hidden="true">
                        </i> Adicionar novas imagens
                    </button>
                </div>
                <div class="col-md-6">
                    <a href="{{ url('vistoria/' . base64_encode($id_survey) . '/editar/Editar-Vistoria/acao') }}"
                        class="btn btn-default" title="Continuar editando a vistoria"
                        @if ($status == 'Finalizada') {{ 'disabled' }} @endif>
                        <i class="fa fa-edit" aria-hidden="true">
                        </i> Ir para a vistoria
                    </a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <!-- CAMPO PARA PASSAR O VALOR DA VISTORIA PARA A REQUISIÇÃO -->
                {{ Form::hidden('id_survey_ambience', $id_survey, ['id' => 'id_survey_ambience']) }}
            </div>
            <div class="">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-8">
                            <ambience-image :id-survey="{{$id_survey}}"></ambience-image>
                            {{ Form::open(['url' => 'vistoria/alter-delete-ambience', 
                            'id' => 'form_alter_delete_ambience']) }}
                            <div class="table-responsive box">
                                <table class="table table-bordered" id="table-ambience-survey">
                                    <thead>
                                        <tr>
                                            <th>Ambiente</th>
                                            <th>Arquivo</th>
                                            <th>Alterar Ambiente</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered box-footer">
                                    <tr>
                                        <th>Ambiente</th>
                                        <th>Arquivo</th>
                                        <th>
                                            <a href="#" 
                                                data-toggle="modal"
                                                data-target="#alter-ambience"
                                                id="alter-ambience-btn" 
                                                class="btn btn-info pull-right">
                                                Alterar
                                            </a>
                                        </th>
                                        <th>
                                            <a href="#" 
                                                id="deleteAmbience"
                                                class="btn btn-danger pull-right"
                                            >Excluir
                                            </a>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            {{--  @include('modal.survey_ambience_upload') --}}
                            @include('modal.modal_alter_ambience')
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Ordem Atual no Laudo</h3>

                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    @foreach ($name_order_actual as $itens_name_order_actual)
                                        <label for=""
                                            class="label label-primary">{{ $itens_name_order_actual->ambience_name }}</label>
                                    @endforeach
                                </div>
                                <!-- /.box-body -->

                            </div>

                            <div class="panel panel-primary">
                                <div class="panel-heading">Ordem do upload de ambiente</div>
                                <ul class="list-group" id="list-group">
                                    @php $ordinal = 0; @endphp
                                    @foreach ($name_ambience as $key => $name_ambience_item)
                                        <li class="list-group-item" value="{{ $name_ambience_item->ambience_id }}">
                                            <i class="fa fa-arrows-alt"></i>
                                            <label for=""
                                                class="text-info">{{ $name_ambience_item->ambience_name }}</label>
                                        </li>
                                    @endforeach
                                    {{-- <li class="list-group-item" value="{{$files_ambience_item->files_ambience_id}}"> {{$files_ambience_item->files_ambience_id_ambience}} </li> --}}
                                </ul>
                                <div class="panel-footer">
                                    <btn-ordem-ambience></btn-ordem-ambience>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('modal.survey_ambience_upload')
@stop
@section('css')
    {{ Html::style('css/survey.css') }}
    {{ Html::style('css/plugins/dropzone/dropzone.css') }}
    {{ Html::style('css/pnotify.buttons.css') }}

@stop
@section('js')
    {{ Html::script('/js/survey.js') }}
    {{ Html::script('/js/plugins/dropzone.js') }}
    {{ Html::script('/js/upload_ambience.js') }}
    {{ Html::script('js/plugins/sortable.min.js') }}
    {{ Html::script('js/plugins/jquery.binding.js') }}
    {{ Html::script('/js/all.js') }}
    {{-- {{ Html::script('/js/upload_ambience.js') }} --}}
    <script type="text/javascript">
        //PÁGINA DE DOWNLOAD DE IMAGENS
        $(function() {
            //   $(".ver_ch").click(function(event){

            //     $("input:checkbox[name=alter_amb]:checked").each(function() {
            //         arr.push($(this).val());            
            //     }); 
            // })
        });
        var el = document.getElementById('list-group');
        item = "";
        var sortable = Sortable.create(el, {

            animation: 450,

            onUpdate: function(evt /**Event*/ ) {
                item = evt.item; // the current dragged HTMLElement
                console.log("item = " + item.value);
            },
            onStart: function( /**Event*/ evt) {
                start = evt.oldIndex;
                console.log("Posição  = " + evt.oldIndex); // element index within parent
            },
            onEnd: function( /**Event*/ evt) {
                var itemEl = evt.item; // dragged HTMLElement
                evt.to; // target list
                evt.from; // previous list
                evt.oldIndex; // element's old index within old parent
                evt.newIndex; // element's new index within new parent
                console.log('itenE1 = ' + itemEl.oldIndex);
            }


        });
    </script>
@stop
