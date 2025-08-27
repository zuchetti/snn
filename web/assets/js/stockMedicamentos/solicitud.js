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
							url: "stockActual",
							params: {
								pag:pag,
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
					scroll: true,
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
						title: 'Código almacen',
						autoHide: false,
				
					}, 
                    {
						field: 'producto',
						title: 'Producto',
						autoHide: false,
					}, 
					
					{
						field: 'presentacion_',
						title: 'Presentación',
						autoHide: false,
					
					}, 
					
					{
						field: 'cant_presentacion',
						title: 'Cantidad Presentación',
						autoHide: false,
						width: 100,
					}, 
					{
						field: 'cantidad',
						title: 'Stock Actual',
						autoHide: false,
						width: 100,
					}, 
					{
						field: '',
						title: 'Pedido',
						autoHide: false,
						width: 100,
						template: function(row,index){
							return '<input id="pedido'+row.idmedicamento+'" name="pedido" presentacion='+row.cant_presentacion+' idmedicamento='+row.idmedicamento+' stock_peticion='+row.cantidad+' type="number" pattern="[0-9]+" class="pedido form-control numeros bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">'
						}
					}                   
				
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
		
		//acept only numbers
		$('.numeros').keyup(function (){
			var charCode = (e.which) ? e.which : e.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
			}
		});


		$(document).on('change', ".pedido", function(e){

			console.log('entra')

			if (this.value!="") {
				if ( $(this).val() > 0 && $(this).val() % $(this).attr('presentacion') == 0 ) { //hacemos la comparación
						//console.log("Si, el número "+$(this).val()+ " es múltiplo de "+$(this).attr('presentacion')  )
				}else{
					var cercano = Math.ceil($(this).val()/$(this).attr('presentacion')) * $(this).attr('presentacion');
					$("#pedido"+$(this).attr('idmedicamento')).val(cercano);
					//console.log(cercano)
					//console.log("No, el número "+$(this).val()+ " no es múltiplo de "+$(this).attr('presentacion') );
				}
			}
			
		});

		//click solicitar
		$(document).on('click', ".solicitar", function(e){
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
						idmedicamento: $(this).attr('idmedicamento'),
						stock_peticion: $(this).attr('stock_peticion'),
						cantidad:$(this).val()
					});
				}
				
			});

			

			$.ajax({
				'url': "nuevaSolicitud",
				'data':{'repodetalle':repodetalle},
				beforeSend: function() {
					$('.solicitar').prop('disabled', true);  
					$(".spinner-border").fadeIn(200);　
				}
			}).done( function(data) {
				$(".spinner-border").hide();　
				obj = JSON.parse(data);
		
				if(obj.status == 200){
		
					$('.solicitar').prop('disabled', true);  
					
					var contentModal = "";
					contentModal += 
					`<div class="modal-body">
						<div class="text-center">
							<i class="fas fa-check"></i>
						</div>
		
						<div id="textM">
							<div>` + obj.message + `</div>
						</div>
		
						<div class="row justify-content-center">
							<div class="col-md-6">
								<a href="reposicionMedicamentos" id="aceptar" class="btn" >Aceptar</a>
							</div>
						</div>
					</div>
					`;
					$("#exampleModal").modal("show");
					$('#contentModal').html(contentModal);
				}
		 
				if(obj.status == 100){
					$('#alerts').html('<div class="alert alert-danger">' +
					'<button type="button" class="close" data-dismiss="alert">' +
					'&times;</button>'+obj.message+'</div>');
					 $('.solicitar').prop('disabled', false);
				
				}
			
			})
		
        })
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
