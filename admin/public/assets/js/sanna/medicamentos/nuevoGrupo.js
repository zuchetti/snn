

////------click crear grupo------

$('.addMedicament').click( function() {

    var idmedicamento = $('#idmedicamento').val();
    var cantidad = $('#cantidad').val();


    if(idmedicamento=="" || idmedicamento==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione un medicamento</div>');
        return false;
    }
    
    if(cantidad=="" || cantidad==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ingrese la cantidad</div>');
        return false;
    }
    
    $.ajaxSetup({headers:{'X-CSRF-Token': $('input[name="_token"]').val()}
        });

    $.ajax({
        'url': "addMedicament",
        'data':{'idmedicamento':idmedicamento,'cantidad':cantidad},
    }).done( function(data) {
  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" data-cantidad="'+value.cantidad+'" name="idmedicamento" value="'+value.idmedicamento+'">'+value.cod_producto+'</td>'+
                '<td>'+value.producto+'</td>'+
                '<td>'+value.descripcion+'</td>'+
                '<td>'+value.cantidad+'</td>'+
            '</tr>';
            
        })
        $('#medicament').html(content);
       


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


function createGroup(){
           
        var nombregrupo=$("#nombregrupo").val();

        if(!$("#nombregrupo").val()){
            $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert"> ' +
                '&times;</button>  Ingrese el <strong> nombre del grupo</strong></div>');
            return false;
        
        }
        var listamedicamentos = [];

        $("input[name=idmedicamento]").each(function () {
            if (this.value!="") {
                var cantidad = $(this).data('cantidad');

                listamedicamentos.push({
                    'idmedicamento': this.value,
                    'cantidad': cantidad,
                }); 
            }
        })

        if(listamedicamentos.length==0){
            $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert"> ' +
                '&times;</button> Debe agregar al menos un medicamento</strong></div>');
            return false;
        
        }


        //console.log(listamedicamentos);
        $.ajaxSetup({headers:{'X-CSRF-Token': $('input[name="_token"]').val()}
        });

        $.ajax({
            'url': "createMedicamento",
            'data':{'nombregrupo':nombregrupo,'listamedicamentos':listamedicamentos},
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
                window.setTimeout(function(){window.location.href = 'medicamentos'},1000);
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
 
    var listamedicamentos = [];

    var idgrupo=($(this).attr("idgrupo"));
    var nombre=($(this).attr("nombre"));

    $("input[name=idmedicamento]").each(function () {
        if (this.value!="") {
            var cantidad = $(this).data('cantidad');

            listamedicamentos.push({
                    'idmedicamento': this.value,
                    'cantidad': cantidad,
            }); 
        }
    })

    $.ajax({
        'url': "agregarMedicamentoGrupo",
        'data':{'idgrupo':idgrupo,'listamedicamentos':listamedicamentos},
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
            $('#boton').prop('disabled', true);
            setTimeout(function() {
               // location.reload();
                location.href='detalleGrupo?idgrupo='+idgrupo+'&nombre='+nombre;

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