
$(document).ready(function () {
    var _language;
    console.log(domain_complet + 'site/office');
    console.log(Admin.baseUrl());
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
            { data: 'teamSites_office', name: 'teamSites_office' },
            { data: 'action', name: 'action', orderable: false, searchable: false }]
    });

    $('#modalEditTeam').on('show.bs.modal', function (event) {
        var target = $(event.relatedTarget) // Button that triggered the modal
        var id = target.data('id') // Extract info from data-* attributes
        $(".teamSites_name").val(target.data('name'));
        $(".teamSites_phoneOne").val(target.data('phone'));
        $(".teamSites_office").val(target.data('office'));
        $(".teamSites_text").val(target.data('text'));
        $(".teamSites_linkedin").val(target.data('linkedin'));
        console.log(Admin.baseUrl()+'/images/team/'+target.data('photo'));
        $("#thumbnailPhoto").attr('src', Admin.baseUrl()+'/images/team/'+target.data('photo'));
        $("#formAlterTeam").attr('action', Admin.baseUrl()+'/site/alterar/'+target.data('id'));
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        // var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        // modal.find('.modal-body input').val(recipient)
      })
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