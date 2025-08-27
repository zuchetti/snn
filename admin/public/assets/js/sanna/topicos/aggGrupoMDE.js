///grupo medicament
$('.addMedicament').click( function() {

    var idgrupo = $('.selectpicker').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de medicamentos</div>');
        return false;
    }


    $.ajax({
        'url': "tableGrupoM",
        'data':{'idgrupo':idgrupo},
    }).done( function(data) {
  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idgroupM" value="'+value.idgrupo+'"></td>'+
                '<td>'+value.nombre+'</td>'+
                '<td>'+value.medicamentos+'</td>'+
            '</tr>';
            
        })
        $('#medicament').html(content);
       


    }) 

})


//grupo examen IMAGEN
$('.addgroupExamenI').click( function() {

    var idgrupo = $('#idgrupoExamenI').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts2').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de examenes imagen</div>');
        return false;
    }


    $.ajax({
        'url': "tableGrupoExamenI",
        'data':{'idgrupo':idgrupo,'tipo':0},
    }).done( function(data) {
  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idgroupI" value="'+value.idgrupo+'"></td>'+
                '<td>'+value.nombre+'</td>'+
                '<td>'+value.examenes+'</td>'+
            '</tr>';
            
        })
        $('#examenI').html(content);
       


    }) 

})


//GRUPO EXAMEN LABO

$('.addgroupExamenL').click( function() {

    var idgrupo = $('#idgrupoExamenL').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts3').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de examenes laboratorio</div>');
        return false;
    }


    $.ajax({
        'url': "tableGrupoExamenL",
        'data':{'idgrupo':idgrupo,'tipo':1},
    }).done( function(data) {
  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idgrupoL" value="'+value.idgrupo+'"></td>'+
                '<td>'+value.nombre+'</td>'+
                '<td>'+value.examenes+'</td>'+
            '</tr>';
            
        })
        $('#examenL').html(content);
       


    }) 

})


//GRUPO EXAMEN LABO

$('.addgroupDiagnostic').click( function() {

    var idgrupo = $('#idgrupoDiagnostic').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts4').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de diagnostico</div>');
        return false;
    }


    $.ajax({
        'url': "tableDiagnostico",
        'data':{'idgrupo':idgrupo},
    }).done( function(data) {
  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idgrupoD" value="'+value.idgrupo+'"></td>'+
                '<td>'+value.nombre+'</td>'+
                '<td>'+value.diagnosticos+'</td>'+
            '</tr>';
            
        })
        $('#diagnostic').html(content);
       


    }) 

})

$('.agregar').click( function() {
    var idbotiquin = $("#idbotiquin").val();

    //a
    var arrayM = [];
    var idgroupM;
    var contarIdgroupM = 0;
    var contarIdgroupL = 0;
    var contarIdgroupI = 0;
    var contarIdgroupD = 0;

    $("input[name='idgroupM']").each(function () {
        if (this.value!="") {
            contarIdgroupM++;

        }
    })

    $("input[name='idgroupI']").each(function () {
        if (this.value!="") {
            contarIdgroupI++;

        }
    })


    $("input[name='idgrupoL']").each(function () {
        if (this.value!="") {
            contarIdgroupL++;

        }
    })
    $("input[name='idgrupoD']").each(function () {
        if (this.value!="") {
            contarIdgroupD++;

        }
    })
    
    if(contarIdgroupM==0){
        $('#alerts5').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione al menos un grupo de medicamentos</div>');
        return false;
    }
    if(contarIdgroupI==0){
        $('#alerts5').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione al menos un grupo de examen imagen</div>');
        return false;
    }

    if(contarIdgroupL==0){
        $('#alerts5').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione al menos un grupo de examen laboratorio</div>');
        return false;
    }
    if(contarIdgroupD==0){
        $('#alerts5').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione al menos un grupo de diagnostico</div>');
        return false;
    }
    

    $("input[name='idgroupM']").each(function () {
        if (this.value!="") {
            arrayM.push($(this).val());
             idgroupM = arrayM.join(',');
        }
    })

    $.ajax({
        'url': "aggGrupoMTopico",
        'data':{'idgrupo_medi':idgroupM,'idbotiquin':idbotiquin},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

    })

    /////////////////////grupo imagen////////////////

    var arrayI = [];
    var idgroupI;
  
    
    $("input[name='idgroupI']").each(function () {
        if (this.value!="") {
            arrayI.push($(this).val());
             idgroupI = arrayI.join(',');
        }
    })


  


    $.ajax({
        'url': "aggGrupoExamenImgTopico",
        'data':{'idgrupo_examenI':idgroupI,'idbotiquin':idbotiquin},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

    })

    /////////////////////grupo imagen lab////////////////
    
    var arrayL = [];
    var idgrupoL;
  

    $("input[name='idgrupoL']").each(function () {
        if (this.value!="") {
            arrayL.push($(this).val());
             idgrupoL = arrayL.join(',');
        }
    })

 

    $.ajax({
        'url': "aggGrupoExamenLabTopico",
        'data':{'idgrupo_examenL':idgrupoL,'idbotiquin':idbotiquin},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);
    })



    /////DIAGNOSTICO////

    var arrayD = [];
    var idgrupoD;
   

    $("input[name='idgrupoD']").each(function () {
        if (this.value!="") {
            arrayD.push($(this).val());
             idgrupoD = arrayD.join(',');
        }
    })

 


    $.ajax({
        'url': "aggTopicoGrupoDiagnostico",
        'data':{'idgrupo_diag':idgrupoD,'idbotiquin':idbotiquin},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        
        obj = JSON.parse(data);

        if(obj.status == 200){

            $('#alerts5').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', true);
            setTimeout(function() {
            // location.reload();
                location.href='topicos';

            }, 2000);
        }

        if(obj.status == 100){
            $('#alerts5').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', false);
        
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