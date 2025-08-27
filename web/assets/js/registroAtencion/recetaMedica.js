

$(document).on('change','#recetafisica',function(){

    if( $(this).prop('checked')){
        $('#codigoreceta').val(0);
        $('#codigoreceta').attr('disabled',false);
       
     }else{
        $('#codigoreceta').attr('disabled',true);
      
     }
 })
var counter;
function getCounter(){
   if($("#contarm").val()!="" && $("#contarm").val()>0 ){
        counter = parseInt($("#contarm").val())+1;
    }else{
        counter = 0;
    }
 
    if(($("#contarm").val()==-1)){
        counter = 0;
    }
    if(($("#contarm").val()==0) && $("#contarm").val()!=undefined){
        counter = 1;
    }

    if($("#contarm").val()==""){
        console.log('entra')
        counter = 0;
    }
    var cont=0;
    $("input[name='idmedicamento']").each(function (index, value) {
        if (this.value!="") {
            cont++;
        }
    });

    if(($("#contarm").val()==-1) && cont>0){
        $("#contarm").val(cont)
        counter = cont+1;
    }


}
getCounter();

function arr(idmedicamento,counter){
    var c;
    $("[name='idmedicamento'").each(function (index, value) {
        if (this.value==idmedicamento && counter!=$(this).attr("counter")) {
           c = $("#cantidadE"+index).val();
        }
    });

    return c;
}

action = 0;
$(document).on('change','.botica-fuente',function(){
    tipo = $(this).val();
    action = 0;
    $(".botica-fuente").each(function () {
        if (this.value!="") {
           
           vl = $(this).val();
           if(vl==1){
             action = 1;
           }
        }
    
    })
    if(action==1){
        $("#delivery").prop("checked", true);
        $("#delivery").val(1);

    }else{
        $("#delivery").prop("checked", false);
        $("#delivery").val(0);
    }
})

$(document).ready(function(){
  

    ////agregar/////
    $(".agregar").click(function () {
        console.log(counter)

        var idmedicamento = $('#idmedicamento').val();

        if(idmedicamento=="" || idmedicamento==undefined){
            $('#alerts1').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione un medicamento</strong></div>');
            return false;
        }

       

        var newTextBoxDiv = $(document.createElement('tr')).attr("id",'mytr'+counter);
        
        
        $.ajax({
            'url': "addMedicament",
            'data':{'idmedicamento':idmedicamento},
        
        }).done( function(data) {
            obj = JSON.parse(data);

            var content="";

                $.each(obj.data, function(index, value) {
        
                    if(value.idmedicamento==idmedicamento){

                       

                        content += `
              
                            <td>
                                <input type="hidden" medic="` + counter + `"
                                counter="` + counter + `"
                                name="idmedicamento" id="idmedicamento` + counter + `" 
                                value="` + value.idmedicamento + `"><input type="hidden" name="idbotiquinitem` + counter + `" id="idbotiquinitem` + counter + `" value="` + value.idbotiquinitem + `">
                                <input type="hidden" name="cod_producto` + counter + `" id="cod_producto` + counter + `" 
                                value="` + value.cod_producto + `"><input type="hidden" name="producto` + counter + `" id="producto` + counter + `" value="` + value.producto + `">
                                ` + value.producto + `
                            </td>
                            <td>
                                <input type="number" id="cantidadE` + counter + `"
                                 class="form-control form-control-sm numbers"
                                name="cantidadE"   min='1' >
                            </td>
                           
                            <td>
                                <input type="text" id="dosis` + counter + `" class="form-control form-control-sm"
                                name="dosis` + counter + `">
                            </td>
                            <td>
                                <input type="hidden" id="presentacion` + counter + `" name="presentacion` + counter + `" 
                            value="` + value.presentacion + `">
                            <input type="hidden" id="presentacion_` + counter + `" name="presentacion_` + counter + `" 
                            value="` + value.presentacion_ + `">
                            ` + value.presentacion_ + `
                            </td>
                            <td>
                                <input type="text" id="via_administracion` + counter + `" class="form-control form-control-sm"
                                name="via_administracion` + counter + `">
                            </td>
                            <td>
                                <input type="text" id="frecuencia` + counter + `" class="form-control form-control-sm" 
                                name="frecuencia` + counter + `">
                            </td>
                            <td>
                                <input type="text" id="duracion` + counter + `"  class="form-control form-control-sm" name="duracion` + index + `">
                            </td>
                            <td width="15%">
                                <select class="form-control form-control-sm" id="cie10` + counter + `">
                                </select>
                            </td>

                            <td>
                            <select class="form-control botica-fuente form-control-sm` + counter + `" id="fuente` + counter + `"  name="fuente">
                                <option value=""></option>`;
                                var verif = arr(value.idmedicamento,counter);
                              
                                if(value.cantidad!=0 && (verif < value.stock || verif==undefined)){
                                    content += `<option value="0" >Botiquín ampliado</option>`;            
                                }
    content += `              <option value="1" >Fuente Externa</option>
                            </select>
                        </td>
                            
                            <td>
                                <input type="hidden" id="stock` + counter + `" 
                                name="stock` + index + `" value="` + value.cantidad + `">
                                ` + value.cantidad + `
                            </td>
                            <td>
                                <a class="delete" onclick="handleRemover(` + idmedicamento + `,` + counter + `)"><i  class="fas fa-minus-circle"></i></a>
                            </td>
                        `;
                
                    }
                })
                newTextBoxDiv.after().html(content);
                newTextBoxDiv.appendTo("#tableMedicaments");
                getCIE10(counter)
                $("#contarm").val(counter);

                counter++;
            

                $(".numbers").bind('keypress', function(event) {
                    var regex = new RegExp("^[0-9]+$");
                    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                    if (!regex.test(key)) {
                      event.preventDefault();
                      return false;
                    }
                });
        

        }) 
      
    });

   ///enviar
    
});

function getCIE10(counter){

    var arrayCie10=$("#arrayCie10").val(); 
    var ar = arrayCie10.split(',');

    $.ajax({
        'url': "getDiagnosticos",
    }).done( function(data) {
        obj = JSON.parse(data);
        console.log(obj);
        var arrayDiag = [];

        $.each(obj.data, function(i, value) {
            if(ar.includes(value.cie10)==true){
                arrayDiag.push({
                    'iddiagnostico':value.iddiagnostico,
                    'diagnostico':value.diagnostico,
                    'cie10':value.cie10
                });
            }
            
        })

        
        var option ="<option value=''></option>";
        $.each(arrayDiag, function(index,item) {
          
            option +=`<option value="` + item.cie10 + `">` + item.cie10 + `</option>`; 
        })
        $('#cie10'+counter).html(option);

    })

}


 function handleRemover2(idmedicamento,key){ 

    $.ajax({
        'url': "deletetableMedicament",
        'data':{'idmedicamento':idmedicamento},
    }).done( function(data) {
        console.log(data);
        $("#mytr"+key).remove();
        location.reload();
    }) 
  

}
 
function handleRemover(idmedicamento,counter){ 
    
    $("#mytr"+counter).remove();

    if(counter==0){
        $("#contarm").val(-1);
        getCounter();

    }else{
        counter--;
        var a=  $("#contarm").val() - 1;
        $("#contarm").val(a)
        getCounter();
    }


   
}




$('.generar').click( function() {

 
    var indicaciones = $("#indicaciones").val();
    var medicamentoslista=[];
    var dni = $("#dni").val();

    var iddepartamento = $("#idubigeo").val();
    var idprovincia = $("#idprovincia").val();

    var idubigeo = $("#idDistriro").val();
    

    var idubigeo = $("#idDistriro").val();
    var direccion = $("#direccion").val();
    var referencia = $("#referencia").val();
    var telf1 = $("#telf1").val();
    var telf2 = $("#telf2").val();
    var email = $("#email").val();
    var delivery = $("#delivery").val();
    var codigoreceta = $("#codigoreceta").val();


    if(delivery==undefined || delivery==null || delivery=="" || delivery=="on"){
        delivery=0;
    }


    var contar;

    var contarfinter=0;
    var contarfext=0;
    var medic=0;
    var prueba=0;
  
    $("[name='idmedicamento'").each(function (index, value) {
        if (this.value!="") {
            if(index==0){
                medic= $(this).attr("medic")
            }
            prueba++;
        }
    });

    var array_medic = [];
    var array_medic_cantidad = [];

    $("[name='idmedicamento'").each(function () {
        if (this.value!="") {
            array_medic.push($(this).val())
        }
    });

    $("[name='cantidadE'").each(function () {
        if (this.value!="") {
            array_medic_cantidad.push($(this).val())
        }
    });
    
    var pruea_arr = [];
    for(m=0;m<array_medic.length;m++){
       pruea_arr.push({
           'idmedicamento': array_medic[m],
           'cantidade': array_medic_cantidad[m]
       })
    }



    if(medic!=0){
        contar=prueba;
    }else{
        contar= $("#contarm").val();
    }

    console.log(contar)

   
       
    if(contar!="" && contar!=-1){

       
        for(var i=medic; i<= contar; i++){
    
            if($("#cantidadE"+i).val()>parseInt($("#stock"+i).val()) && $("#fuente"+i).val()==0){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> La cantidad del medicamento '+i+' no puede se mayor al stock </strong></div>');
                return false;
            }
            if($("#cantidadE"+i).val()==0){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> La cantidad del medicamento '+i+' no puede menor o igual a 0 </strong></div>');
                return false;
            }

            if($("#dosis"+i).val()=="" || $("#dosis"+i).val()==undefined){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Ingrese la dosis del medicamento '+i+' </strong></div>');
                return false;
            }

            if($("#via_administracion"+i).val()=="" || $("#via_administracion"+i).val()==undefined){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Ingrese la vía de administración del medicamento '+i+' </strong></div>');
                return false;
            }

            if($("#frecuencia"+i).val()=="" || $("#frecuencia"+i).val()==undefined){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Ingrese la frecuencia del medicamento '+i+' </strong></div>');
                return false;
            }

            if($("#duracion"+i).val()=="" || $("#duracion"+i).val()==undefined){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Ingrese la duración del medicamento '+i+' </strong></div>');
                return false;
            }

            
            if($("#cie10"+i).val()=="" || $("#cie10"+i).val()==undefined){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Seleccione el cie10 del medicamento '+i+' </strong></div>');
                return false;
            }

            
            if($("#fuente"+i).val()=="" || $("#fuente"+i).val()==undefined){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Seleccione la fuente del medicamento '+i+' </strong></div>');
                return false;
            }
        
            if($("#fuente"+i).val()==0){
                contarfinter++;
            }
            if($("#fuente"+i).val()==1){
                contarfext++;
            }
            
            medicamentoslista.push({
                idbotiquinitem: $("#idbotiquinitem"+i).val(),
                idmedicamento: $("#idmedicamento"+i).val(),
                cod_producto : $("#cod_producto"+i).val(),
                producto: $("#producto"+i).val(),
                cantidad: $("#cantidadE"+i).val(),
                dosis:$("#dosis"+i).val(),
                presentacion: $("#presentacion"+i).val(),
                presentacion_: $("#presentacion_"+i).val(),
                via_administracion:$("#via_administracion"+i).val() ,
                frecuencia: $("#frecuencia"+i).val(),
                duracion: $("#duracion"+i).val(),
                cie10: $("#cie10"+i).val(),
                fuente: $("#fuente"+i).val(),
                stock: $("#stock"+i).val()
            })
        }
    }

    //console.log(medicamentoslista)

   

    if(medicamentoslista.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Seleccione al menos un medicamento</strong></div>');
        return false;
    }
    console.log(contarfext);
    if(contarfext>0){
       
    if(direccion=="" || direccion==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese dirección </strong></div>');
        return false;
    }
        if(idubigeo=="" || idubigeo==undefined){
            $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione departamento </strong></div>');
            return false;
        }
        if(referencia=="" || referencia==undefined){
            $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese la referencia </strong></div>');
            return false;
        }
        if(email=="" || email==undefined){
            $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese email </strong></div>');
            return false;
        }
        if(telf1=="" || telf1==undefined){
            $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese telefono </strong></div>');
            return false;
        }
    }

    if(contarfinter>7){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>El limite de medicamentos para botica interna es de 7</strong></div>');
        return false;
    }
    if(contarfext>7){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>El limite de medicamentos para botica externa es de 7</strong></div>');
        return false;
    }


    if(indicaciones=="" || indicaciones==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese las indicaciones </strong></div>');
        return false;
    }

    if(codigoreceta=="" || codigoreceta==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el código de la receta </strong></div>');
        return false;
    }




   
    if(delivery==1 && (idubigeo=="" || idubigeo==undefined || idubigeo==null )){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Complete la selección de: Departamento,Provincia,Distrito</strong></div>');
        return false;
    }
    
    if(delivery==1 && (direccion=="" || direccion==undefined)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la dirección</strong></div>');
        return false;
    }

    if(delivery==1 && (referencia=="" || referencia==undefined)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la referencia</strong></div>');
        return false;
    }

    if(delivery==1 && (telf1=="" || telf1==undefined) && (telf2=="" || telf2==undefined)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la Teléfono 1 ó el Teléfono 2</strong></div>');
        return false;
    }
    
    if(delivery==1 && (telf2=="" || telf2==undefined) && (telf1=="" || telf1==undefined)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese la Teléfono 1 ó el Teléfono 2</strong></div>');
        return false;
    }
    if(delivery==1 && (email=="" || email==undefined)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese el Correo electrónico</strong></div>');
        return false;
    }
    var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    if (!regex.test(email) && delivery==1) {

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Correo electrónico inválido</strong></div>');
        return false;
    }

    var delivery_datos = new Object();


    if(delivery==1){
      
        delivery_datos.dni = dni;
        delivery_datos.iddepartamento=iddepartamento;
        delivery_datos.idprovincia=idprovincia;
        delivery_datos.idubigeo = idubigeo;
        delivery_datos.direccion = direccion;
        delivery_datos.referencia = referencia;
        delivery_datos.telf1 = telf1;
        delivery_datos.telf2 = telf2;
        delivery_datos.email = email;
    }


    $.ajax({
        'url': "save_receta_session",
        'data':{'indicaciones':indicaciones,'medicamentoslista':medicamentoslista,
        'delivery':delivery,'delivery_datos':delivery_datos,'codigoreceta':codigoreceta},
        beforeSend: function() {
            $('.generar').prop('disabled', true);  
            $("#spiner3").fadeIn(200);　
        }
    }).done( function(data) {
      
        $("#spiner3").hide();　
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
                        <a href="examenesAuxiliares" id="aceptar" class="btn" >Aceptar</a>
                    </div>
                </div>
            </div>
            `;
            $("#exampleModal").modal("show");
            $('#contentModal').html(contentModal);
          
            
            //window.setTimeout(function(){window.location.href = 'diagnostico'},1000);

        }
 

    }) 




})



$('#idmedicamento').select2({
    tags: false,
    allowClear: true,
    placeholder: {
      id: '-1', // the value of the option
      text: 'Seleccione una opción'
    }
});



function handleChangeFuente(fuente,counter){


    var cantidad = parseInt($("#cantidadE"+counter).val());
    var stock =parseInt($("#stock"+counter).val());

    if(cantidad!=undefined && fuente.value==0 && cantidad<stock){
        console.log(stock)
        console.log(cantidad)

        cantidad_fin= parseInt(stock) - parseInt(cantidad);
        $("#stockfuent0"+counter).html(cantidad_fin)
        
    }
    if(cantidad!=undefined && fuente.value==0 && cantidad>=stock){
        $("#stockfuent0"+counter).html(0)
    }
    if(fuente.value==1 && cantidad!=undefined){
        $("#stockfuent0"+counter).html(stock)
        $("#stock"+counter).val(stock)
    }

}

function handleChangeCantidad(c,counter,stoc){
 
    var cantidad = parseInt(c.target.value);
    var stock =parseInt(stoc);
    var fuente =$("#fuente"+counter).val();

    console.log(cantidad)
    console.log(stock)

    if(cantidad!=undefined && (fuente==0 && fuente!="") && cantidad<stock){
        cantidad_fin= parseInt(stock) - parseInt(cantidad);
        $("#stockfuent0"+counter).html(cantidad_fin)
    }
    if(cantidad!=undefined && fuente==0 && cantidad>=stock){
        $("#stockfuent0"+counter).html(0)
    }
    if(fuente==1 && cantidad!=undefined){
        $("#stockfuent0"+counter).html(stock)
        $("#stock"+counter).val(stock)
    }
}



$('#delivery').change(function() {
    if(this.checked) {
        $("#delivery").val(1);
        $('#idubigeo').prop('disabled', false);
        $('#direccion').prop('disabled', false);
        $('#referencia').prop('disabled', false);
        $('#telf1').prop('disabled', false);
        $('#telf2').prop('disabled', false);
        $('#email').prop('disabled', false);

    }else{
        $("#delivery").val(0);

        $('#idubigeo').prop('disabled', true);
        $('#direccion').prop('disabled', true);
        $('#referencia').prop('disabled', true);
        $('#telf1').prop('disabled', true);
        $('#telf2').prop('disabled', true);
        $('#email').prop('disabled', true);
        $('#idprovincia').prop('disabled', true);
        $('#idDistriro').prop('disabled', true);

    }
     
});


if($('#idubigeo').val()){

    console.log($('#idubigeo').val())

    getProvincia($('#idubigeo').val())

}
//Departamento
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

////Provincia

function getProvincia(idubigeo){


    $.ajax({
        'url': "get_provincia",
        'data': { 'idparent': idubigeo},
        'success': function(data) {
            $('#idprovincia').removeAttr('disabled');
            obj = JSON.parse(data);
         
            var option ="";
            option += `<option value="">Seleccionar</option>`;
            $.each(obj.data, function(i, value) {
               
                option += `
                    <option value="` + value.idubigeo + `"`; 
                    if(value.idubigeo==$("#idprovinciaselec").val())                    {  
              
                        option += `selected`;
                    } 
                    option += `>`  + value.nombre + `</option> `;

            })
            $('#idprovincia').html(option);

           


        }
    })
}
if($('#idprovinciaselec').val()){


    getDistrito($('#idprovinciaselec').val())

}

function getDistrito(iddepartamento){


    $.ajax({
        'url': "get_distrito",
        'data': { 'idparent': iddepartamento},
        'success': function(data) {
            $('#idDistriro').removeAttr('disabled');
            obj = JSON.parse(data);
        
            var option ="";
            option += `<option value="">Seleccionar</option>`;
            $.each(obj.data, function(i, value) {
              

                    option += `
                    <option value="` + value.idubigeo + `"`; 
                    if(value.idubigeo==$("#idubigeoselec").val())                    {  
              
                        option += `selected`;
                    } 
                    option += `>`  + value.nombre + `</option> `;

            })
            $('#idDistriro').html(option);


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




//validar solo numeros



$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});


$(".letrasyn").bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
   }
});