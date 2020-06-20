<div class="modal fade" id="option_print_survey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Opção de Impressão</h4>
            </div>
           
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                 {{ Form::open(array('url' => 'vistoria/imprimir/', 'method' => 'get' )) }}
                 {{ Form::hidden('id_survey' , '' , ['class' => 'print_id_survey']) }}
                 {{ Form::hidden('imprimir_com_foto', 'true' ) }}
                 {{ Form::submit('Imprimir com Foto', $attributes = array('class' => 'btn btn-primary click_print_survey' )) }}
                 {{ Form::close() }}
              </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group">
                 {{ Form::open(array('url' => 'vistoria/imprimir/', 'method' => 'get' )) }}
                 {{ Form::hidden('id_survey' , '' , ['class' => 'print_id_survey']) }}
                 {{ Form::hidden('imprimir_com_foto', 'false' ) }}
                 {{ Form::submit('Imprimir sem Foto', $attributes = array('class' => 'btn btn-primary click_print_survey disabled' )) }}
                 {{ Form::close() }}
              </div>
                </div>
              </div>
              <div class="row text-center" id="load_print_survey">
                <img src="{{ url('images/loading.gif') }}">
              </div>
            </div>
            <div class="modal-footer">                
                {{ Form::button('Sair', $attributes = array('class' => 'btn btn-default' , 'data-dismiss' => 'modal')) }}               
            </div>
            
        </div>
    </div>
</div> 