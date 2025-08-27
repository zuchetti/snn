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

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex        : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

//GRUPO EXAMEN LABO
$('.addgroupDiagnostic').click( function() {
    var idgrupo = $('#idgrupoDiagnostic').val();

    if(idgrupo=="" || idgrupo==undefined){
        const message = "Seleccione el grupo de diagnostico";
        $('#alerts4').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }

    $.ajax({
        'url': "tableDiagnostico",
        'data':{'idgrupo':idgrupo},
    }).done( function(data) {
        var content="";
        $.each(data, function(i, value) {
            // Se sanifican los valores antes de insertarlos
            const sanitizedNombre = escapeHtml(value.nombre);
            const sanitizedDiagnosticos = escapeHtml(value.diagnosticos);

            content += '<tr>'+
                '<td><input type="hidden" name="idgrupoD" value="'+escapeHtml(value.idgrupo)+'"></td>'+
                '<td>'+sanitizedNombre+'</td>'+
                '<td>'+sanitizedDiagnosticos+'</td>'+
                '</tr>';
        })
        $('#diagnostic').html(content);
    }) 
})

$('.agregar').click( function() {
    var idbotiquin = $("#idbotiquin").val();
    var idtopico = $("#idtopico").val();
    console.log(idtopico)

    /////DIAGNOSTICO////
    var arrayD = [];
    var idgrupoD;
    var contarIdgroupD = 0;

    $("input[name='idgrupoD']").each(function () {
        if (this.value!="") {
            contarIdgroupD++;
        }
    })
    
    if(contarIdgroupD==0){
        const message = "Seleccione al menos un grupo de diagnostico";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }
    
    $("input[name='idgrupoD']").each(function () {
        if (this.value!="") {
            arrayD.push($(this).val());
            idgrupoD = arrayD.join(',');
        }
    })

    $.ajax({
        'url': "aggTopicoGrupoDiagnostico",
        'data':{'idgrupo_diag':idgrupoD,'idbotiquin':idbotiquin},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
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
            window.setTimeout(function(){window.location.href = 'allDiagnosticoTopico?idtopico='+idtopico},1000);
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