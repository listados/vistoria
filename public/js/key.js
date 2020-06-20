$(document).ready(function () {

  $("#hide_value_delivery").hide();
  $("#confirmreserved").hide();

  //LOAD NO MODAL DA RESERVA QUANDO PESQUISA O CLIENTE
  $("#load_find_client").hide();
  //t
  $("#type_manutencao").hide();
  $("#value_delivery").change(function () {
    /* Act on the event */

    if ($(this).find(":selected").val() != 1) {
      $("#hide_value_delivery").show();
    } else {
      $("#hide_value_delivery").hide();
    }
  });//FIM change
  //CONFIGURAÇÃO PARA DATA BRASILEIRA
  jQuery(function ($) {
    $.datepicker.regional['pt-BR'] = {
      closeText: 'Fechar',
      prevText: '&#x3c;Anterior',
      nextText: 'Pr&oacute;ximo&#x3e;',
      currentText: 'Hoje',
      monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
        'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
      dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado'],
      dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
      dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
      weekHeader: 'Sm',
      dateFormat: 'dd/mm/yy',
      firstDay: 0,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
  });
  moment.locale('pt-BR');

});

$('#key_control').DataTable({
  processing: true,
  serverSide: true,

  ajax: domain_complet + 'chave/show',
  columns: [{
    data: 'keys_code',
    name: 'keys_code'
  },
  {
    data: 'keys_cod_immobile',
    name: 'keys_cod_immobile'
  },
  {
    data: 'keys_status',
    name: 'keys_status'
  },

  {
    data: 'action',
    name: 'action',
    orderable: false,
    searchable: false
  }

  ],
  "language": {
    "lengthMenu": "Exibir _MENU_ chaves por página",
    "emptyTable": "Não existe nenhum tour criado",
    "infoEmpty": "Mostrando 0 Registros",
    "info": "Mostrando _PAGE_ páginas de _PAGES_",
    "searchPlaceholder": "Digite sua pesquisa",
    "search": "Pesquisar: ",
    "show": "Mostrar",
    "paginate": {
      "previous": "Anterior",
      "next": "Próxima",
      "last": "Última",
      "first": "Primeira",
      "loadingRecords": "Aguarde - lendo dados..."
    }
  },
  "iDisplayLength": 50,
  "search": {
    "caseInsensitive": false
  }

});
//PARA AS NOTIFICAÇÕES DE SUCESSO
function pnotify_success(text_notify){
  new PNotify({
    title: 'Sucesso',
    text: text_notify,
    styling: 'fontawesome',
    type: 'success',
    icon: 'fa fa-check',
    animation: 'fade',
    delay: 5000,
    animate_speed: "slow",
    animate: {
      animate: true,
      in_class: 'slideInDown',
      out_class: 'slideOutUp'
  }
  });
}//fim pnotify_success

$("#save_update_code_key").click(function (data) {
  if ($("#keys_cod_immobile").val() == "") {
    new PNotify({
      title: 'Ops!',
      text: 'Precisa ter o campo do Imóvel preenchido',
      styling: 'fontawesome',
      type: 'info',
      icon: 'fa fa-info-circle',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
  } else {
    $.ajax({
      url: domain_complet + 'chave/update-code-key',
      type: 'POST',
      dataType: 'JSON',
      data: $('#form_update_code_key').serializeJSON(),
      success: function (data) {
        new PNotify({
          title: 'Sucesso',
          text: 'Código alterado com sucesso',
          styling: 'fontawesome',
          type: 'success',
          icon: 'fa fa-check',
          animation: 'fade',
          delay: 5000,
          animate_speed: "slow"
        });
        reloadTable('key_control');
        $("#update_code_key").modal('hide');
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
  };
});

//EXCLUIR CHAVE

//REEGISTRAR RESERVA DE CHAVE
$("#save_key").click(function (event) {
  /* create 2017-08-04 by excellence soft */
  if ($("#keys_code_immobile").val() == "") {
    new PNotify({
      title: 'Ops!',
      text: 'O Campo do código da Chave é obrigatório',
      styling: 'fontawesome',
      type: 'info',
      icon: 'fa fa-info-circle',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
    return false;
  }

  $.ajax({
    url: domain_complet + 'chave/store',
    type: 'POST',
    dataType: 'json',
    data: $('#form_save_key').serializeJSON(),
    success: function () {
      new PNotify({
        title: 'Sucesso',
        text: 'Chave Cadastrada com sucesso',
        styling: 'fontawesome',
        type: 'success',
        icon: 'fa fa-check',
        animation: 'fade',
        delay: 5000,
        animate_speed: "slow"
      });
      $("#form_save_key")[0].reset();
      reloadTable('key_control');
    }
  })
    .done(function () {
      console.log("success");
    })
    .fail(function () {
      new PNotify({
        title: 'Erro',
        text: 'Ocorreu um erro, tente novamente',
        styling: 'fontawesome',
        type: 'error',
        icon: 'fa fa-info-circle',
        animation: 'fade',
        delay: 5000,
        animate_speed: "slow"
      });
    })
    .always(function () {
      console.log("complete");
    });

});
//chamada do controller
function modalReserveKey(code_immobile, type) {

  $("#reserveKey").modal('show');
  $("#keys_type").val(type);
  if (type == 'manutencao') {
    $("#type_manutencao").show();
  }
  $.get(domain_complet + '/chave/get/' + code_immobile, function (data) {
    /*optional stuff to do after success */
    $("#control_keys_ref_immobile").val(data[0].keys_cod_immobile);
    $("#confirm_reserves_id").val(data[0].keys_cod_immobile);
    $.each(data, function (index, keys) {
      console.log(keys.keys_code);
      /* iterate through array or object */
      if (keys.keys_status == "Disponível" || keys.keys_status == "Reservado") {
        $("#selectCodeKey").append('<option  value="' + keys.keys_code + '">' + keys.keys_code + '</option>');
      }
    });
  });
}


function dataFormatada(d) {
  var data = new Date(d),
    dia = data.getDate(),
    mes = data.getMonth() + 1,
    ano = data.getFullYear(),
    hora = data.getHours(),
    minutos = data.getMinutes(),
    segundos = data.getSeconds();
  return [dia, mes, ano].join('/') + ' ' + [hora, minutos, segundos].join(':');
}

$(function () {
  //MUDA O BOTÃO DE ACORDO COM A ESCOLHA SE É VISITA   
  $("#control_keys_finality").change(function () {

    if ($("#control_keys_finality").val() == 'visita') {
      // $("#reserveKeySave").html("");
      // $("#reserveKeySave").append('<i class="fa fa-print"> </i> Salvar Visita');
      $("#confirmvisited").show();//CONFIRMAR VISITA
      $("#confirmreserved").hide();//CONFIRMAR RESERVA

    } else {
      $("#confirmreserved").show();//CONFIRMAR VISITA
      $("#confirmvisited").hide();//CONFIRMAR RESERVA
      // $("#reserveKeySave").html("");
      // $("#reserveKeySave").append('<i class="fa fa-key"> </i> Reservar Chaves');
    }
    if ($("#control_keys_finality").val() == 'manutencao') {
      $('#type_manutencao').show();
    } else {
      $('#type_manutencao').hide();
    }
  });
});
function resetFileldsInfo() {
  $("#result").html('');
  $("#title_devolution").html('Não tem informação de devolução');
  $("#ref_imovel").html('');
  $("#cod_key").html('');
  $("#key_status").html('');
  $("#retired_by").html('');
  $("#date_retired").html('');
  $("#date_devolution").html('');
  $("#control_keys_id").val('');
  $("#keys_type_info").html('');
}

//REMOVANDO OPÇÃO DAS CHAVES
function closeModalReserve() {
  $("#selectCodeKey option").remove();
  $("#type_manutencao").hide();
}

function validFields() {
  //VERIFICAÇÃO PARA OS CAMPOS DO MODAL DE RESERVA DE CHAVES
  if ($("#selectCodeKey").val() === "") {
    new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preencher o código da Chave',
      styling: 'bootstrap3',
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
    return false;
  }

  if ($("#keys_visitor_phone_two").val() === "") {
    new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preencher o número do telefone celular',
      styling: 'bootstrap3',
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
    return false;
  }

  if ($("#reserve_keys_date_devolution").val() === "") {
    new PNotify({
      title: 'Ops! Ocorreu um erro',
      text: 'Por favor, preencher a data de devolução',
      styling: 'bootstrap3',
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
    return false;
  }


  return true;

}

function verifyclient() {


  if ($("#keys_visitor_phone_two").val().length >= 14) {
    //LOAD NO MODAL DA RESERVA QUANDO PESQUISA O CLIENTE
    $("#load_find_client").show();
    $.ajax({
      url: domain_complet + 'chave/verify-phone-client',
      type: 'POST',
      dataType: 'JSON',
      data: {keys_visitor_phone_two: $("#keys_visitor_phone_two").val()},
      success: function(data){
       
      $("#load_find_client").hide();
        //SE O OBJETO NÃO FOR VAZIO
        if(jQuery.isEmptyObject(data) == false)
        {
          //LIBERANDO OS CAMPOS PARA EDIÇÃO SE PRECISAR
          $("#control_keys_cpf").removeAttr( "disabled" );
          $("#control_keys_visitor_name").removeAttr( "disabled" );
          $("#clients_email").removeAttr( "disabled" );
          $("#keys_visitor_phone_one").removeAttr( "disabled" );

          $("#control_keys_cpf").val(data.client_cpf);
          $("#control_keys_visitor_name").val(data.client_name);
          $("#clients_email").val(data.client_email);
          $("#keys_visitor_phone_one").val(data.phone_fixed);

        }else{
        $("#control_keys_cpf").removeAttr( "disabled" );
        $("#control_keys_visitor_name").removeAttr( "disabled" );
        $("#clients_email").removeAttr( "disabled" );
        $("#keys_visitor_phone_one").removeAttr( "disabled" );
      }
    }
    });

  } else if ($("#keys_visitor_phone_two").val().length < 14) {
    $("#load_find_client").removeClass('text-primary');
    $("#load_find_client").addClass('text-danger');
    $("#info_load_find_client").html('Número telefônico incompleto');
    //$("#load_find_client").show();
  } else {
    $("#load_find_client").load();
  }

}

//CALENDÁRIO PARA O CAMPO DE DEVOLUÇÃO
$("#reserve_keys_date_devolution").datetimepicker({
  minDate: 0,
  maxDate: "+1M +10D"
});

$("#reserveKeySave").click(function () {

  saveReserve();

});

function saveReserve() {
  valida = validFields();

  if (valida === true) {
    $.ajax({
      url: domain_complet + 'chave/create-reserve',
      type: 'POST',
      dataType: 'JSON',
      data: $('#formReserveKey').serializeJSON(),
      success: function (data) {
        console.log(data);
        reloadTable('key_control');

        if (data.reserve_finality == 'reserva') {
          pnotify_success('Chave reservada com sucesso');
          $("#reserveKey").modal('hide');
        }

        if (data.reserve_finality == 'visita') {
          pnotify_success('Chave reservada com sucesso para uma VISITA');
          $("#reserveKey").modal('hide');
          $("#confirm_reserves_id").val(data.reserves_id);
          $("#confSaveKey").modal('show');
        }
      }
    });
  }

}

$("#search_key_immobile").click(function(){
  
  // $("#code_key_immobile").attr('disabled' , 'true');
  val = $('#code_key_immobile').val();
   //APAGANDO QUALQUER REQUISIÇÃO
   $('#history_key_immobile').DataTable().destroy();
   $('#history_key_immobile').DataTable({
     processing: true,
       //serverSide: true,
       ajax: {
         url: domain_complet + 'chave/search',
         type: 'POST',
         dataType: 'json',
         data: {code_key_immobile: val}
       },
       columns: [
       {data: 'reserves_code_key', name: 'reserves_code_key'},
       {data: 'reserves_ref_immobile', name: 'reserves_ref_immobile'},
       {data: 'reserves_date_exit', name: 'reserves_date_exit'},
       {data: 'reserves_date_devolution', name: 'reserves_date_devolution'},
       {data: 'reserves_id_client' , name: 'reserves_id_client'},
       {data: 'reserves_status' , name: 'reserves_status'},
       {data: 'action', name: 'action', orderable: false, searchable: false}
       ],
       "searching": false,
       "language": {
         "info": "Mostrando pagina _PAGE_ de _PAGES_",
         "show": "Mostrar",
       },
       "iDisplayLength": 50,
       "pagingType": "full_numbers",
       "search": {
        "caseInsensitive": false
      },
      "order": [[ 2, "desc" ]]
    });        
});

//CHAMANDO O MODAL DE CONFIRMAÇÃO
function modal_confirm_reserve(id, code)
{
  $("#confirm_reserves_id").val(id);
  $("#confSaveKey").modal('show');
}
function modal_update_key(id, code_key)
{
  console.log(code_key);
  $("#info_update_code_key").html('Código atual é: <small class="label label-info">'+code_key+'</smal>');
  $("#update_keys_code").val(id);
  $("#update_code_key").modal('show');
}

//RECEBER AS CHAVES - DEVOLUÇÃO
function modal_edit_key(id_reserve) {

  $.get(domain_complet + '/reserva/show/' + id_reserve , function(data) {

    if(data == ""){
      $("#save_confirmed_key").hide();
    }else{
      $("#save_confirmed_key").show(); 
    }
  
    //$("#result").html(data[0]['control_keys_type_immobile']);
    $("#title_devolution").html('Devolução de chaves para o imóvel ' + data[0]['reserves_ref_immobile'] + ' - COD. CHAVE: ' + data[0]['reserves_code_key']);
    $("#ref_imovel").html(data[0]['reserves_ref_immobile']);
    $("#cod_key").html(data[0]['reserves_code_key']);
    $("#key_status").html(data[0]['keys_status']);
    $("#retired_by").html(data[0]['nick']);
    $("#date_retired").html(moment(data[0]['reserves_date_exit']).startOf('day').fromNow());
    $("#date_devolution").html(moment(data[0]['reserves_date_devolution']).format('DD/MMM/YYYY h:mm:ss'));
    $("#control_keys_id").val(data[0]['reserves_id_key']);
    $("#keys_type_info").html(data[0]['reserve_finality']);
    //console.log(moment( data[0]['reserves_date_exit'] , "MM-DD-YYYY") );
  });
  $('#id_key').val(id_reserve);
  $('#modal_edit_key').modal('show');
}

$("#save_confirmed_key").click(function(event) {
  /* Act on the event */

  $.ajax({
    url: domain_complet + 'chave/update/'+$("#id_key").val(),
    type: 'PUT',
    dataType: 'json',
    data: {keys_status: 'Disponível' , keys_devolution: 1},
    success: function(data){
      console.log("recebido" + data.title);
      new PNotify({
        title: data.title,
        text: data.text,
        styling: data.styling,       
        type: data.type,
        icon: data.icon,
        animation: data.animation,
        delay: data.delay,
        animate_speed: data.animate_speed
      });
      //PREENCHENDO O VALOR DO COD OD IMOVEL NO CAMPO DO NODAL, PARA SER REGISTRADO A AVALIAÇÃO
      $("#evaluations_id_reserve").attr('value', data.reserves_id);
      $("#confirm_receipt").modal('show');
      $("#id_key_confirm").val($("#id_key").val());
      reloadTable('key_control');
    }

  }) .fail(function() {
    new PNotify({
      title: 'Erro',
      text: 'Ocorreu um erro, tente novamente',
      styling: 'bootstrap3',       
      type: 'error',
      icon: 'true',
      animation: 'fade',
      delay: 5000,
      animate_speed: "slow"
    });
  })

});

