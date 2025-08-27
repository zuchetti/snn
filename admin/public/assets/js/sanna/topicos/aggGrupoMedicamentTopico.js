$('.addMedicament').click( function() {

    var idgrupo = $('.selectpicker').val();


    if(idgrupo=="" || idgrupo==undefined){
        $('#alerts5').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione el grupo de medicamentos</div>');
        return false;
    }


    $.ajax({
        'url': "tableGrupoM",
        'data':{'idgrupo':idgrupo},
    }).done( function(data) {
  
        var content="";
        $.each(data, function(i, value) {

            content += '<tr>'+
                '<td><input type="hidden" name="idgroupM" value="'+value.idgrupo+'"></td>'+
                '<td>'+value.nombre+'</td>'+
                '<td>'+value.medicamentos+'</td>'+
            '</tr>';
            
        })
        $('#medicament').html(content);
       


    }) 

})

$('.agregar').click( function() {
    var idbotiquin = $("#idbotiquin").val();
    var idtopico = $("#idtopico").val();
    
    

	var arrayM = [];
	var idgroupM;
	var contarIdgroupM  = 0;

    $("input[name='idgroupM']").each(function () {
        if (this.value!="") {
            contarIdgroupM++;

        }
	})
	
	if(contarIdgroupM==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>Seleccione al menos un grupo de medicamentos</div>');
        return false;
	}
	
	$("input[name='idgroupM']").each(function () {
        if (this.value!="") {
            arrayM.push($(this).val());
             idgroupM = arrayM.join(',');
        }
    })

    $.ajax({
        'url': "aggGrupoMTopico",
        'data':{'idgrupo_medi':idgroupM,'idbotiquin':idbotiquin},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();
        $('#boton').prop('disabled', true);　
		obj = JSON.parse(data);
		if(obj.status == 200){

            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
          
            window.setTimeout(function(){window.location.href = 'allMedicamentosTopico?idtopico='+idtopico},1000);

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