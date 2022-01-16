<div class="modal fade" id="modalAlterStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="statusInfo">Desativar Funcionário</h4>
        </div>
        <div class="modal-body">
          <label class="text-danger text-center" id="textStatus">Deseja realmente desativar essa funcionário?</label>
          <small>
              <strong>Obs:</strong>
              <small id="obsStatus">Esse funcionário não será excluso do banco de dados, porém, não irá mais aparecer no site na página do site.</small>
          </small>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="teamSites_id" id="idTeamSites">
            <input type="hidden" name="teamSites_status" id="teamSites_status">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Não</button>
          <button type="button" class="btn btn-primary" id="alterStatusTeam">Sim</button>
        </div>
      </div>
    </div>
  </div>