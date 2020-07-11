webpackJsonp([4],{

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(51);


/***/ }),

/***/ 51:
/***/ (function(module, exports) {

$(document).ready(function () {
  console.log('url js= '.domain_complet);
});

$('#key_control').DataTable({
  processing: true,
  serverSide: true,

  ajax: domain_complet + 'chave/show',
  columns: [{
    data: 'keys_code',
    name: 'keys_code'
  }, {
    data: 'keys_cod_immobile',
    name: 'keys_cod_immobile'
  }, {
    data: 'keys_status',
    name: 'keys_status'
  }, {
    data: 'action',
    name: 'action',
    orderable: false,
    searchable: false
  }],
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

$("#save_update_code_key").click(function (data) {

  $.ajax({
    url: domain_complet + '/update-code-key',
    type: 'POST',
    dataType: 'JSON',
    data: $('#form_update_code_key').serializeJSON(),
    success: function success(data) {
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
  }).done(function () {
    console.log("success");
  }).fail(function () {
    console.log("error");
  }).always(function () {
    console.log("complete");
  });
});

/***/ })

},[50]);