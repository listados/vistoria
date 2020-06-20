/*enviado em 01/06*/
function deleteImageAmbience(e) {
    var t = confirm("Deseja excluir essa imagem?");
    t ? $.ajax({
        url: domain_complet + "/vistoria/imagem-ambiente",
        type: "POST",
        dataType: "json",
        data: {
            files_ambience_id: e
        },
        success: function () {
            location.reload()
        }
    }).done(function () {
        new PNotify({
            title: "Sucesso",
            text: "Ambiente excluido",
            styling: "fontawesome",
            type: "success",
            icon: "true",
            animation: "fade",
            delay: 5e3,
            animate_speed: "slow"
        })
    }).fail(function () {
        new PNotify({
            title: "Erro",
            text: "Ocorreu um erro",
            styling: "fontawesome",
            type: "error",
            icon: "true",
            animation: "fade",
            delay: 5e3,
            animate_speed: "slow"
        })
    }).always(function () {}) : alert("nao confirmou")
}
$(document).ready(function () {
    $(".list-group-item.active");
    $("#system-search").keyup(function () {
        var e = this,
            t = $(".table-list-search tbody"),
            a = $(".table-list-search tbody tr");
        $(".search-sf").remove(), a.each(function (o, s) {
            var n = $(s).text().toLowerCase(),
                r = $(e).val().toLowerCase();
            "" != r ? ($(".search-query-sf").remove(), t.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Pesquisando por: "' + $(e).val() + '"</strong></td></tr>')) : $(".search-query-sf").remove(), n.indexOf(r) == -1 ? a.eq(o).hide() : ($(".search-sf").remove(), a.eq(o).show())
        }), 0 == a.children(":visible").length && t.append('<tr class="search-sf"><td class="text-muted" colspan="6">Não encontrado registro.</td></tr>')
    })
});