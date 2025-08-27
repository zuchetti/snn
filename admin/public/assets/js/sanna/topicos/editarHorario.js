/* 

function getRelog(dia,bloque){
  
    $('#datetimepicker'+dia+bloque).datetimepicker({
        format: 'LT'
    });
}
 */
$('.agregar').click(function(){

    var idtopicohorario = [];
    var dia = [];
    var hora_ini=[];
    var hora_fin=[];
    var horario=[];
    var contarHoraI=0;
    var contarHoraF=0;
    $("[name='hora_ini'").each(function () {
        if($(this).val()!=""){
            contarHoraI++;
            idtopicohorario.push($(this).attr("idtopicohorario"));
            dia.push($(this).attr("dia"));
            hora_ini.push($(this).val());
        }
      
    });
    $("[name='hora_fin'").each(function () {
        if($(this).val()!=""){
            contarHoraF++;
            idtopicohorario.push($(this).attr("idtopicohorario"));
            dia.push($(this).attr("dia"));
            hora_fin.push($(this).val());
        }
        
    });
   

    if(contarHoraI<contarHoraF){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert"> ' +
        '&times; </button> Falta Ingresar hora inicio y hora fin </div>');
        return false;
    }
    for(i=0;i<hora_ini.length;i++){
        horario.push({
            idtopicohorario: idtopicohorario[i],
            dia : dia[i],
            hora_ini: hora_ini[i],
            hora_fin: hora_fin[i]
        }); 

    }

    console.log(horario);

    //var idtopico=$("#idtopico").val();



    $.ajax({
        'url': "updateHorarioTopico",
        'data':{'horario':horario},
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
                location.reload();
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