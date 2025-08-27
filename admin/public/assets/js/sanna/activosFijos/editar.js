$('.agregar').click( function() {
    var idactivofijo = $("#idactivofijo").val();

    var marca = $("#marca").val();
    var modelo = $("#modelo").val();
    var serie = $("#serie").val();
    var cod_inventario = $("#cod_inventario").val();
    var propiedad = $("#propiedad").val();


    var precio = $("#precio").val();
    var estado = $("#estado").val();
    var nombre = $("#nombre").val();

      
    if(idtopico==undefined){
        idtopico = $("#idtopico").val();
      
    }
    if(cod_baja==undefined){
        cod_baja = $("#cod_baja").val();
    }

 
    var comprobante = $("#comprobante").val();


  
    if(cod_inventario=="" || cod_inventario==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el código de inventario</div>');
        return false;
    }
    if(estado=="" || estado==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el estado</div>');
        return false;
    }
   

    if(estado==0 && (idtopico==undefined || idtopico=="") ){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button>Seleccione el tópico asignado</div>');
        return false;
    }

    if(estado==2 && (cod_baja==undefined || cod_baja=="") ){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button>Ingrese el xódigo del Acta de baja de activo</div>');
        return false;
    }

    if(nombre=="" || nombre==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el nombre</div>');
        return false;
    }

    if(marca=="" || marca==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la marca</div>');
        return false;
    }
    
    if(modelo=="" || modelo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el modelo</div>');
        return false;
    }
  
    if(serie=="" || serie==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la serie</div>');
        return false;
    }


    if(precio=="" || precio==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el estado de uso</div>');
        return false;
    }
    
    if(propiedad=="" || propiedad==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la propiedad</div>');
        return false;
    }

    if(comprobante=="" || comprobante==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la propiedad</div>');
        return false;
    }



    $.ajax({
        'url': "updateActivosFijos",
        'data':{'idactivofijo':idactivofijo,'marca':marca,'modelo':modelo,'serie':serie,'cod_inventario':cod_inventario,
        'propiedad':propiedad,'propiedad':propiedad,'precio':precio,'estado':estado,'nombre':nombre,
        'cod_baja':cod_baja,
        'idtopico':idtopico,'comprobante':comprobante},
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
            window.setTimeout(function(){window.location.href = 'administrarActivosFijos',1000});



        }
 
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
             $('#boton').prop('disabled', false);
        
        }
    
    })

})

var idtopico;
$('#idtopico2').on('change',function(){
    idtopico = $(this).val();
})

var cod_baja;
$('#cod_baja2').on('change',function(){
    cod_baja = $(this).val();
})

$('#estado').on('change',function(){
 
    var estado = $(this).val();
    topic_as = document.getElementById("topic_as");
    dado_baja = document.getElementById("dado_baja");

    if(estado==1){
        topic_as.style.display = 'none'
        dado_baja.style.display = 'none'

    }
    if(estado==0){
        topic_as.style.display = 'block'
        dado_baja.style.display = 'none'

    }
    if(estado==2){
        topic_as.style.display = 'none'
        dado_baja.style.display = 'block'
    }

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