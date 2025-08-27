/* $('#idempresa').click(function(){
    var idempresa = $(this).val();
    if(idempresa!=""){
        $.ajax({
            'url': "getSedeEmpresa",
            'data': { 'idempresa': idempresa},
            'success': function(data) {
                $('#idSede').removeAttr('disabled');
                //$("#idSede").addClass("selectpicker");

                obj = JSON.parse(data);
               
                var option ="<option value=''></option>";

                $.each(obj.data, function(i, value) {

                    
                    option += `
                        <option value="` + value.idempresa + `">` + value.empresa + `</option>
                    `;

                })
                $('#idSede').append(option); 


            }
        })
    }else{
        $('#idSede').prop('disabled', true);
    }
});
 */

 
 

$('#idubigeo').change(function(){
    $('#idprovincia').prop('disabled', true);
    $('#idDistriro').prop('disabled', true);

    var idparent = $(this).val();
   
    if(idparent!=""){
        $.ajax({
            'url': "getProvincia",
            'data': { 'idparent': idparent},
            'success': function(data) {
                $('#idprovincia').removeAttr('disabled');
                obj = JSON.parse(data);


            
                var option ="<option value=''></option>";
                $.each(obj.data, function(i, value) {

                    
                    option += `
                        <option value="` + value.idubigeo + `">` + value.nombre + `</option>
                    `;

                })
                $('#idprovincia').html(option);


            }
        })
    }else{
        $('#idprovincia').prop('disabled', true);
        $('#idDistriro').prop('disabled', true);
    }
});

$('#idprovincia').change(function(){
    $('#idDistriro').prop('disabled', true);

    var idparent = $(this).val();
   
    if(idparent!=""){
        $.ajax({
            'url': "getDistrito",
            'data': { 'idparent': idparent},
            'success': function(data) {
                $('#idDistriro').removeAttr('disabled');
                obj = JSON.parse(data);
            
                var option ="<option value=''></option>";

                $.each(obj.data, function(i, value) {

                    
                    option += `
                        <option value="` + value.idubigeo + `">` + value.nombre + `</option>
                    `;

                })
                $('#idDistriro').html(option);


            }
        })
    }else{
        $('#idDistriro').prop('disabled', true);
    }
});


$('.agregar').click( function() {

 
    var selectedItem = $('#idprofesionales').val();

    idprofesionales = selectedItem.join(',');

    var selectedItemidtipocondicion = $('#idtipocondicion').val();
    var idtipocondicion = selectedItemidtipocondicion.join(',');


    var selectedItemidtiposeguro = $('#idtiposeguro').val();
    var idtiposeguro = selectedItemidtiposeguro.join(',');

    var pais = $(".pais").val();
    var idprovincia = $("#idprovincia").val();
    //var idSede = $("#idSede").val();

    var idempresa = $("#idempresa").val();
    var nombre = $("#nombre").val();
    var cod_cso = $("#cod_cso").val();
    var fec_apertura = $("#fec_apertura").val();
    var idubigeo = $("#idDistriro").val();
    var direccion = $("#direccion").val();
    var estado = $("#estado").val();
    var idaseguradora = $("#idaseguradora").val();

    //EJECUTIVO
    var ejecutivo = $("#ejecutivo").val();
    var email_ejecutivo = $("#email_ejecutivo").val();
    var tlf_ejecutivo = $("#tlf_ejecutivo").val();

    //ADMIN CUENTA
    var admincuenta = $("#admincuenta").val();
    var email_admincuenta = $("#email_admincuenta").val();
    var tlf_admincuenta = $("#tlf_admincuenta").val();

    //EMPRES ASEGURADORA
    var broker = $("#broker").val();
    var email_broker = $("#email_broker").val();
    var tlf_broker = $("#tlf_admincuenta").val();

    var botiquin_ampliado = $('input[type=radio]:checked').val();
    
    var cod_almacen = $("#cod_almacen").val();

   if(idempresa=="" || idempresa==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el cliente</div>');
        return false;
    }
    
    if(pais=="" || pais==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el departamento </div>');
        return false;
    }
    if(idprovincia=="" || idprovincia==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la provincia </div>');
        return false;
    }
    if(idubigeo=="" || idubigeo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el distrito </div>');
        return false;
    }
    if(direccion=="" || direccion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la dirección </div>');
        return false;
    }

    if(nombre=="" || nombre==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese la sede </div>');
        return false;
    }
    if(cod_cso=="" || cod_cso==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese código cso </div>');
        return false;
    }

    if(botiquin_ampliado=="" || botiquin_ampliado==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccion botiquin ampliado </div>');
        return false;
    }

    if(botiquin_ampliado==1 && (cod_almacen=="" || cod_almacen==undefined)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert"> ' +
        '&times; </button> Ingrese el código de almacén </div>');
        return false;
    }



 
    if(idprofesionales=="" || idprofesionales==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione las especialidades </div>');
        return false;
    }

    if(fec_apertura=="" || fec_apertura==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la fecha de apertura </div>');
        return false;
    }
    if(estado=="" || estado==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione  el estado </div>');
        return false;
    }
    if(idtipocondicion=="" || idtipocondicion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el tipo de condición </div>');
        return false;
    }
    if(idtiposeguro=="" || idtiposeguro==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione el tipo de seguro </div>');
        return false;
    }

    if(idaseguradora=="" || idaseguradora==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Seleccione la aseguradora </div>');
        return false;
    }
    if(broker=="" || broker==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el nombre del broker </div>');
        return false;
    }

    if(email_broker=="" || email_broker==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el correo electrónico del broker </div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_broker)) {
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button><strong>El correo electrónico del broker es inválido</div>');
        return false;
    }

    if(tlf_broker=="" || tlf_broker==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el teléfono del broker </div>');
        return false;
    }
  
    if(ejecutivo=="" || ejecutivo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el nombre del broker </div>');
        return false;
    }

    if(email_ejecutivo=="" || email_ejecutivo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el correo ejecutivo </div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_ejecutivo)) {
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Email ejecutivo inválido</div>');
        return false;
    }

    if(tlf_ejecutivo=="" || tlf_ejecutivo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el teléfono del broker </div>');
        return false;
    }

    if(admincuenta=="" || admincuenta==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> Ingrese el nombre del administrador de cuenta </div>');
        return false;
    }

    if(email_admincuenta=="" || email_admincuenta==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert"> ' +
        '&times; </button> Ingrese el correo electrónico del administrador de cuenta </div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_admincuenta)) {
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Email de administrador de cuenta inválido</div>');
        return false;
    }

    if(tlf_admincuenta=="" || tlf_admincuenta==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert"> ' +
        '&times; </button> Ingrese el teléfono del administrador de cuenta </div>');
        return false;
    }

    $.ajaxSetup({headers:{'X-CSRF-Token': $('input[name="_token"]').val()}
     });

    $.ajax({
        'url': "aggTopico",
        'data':{'idempresa':idempresa,'nombre':nombre,'cod_cso':cod_cso,
        'fec_apertura':fec_apertura,'idubigeo':idubigeo,'direccion':direccion,'estado':estado,'idaseguradora':idaseguradora
        ,'idtiposeguro':idtiposeguro,'idtipocondicion':idtipocondicion,'idprofesionales':idprofesionales,
        'ejecutivo':ejecutivo,'email_ejecutivo':email_ejecutivo,'tlf_ejecutivo':tlf_ejecutivo,'admincuenta':admincuenta,'email_admincuenta':email_admincuenta,
        'tlf_admincuenta':tlf_admincuenta,'broker':broker,'email_broker':email_broker,'tlf_broker':tlf_broker,'botiquin_ampliado':botiquin_ampliado,
        'cod_almacen':cod_almacen},
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
          
            window.setTimeout(function(){window.location.href = 'calendario_horariotopico?idtopico='+obj.data.idtopico+'&idbotiquin='+obj.data.idbotiquin+'&new=0'},1000);

        }
 
        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
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



//validaciones

$(".numbers").bind('keypress', function(event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
});


$('.decimales').on('input', function () {
    this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
 });


$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});

function handleClick(myRadio) {
  
    var x = document.getElementById("codigoal");

    if(myRadio==1){
        x.style.display = "block";
    }else{
        x.style.display = "none";
    }
}