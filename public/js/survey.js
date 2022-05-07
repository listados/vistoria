
$(document).ready(function () {
  var _language;

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
          infoEmpty:      "Sem registro para mostrar",
          infoFiltered:   " - Filtrando para _MAX_ registros",
          infoEmpty:      'Mostrando 0 de 0 para 0 registros',
          lengthMenu:     "Mostrando _MENU_ registro",
          loadingRecords: "Lendo...",
          processing:     "Processando...",
          search:         "Pesquisar por:",
          zeroRecords:    "Nenhum registro encontrado",
          paginate: {
              first:      "Primeiro",
              last:       "Último",
              next:       "Próximo",
              previous:   "Anterior"
          }
    },
    ajax: domain_complet + '/vistoria/all-survey',
    order: [[0, "desc"]],
    columns: [{ data: 'survey_code', name: 'survey_code' }, { data: 'survey_address_immobile', name: 'survey_address_immobile' }, { data: 'survey_date_register', name: 'survey_date_register' }, { data: 'survey_type_immobile', name: 'survey_type_immobile' }, { data: 'survey_inspetor_name', name: 'survey_inspetor_name' }, { data: 'survey_status', name: 'survey_status' }, { data: 'action', name: 'action', orderable: false, searchable: false }]

  });

  //EDITOR DE CONTEÚDO
  //CKEDITOR.replace('survey_general_aspects');
  $("#editor_aspect").richText({
    bold:true,
    italic:true,
    underline:true,
    imageUpload:false,
    fileUpload:true,
    useParagraph:false,
    removeStyles:true,
    code:false

  });
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

function reloadTable()
{
	$("#table-survey").DataTable().ajax.reload();
}

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
  $('[data-toggle="popover"]').popover();
  $('[data-toggle="tooltip"]').tooltip();
  //SALVAR VISTORIA
  $("#save_button").click(function (event) {
   //$("#load-modal").modal('show');
    //ATRIBUINDO UM RASCUNHO
    $("#survey_status").val("Rascunho");
    //FORÇANDO A ATUALIZAR OS VALORES DO CKEDITOR
    for (instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }
    $.ajax({
      url: domain_complet + '/vistoria/update',
      type: "post",
      dataType: "JSON",
      data: $("#form_survey").serialize(),
      success: function success(data) {
        $("#load-modal").modal('show');
        $("#gif-load-modal").hide();
        $("#label-title-load-modal").html('Rascunho salvo com sucesso');
        $("#success-load-modal").append('<i class="fa fa-check-circle fa-3x"></i>');
        $("#success-load-modal").addClass('text-success');
        $("#success-load-modal").show();
        //ADICIONANDO BOTÃO DE CONTINUAR NA VISTORIA OU SAIR PARA PÁGINA INICIAL
        $("#footer_load_modal").append('<div class="modal-footer">\
                <a href="' + domain_complet + '/vistoria" class="btn btn-default">Sair da Vistoria</a>\
                <a href="' + domain_complet + '/vistoria/' + id_survey_enc + '/editar/Editar-Vistoria/acao" class="btn btn-primary">Continuar na vistoria</a>\
                </div>');
      },
      error: function (data, status, error){
        console.log('data' , data);
        console.log('status' , status);
        console.log('error' , data.responseJSON.mensagem);
        errorNotify(data.responseJSON.mensagem);
       
      }
    }).done(function () {
      console.log("success");
    }).fail(function () {
      console.log("Falhou");
    }).always(function () {
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
        $('#table-ambience-survey').append('<tbody>' + '<tr>' + '<td>' + val.ambience_name + '</td>' + '<td style="width: 50%;"><a href="#" class="thumbnail">' + '<img src="' + route + val.files_ambience_description_file + '" alt="' + val.files_ambience_description_file + '" width="50%" height="50%">' + '</a></td>' + '<td> <input type="checkbox" name="surveyAlter[]" title="Alterar Ambiente" value="' + val.files_ambience_id + '"></td>' + '<td><input type="checkbox" name="surveyDelete[]" title="Excluir Ambiente" value="' + val.files_ambience_id + '"></td>' + '</tr>' + '</tbody>');
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
      success: function success(t) {
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
              click: function click(notice) {
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
      error: function error(e) {
        $.each(e, function (e, t) {});
      }
    });
  });
  
  //ocultando div no modal de pesquisa da vistoria
  $("#divInfoType").hide();
  $("#inputInfoType").hide();
  $("#divInfoPeriod").hide();
  $("#divInfoAddress").hide();
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
        click: function click(notice) {
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
        click: function click(notice) {
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
//PARA ALTERAR O AMBIENCE NA PÁGINA DE DOWNLOAD
$("#btn_alter_order_ambience").click(function(){
  list_id_ambience = "";
  $('#list-group > li').each(function (index, element) {
    // element == this
    list_id_ambience = list_id_ambience + element.value + ",";
  });
  $.ajax({
    type: "POST",
    url: domain_complet + "/vistoria/orderBy",
    data: { order_ambience_survey_list_order: list_id_ambience, order_ambience_survey_id_survey: $("#id_survey_ambience").val()} ,
    dataType: "json",
    success: function (response) {
      successNotify('Ambiente Alterado');
    },
    error: function(response)
    {
      errorNotify(response.responseJSON.message);
    }
  });
});

$("#btnSearchSurvey").click(function (e) { 
  e.preventDefault();
  form = $("#formSearchSurvey").serialize();
  
  $.ajax({
    type: "post",
    url: domain_complet + 'vistoria/all-survey',
    data: form,
    dataType: "json",
    success: function (response) {
      console.log(response.data);
      var returnData = response.data;
      var table = $('#table-survey').DataTable( {
          paging: false,
          retrieve: true,
          pageLength: 100
      } );
      table.clear();
      table.destroy();
      $('#table-survey').DataTable().ajax.reload(response,true);
      // table = $('#table-survey').DataTable({
      //     processing: true,
      //     serverSide: true,
      //     pageLength: 100,
      //     data: returnData,
      //     columns: [{ data: 'survey_code', name: 'survey_code' }, { data: 'survey_address_immobile', name: 'survey_address_immobile' }, { data: 'survey_date_register', name: 'survey_date_register' }, { data: 'survey_type_immobile', name: 'survey_type_immobile' }, { data: 'survey_inspetor_name', name: 'survey_inspetor_name' }, { data: 'survey_status', name: 'survey_status' }, { data: 'action', name: 'action', orderable: false, searchable: false }]
      // });
      // var table = $('#entry-table').DataTable();
      // table
      //   .order(  [ 0, 'asc' ] )
      //   .draw();
      //table.destroy();
      }
  });
});


$('#TypeImmobile').on('change', function() {
  console.log( this.value );
  $("#divInfoType").show();
  $("#inputInfoType").show();
  switch (this.value) {
    case 'code':
      $("#labelInfoType").text('Código');
      $("#inputInfoType").attr("placeholder", "Código da vistoria");
      $("#divInfoPeriod").hide();
      break;
    case 'type':
      $("#labelInfoType").text('Tipo de imóvel');
      $("#inputInfoType").attr("placeholder", "Escolha o tipo do imóvel");
      $("#divInfoPeriod").hide();
      break;
    case 'status':
      $("#labelInfoType").text('Status de vistoria');
      $("#inputInfoType").attr("placeholder", "Escolha o status da vistoria");
      $("#divInfoPeriod").hide();
      break;
    case 'inspector':
      $("#labelInfoType").text('Vistoriador');
      $("#inputInfoType").attr("placeholder", "Escolha o vistoriador");
      $("#divInfoPeriod").hide();
      break;
    case 'porPeriod':
      $("#labelInfoType").text('Por período');
      $("#divInfoPeriod").show();
      $("#divInfoType").hide();
      $("#inputInfoType").hide();
      $("#divInfoAddress").hide();
      //$("#inputInfoType").attr("placeholder", "Escolha o vistoriador");
      break;
    case 'address':
      $("#labelInfoType").text('Endereço');
      $("#inputInfoType").attr("placeholder", "Digite um trecho ou o endereço completo");
      $("#divInfoPeriod").hide();
      break;
  
    default:
      break;
  }
});