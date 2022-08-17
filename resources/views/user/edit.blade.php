@extends('adminlte::page')

@section('title', 'Admin - Usuário')

@section('content_header')
<h1>EM DESENVOLVIMENTO</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
  <li>Perfil</li>
  <li class="active">Cadastro</li>
</ol>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">
    <example-component></example-component>
  </div>
  @include('message.message_general')
	<div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="http://markinternational.info/data/out/565/223867976-avatar-images.png" alt="User profile picture">

        <h3 class="profile-username text-center">Nina Mcintire</h3>

        <p class="text-muted text-center">Software Engineer</p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Followers</b> <a class="pull-right">1,322</a>
          </li>
          <li class="list-group-item">
            <b>Following</b> <a class="pull-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="pull-right">13,287</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-md-8">
   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Dados</h3>
    </div>
    <div class="box-body">
      {{Form::open(['url' => '/usuario/editar/'.$user->id, 'method' => 'put'])}}
      
      <div class="form-group">
        <label for="">Nome Completo:</label>
        <input type="text" name="name" value="{{$user->name}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Nome de Usuário:</label>
        <input type="text" name="nick" value="{{$user->nick}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="">CPF:</label>
        <input type="text" name="cpf" onBlur="javascript:validaCPF(this);" value="{{$user->cpf}}" class="form-control">
      </div>

      <div class="form-group">
        <label for="">E-mail:</label>
        <input type="text" name="email" value="{{$user->email}}" class="form-control">
      </div>
      <div class="form-group">
        <label for="">Celular:</label>

        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-phone"></i>
          </div>
          <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
        </div>
      </div>
      <div class="form-group">
        <label for="">Recebe proposta:</label><br/>
        <div class="btn-group" data-toggle="buttons">
          <?php
          if($user->receive_proposal == 0){
            $check_yes  ='';
            $check_no ='active';
          }else{
            $check_yes  ='active';
            $check_no ='';
          }
          ?>
          <label class="btn btn-default {{$check_yes}}">
            <input type="radio" name="receive_proposal" id="option1" value="1" autocomplete="off" > Sim
          </label>
          <label class="btn btn-default {{$check_no}}">
            <input type="radio" name="receive_proposal" id="option2" value="0" autocomplete="off" checked> Não
          </label>          
        </div>    
      </div>
      <div class="form-group">
        <label>Alterar Senha</label>
        <input type="password" name="password" class="form-control">
      </div>
      <div class="form-group">
        <hr>
        <input type="hidden" value="{{$user->id}}" name="id" >
        <input type="submit" class="btn btn-flat btn-success pull-right" value="Alterar">
      </div>
      {{Form::close()}}
    </div>
    <!-- /.box-body -->
  </div>
</div>
</div>  




@endsection

