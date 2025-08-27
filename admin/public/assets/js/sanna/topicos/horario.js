// Función de ayuda para escapar caracteres HTML y prevenir XSS.
function escapeHtml(unsafe) {
    if (!unsafe) return '';
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

/* function getRelog(dia,bloque){
    $('#datetimepicker'+dia+bloque).datetimepicker({
        format: 'LT'
    });
}
*/
$('.agregar').click(function(){

    var dia = [];
    var hora_ini=[];
    var hora_fin=[];
    var horario=[];
    var contarHoraI=0;
    var contarHoraF=0;
    $("[name='hora_ini'").each(function () {
        if($(this).val()!=""){
            contarHoraI++;
            dia.push($(this).attr("dia"));
            hora_ini.push($(this).val());
        }
    });
    $("[name='hora_fin'").each(function () {
        if($(this).val()!=""){
            contarHoraF++;
            dia.push($(this).attr("dia"));
            hora_fin.push($(this).val());
        }
    });

    if(contarHoraI<contarHoraF){
        const message = "Falta Ingresar hora inicio y hora fin";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert"> ' +
        '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    for(i=0;i<hora_ini.length;i++){
        horario.push({
            dia : dia[i],
            hora_ini: hora_ini[i],
            hora_fin: hora_fin[i]
        }); 
    }
    var idtopico=$("#idtopico").val();
    var idbotiquin=$("#idbotiquin").val();

    $.ajax({
        'url': "aggHorarioTopico",
        'data':{'idtopico':idtopico,'horario':horario},
        beforeSend: function() {
            $('.agregar').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){
            const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+sanitizedMessage+'</div>');
            $('#boton').prop('disabled', true);
            window.setTimeout(function(){window.location.href = 'aggGrupoMDE?idbotiquin='+idbotiquin+'&new=1'},1000);
        }
 
        if(obj.status == 100){
            const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+sanitizedMessage+'</div>');
            $('#boton').prop('disabled', false);
        }
    })
})

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex        : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});