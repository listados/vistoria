<div class="form-group">
    <label>Nome do funcionário</label>
    <input type="text" name="teamSites_name" id="" class="form-control teamSites_name" placeholder="Irá mostrar no site">
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Fone de contato</label>
            <input type="text" 
            name="teamSites_phoneOne"
            class="form-control teamSites_phoneOne"
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
            class="form-control teamSites_office" id="">
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
    class="form-control teamSites_text" rows="3" placeholder="Digite o perfil ou uma descrição para o funcionário"></textarea>
</div>
<div class="form-group">
    <label>Link do linkedin</label>
    <input name="teamSites_linkedin"
    type="text" class="form-control teamSites_linkedin" placeholder="Por exemplo: https://www.linkedin.com/in/sua-url-010203/">
</div>