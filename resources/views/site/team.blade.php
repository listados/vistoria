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
                            <div class="form-group">
                                <label>Nome do funcionário</label>
                                <input type="text" name="teamSites_name" class="form-control" placeholder="Irá mostrar no site">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fone de contato</label>
                                        <input type="text" 
                                        name="teamSites_phoneOne"
                                        class="form-control"
                                        onkeyup="mascara( this, mtel );"
                                        id="teamSites_phoneOne"
                                        maxlength="15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cargo do funcionario</label>
                                        <select 
                                        name="teamSites_office"
                                        class="form-control">
                                            <option selected>--Selecione--</option>
                                            <option>Gestor</option>
                                            <option>Comercial</option>
                                            <option>Administração de Imóveis</option>
                                            <option>Administrativo e Financeiro</option>
                                            <option>Equipe Jurídico</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Descrição do funcionário</label>
                                <textarea 
                                name="teamSites_text"
                                class="form-control" rows="3" placeholder="Digite o perfil ou uma descrição para o funcionário"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Link do linkedin</label>
                                <input name="teamSites_linkedin"
                                type="text" class="form-control" placeholder="Por exemplo: https://www.linkedin.com/in/sua-url-010203/">
                            </div>
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
<script src="{{url('js/all.js')}}"></script>
@stop