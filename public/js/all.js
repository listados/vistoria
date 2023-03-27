webpackJsonp([5],{

/***/ 282:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(283);


/***/ }),

/***/ 283:
/***/ (function(module, exports) {

/* MODULO VISTORIA. ARQUIVO COM FUNCÕES DE CHAMADA ANTES DO ARQUIVO SURVEY.JS*/
/*ARQUIVO PARA ENVIOs*/
$(document).ready(function () {
    PNotify.prototype.options.styling = "fontawesome";
    $('.dropdown-toggle').dropdown();
});
//RELOAD DO DATATABLE
function reloadTable(name_table) {
    $("#" + name_table).DataTable().ajax.reload();
}
//IMPRESSÃO DA VISTORIA
function print_survey(id_survey) {
    $("#option_print_survey").modal('show');
    $(".print_id_survey").val(id_survey);
}

function repli(id_survey) {
    new PNotify({
        title: 'Replicar Vistoria',
        text: 'Deseja realmente replicar a vistoria ' + id_survey + ' ?',
        styling: 'fontawesome',
        type: 'info',
        icon: 'fa fa-question-circle',
        hide: false,

        confirm: {
            confirm: true,
            buttons: [{
                text: 'Replicar',
                addClass: 'btn-default pull-left',
                click: function click(notice) {
                    //MOSTRANDO LOAD
                    $("#load-modal").modal({ show: true });
                    //REDIRECIONANDO APOS 2 SEGUNDOS
                    setTimeout(function () {
                        window.location.replace(domain_complet + '/vistoria/replicar/' + btoa(id_survey));
                    }, 2000);
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
        }
    }).get().on('pnotify.confirm', function () {
        alert('Ok, cool.');
    }).on('pnotify.cancel', function () {
        alert('Oh ok. Chicken, I see.');
    });
}

//ARQUIVAR VISTORIA
function delete_survey(id) {
    new PNotify({
        title: 'Arquivar Vistoria',
        text: 'DESEJA REALMENTE ARQUIVAR ESSA VISTORIA?',
        icon: 'glyphicon glyphicon-question-sign',
        hide: false,
        type: 'error',
        confirm: {
            confirm: true,

            buttons: [{
                text: 'Sim',
                addClass: 'btn-default pull-left',
                click: function click(notice) {
                    console.log('arquivando');
                    notice.remove();
                    $("#load-modal").modal('show');
                    $.ajax({
                        url: domain_complet + '/vistoria/arquivar/' + id,
                        type: 'PUT',
                        dataType: 'JSON',
                        data: { survey_id: id },
                        success: function success(data) {
                            new PNotify({
                                title: 'Sucesso',
                                text: data.description,
                                type: data.message,
                                animate_speed: 'fast'
                            });
                            $("#table-survey").DataTable().ajax.reload();
                            $("#load-modal").modal('hide');
                        }
                    }).done(function () {
                        console.log("success");
                    }).fail(function () {
                        console.log("error");
                    }).always(function () {
                        console.log("complete");
                    });
                }
            }, {
                text: 'Não',
                click: function click(notice) {
                    console.log('Cancelando...');
                    notice.remove();
                }
            }]
        },
        history: {
            history: false
        },
        addclass: 'stack-modal',
        stack: { 'dir1': 'down', 'dir2': 'right', 'modal': true }
    });
}

//MODAL DE LOAD
function showMessageLoad() {
    new PNotify({
        title: 'Aguarde',
        text: 'Já estamos processando sua solicitação',
        type: 'info',
        icon: 'fa fa-hourglass',
        hide: false,
        addclass: 'stack-modal',
        stack: { 'dir1': 'down', 'dir2': 'right', 'modal': true }
    });
}

/** PARA NOFIFICAÇÃOES VIA PNOTIFY */
function successNotify(title_msg_success) {
    new PNotify({
        title: 'Sucesso',
        text: title_msg_success,
        type: 'success',
        icon: 'fa fa-check-circle',
        animate: {
            animate: true,
            in_class: 'bounceInLeft',
            out_class: 'bounceOutRight'
        }
    });
}
function errorNotify(title_error_notify) {
    new PNotify({
        title: 'Ops! Houve um erro',
        text: title_error_notify,
        icon: 'fa fa-times-circle',
        type: 'error'
    });
}

function infoNotify(title_info_notify) {
    new PNotify({
        title: 'Informação',
        text: title_info_notify,
        type: 'info',
        icon: 'fa fa-info-circle',
        animate: {
            animate: true,
            in_class: 'bounceInDown',
            out_class: 'hinge'
        }
    });
}
function delete_key(id, code_key) {
    new PNotify({
        title: 'Excluir Chave',
        text: 'Deseja realmente excluir a chave nº ' + code_key + ' ?',
        icon: 'fa fa-question',
        type: 'error',
        hide: false,
        confirm: {
            confirm: true,
            buttons: [{
                text: 'Sim',
                addClass: 'btn-default pull-left',
                click: function click(notice) {
                    $.ajax({
                        url: domain_complet + 'chave/destroy/' + id,
                        type: 'delete',
                        dataType: 'json',
                        data: { key_code: code_key },
                        success: function success(data) {
                            notice.remove();
                            successNotify('Chave foi excluída com sucesso');
                            reloadTable('key_control');
                        }, error: function error(data, status, _error) {
                            title_error_notify = "Erro ao excluir a chave: " + _error;
                            errorNotify(title_error_notify);
                        }
                    }).fail(function () {
                        notice.remove();
                        new PNotify({
                            title: data.title_msg,
                            text: data.text_msg,
                            type: data.type_msg,
                            icon: data.icon_msg,

                            addclass: 'stack-modal',
                            stack: { 'dir1': 'down', 'dir2': 'right', 'modal': true }
                        });
                    }).always(function () {
                        console.log("complete");
                    });
                }
            }, {
                text: 'Não',
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
        }, addclass: 'stack-modal',
        stack: { 'dir1': 'down', 'dir2': 'right', 'modal': true }
    });
}

//EDITAR CHAVE
function modal_update_key(id, code_key) {
    console.log(code_key);
    $("#info_update_code_key").html('Código atual é: <small class="label label-info">' + code_key + '</smal>');
    $("#update_keys_code").val(id);
    $("#update_code_key").modal('show');
}

/*PARA MASCARAR OS TELEFONES PARA 9 DIGITOS*/
/* Máscaras ER */
function mascara(o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout("execmascara()", 1);
}
function execmascara() {
    v_obj.value = v_fun(v_obj.value);
}
function mtel(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
    return v;
}
function id(el) {
    return document.getElementById(el);
}

/***/ })

},[282]);