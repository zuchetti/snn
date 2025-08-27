
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
                            url: "getActivosFijosTable",
                            params: {
                                pag:pag,
                                query: query,
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
                        width: 30,
                        type: 'number',
                        selector: false,
                        textAlign: 'center',
                        sortable: false,
                        hide: true,
                        template: function(row, index) {
                            idactivofijo=row.idactivofijo;
                             return ''
                        },
                    },
                    {
                        field: 'nombre',
                        title: 'Nombre',
                    },
                    {
                        field: 'cod_inventario',
                        title: 'Cod de inventario',
                        autoHide: false,

                    },
                    {
                    
                        field: 'state',
                        title: 'Estado',
                        autoHide: false,
                        sortable: 'asc',
                        // callback function support for column rendering
                        template: function(row, index) {
                        
                            
                        var status = {                           
                            0: {'title': 'Asignado', 'class': ' kt-badge--danger'},
                            1: {'title': 'No asignado', 'class': 'kt-badge--success'},
                            2: {'title': 'Dado de baja', 'class': 'kt-badge--success'},
                        };

                        return '<span class="kt-badge ' + status[row.estado].class + ' kt-badge--inline kt-badge--pill">' + status[row.estado].title + '</span>';

                        
                        }
                    },

                   
                    {
                        field: 'Acciones',
                        title: 'Acciones',
                        sortable: false,
                        width: 110,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row,index) {
                            return '<a href="editActivoFijo?idactivofijo='+row.idactivofijo+'" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Acciones">\
                                <i class="far fa-edit"></i>\
                            </a>\
                            <div onclick="remover('+row.idactivofijo+')" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Acciones">\
                                <i class="fas fa-trash-alt"></i>\
                            </div>';  
                            
                            
                        },
                    }],

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

        $(document).on('click', "#aprobardescanso", function(e){
            var idpeticiondm=($(this).attr("idpeticiondm"));
            request = $.ajax({                                   
                url: "descansosaprobar",           

                data:{'idpeticion':idpeticiondm},
                success: function(data) {       
                    obj = JSON.parse(data);
                  

                    if (obj.status ==200){datatable.load();//location.href='descansos';
                    }else{ location.href='descansos';}                                                           
                }              
            });  
        }),
        $(document).on('click', "#denegardescanso", function(e){
            var idpeticiondm=($(this).attr("idpeticiondm"));
        
            request = $.ajax({                                   
                url: "descansosdenegar",           

                data:{'idpeticion':idpeticiondm},
                
                success: function(data) {       
                    obj = JSON.parse(data);
                 

                    if (obj.status ==200){datatable.load();//location.href='descansos';
                    }else{// location.href='descansos';
                    }                                                           
                }              
            });  
        }),

        $(document).on('click', "#selectpag", function(e){
            var pagina=($(this).attr("pagina"));
        
            datatable.setDataSourceParam("pag",pagina);

            datatable.setDataSourceParam("fecha_ini",$("#kt_datetimepicker_ini").val());
            datatable.setDataSourceParam("fecha_fin",$("#kt_datetimepicker_fin").val());
            datatable.load();
              
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

//remover
function remover(idactivofijo){

		
	$("#idactivofijo").val(idactivofijo)

	$('#modalconfirmacion').modal('show');

	
}


//remover
function handleAccept(idactivofijo){

	$.ajax({
        'url': "deleteActivoFijo",
        beforeSend: function() {
			$('.accept').prop('disabled', true);
        },
		'data':{'idactivofijo':$("#idactivofijo").val()},
		
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
}