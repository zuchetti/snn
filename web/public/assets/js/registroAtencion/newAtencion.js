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
        const message = "Seleccione la aseguradora";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> ' + message + ' </strong></div>');
        return false;
    }

    if(search=="" || search==undefined){
        const message = "Seleccione el tipo de busqueda";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> ' + message + ' </strong></div>');
        return false;
    }
 
    if(search=='doc' && (tipo_doc!=undefined || tipo_doc!="") && (num_doc==undefined || num_doc=="") && (tipo_doc!=7)){
        const message = "Ingrese el número de documento";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> ' + message + ' </strong></div>');
        return false;
    }

    if(search=='doc' && (tipo_doc!=7)){
        $('.pacienteC').removeClass('disabled');  
        $('.ingresar').prop('disabled', false);  
    }

    if(search=='selectnombresyapellidos' && (nombres==undefined || nombres=="")){
        const message = "Ingrese el primer y segundo nombre";
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> ' + message + ' </strong></div>');
        return false;
    }

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
                        // Se sanifican todas las variables antes de usarlas en el HTML
                        const sanitizedCodProducto = escapeHtml(value.CodProducto);
                        const sanitizedNombreContratante = escapeHtml(value.NombreContratante);
                        const sanitizedNombresAfiliado = escapeHtml(value.NombresAfiliado);
                        const sanitizedApellidoPaternoAfiliado = escapeHtml(value.ApellidoPaternoAfiliado);
                        const sanitizedApellidoMaternoAfiliado = escapeHtml(value.ApellidoMaternoAfiliado);
                        const sanitizedDesEstado = escapeHtml(value.DesEstado);

                        contenido += `
                            <tr>
                                <td>` + sanitizedCodProducto + `</td>
                                <td>` + sanitizedNombreContratante + `</td>
                                <td>` + sanitizedNombresAfiliado + `</td>
                                <td>` + sanitizedApellidoPaternoAfiliado + `</td>
                                <td>` + sanitizedApellidoMaternoAfiliado + `</td>
                                <td>` + sanitizedDesEstado + `</td>`;
                        
                        if(value.CodEstado==1){
                            // Se usa encodeURIComponent para sanificar los parámetros de la URL
                            contenido += `<td bgcolor="yellow" style="color:#000;font-weight:500;">
                                <a href="infoGeneral?NumeroPlan=` + encodeURIComponent(value.NumeroPlan) + `&iafas=` + encodeURIComponent(iafas) + `&nombres=` + encodeURIComponent(nombres) + `&ape_paterno=` + encodeURIComponent(ape_paterno) + `&ape_materno=`+ encodeURIComponent(ape_materno) +`&tipo_doc=`+encodeURIComponent(tipo_doc) +`&num_doc=`+encodeURIComponent(value.NumeroDocumentoAfiliado) +`&CodEstado=`+encodeURIComponent(value.CodEstado) +`&codafiliado=`+encodeURIComponent(value.CodigoAfiliado) +`">
                                    <i class="fas fa-info-circle" style="color:#01a851;font-size:18px"></i>
                                </a>
                            </td>`;
                        }
                        if(value.CodEstado>1 && value.CodEstado!=""){
                            // Se usa encodeURIComponent para sanificar los parámetros de la URL
                            contenido += `<td bgcolor="yellow" style="color:#000;font-weight:500;">
                                <a href="infoGeneral?NumeroPlan=` + encodeURIComponent(value.NumeroPlan) + `&iafas=` + encodeURIComponent(iafas) + `&nombres=` + encodeURIComponent(nombres) + `&ape_paterno=` + encodeURIComponent(ape_paterno) + `&ape_materno=`+ encodeURIComponent(ape_materno) +`&tipo_doc=`+encodeURIComponent(tipo_doc) +`&num_doc=`+encodeURIComponent(value.NumeroDocumentoAfiliado) +`&CodEstado=`+encodeURIComponent(value.CodEstado) +`&codafiliado=`+encodeURIComponent(value.CodigoAfiliado) +`">
                                    <i class="fas fa-info-circle" style="color:#01a851;font-size:18px"></i>
                                </a>
                            </td>`;
                        }
                        if(value.CodEstado==""){
                            contenido += `<td></td>`;
                        }
                        contenido += `</tr>`;
                    })
                    contenido += `
                        </tbody>
                        </table>`;
                    $('#contenidoAfiliado').html(contenido);
                }else{
                    const sanitizedMessage = escapeHtml(obj.message); // <-- CORRECCIÓN APLICADA
                    contenido += `
                        <tr>
                            <td colspan="7">` + sanitizedMessage + `</td>
                        </tr>
                    </tbody>
                    </table>`;
                    $('#contenidoAfiliado').html(contenido);
                }     
            }else{
                const message = "ERROR AL COSULTAR EL SERVICIO DEL SITED";
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> ' + message + ' </strong></div>');
            }
        }
    })
})

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex        : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

function mayus(e) {
    e.value = e.value.toUpperCase();
    $('.ingresar').prop('disabled', false);  
}