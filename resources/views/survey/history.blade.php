@extends('adminlte::page')

@section('title', 'Histórico de Vistoria')

@section('content_header')
<h1>Histórico</h1>
<small>
    Histórico da vistoria 
    <label class="label label-success">
        <b>{{ $histories->first()->survey_id ?? 'N/A' }}</b>
    </label>
</small>

<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
    <li class="active"><a href="{{ url('vistoria') }}"> Vistoria </a></li>
</ol>
@stop

@section('content')

<section class="content">
   <div class="row">
      <div class="col-md-12">
          <!-- DIRECT CHAT -->
          <div class="box box-primary direct-chat direct-chat-info">
            <div class="box-header with-border">
              <h3 class="box-title">Histórico</h3>
              <div class="box-tools pull-right">
                <a href="{{ url('vistoria') }}" class="btn btn-default" title="Voltar para lista de vistoria">
                    <i class="fa fa-arrow-circle-left"></i>
                    Voltar
                </a>
              </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">

                @if($histories->isEmpty())
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <div class="direct-chat-text">
                            Não consta nenhum histórico.
                        </div>
                    </div>
                </div>
                @endif

                @foreach($histories as $history)
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{ $history->user->name ?? 'Usuário desconhecido' }}</span>
                    <span class="direct-chat-timestamp pull-right">
                        @if($history->changed_at)
                            {{ $history->changed_at->format('d/m/Y H:i:s') }}
                        @endif
                    </span>
                  </div>
                  <!-- /.direct-chat-info -->

                  @if(empty($history->user) || empty($history->user->avatar))
                  <img class="direct-chat-img" src="{{ url('dist/img/user.png') }}" alt="Usuário sem foto" style="width: 32px; height: 32px;">
                  @else
                  <img class="direct-chat-img" src="{{ url('dist/img/upload/profile/'.$history->user->avatar) }}" alt="Imagem do usuário">
                  @endif

                  <!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                        <b>{!! $history->field !!}</b>: {!! $history->old_value !!} &rarr; {!! $history->new_value !!}
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
              <!-- Se quiser colocar algo no footer -->
          </div>
          <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
      </div>
      <!-- /.col -->     
    </div>
</section>
@stop
