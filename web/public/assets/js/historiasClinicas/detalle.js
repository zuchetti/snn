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
var dni=$("#dni").val();



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
							url: "detalleHistoriaClinicaTable",
							params: {
								pag:pag,
								query: query,
								fecha_ini: fecha_ini,
								fecha_fin: fecha_fin,
                                petxpag: petxpag,
                                dni:dni
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
						field: 'icono',
                        title: '',
                        width: 20,

						type: 'number',
						selector: false,
						textAlign: 'center',
						sortable: false,
						hide: true,
						template: function(row, index) {
							idatencion=row.idatencion;
							 return ''
						},
					},{
						field: 'idatencion',
						title: 'ID',
						autoHide: false,
						// callback function support for column rendering
						
					},
						
                    {
						field: 'fec_atencion',
						title: 'Fecha de atención',
						type: 'date',
						format: 'MM/DD/YYYY hh:mm:ss',
						autoHide: false,
					},
					
                    {
                        field: 'diagnosticos',
						title: 'Diagnóstico',
					},
					
					{
                    
                        field: 'examenes',
                        title: 'Examenes Auxiliares',
                        autoHide: false,
                        sortable: 'asc',
                        // callback function support for column rendering
                        template: function(row, index) {
                        
                            
                        var status = {                           
                            0: {'title': 'No', 'class': ' kt-badge--danger'},
                            1: {'title': 'Si', 'class': 'kt-badge--success'},
                            2: {'title': 'Si', 'class': 'kt-badge--success'},
                        };

                        return '<span class="kt-badge ' + status[row.examenes].class + ' kt-badge--inline kt-badge--pill">' + status[row.examenes].title + '</span>';

                        
                        }
                    },
                    {
                    
                        field: 'recetas',
                        title: 'Recetas médica',
                        autoHide: false,
                        sortable: 'asc',
                        // callback function support for column rendering
                        template: function(row, index) {
                        
                            
                        var status = {                           
                            0: {'title': 'No', 'class': ' kt-badge--danger'},
                            1: {'title': 'Si', 'class': 'kt-badge--success'},
                            2: {'title': 'Si', 'class': 'kt-badge--success'},
                        };
                        return '<span class="kt-badge ' + status[row.recetas].class + ' kt-badge--inline kt-badge--pill">' + status[row.recetas].title + '</span>';                        
                        }
                    },
                    
                    {
                        field: 'descansomedico',
                        title: 'Descanso médico',
                        autoHide: false,
                        sortable: 'asc',
                        // callback function support for column rendering
                        template: function(row, index) {
                        
                            
                        var status = {
                            0: {'title': 'No', 'class': ' kt-badge--danger'},
                            1: {'title': 'Si', 'class': 'kt-badge--success'},
                        };
                        return '<span class="kt-badge ' + status[row.descansomedico].class + ' kt-badge--inline kt-badge--pill">' + status[row.descansomedico].title + '</span>';                        
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
							return '<a href="detalleaAtencion?idatencion='+row.idatencion+'&dni='+$("#dni").val()+'&nombre='+$("#nombre").val()+'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Detalle">\
							<i class="fas fa-eye"></i>\
							</a>';	
                        }
                    }
                   
					],

		}),

		$(document).on('click', "#descarga", function(e){
			var id=($(this).attr("dni"));
			request = $.ajax({                                   
	            url: "descargaHistoria",           
	            data:{'dni':id},
				 beforeSend: function() {   
					$("#contentInicio").show();
					$("#contentInicio").html("<div class='spinner-border cargando' style='margin-right:10px;' role='status'> </div> Por favor espere");                    
				},
				success: function(data) {       
				  	
	                obj = JSON.parse(data);
	                if (obj.status ==200){ 
	                	var data=obj.data;
	                	var receta=data.recetas;
	                	var examenes=data.examenes;
	                	var hoja_consulta=data.hoja_consulta;
	                	var historia_clinica=data.historia_clinica;
	                	var diagnosticos=data.diagnosticos;

						var receta = XLSX.utils.json_to_sheet(receta);
						var wbreceta = XLSX.utils.book_new();
						XLSX.utils.book_append_sheet(wbreceta, receta, "People");
						XLSX.writeFile(wbreceta, "reporte_receta.xlsx");

						var examenes = XLSX.utils.json_to_sheet(examenes);
						var wbexamenes = XLSX.utils.book_new();
						XLSX.utils.book_append_sheet(wbexamenes, examenes, "Hoja2");
						XLSX.writeFile(wbexamenes, "reporte_examenes.xlsx");

						var hoja_consulta = XLSX.utils.json_to_sheet(hoja_consulta);
						var wbhoja_consulta = XLSX.utils.book_new();
						XLSX.utils.book_append_sheet(wbhoja_consulta, hoja_consulta, "Hoja3");
						XLSX.writeFile(wbhoja_consulta, "reporte_hoja_consulta.xlsx");

						var historia_clinica = XLSX.utils.json_to_sheet(historia_clinica);
						var wbhistoria_clinica = XLSX.utils.book_new();
						XLSX.utils.book_append_sheet(wbhistoria_clinica, historia_clinica, "Hoja4");
						XLSX.writeFile(wbhistoria_clinica, "reporte_historia_clinica.xlsx");

						var diagnosticos = XLSX.utils.json_to_sheet(diagnosticos);
						var wbdiagnosticos = XLSX.utils.book_new();
						XLSX.utils.book_append_sheet(wbdiagnosticos, diagnosticos, "Hoja5");
						XLSX.writeFile(wbdiagnosticos, "reporte_diagnostico.xlsx");
						 
					 	// if(data=='')
					 	// 	return;
					 	// JSONToCSVConvertor(receta, 'receta', true);
					 	// JSONToCSVConvertor(examenes, 'examenes', true);
					 	// JSONToCSVConvertor(hoja_consulta, 'hoja_consulta', true);
					 	// JSONToCSVConvertor(historia_clinica, 'historia_clinica', true);
					 	// JSONToCSVConvertor(diagnosticos, 'diagnosticos', true);

						// function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
						//   //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
						//   var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
						//   var CSV = '';
						//   //Set Report title in first row or line
						//   CSV += ReportTitle + '\r\n\n';
						//   //This condition will generate the Label/Header
						//   if (ShowLabel) {
						//     var row = "";
						//     //This loop will extract the label from 1st index of on array
						//     for (var index in arrData[0]) {
						//       //Now convert each value to string and comma-seprated
						//       row += index + ',';
						//     }
						//     row = row.slice(0, -1);
						//     //append Label row with line break
						//     CSV += row + '\r\n';
						//   }
						//   //1st loop is to extract each row
						//   for (var i = 0; i < arrData.length; i++) {
						//     var row = "";
						//     //2nd loop will extract each column and convert it in string comma-seprated
						//     for (var index in arrData[i]) {
						//       row += '"' + arrData[i][index] + '",';
						//     }
						//     row.slice(0, row.length - 1);
						//     //add a line break after each row
						//     CSV += row + '\r\n';
						//   }
						//   if (CSV == '') {
						//     alert("Invalid data");
						//     return;
						//   }
						//   //Generate a file name
						//   var fileName = "Reporte_";
						//   //this will remove the blank-spaces from the title and replace it with an underscore
						//   fileName += ReportTitle.replace(/ /g, "_");
						//   //Initialize file format you want csv or xls
						//   var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
						//   // Now the little tricky part.
						//   // you can use either>> window.open(uri);
						//   // but this will not work in some browsers
						//   // or you will not get the correct file extension    
						//   //this trick will generate a temp <a /> tag
						//   var link = document.createElement("a");
						//   link.href = uri;
						//   //set the visibility hidden so it will not effect on your web-layout
						//   link.style = "visibility:hidden";
						//   link.download = fileName + ".csv";
						//   //this part will append the anchor tag and remove it after automatic click
						//   document.body.appendChild(link);
						//   link.click();
						//   document.body.removeChild(link);
						// }

	                }else{  $("#load").html("<ul class='list-group'><li class='list-group-item'></div>Ocurrio un error en la descarga</li></ul>");  }                                                           
	            }              
			}).done(function() {
				$("#contentInicio").hide();
			}) 
		
			
		});
		
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