// Función de ayuda para escapar caracteres HTML y prevenir XSS.
function escapeHtml(unsafe) {
    if (!unsafe) return '';
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex        : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});


/* $('#idempresa').click(function(){
    idempresa = $(this).val();
    if(idempresa!=""){
        getSede(idempresa);
    }else{
        $('#idSede').prop('disabled', true);
    }
});


var idempresa=$("#idempresag").val();

getSede(idempresa);
function getSede(idempresa){

    $.ajax({
        'url': "getSedeEmpresa",
        'data': { 'idempresa': idempresa},
        'success': function(data) {
            $('#idSede').removeAttr('disabled');

            obj = JSON.parse(data);
            console.log(obj);
            var option ="";

            $.each(obj.data, function(i, value) {
                // CORRECCIÓN APLICADA: Sanificar el texto de la opción
                const sanitizedEmpresa = escapeHtml(value.empresa);
                option += `<option value="` + escapeHtml(value.idempresa) + `"`; 
                if(value.idempresa==$("#idsede").val())
                { 
                    option += `selected`;
                } 
                option += `>` + sanitizedEmpresa + `</option> `;
            })
            $('#idSede').html(option); // Mejor usar .html para reemplazar
        }
    })
} */

//pais
$('#idubigeo').change(function(){
    $('#idprovincia').prop('disabled', true);
    $('#idDistriro').prop('disabled', true);
    idubigeo = $(this).val();
    
    if(idubigeo!=""){
        getProvincia(idubigeo)
    }else{
        $('#idprovincia').prop('disabled', true);
        $('#idDistriro').prop('disabled', true);
    }
});

var idubigeo=$("#idpais").val();
getProvincia(idubigeo)

function getProvincia(idubigeo){
    
    $.ajax({
        'url': "getProvincia",
        'data': { 'idparent': idubigeo},
        'success': function(data) {
            $('#idprovincia').removeAttr('disabled');
            obj = JSON.parse(data);
            
            var option ="";
            $.each(obj.data, function(i, value) {
                // CORRECCIÓN APLICADA: Sanificar el texto de la opción
                const sanitizedNombre = escapeHtml(value.nombre);
                option += `<option value="` + escapeHtml(value.idubigeo) + `"`; 
                if(value.idubigeo==$("#iddepartamento").val())
                {   
                    option += `selected`;
                } 
                option += `>` + sanitizedNombre + `</option> `;
            })
            $('#idprovincia').html(option);
        }
    })
}


//provincia
$('#idprovincia').change(function(){
    $('#idDistriro').prop('disabled', true);
    var idparent = $(this).val();
    
    if(idparent!=""){
        getDistrito(idparent);
    }else{
        $('#idDistriro').prop('disabled', true);
    }
});

var iddepartamento=$("#iddepartamento").val();
getDistrito(iddepartamento)

function getDistrito(iddepartamento){
    
    $.ajax({
        'url': "getDistrito",
        'data': { 'idparent': iddepartamento},
        'success': function(data) {
            $('#idDistriro').removeAttr('disabled');
            obj = JSON.parse(data);
            
            var option ="";
            $.each(obj.data, function(i, value) {
                // CORRECCIÓN APLICADA: Sanificar el texto de la opción
                const sanitizedNombre = escapeHtml(value.nombre);
                option += `<option value="` + escapeHtml(value.idubigeo) + `"`; 
                if(value.idubigeo==$("#iddistrito").val())
                { 
                    option += `selected`;
                } 
                option += `>` + sanitizedNombre + `</option> `;
            })
            $('#idDistriro').html(option);
        }
    })
}

$('.agregar').click( function() {
    var selectedItem = $('#idprofesionales').val();
    idprofesionales = selectedItem.join(',');
    var selectedItemidtipocondicion = $('#idtipocondicion').val();
    var idtipocondicion = selectedItemidtipocondicion.join(',');
    var selectedItemidtiposeguro = $('#idtiposeguro').val();
    var idtiposeguro = selectedItemidtiposeguro.join(',');
    var pais = $(".pais").val();
    var idprovincia = $("#idprovincia").val();
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
    var myRadio = $('input[type=radio]:checked').val();

    if(myRadio==undefined){
        var cod_almacen = $("#cod_almacen").val();
    }

    if(myRadio==1){
        var cod_almacen = $("#cod_almacen2").val();
    }

    if(myRadio==0){
        var cod_almacen = $("#cod_almacen").val();
    }

    // Validación y sanificación de mensajes de alerta
    if(idempresa=="" || idempresa==undefined){
        const message = "Seleccione el cliente";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + '</div>');
        return false;
    }
    
    if(pais=="" || pais==undefined){
        const message = "Seleccione el departamento";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(idprovincia=="" || idprovincia==undefined){
        const message = "Seleccione la provincia";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(idubigeo=="" || idubigeo==undefined){
        const message = "Seleccione el distrito";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(direccion=="" || direccion==undefined){
        const message = "Ingrese la dirección";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(nombre=="" || nombre==undefined){
        const message = "Ingrese la sede";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(cod_cso=="" || cod_cso==undefined){
        const message = "Ingrese código cso";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(botiquin_ampliado=="" || botiquin_ampliado==undefined){
        const message = "Seleccion botiquin ampliado";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(botiquin_ampliado==1 && (cod_almacen=="" || cod_almacen==undefined)){
        const message = "Ingrese el código de almacén";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
 
    if(idprofesionales=="" || idprofesionales==undefined){
        const message = "Seleccione las especialidades";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(fec_apertura=="" || fec_apertura==undefined){
        const message = "Seleccione la fecha de apertura";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(estado=="" || estado==undefined){
        const message = "Seleccione el estado";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(idtipocondicion=="" || idtipocondicion==undefined){
        const message = "Seleccione el tipo de condición";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(idtiposeguro=="" || idtiposeguro==undefined){
        const message = "Seleccione el tipo de seguro";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(idaseguradora=="" || idaseguradora==undefined){
        const message = "Seleccione la aseguradora";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
    if(broker=="" || broker==undefined){
        const message = "Ingrese el nombre del broker";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(email_broker=="" || email_broker==undefined){
        const message = "Ingrese el correo electrónico del broker";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_broker)) {
        const message = "<strong>El correo electrónico del broker es inválido</strong>";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
        return false;
    }

    if(tlf_broker=="" || tlf_broker==undefined){
        const message = "Ingrese el teléfono del broker";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }
 
    if(ejecutivo=="" || ejecutivo==undefined){
        const message = "Ingrese el nombre del broker";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(email_ejecutivo=="" || email_ejecutivo==undefined){
        const message = "Ingrese el correo ejecutivo";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_ejecutivo)) {
        const message = "Email ejecutivo inválido";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }

    if(tlf_ejecutivo=="" || tlf_ejecutivo==undefined){
        const message = "Ingrese el teléfono del broker";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(admincuenta=="" || admincuenta==undefined){
        const message = "Ingrese el nombre del administrador de cuenta";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    if(email_admincuenta=="" || email_admincuenta==undefined){
        const message = "Ingrese el correo electrónico del administrador de cuenta";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email_admincuenta)) {
        const message = "Email de administrador de cuenta inválido";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + escapeHtml(message) + '</div>');
        return false;
    }

    if(tlf_admincuenta=="" || tlf_admincuenta==undefined){
        const message = "Ingrese el teléfono del administrador de cuenta";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert"> ' +
            '&times; </button> ' + escapeHtml(message) + ' </div>');
        return false;
    }

    var idtopico = $("#idtopico").val();
    
    $.ajax({
        'url': "updateTopico",
        'data':{'idtopico':idtopico,'idempresa':idempresa,'nombre':nombre,'cod_cso':cod_cso,
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

        console.log(obj);

        if(obj.status == 200){
            const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
            $('#alerts').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+sanitizedMessage+'</div>');
            $('#boton').prop('disabled', true);
            window.setTimeout(function(){window.location.href = 'topicos'},1000);
        }
 
        if(obj.status == 100){
            const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
            $('#alerts').html('<div class="alert alert-danger">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button>'+sanitizedMessage+'</div>');
            $('#boton').prop('disabled', false);
        }
    })
    
})

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

var myRadio;
function handleClick(myRadio) {
    var x = document.getElementById("codigoal");
    var z = document.getElementById("codigoal1");
    var botiquin_ampliado = $('input[type=radio]:checked').val();

    if(myRadio==1 && botiquin_ampliado==1){
        x.style.display = "block";
    }
    if(myRadio==0 && botiquin_ampliado==0){
        z.style.display = "none";
    }

    if(myRadio==1 && botiquin_ampliado==0){
        x.style.display = "block";
    }
}