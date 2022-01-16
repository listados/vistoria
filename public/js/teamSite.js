
$(document).ready(function () {
    var _language;
    console.log(domain_complet + 'site/office');
    PNotify.prototype.options.styling = "fontawesome";
    $("#tabelaComercial").DataTable({
        processing: true,
        //serverSide: true,
        iDisplayLength: 50,
        language: (_language = {
            rows: "%d linhas selecionada",
            infoEmpty: "Sem registro para mostrar",
            infoFiltered: " - Filtrando para _MAX_ registros"
        }),
        ajax: domain_complet + '/site/office',
        order: [[0, "desc"]],
        columns: [
            { data: 'teamSites_photo', name: 'teamSites_photo' },
            { data: 'teamSites_name', name: 'teamSites_name' },
            { data: 'teamSites_phoneOne', name: 'teamSites_phoneOne' },
            { data: 'teamSites_linkedin', name: 'teamSites_linkedin' },
            { data: 'teamSites_text', name: 'teamSites_text' },
            { data: 'action', name: 'action', orderable: false, searchable: false }]
    });
});

function deleteTeam(id) {
    new PNotify({
        title: 'Excluir',
        text: 'Esse funcionário será excluido definitivamente. Confirma?',
        icon: 'fa fa-trash',
        type: 'info',
        hide: false,
        confirm: {
          confirm: true,
          buttons: [{
            text: 'Sim',
            addClass: 'btn-default pull-right',
            click: function(notice) {
              //ENVIO DE FORMULÁRIO
              notice.remove();
                $.ajax({
                    type: "delete",
                    url: domain_complet + 'site/delete/'+id,
                    dataType: "json",
                    success: function (response) {
                        $("#tabelaComercial").DataTable().ajax.reload();
                        new PNotify({
                            title: 'Sucesso',
                            text: 'Funcionário excluído com sucesso',
                            icon: 'fa fa-check',
                            type: 'success',
                        });
                        
                    }
                });
               window.location.replace(domain_complet + '/site/equipe#');
            }
           
        }, {
            text: 'Não',
            addClass: 'btn-default pull-left',
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
        },
        addclass: 'stack-modal',
        stack: {'dir1': 'down', 'dir2': 'right', 'modal': true}
      });
}