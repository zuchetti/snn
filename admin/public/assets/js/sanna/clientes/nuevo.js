$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});

$('.agregar').click( function() {
    var empresa = $('#empresa').val();
    var arrayD = [];
    var contar = 0;

    if(empresa=="" || empresa==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ingrese el nombre del cliente</div>');
        return false;
    }

    $("input[name='sedes']").each(function () {
        if (this.value!="") {
            contar++;
        }
    })
    if(contar==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ingrese el nombre de la sede</div>');
        return false;
    }
    $("input[name='sedes']").each(function () {
        if (this.value!="") {
           
            arrayD.push($(this).val());
        }
    })
    sedes = arrayD.join(',');

    $.ajax({
        'url': "addEmpresa",
        'data':{'sedes':sedes,'empresa':empresa},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);
        
        if(obj.status == 200){
    
            $('#alerts2').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', true);

            window.setTimeout(function(){window.location.href = 'clientes'},1000);

        
        }
         
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('#boton').prop('disabled', false);
        }
            
        
    })


})

$('.addother').click( function() {

    var empresa = $('#empresa').val();
    var sede = $('#sede').val();

    var contar = [];
    $("input[name='sede']").each(function () {
        if (this.value!="") {
           contar++;
        }
    })
    console.log(contar)

    if(contar>0){
        $("#empresa").prop( "disabled", true );
    }

    if(empresa=="" || empresa==undefined){
        $('#alerts2').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ingrese el nombre del cliente</div>');
        return false;
    }

    if(sede=="" || sede==undefined){
        $('#alerts2').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Ingrese la sede</div>');
        return false;
    }






    $.ajax({
        'url': "clienteTable",
        'data':{'sede':sede,'empresa':empresa},
    }).done( function(data) {

  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td></td>'+
                '<td>'+value.empresa+'</td>'+
                '<td><input name="sedes" value="'+value.sede+'" type="hidden">'+value.sede+'</td>'+
            '</tr>';
            
        })
        $('#clienteTable').html(content);
       


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