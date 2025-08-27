var KTAppOptions = {
    "colors": {
        "state": {
            "brand": "#5d78ff",
            "dark": "#282a3c",
            "light": "#ffffff",
            "primary": "#5867dd",
            "success": "#34bfa3",
            "info": "#36a3f7",
            "warning": "#ffb822",
            "danger": "#fd3995"
        },
        "base": {
            "label": [
                "#c5cbe3",
                "#a1a8c3",
                "#3d4465",
                "#3e4466"
            ],
            "shape": [
                "#f0f3ff",
                "#d9dffa",
                "#afb4d4",
                "#646c9a"
            ]
        }
    }
};

$.ajaxSetup({
	headers:{
	'X-CSRF-Token': $('input[name="_token"]').val()
	}
});

"use strict";

var query="";
var pag=1;
var fecha_ini=$("#kt_datetimepicker_ini").val();
var fecha_fin=$("#kt_datetimepicker_fin").val();
var petxpag=$("#petxpag").val();



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
							url: "getMedicTopicoTable",
							params: {
								pag:pag,
								query: query,
								fecha_ini: fecha_ini,
								fecha_fin: fecha_fin,
								petxpag: petxpag
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
				sortable: true,
	
				pagination: false,
	
				/*search: {
					input: $('#generalSearch'),
				},*/
	
				// columns definition
				columns: [
					
                    
                    {
						field: 'cod_producto',
						title: 'Código prducto',
					}, 
					{
						field: 'producto',
						title: 'Producto',
					}, 
					{
						field: 'presentacion_',
						title: 'Presentación',
					}, 
					
					{
						width:110,
						field: 'cant_presentacion',
						title: 'Cantidad Presentación',
					},     
					
					{
					
						width:110,
                        field: 'cantidad',
                        title: 'Stock Actual',
                        // callback function support for column rendering
                        template: function(row, index) {
							if(row.cantidad<=0){
								return '<span class="text-danger">'+row.cantidad+'</span>';
							}else{
								return '<span class="text-info">'+row.cantidad+'</span>';
							}

                       
                        
                        }
                    },
				],

		}),

	

	

		$('#petxpag').on('change', function() {
			datatable.setDataSourceParam("petxpag",$("#petxpag").val());
			datatable.setDataSourceParam("pag",1);
			datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
			datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
			datatable.load();
			console.log($("#petxpag").val());
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

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});
