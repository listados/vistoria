webpackJsonp([2],{

/***/ 10:
/***/ (function(module, exports) {

$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
});

$(function () {

    $('#table-proposal-pf').DataTable({
        processing: true,
        serverSide: true,
        ajax: domain_complet + '/escolha-azul/getProposalPF',
        columns: [{ data: 'proposal_id', name: 'proposal_id' }, { data: 'proposal_completed', name: 'proposal_completed' }, { data: 'proposal_name', name: 'proposal_name' }, { data: 'proposal_id_user', name: 'proposal_id_user' }, { data: 'proposal_email', name: 'proposal_email' }, { data: 'proposal_status', name: 'proposal_status' }, { data: 'action', name: 'action', orderable: false, searchable: false }]
    });
});

/***/ }),

/***/ 9:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(10);


/***/ })

},[9]);