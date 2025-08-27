$('.generar').click( function() {

    var presuncion_diagnostica = $("#presuncion_diagnostica").val();
    var presuncion = presuncion_diagnostica.join(',');
    var periodo = $("#periodo").val();

    if(presuncion_diagnostica=="" || presuncion_diagnostica==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Presunción diagnóstica </strong></div>');
        return false;
    }

    
    if(periodo=="" || periodo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el periodo</strong></div>');
        return false;
    }

    $.ajax({
        'url': "save_descanso_session",
        'data':{'presuncion_diagnostica':presuncion,'periodo':periodo},
        beforeSend: function() {
            $('.generar').prop('disabled', true);  
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
                    <div class="col-md-6">
                        <a href="finish_attention" id="aceptar" class="btn" >Aceptar</a>
                    </div>
                </div>
            </div>
            `;
            $("#exampleModal").modal("show");
            $('#contentModal').html(contentModal);
          
        }
    })


})
fechanew ='';
fechaini = $('#fechaini').val();
var fecha2 = new  Date(fechaini);
fecha2.setDate(fecha2.getDate() + 1);
var options = { year: 'numeric', month: 'long', day: 'numeric' };
$('#fecharegistro').val(fecha2.toLocaleDateString("es-ES", options));

$(document).on('change','#periodo',function(){
    periodo = $('#periodo').val();
    fechaini = $('#fechaini').val();
    
    var fecha = new  Date(fechaini);
    var dias = parseInt(periodo); // Número de días a agregar
    // var dias= dias  + 1; 
    fecha.setDate(fecha.getDate() + dias);
    console.info(fecha)
     
    
    var options = { year: 'numeric', month: 'long', day: 'numeric' };
    $('#fechafin').val(fecha.toLocaleDateString("es-ES", options));

   
    
    
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


$(".numbers").bind('keypress', function(event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
});

$('#presuncion_diagnostica').select2({
    tags: false,
    tokenSeparators: [',', ' '],
    placeholder: {
      id: '-1', // the value of the option
      text: 'Seleccione una opción'
    }
});
