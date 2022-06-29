@extends('adminlte::page')

@section('title', 'Dashboard')
<style>
.products-list .product-img img {
    width: 150px !important;
    height: 150px !important;
}
.image-center {
    width: 150px;
    height: 150px;
    display: block;
    margin: 0 auto;
}
</style>
@section('content_header')
    <h1>Equipe</h1>
@stop
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-info"></i> O Preenchimento de todos os campos são obrigatórios</h5>
        </div>
        @include('message.general')
        <form action="{{url('site/createPersonTeam')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-12 ">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            @include('site.team.form')
                            <div class="form-group">
                                <label>Foto</label>
                                <input 
                                name="fileAvatar"
                                type="file" placeholder="link da foto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="box-footer">
                        <a href="{{url('home')}}" class="btn btn-default">Cancelar</a>
                        <button type="submit" class="btn btn-primary pull-right">
                            <i class="fa fa-save"></i> Cadastrar Funcionário
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <br>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Diretoria</h3>
                        
                    </div>
                    <div class="box-body">
                        <div class="table table-responsive">
                            <table id="tabelaComercial" class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nome</th>
                                        <th>Contato</th>
                                        <th>Linkedin</th>
                                        <th>Descrição</th>
                                        <th>Cargo</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    @include('modal.modal_alter_status_team')
                    <!-- Modal -->
<div class="modal fade" id="modalEditTeam" tabindex="-1" role="dialog" aria-labelledby="modalEditTeam">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Editar Funcionário</h4>
        </div>
        <form id="formAlterTeam" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                @include('site.team.form')
            </div>
            <div class="col-md-6">
                <div class="thumbnail">
                    <img id="thumbnailPhoto" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Foto</label>
                    <input 
                    name="fileAvatar"
                    type="file" placeholder="link da foto">
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
          <button type="submit" class="btn btn-primary">
            Atualizar <i class="fa fa-save"></i>
          </button>
        </div>
        </form>
      </div>
    </div>
</div>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
<script src="{{url('js/helpers.js')}}"></script>
<script src="{{url('js/all.js')}}"></script>
<script src="{{url('js/teamSite.js')}}"></script>
@stop