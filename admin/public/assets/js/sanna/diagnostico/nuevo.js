$('.agregar').click( function() {
    var diagnostico = $("#diagnostico").val();
    var cie10 = $("#cie10").val();

    if(diagnostico=="" || diagnostico==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el diagnóstico</div>');
        return false;
    }
    if(cie10=="" || cie10==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el cie 10</div>');
        return false;
    }


    $.ajax({
        'url': "aggDiagnostico",
        'data':{'cie10':cie10,'diagnostico':diagnostico},
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
            setTimeout(function() {
                location.href='administrarDiagnosticos';

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


$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});

$('.decimales').on('input', function () {
    this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
 });


 ///validar solo numeros
function valideKey(evt) {
    var code = evt.which ? evt.which : evt.keyCode;
    if (code == 8) {
        //backspace
        return true;
    } else if (code >= 48 && code <= 57) {
        //is a number
        return true;
    } else {
        return false;
    }
}
