
$(document).on('click', "#descarga", function(e){



    request = $.ajax({                                   
        url: "download_medicamentoreposicion",           
        data:{'idtopico':$("#idtopico").val()},
        success: function(data) {       
           
            obj = JSON.parse(data);
            if (obj.status ==200){
            
                var ws = XLSX.utils.json_to_sheet(obj.data);
            
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "People");
                
                XLSX.writeFile(wb, "reporte.csv");

            }else{ 

             }                                                           
        }              
    });
});


$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});


//remover
function remover(){
	
	$('#modalconfirmacion').modal('show');
}

function handleAccept(){

	$.ajax({
        'url': "denegarSolicitud",
        beforeSend: function() {
			$('.accept').prop('disabled', true);
        },
		'data':{'idreposicionh':$("#idreposicionh").val()},
	}).done( function(data) {

		obj = JSON.parse(data);
	
		if(obj.status == 200){

			$('#alerts6').html('<div class="alert alert-success">' +
			'<button type="button" class="close" data-dismiss="alert">' +
			'&times;</button>'+obj.message+'</div>');
			$('.accept').prop('disabled', true);
            window.setTimeout(function(){window.location.href = "gestionmedicamentos"},2000);

		}
 
		if(obj.status == 100){
			$('#alerts6').html('<div class="alert alert-danger">' +
			'<button type="button" class="close" data-dismiss="alert">' +
			'&times;</button>'+obj.message+'</div>');
			$('.accept').prop('disabled', false);
		
		}
	

	})
}


$(document).on('click', ".aprobar", function(e){
    var repodetalle=[];
    var contar=0;
    $("[name='pedido'").each(function () {
        if (this.value!="") {
            contar++;
        }
        
    });
    

    if(contar==0){
        $('#alerts').html('<div class="alert alert-danger">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button>Ingrese al menos un pedido</div>');
        return false;
            
    }
    $("[name='pedido'").each(function () {
        if (this.value!="") {
            repodetalle.push({
                idreposiciond: $(this).attr('idreposiciond'),
                cantidadfinal:$(this).val()
            });
            
        }
        
    });

    $.ajax({
        'url': "aprobarSolicitud",
        'data':{'idreposicionh':idreposicionh,'repodetalle':repodetalle},
        beforeSend: function() {
            $('.aprobar').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
        obj = JSON.parse(data);

        if(obj.status == 200){

            $('.aprobar').prop('disabled', true);  
            $('#alerts').html('<div class="alert alert-success">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            window.setTimeout(function(){window.location.href = "gestionmedicamentos?"},2000);

        }

        if(obj.status == 100){
            $('#alerts').html('<div class="alert alert-danger">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>'+obj.message+'</div>');
            $('.aprobar').prop('disabled', false);
        
        }
    
    })

})
