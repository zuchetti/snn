$.ajaxSetup({
	headers:{
	'X-CSRF-Token': $('input[name="_token"]').val()
	},
	 /* beforeSend: function() {
		
		$.blockUI();
		
	},
	complete : function(){
		$.unblockUI()
	}  */
});


"use strict";

var query="";
var pag=1;
var permisos=$("#permisos").val();
var tipo=-1;
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
							url: "getusuarios",
							params: {
								query: query,
								pag: pag,
								tipo: tipo,
								petxpag: petxpag
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
	
				columns: [
					{
						field: 'icono',
						title: '',
						width: 30,
						type: 'number',
						selector: false,
						textAlign: 'center',
						sortable: false,
						hide: true,
						template: function(row, index) {
							id=row.id;
							 return ''
						},
					},{
						field: 'nombres',
						title: 'Nombres',
					},{
						field: 'apellidos',
						title: 'Apellidos',
					}, {
						field: 'dni',
						title: 'DNI',
					},{
						field: 'email',
						title: 'Correo',
					},{
						field: 'idrol',
						title: 'Rol',
						autoHide: false,
						sortable: 'asc',
						// callback function support for column rendering
						template: function(row, index) {
						
							
							var status = {
								1: {'title': 'Super Administrador', 'class': 'kt-badge--brand'},
								2: {'title': 'Analista Operativo', 'class': 'kt-badge--success'},
								3: {'title': 'Supervisor de comunicaciones', 'class': ' kt-badge--danger'}
							};
							return '<span class="kt-badge ' + status[row.idrol].class + ' kt-badge--inline kt-badge--pill">' + status[row.idrol].title + '</span>';			
						},
					}, {
						field: 'editar',
						title: 'Acciones',
						sortable: false,
						width: 110,
						overflow: 'visible',
						autoHide: false,
						template: function(row,index) {
							return '<a href="editarusuario?id='+row.idusuario+'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Editar">\
							<i class="flaticon-edit"></i>\
							</a><a href="borrarusuario?id='+row.idusuario+'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Editar">\
							<i class="flaticon2-trash"></i>\
							</a>';														
						},
					}
				],

		}),
		
		$('#kt_form_type').on('change', function() {
			datatable.setDataSourceParam("tipo",$(this).val());
			datatable.setDataSourceParam("pag",1);
			datatable.load();
		}),
		$('#petxpag').on('change', function() {
			datatable.setDataSourceParam("petxpag",$("#petxpag").val());
			datatable.setDataSourceParam("pag",1);
			datatable.load();
			console.log($("#petxpag").val());
		}),
		
		$('#generalSearch').keyup(function(){
			query=document.getElementById("generalSearch").value;
			datatable.setDataSourceParam("pag",1);
			datatable.setDataSourceParam("query",query);
			datatable.load();
			
		}),
		$(window).on('beforeunload', function(){
   			datatable.setDataSourceParam("pag",1);
   			
			datatable.setDataSourceParam("query","");
			datatable.setDataSourceParam("petxpag",10);
		}),

		$(document).on('click', "#selectpag", function(e){
			var pagina=($(this).attr("pagina"));
			datatable.setDataSourceParam("pag",pagina);
			datatable.load();	     
		}),

		$(document).on('click', "#next", function(e){
			var pagina=parseInt($(this).attr("pagina"))+1;
			datatable.setDataSourceParam("pag",pagina);
			datatable.load();
			  
		}),

		$(document).on('click', "#prev", function(e){	
			var pagina=parseInt($(this).attr("pagina"))-1;		
			datatable.setDataSourceParam("pag",pagina);
			datatable.load();		  
		}),

	

		$('#kt_form_status,#kt_form_type').selectpicker()

	}



}; 


jQuery(document).ready(function() {
	
    KTDatatableRemoteAjaxDemo.init()
	
})



