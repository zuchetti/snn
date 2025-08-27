//search select

function selectSearch(sel) {

    divC = document.getElementById("diVdoc");
    divC.style.display = 'none'

    if (sel.value=="doc"){
         divC = document.getElementById("documento");
         divC.style.display = 'block';

         divC = document.getElementById("diVnombres");
         divC.style.display = 'none';

         $("#nombres").val('');
         $("#ape_paterno").val('');
         $("#ape_materno").val('');

    }

    if (sel.value=="selectnombresyapellidos"){
        divC = document.getElementById("documento");
        divC.style.display = 'none';

        divC = document.getElementById("diVnombres");
        divC.style.display = 'block';
    
         $("#num_doc").val('');

   }
   
  
    if (sel.value==""){
        divC = document.getElementById("documento");
        divC.style.display = 'none';

        divC = document.getElementById("diVnombres");
        divC.style.display = 'none';

        $("#nombres").val('');
        $("#ape_paterno").val('');
        $("#ape_materno").val('');
         $("#num_doc").val('');
    }   


}

//tipo doc select
var tipo_doc;
function tipoDoc(sel) {
  
    if (sel.value=="1" || sel.value=="2" || sel.value=="3"){
         divC = document.getElementById("diVdoc");
         divC.style.display = 'block'
         tipo_doc=sel.value;
    }else{
        divC = document.getElementById("diVdoc");
        divC.style.display = 'none'
        var num_doc = $("#num_doc").val('');
    }

    if (sel.value=="7"){
        $('.pacienteC').removeClass('disabled');  
        $('.ingresar').prop('disabled', true);  

    }

}



var iafas;
$('.selectpicker').change(function () {
 
    if($('.selectpicker').val()!=""){
        iafas = $('.selectpicker').val();
        $('#search').prop('disabled', false);  

    }else{
        $('#search').prop('disabled', true);  
    }
 
});

$('.ingresar').click( function() {
    var tipo_doc = $("#tipo_doc").val();
    var num_doc = $("#num_doc").val();
    var nombres = $("#nombres").val();
    var ape_paterno = $("#ape_paterno").val();
    var ape_materno = $("#ape_materno").val();
    var search = $("#search").val();


    if(iafas=="" || iafas==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione la aseguradora </strong></div>');
        return false;
    }

    if(search=="" || search==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el tipo de busqueda </strong></div>');
        return false;
    }

  
    if(search=='doc' && (tipo_doc!=undefined || tipo_doc!="") && (num_doc==undefined || num_doc=="") && (tipo_doc!=7)){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese el número de documento </strong></div>');
        return false;

    }

    if(search=='doc' && (tipo_doc!=7)){
        $('.pacienteC').removeClass('disabled');  
        $('.ingresar').prop('disabled', false);  
        
    }

    if(search=='selectnombresyapellidos' && (nombres==undefined || nombres=="")){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese el primer y segundo nombre </strong></div>');
        return false;

    }

   /*  if(search=='selectnombresyapellidos' && (ape_paterno==undefined || ape_paterno=="")){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese el apellido paterno </strong></div>');
        return false;

    } */
/* 
    if(search=='selectnombresyapellidos' && (ape_materno==undefined || ape_materno=="")){

        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese el apellido materno </strong></div>');
        return false;

    } */



 
    $.ajax({
        'url': "getPaciente",
        'data': {'num_doc':num_doc,'tipo_doc':tipo_doc,'nombres':nombres,'ape_paterno':ape_paterno,'ape_materno':ape_materno,'iafas':iafas},
        beforeSend: function() {
            $('.ingresar').prop('disabled', true);  
            $("#spinner1").fadeIn(200);　
        },
        'success': function(data) {

            var contenido = '<table class="table table-bordered">'+
            '<thead>'+
                '<tr>'+
                    '<th scope="col">Cod.Product</th>'+
                    '<th scope="col">Nombre contratante</th>'+
                    '<th scope="col">Nombres</th>'+
                    '<th scope="col">Ape.Paterno</th>'+
                    '<th scope="col">Ape.Materno</th>'+
                    '<th scope="col">Estado</th>'+
                    '<th scope="col">Ver información</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody>';
            if(data!=undefined){
                obj = JSON.parse(data);

            
       
                $("#spinner1").hide();　
                $('.ingresar').prop('disabled', false);  
    
               
                if(obj.status==200){
                        $.each(obj.data, function(i, value) {
                            contenido += `
                                <tr>
                                    <td>` + value.CodProducto + `</td>
                                    <td>` + value.NombreContratante + `</td>
                                    <td>` + value.NombresAfiliado + `</td>
                                    <td>` + value.ApellidoPaternoAfiliado + `</td>
                                    <td>` + value.ApellidoMaternoAfiliado + `</td>
                                    <td>` + value.DesEstado + `</td>`
                                    if(value.CodEstado==1){
                                    
                        contenido += `<td bgcolor="yellow" style="color:#000;font-weight:500;">
                                        <a href="infoGeneral?NumeroPlan=` + value.NumeroPlan + `&iafas=` + iafas + `&nombres=` + nombres + `&ape_paterno=` + ape_paterno + `&ape_materno=`+ ape_materno +`&tipo_doc=`+tipo_doc +`&num_doc=`+num_doc +`&CodEstado=`+value.CodEstado +`">
                                            <i class="fas fa-info-circle" style="color:#01a851;font-size:18px"></i>
                                        </a>
                                    </td>`;
                                }
                                if(value.CodEstado>1 && value.CodEstado!=""){
                                    contenido += `<td bgcolor="yellow" style="color:#000;font-weight:500;">
                                    <a href="infoGeneral?NumeroPlan=` + value.NumeroPlan + `&iafas=` + iafas + `&nombres=` + nombres + `&ape_paterno=` + ape_paterno + `&ape_materno=`+ ape_materno +`&tipo_doc=`+tipo_doc +`&num_doc=`+num_doc +`&CodEstado=`+value.CodEstado +`">
                                        <i class="fas fa-info-circle" style="color:#01a851;font-size:18px"></i>
                                    </a>
                                </td>`;
                                }
                                if(value.CodEstado==""){
                                    contenido += `<td>
                                   
                                </td>`;
                                }
                    contenido += `</tr>`;
                        })
                        contenido += `
                        </tbody>
                        </table>`;
                        $('#contenidoAfiliado').html(contenido);
    
                    
                }else{
                        contenido += `
                            <tr>
                                <td colspan="7">` +obj.message+ `</td>
                            </tr>
                        </tbody>
                        </table>`;
                        $('#contenidoAfiliado').html(contenido);
    
    
                }    
            }else{
                contenido += `
                    <tr>
                        <td colspan="7">ERROR AL COSULTAR EL SERVICIO DEL SITED</td>
                    </tr>
                </tbody>
                </table>`;
                $('#contenidoAfiliado').html(contenido);
            }
              

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


function mayus(e) {
    e.value = e.value.toUpperCase();
    $('.ingresar').prop('disabled', false);  

}