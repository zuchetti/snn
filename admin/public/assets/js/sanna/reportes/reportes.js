

$.ajaxSetup({

    cache: false,
    headers: {
        'X-CSRF-Token': $('input[name="_token"]').val(),
        'Cache-Control': 'no-cache'
    }

});
"use strict";



var KTDatatableRemoteAjaxDemo=
{
	
	init:function()
	{
		var query="";
		var pag=1;
		var permisos=$("#permisos").val();
		var tipo=-1;
		var estado=-1;
		var fecha_ini=$("#kt_datetimepicker_ini").val();
		var fecha_fin=$("#kt_datetimepicker_fin").val();
		var datatable;
		datatable=$(".kt-datatable").KTDatatable({
			
				// datasource definition
				data: {

					cookie: false,
					type: 'remote',
					source: {
						read: {
							url: "getmodulos",
							params: {
								
							},
							
							map: function(raw) {
								// sample data mapping
							
								var dataSet = raw;
								if (typeof raw.data !== 'undefined') {
									dataSet = raw.data;
								}
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
												      <a class="page-link"  aria-label="Previous">
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
												      <a class="page-link" aria-label="Next">
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
			
				},
				pageSize: 2,
					serverPaging: false,
					serverFiltering: false,
					serverSorting: false,
	
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
						field: 'funcionalidad',
						title: 'Base de Dato',
						autoHide: false,
						sortable: 'asc',
											
						
					},{
						field: 'detalle',
						title: 'Descarga XLS',
						sortable: false,
						width: 110,
						overflow: 'visible',
						autoHide: false,
						template: function(row,index) {
							return '<a id="descarga" nombre="'+row.funcionalidad+'" idreporte="'+row.id+'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Descarga">\
							<i class="flaticon-download-1"></i>\
							</a>';														
						},
					}
				],

		}),
		

		

		$(document).on('click', "#descarga", function(e){
			var id=($(this).attr("idreporte"));
			var nombre=($(this).attr("nombre"));

			
			console.log(nombre);
			var fecha_ini=$("#kt_datetimepicker_ini").val();
			var fecha_fin=$("#kt_datetimepicker_fin").val();

			var mes=$("#mes").val();
			var anio=$("#anio").val();

			if(id==11 || id==12){
				if(mes==undefined){
					alert("Falta seleccionar el mes")
				}

				if(anio==undefined){
					alert("Falta seleccionar el mes")
				}
			}

		
			$.ajax({     
			             
				url: "getreporte",           
				data:{'id':id,'fecha_ini':fecha_ini,'fecha_fin':fecha_fin,'mes':mes,'anio':anio,
				'nombre':nombre},
				
				
				success: function(data) {       
					obj = JSON.parse(data);
					if (obj.status ==200){ 
						var data=obj.data;

						//console.log(data);
						if(id==11 || id==12){
							$.each(data, function(i, row) {

								if(row.tipo==0){
									var ws = XLSX.utils.json_to_sheet(row.tabla);
									var wb = XLSX.utils.book_new();
									XLSX.utils.book_append_sheet(wb, ws, "Hoja");
									
									XLSX.writeFile(wb, nombre+".xlsx");
								}
	
							})
						}else{

							var ws = XLSX.utils.json_to_sheet(data);
							var wb = XLSX.utils.book_new();
							XLSX.utils.book_append_sheet(wb, ws, "Hoja");
							XLSX.writeFile(wb, nombre+".xlsx");
						}
						

						/* for (const key in ws) {
							// primera línea, encabezado
						
							  ws[key].s = {
								fill: {
								  fgColor: { rgb: '#000000' }
								},
								
								border: {
								  bottom: {
									style: 'thin',
									color: '#ffffff'
								  }
								}
							  }
							
						  } */
					
				
						/* if(data=='')
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
						}	 */

					}else{  $("#load").html("<ul class='list-group'><li class='list-group-item'></div>Ocurrio un error en la descarga</li></ul>");  }                                                           
				}              
			})
		})
	
		
		
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
			//console.log($("#petxpag").val());
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
			datatable.setDataSourceParam("petxpag",10);
		}),



		$(document).on('click', "#selectpag", function(e){
			var pagina=($(this).attr("pagina"));
		
			datatable.setDataSourceParam("pag",pagina);

			datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
			datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
			datatable.load();

			//console.log(datatable.getSelectedRecords())
			  
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