PNotify.prototype.options.styling = "fontawesome";
$('#table-ambience').DataTable({
    processing: true,
    serverSide: true,
    bLengthChange: false,//remove a escolha das entradas
    ajax: domain_complet + 'admin/configuracao/get-ambiente',
    columns: [                
        { data: 'ambience_name' , name: 'ambience_name'},
        { data: 'action', name: 'action', orderable: false, searchable: false }
       
    ]
});
function alterAmbience(id)
{
    var id_ambience = id;
    new PNotify({
    title: 'Alterar Ambiente',
    text: 'Digite o novo nome do ambience',
    icon: 'fa fa-info-circle',
    hide: false,
    type: 'info',
    confirm: {
    prompt: true,
    confirm: true,
    buttons: [{
        text: 'Alterar',
        addClass: 'btn btn-default',
        click: function(notice, val) {
            $.ajax({
                type: "put",
                url: domain_complet+'admin/alter-ambience',
                data: {ambience_id: id_ambience, ambience_name: val},
                dataType: "json",
                success: function (response) {                        
                    successNotify('Ambiente Alterado');
                    reloadTable('table-ambience');
                    notice.remove();
                }
            });
        }
    },
    {
        text: 'Cancelar',
        addClass: 'btn',
        click: function(notice, val) {
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
    addClass: 'stack-modal',
    stack: {'dir1': 'down','dir2':'right','modal':true},
    })
}

$("#btn-save-ambience").click(function(){
   
    $.ajax({
        type: "post",
        url: domain_complet +'admin/ambience',
        data: {ambience_name: $("#ambience_name").val()},
        dataType: "json",
        success: function (response) {
            successNotify('AMBIENTE CADASTRADO COM SUCESSO');
            reloadTable('table-ambience');
        }
    });
});