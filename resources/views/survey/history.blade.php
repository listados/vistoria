@extends('adminlte::page')

@section('title', 'Histórico de Vistoria')

@section('content_header')
<h1>Histórico</h1><small>Histórico da vistoria <label class="label  label-success"> <b>{{ $history[0]->history_survey_id_survey }}</b> </label> </small>

<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
    <li class="active"> <a href="{{ url('vistoria') }}"> Vistoria </a> </li>
</ol>
@stop

@section('content')

<section class="content">
   <div class="row">
      <div class="col-md-6">
          <!-- DIRECT CHAT -->
          <div class="box box-primary direct-chat direct-chat-info">
            <div class="box-header with-border">
              <h3 class="box-title">Histórico</h3>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                @if(count($history) == 0)
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <div class="direct-chat-text">
                            Não consta nenhum vistoria.
                        </div>
                    </div>
                </div>
                @endif
                @foreach($history as $historys)
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{$historys->nick}}</span>
                    <span class="direct-chat-timestamp pull-right">
                        @if($historys->history_survey_date == '0000-00-00 00:00:00' || $historys->history_survey_date == NULL)
                        @else
                        {{date("d/m/Y H:i:s" , strtotime($historys->history_survey_date)) }}
                        @endif
                    </span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="{{url('dist/img/upload/profile/'.$historys->avatar)}}" alt="message user image">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    {{$historys->history_survey_action}}
                </div>
                <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
            @endforeach
        </div>
        <!--/.direct-chat-messages-->

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!--/.direct-chat -->
</div>
<!-- /.col -->		
<div class="col-md-6">
 <div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Histórico de Contestação</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="col-md-12">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Histórico</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab">Contestar</a></li>
                    <li class="pull-left header"><i class="fa fa-th"></i></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                       The European languages are members of the same family. Their separate existence is a myth.
                       For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                       in their grammar, their pronunciation and their most common words. Everyone realizes why a
                       new common language would be desirable: one could refuse to pay expensive translators. To
                       achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                       words. If several languages coalesce, the grammar of the resulting language is more simple
                       and regular than that of the individual languages.

                   </div>
                   <!-- /.tab-pane -->
                   <div class="tab-pane" id="tab_2-2">
                    <div class="input-group">
                        <textarea name="" id="" cols="65" rows="10" form="form-control" placeholder="Descreva o que você não concorda com a vistoria"></textarea>
                    </div>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-danger btn-flat">Salvar Contestação</button>
                    </span>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.box-body -->
</div>
<!--/.box -->
</div>
</div>
</section>
@stop