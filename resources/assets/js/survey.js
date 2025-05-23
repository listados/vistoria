
$(document).ready(function () {

  $("#send_file_upload").hide();
  PNotify.prototype.options.styling = "bootstrap3";
  PNotify.prototype.options.styling = "fontawesome";
  $("#load_print_survey").hide();
  $('[data-toggle="tooltip"]').tooltip();
  $("#table-survey").DataTable({
    processing: true,
    //serverSide: true,
    iDisplayLength: 50,
    language: {
      rows: "%d linhas selecionada",
      infoEmpty: "Sem registro para mostrar",
      infoFiltered: " - Filtrando para _MAX_ registros",
      infoEmpty: 'Mostrando 0 de 0 para 0 registros',
      lengthMenu: "Mostrando _MENU_ registro",
      loadingRecords: "Lendo...",
      processing: "Processando...",
      search: "Pesquisar por:",
      zeroRecords: "Nenhum registro encontrado",
      paginate: {
        first: "Primeiro",
        last: "Último",
        next: "Próximo",
        previous: "Anterior"
      }
    },
    ajax: domain_complet + '/vistoria/all-survey',
    order: [[0, "desc"]],
    columns: [
      { data: 'survey_code', name: 'survey_code' },
      { data: 'survey_address_immobile', name: 'survey_address_immobile' },
      { data: 'survey_date_register', name: 'survey_date_register' },
      { data: 'survey_type_immobile', name: 'survey_type_immobile' },
      { data: 'survey_inspetor_name', name: 'survey_inspetor_name' },
      { data: 'survey_status', name: 'survey_status' },
      { data: 'action', name: 'action', orderable: false, searchable: false }
    ],

  });

  //EDITOR DE CONTEÚDO
  CKEDITOR.replace('survey_general_aspects');
  CKEDITOR.replace('survey_reservation');
  CKEDITOR.replace('survey_provisions');
  CKEDITOR.replace('survey_keys');
  /*
Link exemplo : http://makitweb.com/dynamically-add-and-remove-element-with-jquery/
@autor: Excellence Soft - Junior Oliveira
Para locador nome do campo é: locator
Para Locatário nome do campo é: occupant
Para Fiador o nome do campo é: guarantor

*/
  // Removendo elemento
  $('.container').on('click', '.remove', function () {
    var id = this.id;
    var split_id = id.split("_");
    var deleteindex = split_id[1];
    // Remove <div> with id
    $("#div_" + deleteindex).remove();
  });

  $('.containerLocatario').on('click', '.removeLocatario', function () {
    var id = this.id;
    var split_id = id.split("_");
    var deleteindex = split_id[1];
    // Remove <div> with id
    $("#divLocatario_" + deleteindex).remove();
  });
  $('.containerFiador').on('click', '.removeFiador', function () {
    var id = this.id;
    var split_id = id.split("_");
    var deleteindex = split_id[1];
    // Remove <div> with id
    $("#divFiador_" + deleteindex).remove();
  });

});
$(function () {
  //PARA UPLOAD DE IMAGENS
  $("#ambience_upload").change(function () {
    if ($("#ambience_upload").val() != "") {
      $("#send_file_upload").show();
    } else {
      $("#send_file_upload").hide();
    }
  });
  //FIM UPLOAD DE IMAGENS
  $('[data-toggle="popover"]').popover()
  $('[data-toggle="tooltip"]').tooltip();
  //SALVAR VISTORIA
  $("#save_button").click(function (event) {
    $("#load-modal").modal('show');
    //ATRIBUINDO UM RASCUNHO
    $("#survey_status").val("Rascunho");
    //FORÇANDO A ATUALIZAR OS VALORES DO CKEDITOR
    for (instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }
    console.log($("#survey_status"));
    $.ajax({
      url: domain_complet + 'vistoria/update',
      type: "post",
      dataType: "JSON",
      data: $("#form_survey").serialize(),
      success: function (data) {
        $("#load-modal").modal('show');
        $("#gif-load-modal").hide();
        $("#label-title-load-modal").html('Rascunho salvo com sucesso');
        $("#success-load-modal").append('<i class="fa fa-check-circle fa-3x"></i>');
        $("#success-load-modal").addClass('text-success');
        $("#success-load-modal").show();
        //ADICIONANDO BOTÃO DE CONTINUAR NA VISTORIA OU SAIR PARA PÁGINA INICIAL
        $("#footer_load_modal").append('<div class="modal-footer">\
                <a href="'+ domain_complet + '/vistoria" class="btn btn-default">Sair da Vistoria</a>\
                <a href="'+ domain_complet + '/vistoria/' + id_survey_enc + '/editar/Editar-Vistoria/acao" class="btn btn-primary">Continuar na vistoria</a>\
                </div>');
      }
    })
      .done(function () {
        console.log("success");
      })
      .fail(function () {
        console.log("error");
      })
      .always(function () {
        console.log("complete");
      });

  });

  $(".click_print_survey").click(function () {
    $("#load_print_survey").show();
  });

  function getImageAmbience() {
    route = domain_complet + '/dist/img/upload/vistoria/';
    $.get(domain_complet + "/files_ambience/show/" + $("#id_survey_ambience").val(), function (data) {
      /*optional stuff to do after success */
      $.each(data, function (index, val) {
        /* iterate through array or object */
        // console.log('index = ' + index + ' val = ' + val.files_ambience_description_file);
        $('#table-ambience-surveys').append('<tbody>' +
          '<tr>' +
          '<td>' + val.ambience_name + '</td>' +
          '<td style="width: 50%;"><a href="#" class="thumbnail">' +
          '<img src="' + route + val.files_ambience_description_file + '" alt="' + val.files_ambience_description_file + '" width="50%" height="50%">' +
          '</a></td>' +
          '<td> <input type="checkbox" name="surveyAlter[]" title="Alterar Ambiente" value="' + val.files_ambience_id + '"></td>' +
          '<td><input type="checkbox" name="surveyDelete[]" title="Excluir Ambiente" value="' + val.files_ambience_id + '"></td>' +
          '</tr>' +
          '</tbody>')
      });

    });
  }

  getImageAmbience();

});

$(document).ready(function () {


  $("#completed_button").click(function (t) {
    showMessageLoad();
    $("#survey_status").val("Finalizada");
    route_complet_survey = window.location.origin + project_survey;
    form_complete_survey = $("#form_survey").serialize();
    $.ajax({
      url: route_complet_survey + "/vistoria/update",
      type: "POST",
      dataType: "JSON",
      data: form_complete_survey,
      success: function (t) {
        new PNotify({
          title: 'Finalizado',
          text: 'Vistoria Finalizada com sucesso',
          icon: 'fa fa-check-circle',
          type: 'success',
          hide: false,
          confirm: {
            confirm: true,
            buttons: [{
              text: 'Ok, ir para lista de vistoria',
              addClass: 'btn-default pull-right',
              click: function (notice) {
                //ENVIO DE FORMULÁRIO
                window.location.replace(route_complet_survey + 'vistoria');

              }

            }, null]
          },
          buttons: {
            closer: false,
            sticker: false
          },
          history: {
            history: false
          },
          addclass: 'stack-modal',
          stack: { 'dir1': 'down', 'dir2': 'right', 'modal': true }
        });
      },
      error: function (e) {
        $.each(e, function (e, t) { })
      }
    })
  });

});

$("#sendAlterAmbience").click(function (event) {
  /* Act on the event */
  showMessageLoad();

});

$("#deleteAmbience").click(function (event) {
  new PNotify({
    title: 'Excluir Imagem',
    text: 'Você realmente deseja excluir essa imagem?',
    icon: 'fa fa-question-circle',
    hide: false,
    confirm: {
      confirm: true,
      buttons: [{
        text: 'Excluir',
        addClass: 'btn-default pull-left',
        click: function (notice) {
          //ENVIO DE FORMULÁRIO
          $("#form_alter_delete_ambience").submit();
          //MOSTRANDO LOAD
          $("#load-modal").modal({ show: true });
          // //REDIRECIONANDO APOS 2 SEGUNDOS
          // setTimeout(function(){ 
          //   window.location.replace(domain_complet + '/alter-delete-ambience/');
          // }, 2000);
        }

      }, {
        text: 'Cancelar',
        click: function (notice) {
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
    },
    addclass: 'stack-modal',
    stack: { 'dir1': 'down', 'dir2': 'right', 'modal': true }
  });
});

function repli(id_survey){
  (new PNotify({
    title: 'Replicar Vistoria',
    text: 'Deseja realmente replicar a vistoria '+id_survey+' ?',
    styling: 'fontawesome',       
    type: 'info',       
    icon: 'fa fa-question-circle',
    hide: false,
    
    confirm: {
        confirm: true,
        buttons: [{
            text: 'Replicar',
            addClass: 'btn-default pull-left',
            click: function(notice) {
            	//MOSTRANDO LOAD
            	$("#load-modal").modal({show:true});
            	//REDIRECIONANDO APOS 2 SEGUNDOS
            	setTimeout(function(){ 
            		window.location.replace(domain_complet + '/vistoria/replicar/'+btoa(id_survey) );
            	}, 2000);
            }
           
        }, {
            text: 'Cancelar',
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
	})).get().on('pnotify.confirm', function() {
	    alert('Ok, cool.');
	}).on('pnotify.cancel', function() {
	    alert('Oh ok. Chicken, I see.');
	});
}