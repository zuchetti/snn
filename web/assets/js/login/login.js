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

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la <strong>Contraseña</strong></div>');
        return false;
    }

    var pswd = $("#password").val();
    dni = $("#user").val();
    
    if(pswd.length < 12){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener como mínimo 12 caracteres </div>');
        return false;
    }

    contador = 0;

    re = /[0-9]/;
    if(!re.test(pswd)) {
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener al menos un número </div>');
        // return false;
    }else{
        contador++;
    }
    re = /[a-z]/;
    if(!re.test(pswd)) {
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener al menos una letra </div>');
        // return false;
    }else{
        contador++;
    }
    re = /[A-Z]/;
    if(!re.test(pswd)) {
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener al menos una letra mayúscula </div>');
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
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña no cumple los requisitos</div>');
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
      
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Contraseña actualizada</div>');
            window.setTimeout(function(){window.location.href = "https://200.48.199.90:8002/sanna/web/public/"},2000);

        }

     
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ocurrió un <strong>error</strong></div>');
            $('#button').prop('disabled', false);

        }  

        
    })
})


//login
$(".login").click(function() {
    
    if(!$("#user").val()){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese el <strong>dni</strong></div>');
        return false;

    }
/*     if(!$("#password").val()){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la <strong>Contraseña</strong></div>');
        return false;
    } */

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
                        window.location.href = 'https://racso.doctormas.com.pe/topico'
                    }
                }

            }

            if(obj.status==100){
                $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> '+obj.message +'</strong></div>');
                 window.setTimeout(function(){window.location.href = 'https://racso.doctormas.com.pe/'},3000);
                 return false;
            }


           /* 
           
          */

 

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

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese el <strong>dni</strong></div>');
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
      
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>El código se ha enviado a su correo electrónico</div>');
            window.setTimeout(function(){window.location.href = "confirmCode?dni="+dni},3000);

        }

     
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#button').prop('disabled', false);

        }  

        
    })


})


//send
$(".update").click(function() {

    var dni = $("#user").val();
    var codigo = $("#codigo").val();

    if(!$("#user").val()){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese el <strong>dni</strong></div>');
        return false;

    }

    
    if(!$("#codigo").val()){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese el <strong>código</strong></div>');
        return false;

    }

    if(!$("#password").val()){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la <strong>Contraseña</strong></div>');
        return false;
    }

    var pswd = $("#password").val();
    dni = $("#user").val();

    if(pswd.length < 12){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener como mínimo 12 caracteres </div>');
        return false;
    }

    contador = 0;

    re = /[0-9]/;
    if(!re.test(pswd)) {
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener al menos un número </div>');
        // return false;
    }else{
        contador++;
    }
    re = /[a-z]/;
    if(!re.test(pswd)) {
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener al menos una letra minuscula </div>');
        // return false;
    }else{
        contador++;
    }
    re = /[A-Z]/;
    if(!re.test(pswd)) {
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña debe tener al menos una letra mayúscula </div>');
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
        $('#alerts').append('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> La contraseña no cumple los requisitos</div>');
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
      
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Contraseña actualizada</div>');
            window.setTimeout(function(){window.location.href = "https://200.48.199.90:8002/sanna/web/public/"},2000);

        }

     
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            window.setTimeout(function(){window.location.href = "confirmCode"},2000);


        }  

        
    })


})