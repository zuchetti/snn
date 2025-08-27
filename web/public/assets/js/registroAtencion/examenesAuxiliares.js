
$('.generar').click( function() {

    //EXAMENES IMAGENES
    var indicaciones_I = $("#indicaciones_I").val();

    //EXAMENES LABORATORIO
    var indicaciones_L = $("#indicaciones_L").val();


    //validar

    var checkcntar=0;
    var cantidad=0;
    var cie10=0;

    $('select[name=examenI]').each(function () {
        if (this.value!="") {
            checkcntar++;
        }
    })
    $('input[name=cantidadI]').each(function () {
        if (this.value!="") {
            cantidad++;
        }
    })
    $('select[name=cie10I]').each(function () {
        if (this.value!="") {
            cie10++;
        }
    })


    if((cantidad || cie10) < checkcntar){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Debe completar los campos cantidad y/o cie10 </strong></div>');
        return false;
    }

    //img

    var examenlista_I = [];

   
    $("[name='examenI'").each(function (index,value) {
        if (this.value!="") {           
           
            var element = $("option:selected", value);        
            examenlista_I.push({
                idexamenauxiliar: $(this).val(),
                examen: element.attr("examen"),
                cie10: $("#cie10_"+index).val(),
                cant: $("#cantidad_"+index).val()
            });
        } 
    });

    console.log(examenlista_I)

    //return false;

    if(!$('#indicaciones_I').val() && examenlista_I.length>0){
                    
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese las indicaciones en examenes de imagen</strong></div>');
        return false;
    }

    if($('#indicaciones_I').val()!="" && examenlista_I.length==0){
                    
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Seleccione al menos un examen de imagen</strong></div>');
        return false;
    }

    //lab
    var checkcntarl=0;
    var cantidadl=0;
    var cie10l=0;

    $('select[name="examenL"]').each(function () {
        if (this.value!="") {
            checkcntarl++;
        }
    })
    $('input[name="cantidadL"]').each(function () {
        if (this.value!="") {
            cantidadl++;
        }
    })
    $('select[name="cie10L"]').each(function () {
        if (this.value!="") {
            cie10l++;
        }
    })

    if((cantidadl || cie10l) < checkcntarl){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Debe completar los campos cantidad y/o cie10 </strong></div>');
        return false;
    }

  


    var examenlista_L=[];

    $("[name='examenL'").each(function (index,value) {
        if (this.value!="") {           
            var element = $("option:selected", value);        
            examenlista_L.push({
                idexamenauxiliar: $(this).val(),
                examen: element.attr("examen"),
                cie10: $("#cie10_L"+index).val(),
                cant: $("#cantidadL_"+index).val()
            });
        } 
    });
    console.log(examenlista_L)



    if($('#indicaciones_L').val()!="" && examenlista_L.length==0){
                    
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Seleccione al menos un examen de laboratorio</strong></div>');
        return false;
    }

    if(($('#indicaciones_L').val()=="" || $('#indicaciones_L').val()==undefined) && examenlista_L.length>0){
                    
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese las indicaciones en examenes de laboratorio</strong></div>');
        return false;
    }

    if(examenlista_L.length==0 && examenlista_I.length==0){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Debe ingresar al menos un examen</strong></div>');
        return false;
    }
  

    if(examenlista_L.length==0){
        var lab = {};
    }else{
        var lab = {};
        lab['indicaciones'] = indicaciones_L;
        lab['examenlista'] = examenlista_L;
    
    }


    if(examenlista_I.length==0){
        var img = {};
    }else{
        var img = {};
        img['indicaciones'] = indicaciones_I;
        img['examenlista'] = examenlista_I
    }



    $.ajax({
        'url': "save_examenes_session",
        'data':{'lab':lab,'img':img},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
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
                        <a href="descansoMedico" id="aceptar" class="btn" >Aceptar</a>
                    </div>
                </div>
            </div>
            `;
            $("#exampleModal").modal("show");
            $('#contentModal').html(contentModal);

        }
 
       

    })



})

var counter;
function getCounter(){
    if($("#contarmI").val()!=undefined && $("#contarmI").val()>0){
        counter = parseInt($("#contarmI").val());
    }else{
        counter = 1;
    }
    
}

var counter2;
function getCounter2(){
    if($("#contarmL").val()!=undefined && $("#contarmL").val()>0){
        counter2 = parseInt($("#contarmL").val());
    }else{
        counter2 = 1;
    }
    
}
////agregar EXAMEN LAB/////

getCounter2();   
$(".agregarExamiL").click(function () {

        var newTextBoxDiv = $(document.createElement('div')).attr("id",'lista2'+counter2);

        content = '';
        content += `
        <div class="row">
            <div class="col-md-5">
                <select  class="input form-control" name="examenL"  id="examenL` + counter2 + `" onchange="getval2(this,` + counter2 + `);">
                `;
                getExamenL(counter2)
content += `    </select>
            </div>
            <div class="col-md-2">
                <input type="number" min="1"  name="cantidadL" disabled id="cantidadL_` + counter2 + `"
                class="input form-control form-control-sm numbers">
            </div>
            <div class="col-md-3">
                <select class="form-control form-control-sm" name="cie10L" disabled id="cie10_L`+counter2+`">
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger" onclick="handleRemover2(`+counter2+`)"><i style="color:#fff;" class="fas  fa-minus-circle"></i></button>
            </div>
        </div>
        `;
        newTextBoxDiv.after().html(content);
        newTextBoxDiv.appendTo("#otros2");
        prueba();
        getCIE102(counter2)
        counter2++;

})

////agregar EXAMEN IMAGE/////
getCounter();   
$(".agregarExami").click(function () {

        var newTextBoxDiv = $(document.createElement('div')).attr("id",'lista'+counter);

        content = '';
        content += `
        <div class="row">
            <div class="col-md-5">
                <select  class="input form-control" name="examenI"  id="examenI` + counter + `" onchange="getval(this,` + counter + `);">
                `;
                getExamenI(counter)
content += `    </select>
            </div>
            <div class="col-md-2">
                <input type="number" min="1"  name="cantidadI" disabled id="cantidad_` + counter + `"
                class="input form-control form-control-sm numbers">
            </div>
            <div class="col-md-3">
                <select class="form-control form-control-sm" name="cie10Ihhh" disabled id="cie10_`+counter+`">     
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger" onclick="handleRemover(`+counter+`)"><i style='color:#fff;' class="fas  fa-minus-circle"></i></button>
            </div>
        </div>
        `;
        newTextBoxDiv.after().html(content);
        newTextBoxDiv.appendTo("#otros");
        prueba();
        getCIE10(counter)
        counter++;

})


function handleRemover(key){ 
    $("#lista"+key).remove();
    counter--;
}

function handleRemover2(key){ 
    $("#lista2"+key).remove();
    counter2--;
}


function prueba(){

    $('select[name="examenI"]').select2({
        tags: false,
        allowClear: true,
        placeholder: {
          id: '-1', // the value of the option
          text: 'Seleccione una opción'
        }
    });

    $('select[name="examenL"]').select2({
        tags: false,
        allowClear: true,
        placeholder: {
          id: '-1', // the value of the option
          text: 'Seleccione una opción'
        }
    });
}
prueba();

function getval(select,id){

    if(select.value!=""){
        $('#cantidad_'+id).prop("disabled", false); 
        $('#cie10_'+id).prop("disabled", false); 
    }else{
        $('#cantidad_'+id).prop("disabled", true); 
        $('#cie10_'+id).prop("disabled", true); 
    }

}

function getval2(select,id){

    if(select.value!=""){
        $('#cantidadL_'+id).prop("disabled", false); 
        $('#cie10_L'+id).prop("disabled", false); 
    }else{
        $('#cantidadL_'+id).prop("disabled", true); 
        $('#cie10_L'+id).prop("disabled", true); 
    }

}




//validar solo numeros

$(".numbers").bind('keypress', function(event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
});


function getCIE10(counter){

    var arrayCie10=$("#arrayCie10").val(); 
    var ar = arrayCie10.split(',');

    $.ajax({
        'url': "getDiagnosticos",
    }).done( function(data) {
        obj = JSON.parse(data);
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
          
            option +=`<option value="` + item.cie10 + `">` + item.diagnostico + `</option>`; 
        })
        $('#cie10_'+counter).html(option);

    })

}

function getCIE102(counter2){

    var arrayCie10=$("#arrayCie10").val(); 
    var ar = arrayCie10.split(',');

    $.ajax({
        'url': "getDiagnosticos",
    }).done( function(data) {
        obj = JSON.parse(data);
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
          
            option +=`<option value="` + item.cie10 + `">` + item.diagnostico + `</option>`; 
        })
        $('#cie10_L'+counter2).html(option);

    })



}

function getExamenI(counter){
    $.ajax({
        'url': "getExamenImgTopico",
    
    }).done( function(data) {
        obj = JSON.parse(data);

        var option ="<option value=''></option>";
        $.each(obj.data, function(i, value) {
           
            option += `
                <option examen="` + value.examen + `" value="` + value.idexamenauxiliar + `">` + value.examen + `</option>`; 
                
        })
        $('#examenI'+counter).html(option);
    })
}

function getExamenL(counter2){
    $.ajax({
        'url': "getExamenLabTopico",
    
    }).done( function(data) {
        obj = JSON.parse(data);

        var option ="<option value=''></option>";
        $.each(obj.data, function(i, value) {
           
            option += `
                <option examen="` + value.examen + `" value="` + value.idexamenauxiliar + `">` + value.examen + `</option>`; 
                
        })
        $('#examenL'+counter2).html(option);
    })
}

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});