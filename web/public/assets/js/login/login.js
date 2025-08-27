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


$(".change").click(function() {

    if(!$("#password").val()){
        const message = "Ingrese la <strong>Contraseña</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>' + message + '</div>');
        return false;
    }

    var pswd = $("#password").val();
    dni = $("#user").val();
    
    if(pswd.length < 12){
        const message = "La contraseña debe tener como mínimo 12 caracteres";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
        return false;
    }

    contador = 0;

    re = /[0-9]/;
    if(!re.test(pswd)) {
        const message = "La contraseña debe tener al menos un número";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
        // return false;
    }else{
        contador++;
    }
    re = /[a-z]/;
    if(!re.test(pswd)) {
        const message = "La contraseña debe tener al menos una letra";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
        // return false;
    }else{
        contador++;
    }
    re = /[A-Z]/;
    if(!re.test(pswd)) {
        const message = "La contraseña debe tener al menos una letra mayúscula";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
        // return false;
    }else{
        contador++;
    }
    re  = /[#?!@$%^&*]/;

    if(!re.test(pswd)) {
        
    }else{
        contador++;
    }

    if(contador<3){
        const message = "La contraseña no cumple los requisitos";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + '</div>');
        return false;
    }

    $.ajax({
        'url': "createPassword",
        'data': {'password':pswd,'dni':dni},
        beforeSend: function() {
            $(".spinner-border").show();　
            $('#button').prop('disabled', true);  
        }           
    }).done( function(data) {
        $('#button').prop('disabled', true);  
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){
            const message = "Contraseña actualizada";
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
            window.setTimeout(function(){window.location.href = "https://racso.doctormas.com.pe/sanna/web/public/"},2000);
        }

        if(obj.status == 100){
            const message = "Ocurrió un <strong>error</strong>";
            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
            $('#button').prop('disabled', false);
        }   
    })
})


//login
$(".login").click(function() {
    
    if(!$("#user").val()){
        const message = "Ingrese el <strong>dni</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>' + message + '</div>');
        return false;
    }

    var e = $("input[name=_token]").val();
    dni = $("#user").val();
    var pass = $("#password").val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        'url': "login",
        "method": "POST",
        'data':{'dni':dni,'password':pass},
        beforeSend: function() {       
            $(".spinner-border").fadeIn(200);　
        },
        'success': function(data) {
            obj = JSON.parse(data);

            if(obj.status==200){
                if(obj.google_secret==1){
                    window.setTimeout(function(){window.location.href = obj.url+'?dni='+dni});
                }else{
                    if(obj.password==0){
                        location.href='changePassword?dni='+dni;
                    }else{
                        window.location.href = url+'topico'
                    }
                }
            }

            if(obj.status==100){
                const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
                $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> ' + sanitizedMessage + '</strong></div>');
                window.setTimeout(function(){window.location.href = 'https://racso.doctormas.com.pe/sanna/web/public/'},3000);
                return false;
            }
        }   
    })
})


/////mostrar password
function mostrarPassword(){
    var cambio = document.getElementById("password");
    if(cambio.type == "password"){
        cambio.type = "text";
        $('.icon').removeClass('far fa-eye-slash').addClass('far fa-eye');
    }else{
        cambio.type = "password";
        $('.icon').removeClass('far fa-eye').addClass('far fa-eye-slash');
    }
} 

$(document).ready(function () {
//CheckBox mostrar contraseña
    $('#ShowPassword').click(function () {
        $('#password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });

});

//send
$(".send").click(function() {
    var dni = $("#user").val();
    if(!$("#user").val()){
        const message = "Ingrese el <strong>dni</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>' + message + '</div>');
        return false;
    }

    $.ajax({
        'url': "getCode",
        'data': {'dni':dni},
        beforeSend: function() {
            $(".spinner-border").show();　
            $('#button').prop('disabled', true);  
        }           
    }).done( function(data) {
        $('#button').prop('disabled', true);  
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){
            const message = "El código se ha enviado a su correo electrónico";
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
            window.setTimeout(function(){window.location.href = "confirmCode?dni="+dni},3000);
        }

        if(obj.status == 100){
            const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + sanitizedMessage + '</div>');
            $('#button').prop('disabled', false);
        }   
    })
})


//send
$(".update").click(function() {
    var dni = $("#user").val();
    var codigo = $("#codigo").val();

    if(!$("#user").val()){
        const message = "Ingrese el <strong>dni</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>' + message + '</div>');
        return false;
    }

    if(!$("#codigo").val()){
        const message = "Ingrese el <strong>código</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>' + message + '</div>');
        return false;
    }

    if(!$("#password").val()){
        const message = "Ingrese la <strong>Contraseña</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>' + message + '</div>');
        return false;
    }

    var pswd = $("#password").val();
    dni = $("#user").val();

    if(pswd.length < 12){
        const message = "La contraseña debe tener como mínimo 12 caracteres";
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
        return false;
    }

    contador = 0;
    re = /[0-9]/;
    if(!re.test(pswd)) {
        const message = "La contraseña debe tener al menos un número";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
    }else{
        contador++;
    }
    re = /[a-z]/;
    if(!re.test(pswd)) {
        const message = "La contraseña debe tener al menos una letra minuscula";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
    }else{
        contador++;
    }
    re = /[A-Z]/;
    if(!re.test(pswd)) {
        const message = "La contraseña debe tener al menos una letra mayúscula";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + ' </div>');
    }else{
        contador++;
    }
    re  = /[#?!@$%^&*]/;

    if(!re.test(pswd)) {
        
    }else{
        contador++;
    }

    if(contador<3){
        const message = "La contraseña no cumple los requisitos";
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> ' + message + '</div>');
        return false;
    }
    
    $.ajax({
        'url': "updatePassword",
        'data': {'dni':dni,'password':pswd,'codigo':codigo},
        beforeSend: function() {
            $(".spinner-border").show();　
            $('#button').prop('disabled', true);  
        }           
    }).done( function(data) {
        $('#button').prop('disabled', true);  
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){
            const message = "Contraseña actualizada";
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
            window.setTimeout(function(){window.location.href = "https://racso.doctormas.com.pe/sanna/web/public/"},2000);
        }

        if(obj.status == 100){
            const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + sanitizedMessage + '</div>');
            window.setTimeout(function(){window.location.href = "confirmCode"},2000);
        }   
    })
})