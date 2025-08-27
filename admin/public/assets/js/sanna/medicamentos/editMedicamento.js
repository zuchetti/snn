$('.agregar').click( function() {
    var tipo = $("#tipo").val();
    var cod_producto = $("#cod_producto").val();
    var producto = $("#producto").val();
    var presentacion = $("#presentacion").val();
    var precio_costo1 = $("#precio_costo1").val();
    var precio_venta1 = $("#precio_venta1").val();
    var precio_venta2 = $("#precio_venta2").val();
    var precio_farmext = $("#precio_farmext").val();
    var cant_presentacion = $("#cant_presentacion").val();
    var idmedicamento = $("#idmedicamento").val();

  
    if(cod_producto=="" || cod_producto==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el código del producto</div>');
        return false;
    }
    if(producto=="" || producto==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el nombre del producto</div>');
        return false;
    }

    if(tipo=="" || tipo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el tipo</div>');
        return false;
    }

    if(presentacion=="" || presentacion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la presentación</div>');
        return false;
    }
    if(precio_costo1=="" || precio_costo1==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el precio del costo 1</div>');
        return false;
    }

 


    if(precio_venta1=="" || precio_venta1==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el precio de venta 1</div>');
        return false;
    }

    
    if(precio_venta2=="" || precio_venta2==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el precio de venta 2</div>');
        return false;
    }

    if(precio_farmext=="" || precio_farmext==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el precio de farm ext</div>');
        return false;
    }


    if(cant_presentacion=="" || cant_presentacion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la cantidad presentación</div>');
        return false;
    }

    $.ajax({
        'url': "editMedicamentoAll",
        'data':{'idmedicamento':idmedicamento,'cant_presentacion':cant_presentacion,'tipo':tipo,'cod_producto':cod_producto,'producto':producto,'presentacion':presentacion,'precio_costo1':precio_costo1,
        'precio_venta1':precio_venta1,'precio_venta2':precio_venta2,'precio_farmext':precio_farmext
        },
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
            setTimeout(function() {
                location.reload();
            }, 1000);
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


$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});


$('.decimales').on('input', function () {
    if(this.value!=undefined){
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    }
});
  
