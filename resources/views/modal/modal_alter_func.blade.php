<!-- Modal Mudar Status da Proposta-->
<div class="modal fade" id="modal_alter_functionary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ALTERAR ATENDENTE</h4>
      </div>
      <div class="modal-body">
     
        <label for="">Escolha o atendente</label>
        {{Form::select('size', $atendent,0,
            [
                'class' => 'form-control',
                'placeholder' => 'Selecione um atendente',
                'id' => 'selectAtendentModal'
            ]
        )}}
      </div>
            <div class="modal-footer">
                <input type="text" name="idProposalPf" id="inputIdProposalPf">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                <button type="button" value="Alterar" id="alterar_atendente_proposta" class="btn btn-primary pull-right">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar
                </button>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
