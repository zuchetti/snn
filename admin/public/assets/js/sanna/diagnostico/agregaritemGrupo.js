//OVERLAY
$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

////------click crear grupo------
$('.agregar').click( function() {
         
    var idgrupo=($(this).attr("idgrupo"));
    var nombre=($(this).attr("nombre"));           
    var arrayD = [];
    var iddiagnostico;
    $("input[name='iddiagnostico']").each(function () {
        if (this.value!="") {
            arrayD.push($(this).val());
        }
    })

    iddiagnostico = arrayD.join(',');

 
    if(arrayD.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Seleccione un <strong> diagnóstico</strong></div>');
        return false;
    }
  

    $.ajax({
        'url': "agregarDiagnosticoGrupo",
        'data':{'idgrupo':idgrupo,'iddiagnostico':iddiagnostico},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
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

            window.setTimeout(function(){window.location.href = 'detalleGrupoDiagnostico?idgrupo='+idgrupo+'&nombre='+nombre},1000);

        
        }
         
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', false);
        }
            
        
    })

})

//agregar diagnostico
$('.addMedicament').click( function() {

    var iddiagnostico = $('.selectpicker').val();

    if(iddiagnostico=="" || iddiagnostico==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione un diagnostico</div>');
        return false;
    }

    console.log(iddiagnostico)

    $.ajax({
        'url': "addDiagnostico",
        'data':{'iddiagnostico':iddiagnostico},
    }).done( function(data) {

        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="iddiagnostico" value="'+value.iddiagnostico+'"></td>'+
                '<td>'+value.diagnostico+'</td>'+
                '<td>'+value.cie10+'</td>'+
            '</tr>';
            
        })
        $('#diagnosticoss').html(content);
    

    }) 

})