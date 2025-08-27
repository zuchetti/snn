$(document).on('change','#funcionniega',function(){

    if( $(this).prop('checked')){
        $('#tem').val(0);
        $('#pa').val(0);
        $('#fc').val(0);
        $('#fr').val(0);
        $('#peso').val(0);
        $('#talla').val(0);
        $('#imc').val(0);
        $('#saturacion').val(0);

        $('#tem').attr('disabled',true);
        $('#pa').attr('disabled',true);
        $('#fc').attr('disabled',true);
        $('#fr').attr('disabled',true);
        $('#peso').attr('disabled',true);;
        $('#talla').attr('disabled',true);
        $('#imc').attr('disabled',true);
        $('#saturacion').attr('disabled',true);
     }else{
        $('#tem').attr('disabled',false);
        $('#pa').attr('disabled',false);
        $('#fc').attr('disabled',false);
        $('#fr').attr('disabled',false);
        $('#peso').attr('disabled',false);;
        $('#talla').attr('disabled',false);
        $('#imc').attr('disabled',false);
        $('#saturacion').attr('disabled',false)

        $('#tem').val('');
        $('#pa').val('');
        $('#fc').val('');
        $('#fr').val('');
        $('#peso').val('');
        $('#talla').val('');
        $('#imc').val('');
        $('#saturacion').val('');
         
        
     }
 })

$(document).ready(function(){
    pa = $('#pa');

    pa.on('input',function(){
        te = pa.val();
        telimpio = te.replace(/[^0-9/]/g, '');
        pa.val(telimpio);

        console.log(te);
    })
})


$('.generar').click( function() {

    var fecha = $("#fecha").val();
    var hora = $("#hora_atencion").val();
    var edad = $("#edad").val();
    var motivo_consulta = $("#motivo_consulta").val();
    var forma_inicio = $("#forma_inicio").val();
    var curso = $("#curso").val();
    var tiempo_enfermedad = $("#tiempo_enfermedad").val();
    var relato_cronologico = $("#relato_cronologico").val();
    var apetito = $("#apetito").val();
    var sed = $("#sed").val();
    var suenho = $("#suenho").val();
    var animo = $("#animo").val();
    var fur = $("#fur").val();
    var ram = $("#ram").val();
    var orina = $("#orina").val();
    var deposiciones = $("#deposiciones").val();
    var tem = $("#tem").val();
    var pa = $("#pa").val();
    var fc = $("#fc").val();
    var fr = $("#fr").val();
    var peso = $("#peso").val();
    var talla = $("#talla").val();
    var imc = $("#imc").val();
    var saturacion = $("#saturacion").val();
    var sexo = $("#sexo").val();

    var orinaObj = {};

    orinaObj['id'] = orina;
    orinaObj['comentario'] = $("#comentarioO").val();

    
    var disposicioObj = {};

    disposicioObj['id'] = deposiciones;
    disposicioObj['comentario'] = $("#comentariod").val();

    if(sexo==2){
        // if(fur=="" || fur==undefined){
        //     $('#alerts').html('<div class="alert alert-info">' +
        //         '<button type="button" class="close" data-dismiss="alert">' +
        //         '&times;</button> Ingrese la fecha FUR </strong></div>');
        //     return false;
        // }
    }
    if(motivo_consulta=="" || motivo_consulta==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el motivo de la consulta </strong></div>');
        return false;
    }
    if(saturacion=="" || saturacion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese la saturación </strong></div>');
        return false;
    }
    if(orina=="" || orina==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese la orina </strong></div>');
        return false;
    }
    if(deposiciones=="" || deposiciones==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese las deposiciones </strong></div>');
        return false;
    }
    if(forma_inicio=="" || forma_inicio==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese forma de inicio </strong></div>');
        return false;
    }
    if(curso=="" || curso==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el curso </strong></div>');
        return false;
    }
    if(tiempo_enfermedad=="" || tiempo_enfermedad==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el tiempo de enfermedad </strong></div>');
        return false;
    }

    if(relato_cronologico=="" || relato_cronologico==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ingrese el relato cronologico </strong></div>');
        return false;
    }


    if(ram=="" || ram==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo ram </strong></div>');
        return false;
    }

    if(apetito=="" || apetito==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo apetito </strong></div>');
        return false;
    }

    if(sed=="" || sed==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo sed </strong></div>');
        return false;
    }

    if(suenho=="" || suenho==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo sueño </strong></div>');
        return false;
    }

    
    console.log($("#idmodalidad").val())

    if((tem=="" || tem==undefined) && $("#idmodalidad").val()!=0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo temperatura </strong></div>');
        return false;
    }



    if((pa=="" || pa==undefined)  && $("#idmodalidad").val()!=0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo pa </strong></div>');
        return false;
    }

    if((fc=="" || fc==undefined)  && $("#idmodalidad").val()!=0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo fc </strong></div>');
        return false;
    }

    if((fr=="" || fr==undefined)  && $("#idmodalidad").val()!=0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo fr </strong></div>');
        return false;
    }

    if((peso=="" || peso==undefined)  && $("#idmodalidad").val()!=0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo peso </strong></div>');
        return false;
    }


    if((talla=="" || talla==undefined)  && $("#idmodalidad").val()!=0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Falta llenar el campo talla </strong></div>');
        return false;
    }


    var cie10Array = $('#cie10').val();

    var cie10 = cie10Array.join(',');

    
    if(cie10=="" || cie10==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el diagnóstico  </strong></div>');
        return false;
    }

    var checkcntar=0;
    var estadogeneral=0;
    var estadoconciencia=0;

    $('input[name=check]').each(function () {
        if (this.checked) {
            checkcntar++;
        }
    })
    $('input[name=estadogeneral]').each(function () {
        if (this.value!="") {
            estadogeneral++;
        }
    })
    $('input[name=estadoconciencia]').each(function () {
        if (this.value!="") {
            estadoconciencia++;
        }
    })

    if((estadogeneral || estadoconciencia) < checkcntar){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Debe completar los campos en Examen clínica regional </strong></div>');
        return false;
    }

    var clinica_regional=[];
    estadogeneralv =$("#estadogeneralprincipal").val();
    estadoconcienciav=$("#estadoconcienciaprincipal").val()
    if(estadogeneralv=="" || estadogeneralv==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el estado general </strong></div>');
        return false;
    }
    if(estadoconcienciav=="" || estadoconcienciav==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el estado de conciencia </strong></div>');
        return false;
    }

    clinica_regional.push({
        'id': -1,
        'nombre': "Estado General",
        'estadogeneral': $("#estadogeneralprincipal").val(),
        'estadoconciencia': '',
    });
    clinica_regional.push({
        'id': -2,
        'nombre': "Estado de Conciencia",
        'estadogeneral': '',
        'estadoconciencia': $("#estadoconcienciaprincipal").val(),
    });

   
    

    $('input[name=check]').each(function () {
        if (this.checked) {
            id=$(this).val();
            clinica_regional.push({
                'id': id,
                'nombre': $(this).attr('nombre'),
                'estadogeneral': $("#estadogeneral"+id).val(),
                'estadoconciencia': $("#estadoconciencia"+id).val(),
            }); 
        }
    });

    

    console.log(clinica_regional.length);
    
    if(clinica_regional.length==2){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese como mínimo un exámen regional </strong></div>');
        return false;
    }

    $.ajax({
        'url': "save_diagnostic_session",
        'data':{'cie10':cie10,'fecha':fecha,'hora':hora,
        'edad':edad,'motivo_consulta':motivo_consulta,'forma_inicio':forma_inicio,
        'curso':curso,'tiempo_enfermedad':tiempo_enfermedad,'relato_cronologico':relato_cronologico,
        'apetito':apetito,'sed':sed,'suenho':suenho,'fur':fur,'ram':ram,'orina':orinaObj,'deposiciones':disposicioObj,
        'tem':tem,'pa':pa,'fc':fc,'fr':fr,'peso':peso,'talla':talla,'imc':imc,
        'clinica_regional':clinica_regional,'saturacion':saturacion
        },
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
      

        if(data == 'ok'){

     
            $('#boton').prop('disabled', true);

            var contentModal = "";
            contentModal += 
            `<div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-check"></i>
                </div>

                <div id="textM">
                    <div>Datos guardados</div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">`;
                        if($("#tipo_atencion").val()==0){
                            contentModal += 
                            `<a href="recetaMedica" id="aceptar" class="btn" >Aceptar</a>`;

                        }else{
                            contentModal += 
                            `<a href="finish_attention" id="aceptar" class="btn" >Aceptar</a>`;
                        }
  contentModal += 
                ` </div>
                </div>
            </div>
            `;
            $("#exampleModal").modal("show");
            $('#contentModal').html(contentModal);
        }
    
    })


})





$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

$('#cie10').select2({
    tags: false,
    tokenSeparators: [',', ' '],
    placeholder: {
      id: '-1', // the value of the option
      text: 'Seleccione una opción'
    }
});


$('.decimales').on('input', function () {
    if(this.value!=undefined){
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    }
});

var peso;
var talla;
$('#peso').on('input',function(){
    peso = $(this).val();

    if(peso!=undefined && talla!=undefined){
        imc = parseFloat(peso) / parseFloat(Math.pow(talla, 2));
        $("#imc").val(imc.toFixed(2));

    }else{
        $("#imc").val('');
    }
   
})

$('#talla').on('input', function () {
    talla = $(this).val();
    if(peso!=undefined && talla!=undefined){
        imc = parseFloat(peso) / parseFloat(Math.pow(talla, 2));
        $("#imc").val(imc.toFixed(2));

    }else{
        $("#imc").val('');

    }
   
});


//changecheck

$("input[name=check]").change(function(){

    if (this.checked) {
        id =$(this).val();
        console.log(id)
        $('#estadogeneral'+id).prop("disabled", false); 
        $('#estadoconciencia'+id).prop("disabled", false); 
    }else{
        id =$(this).val();
        $('#estadogeneral'+id).prop("disabled", true); 
        $('#estadoconciencia'+id).prop("disabled", true); 
    }

})


$('#orina').change(function() {

   
    if ($(this).val()!="") {
        console.log('entra')
        if($(this).val()==2){
            $('.divo').show();
        }else{
            $('.divo').hide();
        }
        
    }else{
        $('.divo').hide();
        $("#comentarioO").val('');
    }

});

$('#deposiciones').change(function() {
    if ($(this).val()!="") {
        if($(this).val()==2){
            $('.divd').show();
        }else{
            $('.divd').hide();
        }
        
    }else{
        $('.divd').hide();
        $("#comentariod").val('');
    }

});


