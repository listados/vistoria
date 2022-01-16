
$(document).ready(function () {
    var _language;
    console.log(domain_complet + 'site/office/Gestor');
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
               window.location.replace('http://localhost:4000/site/equipe#');
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

function showModalStatus(status, id) {
    //STATUS 1 = ATIVO; 0 DESATIVADO
    if(status == 1) {
        statusInfo = "Desativar Funcionário";
        textStatus = "Deseja realmente DESATIVAR esse(a) funcionário(a)?";
        obsStatus = "Esse funcionário não será excluso do banco de dados, porém, não irá mais aparecer no site na página do site.";
        teamSites_status = 0;
    }else{
        statusInfo = "Ativar Funcionário";
        textStatus = "Deseja realmente ATIVAR esse(a) funcionário(a)?";
        obsStatus = "Esse funcionário será ativo e por isso ele será mostrado no site"
        teamSites_status = 1;
    }
    $("#statusInfo").html(statusInfo);
    $("#textStatus").html(textStatus);
    $("#obsStatus").html(obsStatus);
    $("#idTeamSites").val(id);
    $("#teamSites_status").val(teamSites_status);
    $('#modalAlterStatus').modal('show');
}

$("#alterStatusTeam").click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "put",
        url: domain_complet + "api/team/"+$("#idTeamSites").val(),
        data: {teamSites_status : $("#teamSites_status").val()},
        dataType: "json",
        success: function (response) {
            $('#modalAlterStatus').modal('hide');
            Swal.fire({
                title: 'Sucesso!',
                text: 'Status alterado com sucesso',
                icon: 'success'
            })
            $("#tabelaComercial").DataTable().ajax.reload();
            setTimeout(() => {
                Swal.close();
            }, 2000);
            
        }
    });
});