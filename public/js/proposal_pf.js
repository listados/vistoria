webpackJsonp([2],{

/***/ 280:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(281);


/***/ }),

/***/ 281:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    getTableProposalPF();
    $('#selectAtendentModal').change(function (e) {
        e.preventDefault();
        // $("#inputIdProposalPf").val($('#selectAtendentModal').val());   
    });
    $('#modal_alter_functionary').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var idProposal = button.data('id'); // Extract info from data-* attributes
        $("#inputIdProposalPf").val(idProposal);
    });
});

$(function () {

    $("#alterar_atendente_proposta").click(function (e) {
        e.preventDefault();
        var idProposal = $("#inputIdProposalPf").val();
        var dataProposal = { proposal_id_user: $('#selectAtendentModal').val() };
        $.ajax({
            type: "PATCH",
            url: domain_complet + "api/escolha-azul/update/" + idProposal,
            data: dataProposal,
            dataType: "json",
            success: function success(response) {
                console.log({ response: response });
                $('#table-proposal-pf').DataTable().clear().destroy();
                getTableProposalPF();
            }
        });
    });
});

function getTableProposalPF() {
    $('#table-proposal-pf').DataTable({
        processing: true,
        serverSide: true,
        ajax: domain_complet + '/escolha-azul/getProposalPF',
        columns: [{ data: 'proposal_id', name: 'proposal_id' }, { data: 'proposal_completed', name: 'proposal_completed' }, { data: 'proposal_name', name: 'proposal_name' }, { data: 'proposal_id_user', name: 'proposal_id_user' }, { data: 'proposal_email', name: 'proposal_email' }, { data: 'proposal_status', name: 'proposal_status' }, { data: 'action', name: 'action', orderable: false, searchable: false }]
    });
}

/***/ })

},[280]);