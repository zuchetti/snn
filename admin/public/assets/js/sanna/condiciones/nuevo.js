$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});

$('.agregar').click( function() {
    var condicion = $("#condicion").val();


    if(condicion=="" || condicion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert"> ' +
        '&times; </button> Ingrese el nombre de la condición</div>');
        return false;
    }

    $.ajax({
        'url': "addCondicion",
        'data':{'condicion':condicion},
        beforeSend: function() {
            $('.agregar').prop('disabled', true);  
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
            window.setTimeout(function(){window.location.href = 'condiciones'},1000);

        }
 
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
             $('#boton').prop('disabled', false);
        }


    
    })
})