

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});


$('.agregar').click( function() {

    var arrayD = [];
    var idactivofijo;
    $("input[name=idactivofijo]").each(function () {
        if (this.value!="") {
            arrayD.push($(this).val());
        }
    })
    idactivofijo = arrayD.join(',');

    if(arrayD.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Seleccione un <strong> activo fijo </strong></div>');
        return false;
    }

  
 
    var nombregrupo=$("#nombregrupo").val();

    if(!$("#nombregrupo").val()){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el <strong> nombre del grupo</strong></div>');
        return false;
    
    }

    $.ajax({
        'url': "createGrupoActivoFijo",
        'data':{'nombregrupo':nombregrupo,'idactivofijo':idactivofijo},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $('#boton').prop('disabled', true);  

        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){

            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            window.setTimeout(function(){window.location.href = 'activosfijos'},1000);
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

    var idactivofijo = $('#idactivofijo').val();
    console.log(idactivofijo)

    if(idactivofijo=="" || idactivofijo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione un activo fijo</div>');
        return false;
    }



    $.ajax({
        'url': "addActivoFijo",
        'data':{'idactivofijo':idactivofijo},
    }).done( function(data) {
   

        var content="";
        $.each(data, function(i, value) {
            //console.log(value.marca)
            content += '<tr>'+
                '<td><input type="hidden" name="idactivofijo" value="'+value.idactivofijo+'"></td>'+
                '<td>'+value.marca+'</td>'+
                '<td>'+value.modelo+'</td>'+
                '<td>'+value.serie+'</td>'+
                '<td>'+value.precio+'</td>'+
          
            '</tr>';
            
        })
        $('#activosTable').html(content);
       


    }) 

})



$('.aggitem').click( function() {
    var idgrupo=($(this).attr("idgrupo"));
    var nombre=($(this).attr("nombre"));
    console.log()

    var arrayD = [];
    var idactivofijo;
    $("input[name=idactivofijo]").each(function () {
        if (this.value!="") {
            arrayD.push($(this).val());
        }
    })
    idactivofijo = arrayD.join(',');

    if(arrayD.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Seleccione un <strong> activo fijo </strong></div>');
        return false;
    }

    $.ajax({
        'url': "agregarActivofijoGrupo",
        'data':{'idgrupo':idgrupo,'idactivofijo':idactivofijo},
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
            setTimeout(function() {
               // location.reload();
                location.href='detalleGrupoActivosFijos?idgrupo='+idgrupo+'&nombre='+nombre;
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
