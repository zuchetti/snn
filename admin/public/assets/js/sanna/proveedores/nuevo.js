$('.agregar').click( function() {
    var ruc = $("#ruc").val();
    var razon_social = $("#razon_social").val();
    var contacto = $("#contacto").val();
    var email_contacto = $("#email_contacto").val();
    var telf_contacto = $("#telf_contacto").val();

    var concepto_plselect = $("#concepto_pl").val();
    
    var concepto_pl = concepto_plselect.join(',');

  
    if(ruc=="" || ruc==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el RUC</div>');
        return false;
    }
    if(razon_social=="" || razon_social==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la razón social</div>');
        return false;
    }
    if(contacto=="" || contacto==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">  ' +
            '&times; </button> Ingrese el contacto</div>');
        return false;
    }

    if(email_contacto=="" || email_contacto==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el email de contacto</div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_contacto)) {
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Email de contacto inválido</div>');
        return false;
    }

    if(telf_contacto=="" || telf_contacto==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el teléfono de contacto</div>');
        return false;
    }
    
    if(concepto_pl=="" || concepto_pl==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el concepto PL </div>');
        return false;
    }
  
 
    $.ajax({
        'url': "aggProveedor",
        'data':{'ruc':ruc,'razon_social':razon_social,'contacto':contacto,'email_contacto':email_contacto,
        'telf_contacto':telf_contacto,'concepto_pl':concepto_pl},
        beforeSend: function() {
            $('.agregar').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){

            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', true);
            window.setTimeout(function(){window.location.href = 'proveedores'},1000);

        }
 
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
             $('#boton').prop('disabled', false);
        
        }
    
    })

})

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

$('.decimales').on('input', function () {
    if(this.value!=undefined){
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    }
});

$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});
