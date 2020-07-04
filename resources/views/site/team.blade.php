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
            {{-- <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="img-responsive image-center" src="https://image.flaticon.com/icons/png/512/72/72737.png" alt="User profile picture">
                        <p class="text-muted text-center"><br><br><br></p>        
                        <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <label for="">Nome do funcionário</label>
                        <input type="file" name="image" class="form-control">
                        </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
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
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Diretoria</a></li>
              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Comercial</a></li>
              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Adm Imóveis</a></li>
              <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Adm Financeiro</a></li>
              <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Jurídico</a></li>
            </ul>
          
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home">
                 <div class="row">
                     <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                              <h3 class="box-title">Registrar os gestores</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 219px;">Rendering engine</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 268px;">Browser</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 239px;">Platform(s)</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 188px;">Engine version</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 138px;">CSS grade</th></tr>
                                </thead>
                                <tbody>
                                <tr role="row" class="odd">
                                  <td class="sorting_1">Gecko</td>
                                  <td>Firefox 1.0</td>
                                  <td>Win 98+ / OSX.2+</td>
                                  <td>1.7</td>
                                  <td>A</td>
                                </tr>
                                </tfoot>
                              </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
                            </div>
                            <!-- /.box-body -->
                          </div>
                     </div>
                 </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="profile">...</div>
              <div role="tabpanel" class="tab-pane" id="messages">...</div>
              <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>
        </div>
       </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop