
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

var pag=1;
var petxpag=$("#petxpag").val();
var idreposicionh=$("#idreposicionh").val();
var estado=$("#estado").val();



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
							url: "getDetailPedido",
							params: {
								pag:pag,
                                petxpag: petxpag,
                                idreposicionh:idreposicionh
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
						width:110,
						field: 'cod_producto',
						title: 'Código almacen',
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
						field: 'cant_presentacion',
						title: 'Cantidad Presentación',
						autoHide: false,
					}, 
					{
						width: 110,
						field: 'stock_peticion',
						title: 'Stock Actual',
						autoHide: false,
					}, 
					
					
					{
						field: 'cantidad',
						title: 'Pedido médico',
						autoHide: false,
						width: 110,
						template: function(row,index){
							return '<input name="pedidoMedico" id="cant_presentacion'+row.idreposiciond+'" disabled value="'+row.cantidad+'" class="form-control numeros bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2">'
							
						}
					},
					{
						field: '',
						title: 'Pedido',
						autoHide: false,
						width: 110,
						template: function(row,index){
							var status = {                           
								0: {'title': row.cantidadfinal, 'class': 'kt-badge--warning'},
								1: {'title': row.cantidadfinal, 'class': 'kt-badge--success'},
								2: {'title': 'Desaprobado', 'class': ' kt-badge--danger'},
							};
	
							if(estado==0){
								return '<input name="pedido" id="pedido" pedido="'+row.cant_presentacion+'" min="1" idreposiciond="'+row.idreposiciond+'" value="'+row.cantidad+'" type="number" pattern="[0-9]+" class="form-control numeros bg-light border-0 small pedido'+row.idreposiciond+'">'
							}
							if(estado==1 || estado==2){
								return '<span class="kt-badge ' + status[estado].class + ' kt-badge--inline kt-badge--pill">' + status[estado].title + '</span>';
							}
						}
					}   
                   
				],

		}),

	

		$(document).on('click', "#descarga", function(e){
			
			request = $.ajax({                                   
	            url: "descargapedido",           
	            data:{'idreposicionh':idreposicionh},
				 beforeSend: function() {   
					$("#contentInicio").show();
					$("#contentInicio").html("<div class='spinner-border cargando' style='margin-right:10px;' role='status'> </div> Por favor espere");                    
				},
				success: function(data) {       
				  
					
	                obj = JSON.parse(data);
	                if (obj.status ==200){ 
	                	var data=obj.data;
					 	if(data=='')
					 		return;
					 	JSONToCSVConvertor(data, obj.nombre, true);
						 
						function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
						  //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
						  var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
						  var CSV = '';
						  //Set Report title in first row or line
						  CSV += ReportTitle + '\r\n\n';
						  //This condition will generate the Label/Header
						  if (ShowLabel) {
						    var row = "";
						    //This loop will extract the label from 1st index of on array
						    for (var index in arrData[0]) {
						      //Now convert each value to string and comma-seprated
						      row += index + ',';
						    }
						    row = row.slice(0, -1);
						    //append Label row with line break
						    CSV += row + '\r\n';
						  }
						  //1st loop is to extract each row
						  for (var i = 0; i < arrData.length; i++) {
						    var row = "";
						    //2nd loop will extract each column and convert it in string comma-seprated
						    for (var index in arrData[i]) {
						      row += '"' + arrData[i][index] + '",';
						    }
						    row.slice(0, row.length - 1);
						    //add a line break after each row
						    CSV += row + '\r\n';
						  }
						  if (CSV == '') {
						    alert("Invalid data");
						    return;
						  }
						  //Generate a file name
						  var fileName = "Reporte_";
						  //this will remove the blank-spaces from the title and replace it with an underscore
						  fileName += ReportTitle.replace(/ /g, "_");
						  //Initialize file format you want csv or xls
						  var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
						  // Now the little tricky part.
						  // you can use either>> window.open(uri);
						  // but this will not work in some browsers
						  // or you will not get the correct file extension    
						  //this trick will generate a temp <a /> tag
						  var link = document.createElement("a");
						  link.href = uri;
						  //set the visibility hidden so it will not effect on your web-layout
						  link.style = "visibility:hidden";
						  link.download = fileName + ".csv";
						  //this part will append the anchor tag and remove it after automatic click
						  document.body.appendChild(link);
						  link.click();
						  document.body.removeChild(link);
						}	

	                }else{  $("#load").html("<ul class='list-group'><li class='list-group-item'></div>Ocurrio un error en la descarga</li></ul>");  }                                                           
	            }              
			}).done(function() {
				$("#contentInicio").hide();
			}) 
		
			
		});

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
  			datatable.setDataSourceParam("estado","");
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
        //acept only numbers
        $('.numeros').keyup(function (){
            var charCode = (e.which) ? e.which : e.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
            }
        });

		//click solicitar
		$(document).on('change', "#pedido", function(e){

			console.log('entra')

			if (this.value!="") {
				if ( $(this).val() > 0 && $(this).val() % $(this).attr('pedido') == 0 ) { 
					console.log('es multiplo')
				}else{
					var cercano = Math.ceil($(this).val()/$(this).attr('pedido')) * $(this).attr('pedido');
					console.log('no es multiplo')
					$(".pedido"+$(this).attr('idreposiciond')).val(cercano);
					//console.log(cercano)
					//console.log("No, el número "+$(this).val()+ " no es múltiplo de "+$(this).attr('presentacion') );
				}
			}
			
		});

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
		

	}



}; 


jQuery(document).ready(function() {
	
    KTDatatableRemoteAjaxDemo.init()

})

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

$(document).ajaxSend(function(){
    $.LoadingOverlay("show", {
        fade  : [2000, 1000],
        zIndex          : 1500
    });
});
$(document).ajaxComplete(function(){
    $.LoadingOverlay("hide");
});
