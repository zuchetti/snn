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

//autocomple off
var ruta = $('meta[name="base_url"]').attr('content') + '/';
const url = ruta; // Asumimos que esta es la URL base del sitio

$(document).ready(function(){
    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });
});


///validar solo numeros
function valideKey(evt) {
    var code = evt.which ? evt.which : evt.keyCode;
    if (code == 8) {
        //backspace
        return true;
    } else if (code >= 48 && code <= 57) {
        //is a number
        return true;
    } else {
        return false;
    }
}

// Función para validar si una URL es del mismo origen
function isSameOrigin(url) {
    try {
        const urlObj = new URL(url);
        return urlObj.origin === window.location.origin;
    } catch (e) {
        return false;
    }
}


//login
$(".login").click(function() {
    
    // CORRECCIÓN: Sanificamos los mensajes de alerta
    if(!$("#user").val()){
        const message = "Ingrese el <strong>dni</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }
    if(!$("#password").val()){
        const message = "Ingrese la <strong>Contraseña</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }

    var dni = $("#user").val();
    var password = $("#password").val();

    // CORRECCIÓN: Usar directamente la URL base para la redirección normal.
    var dashboardUrl = url + 'dashboard';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        'url': "login",
        "method": "POST",
        'data':{'dni':dni,'password':password},
        beforeSend: function() {      
            $(".spinner-border").fadeIn(200);  
        },
        'success': function(data) {

            obj = JSON.parse(data);
 
            if(obj.status==200){
                // CORRECCIÓN: Validar la URL antes de redirigir
                if(obj.google_secret==1){
                    // Validamos que la URL pertenezca al mismo origen antes de redirigir
                    if(isSameOrigin(obj.url)){
                         window.setTimeout(function(){window.location.href = obj.url+'?dni='+escapeHtml(dni)});
                    }
                }else{
                    window.location.href = dashboardUrl;
                }
            }

            if(obj.status==100){
                // CORRECCIÓN: Sanificamos el mensaje del servidor
                const message = "DNI y/o contraseña <strong>incorrecto</strong>";
                $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>' + escapeHtml(message) + '</div>');
                window.setTimeout(function(){window.location.reload()},2000);
            }
        }    
    })
})