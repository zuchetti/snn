
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
var idgrupo=($("#boton").attr("idgrupo"));


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
                            url: "getMedicamentosAllTable",
                            params: {
                                pag:pag,
                                query: query,
                                petxpag: petxpag,
                                idgrupo: idgrupo
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
                            idmedicamento=row.idmedicamento;
                             return ''
                        },
                    },{
                        field: 'idmedicamento',
                        title: 'ID',
                        autoHide: false,
                        selector: {
                            class: 'kt-checkbox--solid'
                        }
                        // callback function support for column rendering
                        
                    }, 
                    {
                        field: '',
                        title: 'Ingrese la cant',
                        sortable: false,
                        width: 110,
                        overflow: 'visible',
                        autoHide: false,
                        template: function(row,index) {
                            return '<input type="number" max="'+row.cantidad+'" min="0" data-idmedicamento="'+idmedicamento+'" name="cantidad" class="form-control bg-light border-0 small">';  
                        },
                    },
                    
                    {
                        field: 'producto',
                        title: 'Nombre de medicamento',
                    }, {
                        field: 'cod_producto',
                        title: 'Nº de articulo',
                        
                        },{
                        field: 'descripcion',
                        title: 'Descripción',
                        
                    },{
                        field: 'presentacion_',
                        title: 'Unidad',
                        autoHide: false,

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
            datatable.setDataSourceParam("petxpag",150);
            datatable.setDataSourceParam("idgrupo",idgrupo);
            console.log(idgrupo);
            console.log("hi");
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

        ////------click crear grupo------
        $('.agregar').click( function() {
            var IdMedicamentos = [];
            var cantidad = [];
            var idmedicamento;
            var contarrId=0;
            var contarrCant=0;

            var idgrupo=($(this).attr("idgrupo"));
            var nombre=($(this).attr("nombre"));


            $("input[type=checkbox]").each(function () {
                if (this.checked && this.value!="on") {
                    contarrId++;
                }
            })

            $("input[name=cantidad]").each(function () {
                if (this.value!="") {
                    contarrCant++;
                }
            })
    
            if(contarrId==0){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Seleccione un <strong> medicamento</strong></div>');
                return false;
            }

            if(contarrCant < contarrId){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Ingrese la cantidad de cada medicamento seleccionado</div>');
                return false;
            }

            if(contarrCant > contarrId){
                $('#alerts').html('<div class="alert alert-info">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button> Seleccione el medicamento e ingrese la cantidad del mismo</div>');
                return false;
            }

            $("input[type=checkbox]").each(function () {
                if (this.checked && this.value!="on") {
                    IdMedicamentos.push($(this).val());
                }
            })

            $("input[name=cantidad]").each(function () {
                if (this.value!="") {
                    cantidad.push($(this).val());
                }
            })

            var listamedicamentos = [];

            for(x=0;x<IdMedicamentos.length;x++){
                listamedicamentos.push({
                    'idmedicamento': IdMedicamentos[x],
                    'cantidad': cantidad[x],
                }); 
            }

          

            $.ajax({
                'url': "agregarMedicamentoGrupo",
                'data':{'idgrupo':idgrupo,'listamedicamentos':listamedicamentos},
                beforeSend: function() {
                    $('#boton').prop('disabled', true);  
                    $(".spinner-border").fadeIn(200);　
                }
            }).done( function(data) {
                $(".spinner-border").hide();　
                obj = JSON.parse(data);
        
                if(obj.status == 200){
    
                    $('#alerts').html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>'+obj.message+'</div>');
                    $('#boton').prop('disabled', true);
                    setTimeout(function() {
                       // location.reload();
                        location.href='detalleGrupo?idgrupo='+idgrupo+'&nombre='+nombre;

                    }, 1000);
                }
         
                if(obj.status == 100){
                    $('#alerts').html('<div class="alert alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>'+obj.message+'</div>');
                     $('#boton').prop('disabled', false);
                
                }
            
        
            })
        })  
    }
}; 
jQuery(document).ready(function() { 
    KTDatatableRemoteAjaxDemo.init()
})

