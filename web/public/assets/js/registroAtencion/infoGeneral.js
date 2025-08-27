


$('.next').click( function() {

    var CodigoTipoCobertura =  $('input[name=CodigoTipoCobertura]:checked').val();
    var idsubcliente=$("#idsubcliente").val();
    var idmodalidad=$("#idmodalidad").val();


    if(CodigoTipoCobertura=="" || CodigoTipoCobertura==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el beneficio </strong></div>');
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


    let objData={};
    $('input[name=CodigoTipoCobertura]:checked').each(function () {

        objData['ApellidoMaternoAfiliado']= $(this).attr("ApellidoMaternoAfiliado"); 
        objData['ApellidoPaternoAfiliado']= $(this).attr("ApellidoPaternoAfiliado"); 
        objData['BeneficioMaximoInicial']= $(this).attr("BeneficioMaximoInicial"); 
        objData['CodigoAfiliado']= $(this).attr("CodigoAfiliado"); 
        objData['CodigoTitular']= $(this).attr("CodigoTitular"); 
        objData['CodCalificacionServicio']= $(this).attr("CodCalificacionServicio"); 
        objData['CodEstado']= $(this).attr("CodEstado"); 
        objData['CodEspecialidad']= ""; 
        objData['CodMoneda']= $(this).attr("CodMoneda"); 
        objData['CodCopagoFijo']= $(this).attr("CodCopagoFijo"); 
        objData['CodCopagoVariable']= $(this).attr("CodCopagoVariable"); 
        objData['CodParentesco']= $(this).attr("CodParentesco"); 
        objData['CodProducto']= $(this).attr("CodProducto"); 
        objData['NumeroDocumentoContratante']= $(this).attr("NumeroDocumentoContratante"); 
        objData['CodSubTipoCobertura']= $(this).attr("CodSubTipoCobertura"); 
        objData['CodTipoCobertura']= $(this).attr("CodTipoCobertura"); 
        objData['CodTipoAfiliacion']= $(this).attr("CodTipoAfiliacion"); 
        objData['DesProducto']= $(this).attr("DesProducto"); 
        objData['CodEstadoMarital']= $(this).attr("CodEstadoMarital"); 
        objData['CodFechaFinCarencia']= $(this).attr("CodFechaFinCarencia"); 
        objData['CodFechaAfiliacion']= $(this).attr("CodFechaAfiliacion"); 
        objData['CodFechaInicioVigencia']= $(this).attr("CodFechaInicioVigencia"); 
        objData['CodFechaNacimiento']= $(this).attr("CodFechaNacimiento"); 
        objData['CodGenero']= $(this).attr("CodGenero"); 
        objData['SUNASA']= $(this).attr("SUNASA"); 
        objData['IAFAS']= $(this).attr("IAFAS"); 
        if($(this).attr("CondicionesEspeciales")!=" "){
            objData['CondicionesEspeciales']= $(this).attr("CondicionesEspeciales"); 


        }else{
            objData['CondicionesEspeciales']= ""; 
        }
        objData['ApellidoMaternoTitular']= $(this).attr("ApellidoMaternoTitular"); 
        objData['NombreContratante']= $(this).attr("NombreContratante"); 
        objData['ApellidoPaternoTitular']= $(this).attr("ApellidoPaternoTitular"); 
        objData['NombresAfiliado']= $(this).attr("NombresAfiliado"); 
        objData['NombresTitular']= $(this).attr("NombresTitular"); 
        objData['NumeroCertificado']= $(this).attr("NumeroCertificado"); 
        objData['NumeroContrato']= $(this).attr("NumeroContrato"); 
        objData['NumeroDocumentoAfiliado']= $(this).attr("NumeroDocumentoAfiliado"); 
        objData['NumeroDocumentoTitular']= $(this).attr("NumeroDocumentoTitular"); 
        objData['NumeroPlan']= $(this).attr("NumeroPlan"); 
        objData['NumeroPoliza']= $(this).attr("NumeroPoliza"); 
        objData['RUC']= $(this).attr("RUC"); 
        objData['CodTipoDocumentoContratante']= $(this).attr("CodTipoDocumentoContratante"); 
        objData['CodTipoDocumentoAfiliado']= $(this).attr("CodTipoDocumentoAfiliado"); 
        objData['CodTipoDocumentoTitular']= $(this).attr("CodTipoDocumentoTitular"); 
        objData['CodTipoPlan']= $(this).attr("CodTipoPlan"); 
        objData['CodIndicadorRestriccion']= $(this).attr("CodIndicadorRestriccion"); 

      
    });

    //console.log(objData)


    $.ajax({
        'url': "ConsultaNumeroAutorizacion",
        'data':{'objData':objData,'idsubcliente':idsubcliente,'idmodalidad':idmodalidad},
        beforeSend: function() {
            $('.next').prop('disabled', true);  
            $("#spiner2").fadeIn(200);　
        }
    }).done( function(data) {
        $('.next').prop('disabled', true);  

        $("#spiner2").hide();　
        if(data){
            obj = JSON.parse(data);

            if(obj.status==200){
                location.href='historyClinic';
            }
            if(obj.status==100){
                $('#alerts').html('<div class="alert alert-danger">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+obj.message+'</div>');
                 $('.next').prop('disabled', false);
            }
        }else{
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>ERROR EN EL SERVICIO</div>');
             $('.next').prop('disabled', false);
        
        }
        

    })



})

$('input[name=CodigoTipoCobertura]:radio').on('change', function() {
    if(this.value!=""){
        if($(this).attr('bene')=="CENTRO SALUD EN OFICINA"){
            
            $('.botones').prop('disabled', false);  

        }else{
           
            $('.botones').prop('disabled', true);  

        }
  
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

