var SurveyMessage = (function () {
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
        })
    }
    function errorNotify(title_error_notify) {
        new PNotify({
            title: 'Ops! Houve um erro',
            text: title_error_notify,
            icon: 'fa fa-times-circle',
            type: 'error',
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
        })
    }
    return {
        showMessageLoad,
        successNotify,
        errorNotify,
        infoNotify
    }
});