$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});

function deleteGrupoLaboratorio(idgrupo,idtopico){
	$.ajax({
		'method':'POST',
        'url': "delete_grupo_topico",
        'data':{'idgrupo':idgrupo,'tipo':1,idtopico:idtopico},
    }).done( function(data) {
  
        var content="";
        alert('Grupo eliminado del tópico');
		location.reload();
       

    }) 
}

function deleteGrupoImagen(idgrupo,idtopico){
	$.ajax({
		'method':'POST',
        'url': "delete_grupo_topico",
        'data':{'idgrupo':idgrupo,'tipo':0,idtopico:idtopico},
    }).done( function(data) {
  
        var content="";
        
       alert('Grupo eliminado del tópico');
	   location.reload();


    }) 
}


//grupo examen IMAGEN
$('.addgroupExamenI').click( function() {

    var idgrupo = $('#idgrupoExamenI').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts2').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de examenes imagen</div>');
        return false;
    }

	console.log(idgrupo);

    $.ajax({
        'url': "tableGrupoExamenI",
        'data':{'idgrupo':idgrupo,'tipo':0},
    }).done( function(data) {
  
        var content="";
        let gruposArray = idgrupo.toString().split(',');

			$.each(data, function(i, value) {
				if (gruposArray.includes(value.idgrupo.toString())) {
					content += '<tr>'+
						'<td><input type="hidden" name="idgroupI" value="'+value.idgrupo+'"></td>'+
						'<td>'+value.nombre+'</td>'+
						'<td>'+value.examenes+'</td>'+
					'</tr>';
				}
			});

        $('#examenI').html(content);
       


    }) 

})


//GRUPO EXAMEN LABO

$('.addgroupExamenL').click( function() {

    var idgrupo = $('#idgrupoExamenL').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts3').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de examenes laboratorio</div>');
        return false;
    }


    $.ajax({
        'url': "tableGrupoExamenL",
        'data':{'idgrupo':idgrupo,'tipo':1},
    }).done( function(data) {
  
        var content="";
        let gruposArray = idgrupo.toString().split(',');

			$.each(data, function(i, value) {
				if (gruposArray.includes(value.idgrupo.toString())) {
					content += '<tr>'+
						'<td><input type="hidden" name="idgroupI" value="'+value.idgrupo+'"></td>'+
						'<td>'+value.nombre+'</td>'+
						'<td>'+value.examenes+'</td>'+
					'</tr>';
				}
			});
        $('#examenL').html(content);
       


    }) 

})

$('.agregar').click( function() {
	var idbotiquin = $("#idbotiquin").val();
	var contarIdgroupL = 0;
	var contarIdgroupI = 0;
	
	$("input[name='idgroupI']").each(function () {
        if (this.value!="") {
            contarIdgroupI++;

        }
	})
	
    $("input[name='idgrupoL']").each(function () {
        if (this.value!="") {
            contarIdgroupL++;

        }
	})

	if(contarIdgroupL==0 && contarIdgroupI==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de examenes de imagen o laboratorio</div>');
        return false;
    }


	var arrayI = [];
	var idgroupI;
	
	if(contarIdgroupI>0){
		$("input[name='idgroupI']").each(function () {

			if (this.value!="") {
				arrayI.push($(this).val());
				idgroupI = arrayI.join(',');
			}
		})
		
		$.ajax({
			'url': "aggGrupoExamenImgTopico",
			'data':{'idgrupo_examenI':idgroupI,'idbotiquin':idbotiquin},
			beforeSend: function() {
				$('#boton').prop('disabled', true);  
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
				
			}
	
			if(obj.status == 100){
				$('#alerts').html('<div class="alert alert-danger">' +
				'<button type="button" class="close" data-dismiss="alert">' +
				'&times;</button>'+obj.message+'</div>');
				$('#boton').prop('disabled', false);
			}
		})
	}

	if(contarIdgroupL>0){

		var arrayL = [];
		var idgrupoL;
	  
	
		$("input[name='idgrupoL']").each(function () {
			if (this.value!="") {
				arrayL.push($(this).val());
				 idgrupoL = arrayL.join(',');
			}
		})

		$.ajax({
			'url': "aggGrupoExamenLabTopico",
			'data':{'idgrupo_examenL':idgrupoL,'idbotiquin':idbotiquin},
			beforeSend: function() {
				$('#boton').prop('disabled', true);  
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
				window.setTimeout(function(){window.location.href = 'allExamenesTopico?idtopico='+idtopico},1000);

			}
	
			if(obj.status == 100){
				$('#alerts').html('<div class="alert alert-danger">' +
				'<button type="button" class="close" data-dismiss="alert">' +
				'&times;</button>'+obj.message+'</div>');
				$('#boton').prop('disabled', false);
			}
			
		})
	

	}

})
