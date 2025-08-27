
////------click crear grupo------

function createGroup(){
           
    var nombregrupo=$("#nombregrupo").val();

    if(!$("#nombregrupo").val()){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times;</button>  Ingrese el <strong> nombre del grupo</strong></div>');
        return false;
    
    }
  

    var arrayExamenes = [];
    var idexamenauxiliar;
    $("input[name=idexamenauxiliar]").each(function () {
        if (this.value!="") {
            arrayExamenes.push($(this).val());
        }
    })
    idexamenauxiliar = arrayExamenes.join(',');

    console.log(arrayExamenes)


    if(arrayExamenes.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times;</button> Debe agregar al menos un examen</strong></div>');
        return false;
    
    }


    //console.log(listamedicamentos);

    $.ajax({
        'url': "createExamenGrupo",
        'data':{'nombregrupo':nombregrupo,'idexamenauxiliar':idexamenauxiliar},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){

            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', true);
            window.setTimeout(function(){window.location.href = 'examenauxiliar'},1000);
        }
 
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
             $('#boton').prop('disabled', false);
        
        }
    

    })
 
}

$('.agregarItem').click( function() {
    var arrayExamenes = [];
    var idexamenauxiliar;
    $("input[name=idexamenauxiliar]").each(function () {
        if (this.value!="") {
            arrayExamenes.push($(this).val());
        }
    })
    idexamenauxiliar = arrayExamenes.join(',');

    console.log(arrayExamenes)


    if(arrayExamenes.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times;</button> Debe agregar al menos un examen</strong></div>');
        return false;
    
    }
    var idgrupo=($(this).attr("idgrupo"));
    var nombre=($(this).attr("nombre"));

    $.ajax({
        'url': "agregarExamenGrupo",
        'data':{'idgrupo':idgrupo,'idexamenauxiliar':idexamenauxiliar},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){
            $('#boton').prop('disabled', true);

            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            setTimeout(function() {
                location.href='detalleGrupoExamen?idgrupo='+idgrupo+'&nombre='+nombre;
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

//agregar examen lab
$('.addMedicament').click( function() {

    var idexamenauxiliar = $('.selectpicker').val();

    if(idexamenauxiliar=="" || idexamenauxiliar==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione un examen</div>');
        return false;
    }



    $.ajax({
        'url': "addExamenLab",
        'data':{'idexamenauxiliar':idexamenauxiliar},
    }).done( function(data) {

  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idexamenauxiliar" value="'+value.idexamenauxiliar+'"></td>'+
                '<td>'+value.examen+'</td>'+
                '<td>'+value.precio+'</td>'+
            '</tr>';
            
        })
        $('#examenLab').html(content);
       


    }) 

})

//agregar examen imagen
$('.addMedicamentI').click( function() {

    var idexamenauxiliar = $('.selectpicker').val();

    if(idexamenauxiliar=="" || idexamenauxiliar==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione un examen</div>');
        return false;
    }



    $.ajax({
        'url': "addExamenImagen",
        'data':{'idexamenauxiliar':idexamenauxiliar},
    }).done( function(data) {

  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idexamenauxiliar" value="'+value.idexamenauxiliar+'"></td>'+
                '<td>'+value.examen+'</td>'+
                '<td>'+value.precio+'</td>'+
            '</tr>';
            
        })
        $('#examenImagen').html(content);
       


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