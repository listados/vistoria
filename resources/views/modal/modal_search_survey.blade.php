<div class="modal fade" id="modalSearchSurvey" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pesquisar Vistoria</h4>
        </div>
        <div class="modal-body">
            <form id="formSearchSurvey">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group col-md-6">
                        <label for="">Código: </label>
                        <input type="text" name="immobile_code" class="form-control" id="code" placeholder="Código">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Tipo: </label>
                        <select name="immobile_type" class="form-control" id="TypeImmobile">
                            <option value="">--Selecione--</option>
                            <option value="">01</option>
                            <option value="">02</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="form-group col-md-6">
                        <label for="">Status: </label>
                        <select name="immobile_type" class="form-control" id="TypeImmobile">
                            <option value="">--Selecione--</option>
                            <option value="">Rascunho</option>
                            <option value="">Finalizado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Vistoriado: </label>
                        <select name="immobile_type" class="form-control" id="TypeImmobile">
                            <option value="">--Selecione--</option>
                            <option value="">Francisco</option>
                            <option value="">Yara Pereira</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <p class="help-block">Pesquisar as vistorias rascunho ou finalizada que estão em um período.</p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">De: </label>
                        <input type="text" name="immobile_dateStart" class="form-control" id="immobile_dateStart" placeholder="__/__/____">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Até: </label>
                        <input type="text" name="immobile_dateEnd" class="form-control" id="immobile_dateEnd" placeholder="__/__/____">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Endereço do Imóvel: </label>
                        <input type="text" name="immobile_address" class="form-control" id="immobile_address" placeholder="Ex: Avenida Santos Dummont">
                    </div>
                </div>
            </div>
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
          <button type="button" id="btnSearchSurvey" class="btn btn-primary">
              <i class="fa fa-search"></i> Pesquisar
          </button>
        </div>
      </div>
    </div>
  </div>