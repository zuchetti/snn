$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});


$(document).on("click", ".browseFimrma", function() {
    var file = $(this).parents().find(".filefirma");
    file.trigger("click");
  });
  $('#firmaDigital').change(function(e) {
 
    
    if(e.target.files[0]!=undefined){
        var fileName = e.target.files[0].name;
        $("#file1").val(fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("previewFirma").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    }else{
        document.getElementById("previewFirma").src = 'https://placehold.it/80x80';
    }
});


$(document).on("click", ".browseSello", function() {
    var file = $(this).parents().find(".filesello");
    file.trigger("click");
  });
  $('#selloDigital').change(function(e) {

    if(e.target.files[0]!=undefined){
        var fileName = e.target.files[0].name;
        $("#file2").val(fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("previewSello").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    }else{
        document.getElementById("previewSello").src = 'https://placehold.it/80x80';
    }
});


$('.agregar').click( function() {
    var tipo_doc = $("#tipo_doc").val();
    var num_doc = $("#num_doc").val();
    var nombres = $("#nombres").val();
    var ape_paterno = $("#ape_paterno").val();
    var ape_materno = $("#ape_materno").val();
    var sexo = $("#sexo").val();
    var fec_nacimiento = $("#fec_nacimiento").val();
    var email = $("#email").val();
    var telefono = $("#telefono").val();
    var asignacion_familiar = $("#asignacion_familiar").val();
    var idtipoprofesional = $("#idtipoprofesional").val();
    var tarifa = $("#tarifa").val();
    var cod_rns = $("#cod_rns").val();
    var cod_overall = $("#cod_overall").val();
    var fec_ingplanilla = $("#fec_ingplanilla").val();
    var idtipoplanilla = $("#idtipoplanilla").val();

    var password = $("#password").val();
    var password1 = $("#password1").val();
    console.log(password);

    if(password != password1){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button>Las contraseñas no coinciden</div>');
        return false;
    }

    if(password=="" || password==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la contraseña</div>');
        return false;
    }

    if(num_doc=="" || num_doc==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el número de documento</div>');
        return false;
    }
    if(nombres=="" || nombres==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el su nombre</div>');
        return false;
    }
    if(ape_paterno=="" || ape_paterno==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el apellido paterno</div>');
        return false;
    }
    if(ape_materno=="" || ape_materno==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el apellido materno</div>');
        return false;
    }

    if(sexo=="" || sexo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el sexo</div>');
        return false;
    }

    if(fec_nacimiento=="" || fec_nacimiento==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la fecha de nacimiento</div>');
        return false;
    }

    if(email=="" || email==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el correo electrónico</div>');
        return false;
    }

   
    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email)) {
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Correo electrónico inválido</div>');
        return false;
    }
    if(telefono=="" || telefono==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el telefono</div>');
        return false;
    }
    if(asignacion_familiar=="" || asignacion_familiar==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la asignación familiar</div>');
        return false;
    }

    if(idtipoprofesional=="" || idtipoprofesional==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la profesión</div>');
        return false;
    }

    if(tarifa=="" || tarifa==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la tarifa</div>');
        return false;
    }
    if(cod_rns=="" || cod_rns==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el código RNS</div>');
        return false;
    }

    if(cod_overall=="" || cod_overall==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el código OVERALL</div>');
        return false;
    }

    
    if(fec_ingplanilla=="" || fec_ingplanilla==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la fecha de ingreso a planilla</div>');
        return false;
    }

    if(idtipoplanilla=="" || idtipoplanilla==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la planilla</div>');
        return false;
    }


    var fima =$('#firmaDigital').val();
    if (fima=="" || fima==undefined) { 
        firmaDigital = "";
    }else{
        firmaDigital = $('#firmaDigital')[0].files[0];
    }

    var sello =$('#selloDigital').val();

    if (sello=="" || sello==undefined) { 

        selloDigital = "";

    }else{
        selloDigital = $('#selloDigital')[0].files[0];

    }


    var data = new FormData();
    data.append('tipo_doc', tipo_doc);
    data.append('num_doc', num_doc);
    data.append('nombres', nombres);
    data.append('ape_paterno', ape_paterno);
    data.append('ape_materno', ape_materno)
    data.append('sexo', sexo)
    data.append('fec_nacimiento', fec_nacimiento)
    data.append('email', email)
    data.append('telefono', telefono)
    data.append('asignacion_familiar', asignacion_familiar)
    data.append('idtipoprofesional', idtipoprofesional)
    data.append('tarifa', tarifa)
    data.append('cod_rns', cod_rns)
    data.append('cod_overall', cod_overall)
    data.append('fec_ingplanilla', fec_ingplanilla)
    data.append('idtipoplanilla', idtipoplanilla)
    data.append('firmaDigital', firmaDigital)
    data.append('selloDigital', selloDigital)
    data.append('password', password)

    $.ajaxSetup({headers:{'X-CSRF-Token': $('input[name="_token"]').val()}
     });
    $.ajax({
        enctype: 'multipart/form-data',
        url: 'aggPersonalMedico',        
        type: "POST",            
        data: data, 
        beforeSend: function() {     
            $('.agregar').prop('disabled', true);
            $(".spinner-border").fadeIn(200);　
        },			
        processData: false,
        contentType: false,
    }).done( function(data) {
            $(".spinner-border").hide();　
            obj = JSON.parse(data);

          
            if(obj.status == 200){
    
                $('#alerts').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+obj.message+'</div>');
                $('#boton').prop('disabled', true);
                window.setTimeout(function(){window.location.href = 'calendario_horariomedico?idprofesional='+obj.data.idprofesional},1000);

            }
     
            if(obj.status == 100){
                $('#alerts').html('<div class="alert alert-danger">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+obj.message+'</div>');
                 $('#boton').prop('disabled', false);
            
            }
            
        }) 
   

})

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

$('.decimales').on('input', function () {
    if(this.value!=undefined){
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    }
});
  
$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});