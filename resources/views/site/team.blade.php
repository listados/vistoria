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
    <div class="col-md-12"><br></div>
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
<script src="{{url('js/teamSite.js')}}"></script>

@stop