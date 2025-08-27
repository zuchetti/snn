$('.ingresar').click( function() {

    var tipo_doc = $("#tipo_doc").val();
    var num_doc = $("#num_doc").val();
    var ape_paterno = $("#ape_paterno").val();
    var ape_materno = $("#ape_materno").val();
    var nombres = $("#nombres").val();
    var fec_nacimiento = $("#fec_nacimiento").val();
    var sexo = $("#sexo").val();
    var idsubcliente=$("#idsubcliente").val();
    var idmodalidad=$("#idmodalidad").val();


    if(tipo_doc=="" || tipo_doc==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el tipo de documento </strong></div>');
        return false;
    }

    if((num_doc=="" || num_doc==undefined) && tipo_doc!=7){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el tipo de documento </strong></div>');
        return false;
    }

    
    if(ape_paterno=="" || ape_paterno==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el apellido paterno </strong></div>');
        return false;
    }

    if(ape_materno=="" || ape_materno==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el apellido materno </strong></div>');
        return false;
    }
    if(nombres=="" || nombres==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese los nombres </strong></div>');
        return false;
    }

    if(fec_nacimiento=="" || fec_nacimiento==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione la fecha de nacimiento </strong></div>');
        return false;
    }

    if(sexo=="" || sexo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el sexo </strong></div>');
        return false;
    }

    if(idsubcliente=="" || idsubcliente==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el subcliente </strong></div>');
        return false;
    }


    if(idmodalidad=="" || idmodalidad==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione la modalidad de atención </strong></div>');
        return false;
    }

    $.ajax({
        'url': "savedPacienteCortesia",
        'data':{'idsubcliente':idsubcliente,'idmodalidad':idmodalidad,
        'tipo_doc':tipo_doc,'num_doc':num_doc,'ape_paterno':ape_paterno,'ape_materno':ape_materno,
        'nombres':nombres,'fec_nacimiento':fec_nacimiento,'sexo':sexo},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　

        if(data=='ok'){
            location.href='historyClinic'
        
        }else{

            $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Error al guardar la información </strong></div>');
        }


    })


})


//change tipo doc

$('#tipo_doc').change(function(){

    if($(this).val()!="" && $(this).val()!=7){

        $('#num_doc').prop('disabled', false);

    }else{
        $('#num_doc').prop('disabled', true);
    }
});

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

function mayus(e) {
    e.value = e.value.toUpperCase();
    $('.ingresar').prop('disabled', false);  

}