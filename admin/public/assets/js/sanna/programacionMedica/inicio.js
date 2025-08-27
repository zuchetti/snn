
$.ajaxSetup({

    cache: false,
    headers: {
        'X-CSRF-Token': $('input[name="_token"]').val(),
        'Cache-Control': 'no-cache'
    }

});

"use strict";

var pag=1;
var permisos=$("#permisos").val();
var fecha_ini=$("#kt_datetimepicker_ini").val();
var fecha_fin=$("#kt_datetimepicker_fin").val();
var petxpag=$("#petxpag").val();
var query="";
var estado=-1;


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
							url: "getProgramacionMedicaTable",
							params: {
								pag:pag,
								query: query,
								fecha_ini: fecha_ini,
								fecha_fin: fecha_fin,
								petxpag: petxpag,
								estado: estado
							},
							/*params: {
								estado: 1,
								tipo: 1
							  },*/
							
							
							// sample custom headers
							// headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
							map: function(raw) {
								// sample data mapping

								var dataSet = raw;
								if (typeof raw.data !== 'undefined') {
									dataSet = raw.data;
								}

								var i;
								indexpaginas=``;
								pagactual=raw.meta.page;
								pagfinal=raw.meta.pages;

								if(pagactual==1){
									indexpaginas+=`<li class="page-item disabled">
												      <a class="page-link" aria-label="Previous">
												        <span aria-hidden="true">&laquo;</span>
												        <span class="sr-only">Previous</span>
												      </a>
												    </li>`;
								}else{
									indexpaginas+=`<li id="prev" pagina="`+pagactual+`" class="page-item">
												      <a class="page-link" aria-label="Previous">
												        <span aria-hidden="true">&laquo;</span>
												        <span class="sr-only">Previous</span>
												      </a>
												    </li>`;
								}

								for(i=1; i<=pagfinal;i++){
									if(pagactual==i){
										indexpaginas+=`<li id="selectpag" pagina="`+i+`" class="page-item active"><a class="page-link">`+i+`<span class="sr-only">(current)</span></a></li>`;
									}else{
										indexpaginas+=`<li id="selectpag" pagina="`+i+`" class="page-item"><a class="page-link" >`+i+`<span class="sr-only">(current)</span></a></li>`;
									}
									
								}

								if(pagactual==pagfinal){
									indexpaginas+=`<li class="page-item disabled">
												      <a class="page-link"  aria-label="Next">
												        <span aria-hidden="true">&raquo;</span>
												        <span class="sr-only">Next</span>
												      </a>
												    </li>`;
								}else{
									indexpaginas+=`<li id="next" pagina="`+pagactual+`" class="page-item">
												      <a class="page-link"  aria-label="Next">
												        <span aria-hidden="true">&raquo;</span>
												        <span class="sr-only">Next</span>
												      </a>
												    </li>`;
								}


								$("#paginas").html(indexpaginas);

								return dataSet;
							},
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
					
						field: 'nombre',
						title: 'Nombre',
						autoHide: false,
                    }, 
					{
						field: 'cod_cso',
						title: 'Código CSO',
						autoHide: false,
					}, 
					
                    {
					
						field: 'profesionales',
						title: 'N° Especialidades',
						autoHide: false,
                    },{
					
						field: 'calendario',
						title: 'Horarios',
						autoHide: false,

						template: function(row, index) {                 
                        var status = {
                            0: {'title': 'Nuevo', 'class': 'kt-badge--brand'},
                            1: {'title': 'Restante '+row.horasrestantes+' Hrs.', 'class': ' kt-badge--danger'},
                            2: {'title': 'Completo', 'class': ' kt-badge--success'},
                        }
                        return '<span class="kt-badge ' + status[row.calendario].class + ' kt-badge--inline kt-badge--pill">' + status[row.calendario].title + '</span>';    
                        }
                    },
                    {
						field: 'detalle',
						title: 'Detalle',
						sortable: false,
						width: 110,
						overflow: 'visible',
						autoHide: false,
						template: function(row,index) {


							fecha_ini=$("#kt_datetimepicker_ini").val();
							fecha_fin=$("#kt_datetimepicker_fin").val();
							
							return '<a href="calendario?idtopico='+row.idtopico+'"  class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detalle">\
							<i class="fas fa-eye"></i>\
							</a>';	
							
							
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
			
			datatable.setDataSourceParam("estado",$(this).val());
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
			datatable.setDataSourceParam("petxpag",10);
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
		
		

		$('#kt_form_status,#kt_form_type').selectpicker()

		

	}



}; 


jQuery(document).ready(function() {
	
    KTDatatableRemoteAjaxDemo.init()

})

//remover
function remover(idtopico){
	$.ajax({
		'url': "deleteTopico",
		'data':{'idtopico':idtopico},
		
	}).done( function(data) {

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
}