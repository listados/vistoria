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

@section('content')
<div class="row">
    <form action="{{url('site/createPersonTeam')}}" method="post" enctype="multipart/form-data">
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
                                class="form-control">
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
                        <label>Link do Foto</label>
                        <input 
                        name="teamSites_photo"
                        type="text" class="form-control" placeholder="link da foto">
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

<div class="row">
    <div class="col-md-12"><br></div>
</div>
<div class="row">
    <div class="col-md-12">
       <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Diretoria</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Comercial</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Adm Imóveis</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Adm Financeiro</a></li>
            <li role="presentation"><a href="#juridico" aria-controls="settings" role="tab" data-toggle="tab">Jurídico</a></li>
        </ul>
        
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
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
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">...Comercial</div>
            <div role="tabpanel" class="tab-pane" id="messages">.Imóveis..</div>
            <div role="tabpanel" class="tab-pane" id="settings">..Financeiro.</div>
            <div role="tabpanel" class="tab-pane" id="juridico">..Jurídico.</div>
          </div>
       </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="{{url('js/teamSite.js')}}"></script>

@stop