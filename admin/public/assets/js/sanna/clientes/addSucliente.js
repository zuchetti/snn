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

//OVERLAY
$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex        : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

//agregar sede
$('.addSede').click( function() {
    var empresa = $('#empresa').val();
    var sede = $('#sede').val();

    if(sede=="" || sede==undefined){
        const message = "Ingrese el nombre de la sede";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }

    $.ajax({
        'url': "addSedeTable",
        'data':{'sede':sede,'empresa':empresa},
    }).done( function(data) {

        console.log(data)
        var content="";
        $.each(data, function(i, value) {
            
            // CORRECCIÓN APLICADA: Sanificamos los datos antes de insertarlos
            const sanitizedEmpresa = escapeHtml(value.empresa);
            const sanitizedSede = escapeHtml(value.sede);
            
            content += '<tr>'+
                '<td></td>'+
                '<td>'+sanitizedEmpresa+'</td>'+
                '<td><input name="sedes" value="'+sanitizedSede+'" type="hidden">'+sanitizedSede+'</td>'+
                '</tr>';
        })
        $('#sedes').html(content);
    }) 
})

//guardar
$('.agregar').click( function() {
    var idempresa = $('#idempresa').val();
    var empresa = $('#empresa').val();
    var contar = 0;
    $("input[name='sedes']").each(function () {
        if (this.value!="") {
            contar++;
        }
    })
    if(contar==0){
        const message = "Ingrese el nombre de la sede";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }
    var arrayD = [];
    $("input[name='sedes']").each(function () {
        if (this.value!="") {
            arrayD.push($(this).val());
        }
    })
    sedes = arrayD.join(',');
    console.log(sedes)

    $.ajax({
        'url': "saveSubcliente",
        'data':{'sedes':sedes,'idempresa':idempresa},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);
        
        if(obj.status == 200){
            // CORRECCIÓN APLICADA: Sanificamos el mensaje del servidor
            const sanitizedMessage = escapeHtml(obj.message);
            $('#alerts2').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+sanitizedMessage+'</div>');
            $('#boton').prop('disabled', true);

            // CORRECCIÓN APLICADA: Usamos encodeURIComponent para la URL
            const encodedEmpresa = encodeURIComponent(empresa);
            window.setTimeout(function(){window.location.href = 'detalleEmpresa?idempresa='+idempresa+'&empresa='+encodedEmpresa},1000);
        }
        
        if(obj.status == 100){
            // CORRECCIÓN APLICADA: Sanificamos el mensaje del servidor
            const sanitizedMessage = escapeHtml(obj.message);
            $('#alerts').html('<div class="alert alert-danger">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+sanitizedMessage+'</div>');
            $('#boton').prop('disabled', false);
        }
    })
})