
$.ajaxSetup({

    cache: false,
    headers: {
        'X-CSRF-Token': $('input[name="_token"]').val(),
        'Cache-Control': 'no-cache'
    }

});

"use strict";

var estado=-1;
var query="";
var tipo=-1;
var pag=1;
var permisos=$("#permisos").val();
var fecha_ini=$("#kt_datetimepicker_ini").val();
var fecha_fin=$("#kt_datetimepicker_fin").val();
var petxpag=$("#petxpag").val();
var tipo_profesional=-1;


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
							url: "getSolicitudReposicion",
							params: {
								pag:pag,
								query: query,
								fecha_ini: fecha_ini,
								estado:estado,
								fecha_fin: fecha_fin,
								petxpag: petxpag,
								tipo_profesional:tipo_profesional,
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
		
						field: 'cod_cso',
						title: 'CSO',
						autoHide: false,
					
                    }, 
                    {
		
						field: 'nombre',
						title: 'Sede',
						autoHide: false,
					
					}, 
					{
					
						field: 'created_at',
						title: 'Fecha',
						autoHide: false,

					}, 
					{
						width:110,
                        field: 'state',
                        title: 'Estado',
                        autoHide: false,
                        sortable: 'asc',
                        // callback function support for column rendering
                        template: function(row, index) {
                        var status = {                           
                            0: {'title': 'Pendiente', 'class': 'kt-badge--warning'},
							1: {'title': 'Aprobada', 'class': 'kt-badge--success'},
							2: {'title': 'Denegada', 'class': ' kt-badge--danger'},
                        };

                        return '<span class="kt-badge ' + status[row.state].class + ' kt-badge--inline kt-badge--pill">' + status[row.state].title + '</span>';
                        
                        }
                    },
					{
						field: 'items',
						title: 'Nº Items',
						autoHide: false,
					},
					
					
                   
					{
						field: 'Opciones',
						title: 'Opciones:',
					
						sortable: false,
						width: 70,
						overflow: 'visible',
						autoHide: false,
						template: function(row,index) {
							return '<a href="pedidoDetail?idreposicionh='+row.idreposicionh+'&state='+row.state+'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detalle">\
							<i class="fas fa-eye"></i>\
							</a>'
							
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
			
			datatable.setDataSourceParam("tipo_profesional",$(this).val());
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
			pickerPosition: 'bottom-right',
			language: 'es'
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
			pickerPosition: 'bottom-right',
			language: 'es'
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
		
		

		$('#kt_form_status,#kt_form_type').selectpicker()

		

	}



}; 


jQuery(document).ready(function() {
	
    KTDatatableRemoteAjaxDemo.init()

})



//remover
function remover(idtopico){
	
	$("#idtopico").val(idtopico)

	$('#modalconfirmacion').modal('show');

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