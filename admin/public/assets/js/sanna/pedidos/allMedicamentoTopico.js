

$.ajaxSetup({

    cache: false,
    headers: {
        'X-CSRF-Token': $('input[name="_token"]').val(),
        'Cache-Control': 'no-cache'
    }

});
"use strict";

var idtopico=$("#idtopico").val();
var pag=1;
var petxpag=$("#petxpag").val();
var query="";



var KTDatatableRemoteAjaxDemo=
{
	init:function()
	{
		var datatable;
		datatable=$(".kt-datatable").KTDatatable({
			
				// datasource definition
				data: {
					cookie: false,
					type: 'remote',
					source: {
						read: {
							url: "getAllMedicamentoTopico",
							params: {
								pag:pag,
								idtopico:idtopico,
								petxpag: petxpag,
								query : query
							},
							/*params: {
								estado: 1,
								tipo: 1
							  },*/
							
							
							// sample custom headers
							// headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
							
						},
					},
					pageSize: 10,
					serverPaging: false,
					serverFiltering: false,
					serverSorting: false,
				},
		

				// layout definition
				layout: {
					scroll: false,
					footer: false,
					spinner: {
						type: 'loader',
						message :'Espere por favor'
					}
				},
	
				
				// column sorting
				sortable: false,
	
				pagination: false,
	
				/*search: {
					input: $('#generalSearch'),
				},*/
	
				// columns definition
				columns: [
				
                    {
						width:110,
						field: 'cod_producto',
						title: 'COD PRODUCTO',
                    },
                    {
						field: 'producto',
						title: 'Producto',
					},
					{
						field: 'cantidad',
						title: 'Cantidad',
					},
					{
						field: 'Eliminar',
						title: 'Eliminar',
						sortable: false,
						width: 110,
						overflow: 'visible',
						autoHide: false,
						template: function(row,index) {
							return '<div  onclick="remover('+row.idbotiquinitem+')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detalle">\
							<i class="fas fa-trash-alt"></i>\
							</a></div>';	
						},
					}
					
                   
				],

		}),

		
		$('#kt_form_status').on('change', function() {
			datatable.setDataSourceParam("estado",$(this).val());
			datatable.setDataSourceParam("pag",1);
			datatable.load();
		}),

		$('#kt_form_type').on('change', function() {
			
			datatable.setDataSourceParam("tipo",$(this).val());
			datatable.setDataSourceParam("pag",1);
			datatable.load();

		}),		


		$('#petxpag').on('change', function() {
			datatable.setDataSourceParam("petxpag",$("#petxpag").val());
			datatable.setDataSourceParam("pag",1);
			datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
			datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
			datatable.load();
			console.log($("#petxpag").val());
		}),
		$('#kt_datetimepicker_ini').datetimepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            pickerPosition: 'bottom-right'
        }),
        $('#kt_datetimepicker_ini').on('change',function(){
        	datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
        	datatable.setDataSourceParam("pag",1);
			datatable.load();
        }),
		$('#kt_datetimepicker_fin').datetimepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            pickerPosition: 'bottom-right'
        }),
        $('#kt_datetimepicker_fin').on('change',function(){
        	datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
        	datatable.setDataSourceParam("pag",1);
			datatable.load();
        }),

		$('#generalSearch').keyup(function(){

			query=document.getElementById("generalSearch").value;
			//console.log(search);

			datatable.setDataSourceParam("query",query);
			datatable.setDataSourceParam("pag",1);
			datatable.load();
			//console.log($(this).val());
		}),
		$(window).on('beforeunload',function(){  		
  			datatable.setDataSourceParam("estado","-1");
   			datatable.setDataSourceParam("tipo","-1");
   			datatable.setDataSourceParam("query","");
   			datatable.setDataSourceParam("pag",1);
   			datatable.setDataSourceParam("fecha_ini","");
			datatable.setDataSourceParam("fecha_fin","");
			datatable.setDataSourceParam("petxpag",150);
		}),

	


		$(document).on('click', "#selectpag", function(e){
			var pagina=($(this).attr("pagina"));
		
			datatable.setDataSourceParam("pag",pagina);

			datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
			datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
			datatable.load();

			console.log(datatable.getSelectedRecords())
			  
		}),

		$(document).on('click', "#next", function(e){
		
			datatable.setDataSourceParam("pag",pagina);
			datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
			datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
			datatable.load();

			  
		}),

		$(document).on('click', "#prev", function(e){
			
			var pagina=parseInt($(this).attr("pagina"))-1;
			
			datatable.setDataSourceParam("pag",pagina);
			datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
			datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
			datatable.load();
			  
		}),
		
	/* 	$('.descarga').click( function() {
			
			var stockdetalle = [];
			
			$("[name='cantidad'").each(function () {
				if (this.value!="") {      				
					stockdetalle.push({
						idbotiquinitem: $(this).attr('idbotiquinitem'),
						cantidad:$(this).val()
					});
				}
				
			});

			$.ajax({
				'url': "update_stockBotiquin",
				beforeSend: function() {
					$('.accept').prop('disabled', true);
				},
				'data':{'stockdetalle':stockdetalle},
				
			}).done( function(data) {
		
				obj = JSON.parse(data);
			
				if(obj.status == 200){
		
					$('#alerts6').html('<div class="alert alert-success">' +
					'<button type="button" class="close" data-dismiss="alert">' +
					'&times;</button>'+obj.message+'</div>');
					$('.accept').prop('disabled', true);
					setTimeout(function() {
						location.reload();
					}, 1000);
				}
		 
				if(obj.status == 100){
					$('#alerts6').html('<div class="alert alert-danger">' +
					'<button type="button" class="close" data-dismiss="alert">' +
					'&times;</button>'+obj.message+'</div>');
					$('.accept').prop('disabled', false);
				
				}
			
		
			})



		}) */
			
			
		

		$('#kt_form_status,#kt_form_type').selectpicker()

		

	}



}; 


jQuery(document).ready(function() {
	
    KTDatatableRemoteAjaxDemo.init()

})

$(".numbers").bind('keypress', function(event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
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

function remover(idbotiquinitem){

		
	$("#idbotiquinitem").val(idbotiquinitem)

	$('#modalconfirmacion').modal('show');

	
}

function handleAccept(){


	$.ajax({
		'url': "delete_medic_topico",
		beforeSend: function() {
			$('.accept').prop('disabled', true);

        },
		'data':{'idbotiquinitem':$("#idbotiquinitem").val()},
		
	}).done( function(data) {

		obj = JSON.parse(data);
	
		if(obj.status == 200){

			$('#alerts6').html('<div class="alert alert-success">' +
			'<button type="button" class="close" data-dismiss="alert">' +
			'&times;</button>'+obj.message+'</div>');
			$('.accept').prop('disabled', true);
			setTimeout(function() {
				location.reload();
			}, 2000);
		}
 
		if(obj.status == 100){
			$('#alerts6').html('<div class="alert alert-danger">' +
			'<button type="button" class="close" data-dismiss="alert">' +
			'&times;</button>'+obj.message+'</div>');
			$('.accept').prop('disabled', false);
		
		}
	

	})
}
