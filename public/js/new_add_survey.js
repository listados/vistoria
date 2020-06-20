function addUserSurvey(nameElement, nameDiv, nameContainer, nameRemove , nameField)
{
      var placeholder = "";
      if(nameField == 'locator')
      {
        placeholder = 'Locador';
      }else if(nameField == 'occupant')
      {
        placeholder = 'Locatário';
      }else if(nameField == 'guarantor')
      {
        placeholder = 'Fiador';
      } 
        
       // Finding total number of elements added
      var total_element = $("."+nameElement).length;

      // last <div> with element class id
      var lastid = $("."+nameElement+":last").attr("id");
      var split_id = lastid.split("_");
      var nextindex = Number(split_id[1]) + 1;

      var max = 5;
      // Check total number elements
      if (total_element < max) {
          // Adding new div container after last occurance of element class
          $("."+nameElement+":last").after("<div class='"+nameElement+" row col-md-11 alert' style='background:#D8F9D9;'  id='"+nameDiv+"_" + nextindex + "'></div>");

          // Adding element to <div>
          $("#"+nameDiv+"_" + nextindex).append('<div class="col-md-5">\
          <label>Nome do '+placeholder+' <span class="text-success">+</span></label>\
          <input type="hidden" id="id_user[]">\
          <input type="text" name="survey_'+nameField+'_name[]" required="true" id="txt_' + nextindex + '"  value="" placeholder="Nome do '+placeholder+'" class="form-control"></div>\
          <div class="col-md-3"><label>CPF ou CNPJ <span class="text-success">+</span></label>\
          <input type="text" name="survey_'+nameField+'_cpf[]"   value="" placeholder="CPF ou CNPJ do '+placeholder+'" class="form-control" id="cpf_locador"></div>\
      </div>\
      <div class="form-group col-md-4">\
  <label>E-mail '+placeholder+' <span class="text-success">+</span></label>\
    <div class="input-group">\
        <input type="text" class="form-control" name="survey_'+nameField+'_email[]" placeholder="Email do '+placeholder+'">\
        <span  class="input-group-btn">\
            <a href="#" class="btn btn-primary '+nameRemove+' " title="Remover este locador" id="remove_' + nextindex + '">\
          <i class="fa fa-minus-circle"></i></a>\
        </span>\
    </div>\
  </div>');

	}
}//FIM ADDUSERSER

function addLocatarioSurvey(nameElement, nameDiv, nameContainer, nameRemove , nameField)
{
      var placeholder = "";
      if(nameField == 'locator')
      {
        placeholder = 'Locador';
      }else if(nameField == 'occupant')
      {
        placeholder = 'Locatário';
      }else if(nameField == 'guarantor')
      {
        placeholder = 'Fiador';
      } 
        
       // Finding total number of elements added
      var total_element = $("."+nameElement).length;

      // last <div> with element class id
      var lastid = $("."+nameElement+":last").attr("id");
      var split_id = lastid.split("_");
      var nextindex = Number(split_id[1]) + 1;

      var max = 5;
      // Check total number elements
      if (total_element < max) {
          // Adding new div container after last occurance of element class
          $("."+nameElement+":last").after("<div class='"+nameElement+" col-md-12 alert' style='background:#D8F9D9;'  id='"+nameDiv+"_" + nextindex + "'></div>");

          // Adding element to <div>
          $("#"+nameDiv+"_" + nextindex).append('<div class="col-md-5">\
          <label>Nome do '+placeholder+' <span class="text-success">+</span></label>\
          <input type="hidden" id="id_user[]">\
          <input type="text" name="survey_'+nameField+'_name[]" required="true" id="txt_' + nextindex + '"  value="" placeholder="Nome do '+placeholder+'" class="form-control"></div>\
          <div class="col-md-3"><label>CPF ou CNPJ <span class="text-success">+</span></label>\
          <input type="text" name="survey_'+nameField+'_cpf[]"   value="" placeholder="CPF ou CNPJ do '+placeholder+'" class="form-control" id="cpf_locador"></div>\
      </div>\
      <div class="form-group col-md-4">\
  <label>E-mail '+placeholder+' <span class="text-success">+</span></label>\
    <div class="input-group">\
        <input type="text" class="form-control" name="survey_'+nameField+'_email[]" placeholder="Email do '+placeholder+'">\
        <span  class="input-group-btn">\
            <a href="#" class="btn btn-primary '+nameRemove+' " title="Remover este locador" id="remove_' + nextindex + '">\
          <i class="fa fa-minus-circle"></i></a>\
        </span>\
    </div>\
  </div>');

  }
}//FIM ADDUSERSER

function deleteUserSurvey(id_user , id_survey)
{

  new PNotify({
    title: 'Excluir Usuário',
    text: 'Deseja realmente excluir esse usuário?',
    styling: 'fontawesome',       
    type: 'error',       
    icon: 'fa fa-check',
    hide: false,
    animation: 'fade',
    animate_speed: "slow",
    confirm: {
      confirm: true,
      buttons: [{
            text: 'Sim',
            addClass: 'btn-default pull-left',
            click: function(notice) {
                $.ajax({
                url: domain_complet + '/vistoria/delete-user',
                type: 'POST',
                dataType: 'json',
                data: {id: id_user, relation_survey_user_id_user: id_survey},
                success: function(data){       
                  new PNotify({
                      title: 'Sucesso!',
                      text: 'Usuário Excluído com sucesso',
                      type: 'success',
                      styling: 'fontawesome',  
                      icon: 'fa fa-check',
                      animation: 'fade',
                      delay: 5000      
                  });
                   window.location.replace(domain_complet+'/vistoria/'+btoa(id_survey)+'/editar/Editar-Vistoria/acao');
                }
              });
            }
        }, {
            text: 'Não',
            click: function(notice) {
                 notice.remove();
            }
        }]
    },
    buttons: {
      closer: false,
      sticker: false
    },
    history: {
      history: false
    }
  }).get().on('pnotify.confirm', function() {

    

  }).on('pnotify.cancel', function() {
    alert('Oh ok. Chicken, I see.');
  });


  
}