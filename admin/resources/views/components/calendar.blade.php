<script>

var KTCalendarBasic = function() {

return {
    //main function to initiate the module
    init: function() {
        var fecha_ini_=$("#fecha_ini").val();
        var fecha_ini= moment(fecha_ini_);
        var todayDate = moment().startOf('day');


        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
        
        var VISTAMONTH=fecha_ini.format('YYYY-MM-DD');

        var nuevo;
        var dia;
        var hora_ini;
        var hora_fin;
        var idprofesional;
        var planilla;
        var motivo;
        var comentario;
        var idprogramacionmedica;
        var idtopico=$("#idtopico").val();
        var idprofesionalreemplazo;
        var idprogramacionmedica;
        var eventoinfo;
        var eliminados=[];
        var horarios=[];
        var nombresp;
        var calendarEl = document.getElementById('kt_calendar');
        var count=0;
        var idtipoprofesional;



        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            themeSystem: 'bootstrap',

            isRTL: KTUtil.isRTL(),

            header: {
                left: 'prev,next hoy',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
           

            views: {
                    dayGridMonth: { buttonText: 'Mes' },
                    timeGridWeek: { buttonText: 'Semana' },
                    timeGridDay: { buttonText: 'Dia' }
                },


            defaultView: 'dayGridMonth',
            defaultDate: VISTAMONTH,
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events:     [<?php 

            if($calendario->status==200){
                
                foreach ($calendario->data as $item) {
                    echo '{
                        title: "'.$item->title.'",
                        daysOfWeek: "'.$item->daysOfWeek.'", 
                        daysOfWeek: [
                            "'.$item->daysOfWeek.'"
                        ],
                        startTime: "'.$item->startTime.'",
                        endTime: "'.$item->endTime.'",
                        display: "background",
                        rendering: "background",
                        className: "fc-event-danger fc-event-solid-warning"
                    },';             
                }

                foreach ($calendario->programado as $item) {
                    echo '{
                        title: "'.$item->title.'",
                        id:"'.$item->idprogramacionmedica.'",
                        start: "'.$item->start.'", 
                        end: "'.$item->end.'",
                        idprofesional:"'.$item->idprofesional.'",
                        idespecialidad:"'.$item->idespecialidad.'",
                        className:"'.$item->className.'",
                        description: "",
                        popup:"Reemplazar",
                        nuevo:0,
                        editado:0
                    },';             
                }        
            }
            ?> ],

            eventClick: function(info) {

                if ( typeof info.event.id !== "undefined" && info.event.id) {
                    
                    var element = $(info.el);

                    idprofesional=info.event.extendedProps.idprofesional;
                    idprogramacionmedica=info.event.id;
                    start=info.event.start.toISOString();
                    end=info.event.end.toISOString();
                    eventoinfo=info.event;
                    idtipoprofesional=info.event.extendedProps.idespecialidad;
                   
                    dia =  start.split("T")[0];
                    nombres=info.event.title;
                    hora_ini=start.split("T")[1];

                    var start =info.event.start; // Or the date you'd like converted.
                    var start = new Date(start.getTime() - (start.getTimezoneOffset() * 60000)).toISOString();
                    var end =info.event.end; // Or the date you'd like converted.
                    var end = new Date(end.getTime() - (end.getTimezoneOffset() * 60000)).toISOString();
                    hora_ini=start.split("T")[1];
                    hora_ini=hora_ini.split("Z")[0];
                    $('#hora_ini_reemplazo').val(hora_ini);
                    hora_fin=end.split("T")[1];
                    hora_fin=hora_fin.split("Z")[0];
                    $('#hora_fin_reemplazo').val(hora_fin);                 
        
                    $('#nombremodal').val(nombres);               
                    $('#fecha_reemplazo').html(dia);               
                    $('#kt_modal_2').modal('show');
                }   
                

                // change the border color just for fun
                //info.el.style.borderColor = 'red';
              },

            dateClick: function(info) {
            
               var element = $(info.el);
               data=info.dateStr;
               
               dia = data.split("T")[0];
               horas=data.split("T")[1];
               if (typeof horas !== "undefined") {
                    hora_ini=horas.split("-")[0];
                    $('#hora_ini').val(hora_ini);
                }
               $('#fechamodal').html(dia);               
               $('#kt_modal_7').modal('show');
                
            },

            eventRender: function(info) {
                var element = $(info.el);

                if (info.event.extendedProps && info.event.extendedProps.popup) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', info.event.extendedProps.popup);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        element.data('content', info.event.extendedProps.popup);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' +  info.event.extendedProps.popup + '</div>');
                    }
                }
            },


        });

        

        calendar.render();

        $('#generalSearch').attr("disabled", true);
        $('#generalSearch').select2({
            tags: false,
            allowClear: true,
                placeholder: {
                id: '-1', // the value of the option
                text: 'Seleccione una opción'
            }
        });

        $('#hora_ini').change(function () {
            var value = $(this).val();
            if (value.length == 0) {
                $('#generalSearch').val();
                $('#generalSearch').attr("disabled", true);
            }else
            hora_ini=value;
console.log("change");
            $('#generalSearch').attr("disabled", true);


        });

        $('#hora_fin').change(function () {
            var value = $(this).val();
            if (value.length == 0 ) {
                $('#generalSearch').val();
                $('#generalSearch').attr("disabled", true);
            }else
            hora_fin=value;
            console.log("change");
            $('#generalSearch').attr("disabled", true);

        });

        $(document).on('click', "#prueba", function(e){            
            eventSource=(calendar.getEventSources());
            eventSource.remove();             
        });

        $(document).on('click', "#repetir", function(e){            
            $('#kt_modal_3').modal('show');         
            
        });

        
        $(document).on('click', "#btmodal_repetir", function(e){

            var anio_origen=$('#anio_origen').val();
            var anio_destino=$('#anio_destino').val();
            var mes_origen=$('#mes_origen').val();
            var mes_destino =$('#mes_destino').val();

            console.log(anio_origen);
            console.log(anio_destino);
            console.log(mes_origen);
            console.log(mes_destino );

            if(anio_origen==undefined || anio_origen==""){
                $('#alerts4').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese el año de origen </div>');
                setTimeout(function() { $('#alerts4').html('');},2000);
                return false;
            }


            if(anio_destino==undefined || anio_destino==""){
                $('#alerts4').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese el año de destino</div>');
                setTimeout(function() { $('#alerts4').html('');},2000);
                return false;
            }

            if(mes_origen==undefined || mes_origen==""){
                $('#alerts4').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione el mes de origen</div>');
                setTimeout(function() { $('#alerts4').html('');},2000);
                return false;
            }
            if(mes_destino ==undefined || mes_destino ==""){
                $('#alerts4').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese el mes de destino </div>');
                setTimeout(function() { $('#alerts4').html('');},2000);
                return false;
            }        
            
            var idtopico=$("#idtopico").val();

            request = $.ajax({                                   
                url: "repetirProgramacion",           

                data:{'anio_destino':anio_destino,'mes_destino':mes_destino , 'anio_origen':anio_origen,'mes_origen':mes_origen,'idtopico':idtopico},
                beforeSend: function() {
                    
                    $('#repetir').prop('disabled', true);
                    $('#btmodal_repetir').prop('disabled', true);
                    $(".spinner-border").fadeIn(200);　
                },
                success: function(data) {       
                    obj = JSON.parse(data);
                 
                    if (obj.status ==200){
                        $('#alerts4').html('<div class="alert alert-success">' +
                        '<button type="button" class="close" data-dismiss="alert">' +
                        '&times;</button>'+obj.message+'</div>');
                        window.setTimeout(function(){window.location.href = 'calendario?idtopico='+idtopico},1000);

                    
                    }else{
                        $('#alerts4').html('<div class="alert alert-danger">' +
                        '<button type="button" class="close" data-dismiss="alert">' +
                        '&times;</button>'+obj.message+'</div>');
                        $('#btmodal_repetir').prop('disabled', false);
                        $('#repetir').prop('disabled', false);
                    }                                                           
                }              
            });    
        });

        $(document).on('click', "#btnmodal_agregar", function(e){

            $("[name='hora_ini'").each(function () {
                if($(this).val()!=""){
                    hora_ini=($(this).val());
                }
            });
            
            $("[name='hora_fin'").each(function () {
                if($(this).val()!=""){
                    hora_fin=($(this).val());
                }
            });
            
            especialidad=$("#especialidades_rb input[type='radio']:checked").val(); 
            
            if(hora_ini==undefined || hora_ini==""){
                $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione la hora de inicio</div>');
                setTimeout(function() { $('#alerts').html('');},2000);
                return false;
            }

            if(hora_fin==undefined || hora_fin==""){
                $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione la hora fin</div>');
                setTimeout(function() { $('#alerts').html('');},2000);
                return false;
            }

            if(idprofesional==undefined || idprofesional==""){
                $('#alerts').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese el nombre del médico</div>');
                setTimeout(function() { $('#alerts').html('');},2000);
                return false;
            }

            if(especialidad==undefined || especialidad==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione la especialidad</div>');
                setTimeout(function() { $('#alerts').html('');},2000);
                return false;
            }
 
            if(hora_ini!=undefined && hora_ini!="" || hora_fin!=undefined && hora_fin!="" && idprofesional!=undefined && idprofesional!="" && especialidad!=undefined && especialidad!=""){

                if($('#repetirbloque input[type=checkbox]').prop('checked')) nuevo=2;
                else nuevo=1;

                count=count+1;
                calendar.addEvent( 
                    {
                        start: dia+'T'+hora_ini,
                        nuevo:nuevo,
                        editado:0,
                        end: dia+'T'+hora_fin,
                        id:'_'+count,
                        overlap:false,
                        idprofesional: idprofesional,
                        title: nombresp,
                        idespecialidad: especialidad
                    }
                );
                console.log(nombresp);

                $('#alerts').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Agregado exitosamente, guardar los cambios</div>');
                setTimeout(function() { $('#alerts').html('');},2000);

                hora_ini="";
                hora_fin="";
                idprofesional="";
                $("#generalSearch").val();
                $('#hora_ini').val(hora_ini);
                $('#hora_fin').val(hora_fin);
                setTimeout(function() {$('#kt_modal_7').modal('toggle'); },2000);
                
            }
            
                  
        });

        $(document).on('click', "#btnmodal_reemplazar", function(e){


            $("[name='hora_ini_reemplazo'").each(function () {
                if($(this).val()!=""){
                    hora_ini=($(this).val());
                }
            });
            
            $("[name='hora_fin_reemplazo'").each(function () {
                if($(this).val()!=""){
                    hora_fin=($(this).val());
                }
            });

            var start=dia+"T"+hora_ini;
            var end=dia+"T"+hora_fin;
            comentario=$('#comentario').val();
            motivo=$("#motivo input[type='radio']:checked").val(); 
            planilla=$("#planilla input[type='radio']:checked").val(); 

            console.log(start);

            if(hora_ini==undefined || hora_ini==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione la hora de inicio</div>');
                setTimeout(function() { $('#alerts2').html('');},2000);
                return false;
            }

            if(hora_fin==undefined || hora_fin==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione la hora fin</div>');
                setTimeout(function() { $('#alerts2').html('');},2000);
                return false;
            }


            if(comentario==undefined || comentario==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese el comentario</div>');
                setTimeout(function() { $('#alerts2').html('');},2000);
                return false;
            }


            if(motivo==undefined || motivo==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione el motivo</div>');
                setTimeout(function() { $('#alerts2').html('');},2000);
                return false;
            }

            if(planilla==undefined || planilla==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Seleccione la planillña</div>');
                setTimeout(function() { $('#alerts2').html('');},2000);
                return false;
            }
            if(idprofesionalreemplazo==undefined || idprofesionalreemplazo==""){
                $('#alerts2').html('<div class="alert alert-info">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Ingrese el nombre del médico </div>');
                setTimeout(function() { $('#alerts2').html('');},2000);
                return false;
            }
            
            if(hora_ini!=undefined && hora_ini!="" || hora_fin!=undefined && hora_fin!="" && comentario!=undefined && comentario!="" && motivo!=undefined && motivo!="" && planilla!=undefined && planilla!="" && idprofesionalreemplazo!=undefined && idprofesionalreemplazo!=""){
                eventoinfo.setDates( start, end );
                eventoinfo.setExtendedProp( 'editado', 1 );
                eventoinfo.setExtendedProp( 'comentario', comentario);
                eventoinfo.setExtendedProp( 'motivo', motivo );
                eventoinfo.setExtendedProp( 'planilla', planilla );
                eventoinfo.setExtendedProp( 'idprofesional', idprofesional );
                eventoinfo.setExtendedProp( 'idprofesionalreemplazo', idprofesionalreemplazo );
                eventoinfo.setProp( 'title', nombresp );

                $('#alerts').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> reemplazado exitosamente, guardar los cambios</div>');
                setTimeout(function() { $('#alerts').html('');},2000);
                $('input:radio[name=motivo]').each(function () { $(this).prop('checked', false); });
                $('input:radio[name=planilla]').each(function () { $(this).prop('checked', false); });
                hora_ini="";
                hora_fin="";
                idprofesional="";
                idprofesionalreemplazo="";
                $("#generalSearch_reemplazo").val("");
                $("#comentario").val("");
                $('#hora_ini_reemplazo').val(hora_ini);
                $('#hora_fin_reemplazo').val(hora_fin);
                setTimeout(function() {$('#kt_modal_2').modal('toggle'); },2000);  
            }

                      
        });

        $(document).on('click', "#btnmodal_borrar", function(e){           
           if (eventoinfo.extendedProps.nuevo==0 ) {
                eliminados.push(eventoinfo.id);
            }    
           eventoinfo.remove();
        });

        $(document).on('click', "#guardarhorario", function(e){

               var calendario=calendar.getEvents();
               horario=[];
               calendario.forEach(function(evento,index){
                    if ( typeof evento.id !== "undefined" && evento.id) {
 
                        var start =evento.start; // Or the date you'd like converted.
                        var start = new Date(start.getTime() - (start.getTimezoneOffset() * 60000)).toISOString();
                        var end =evento.end; // Or the date you'd like converted.
                        var end = new Date(end.getTime() - (end.getTimezoneOffset() * 60000)).toISOString();
                        hora_ini=start.split("T")[1];
                        hora_ini=hora_ini.split("Z")[0];
                        
                        hora_fin=end.split("T")[1];
                        hora_fin=hora_fin.split("Z")[0];

                        dia=start.split("T")[0];
                        
                        nuevo=evento.extendedProps.nuevo;
                        editado=evento.extendedProps.editado;
                        motivo=evento.extendedProps.motivo;
                        comentario=evento.extendedProps.comentario;
                        planilla=evento.extendedProps.planilla;
                        idprofesional=evento.extendedProps.idprofesional;
                        idprofesionalreemplazo=evento.extendedProps.idprofesionalreemplazo;
                        idespecialidad=evento.extendedProps.idespecialidad;

                         horario.push({
                            idprogramacionmedica: evento.id,
                            hora_ini: hora_ini,
                            hora_fin: hora_fin,
                            dia:dia,
                            nuevo:nuevo,
                            editado:editado,
                            comentario:comentario,
                            motivo:motivo,
                            idplanilla:planilla,                        
                            idprofesional_actual:idprofesional,
                            idprofesional_reemplazo:idprofesionalreemplazo,
                            idespecialidad:idespecialidad

                        }); 
                    }                
               });
                
                console.log(horario); 
                console.log(eliminados); 
                var idtopico=$("#idtopico").val();

            
                if(horario.length==0){
                    $('#alerts3').html('<div class="alert alert-info">' +
                   '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>Debe ingresar el horario</div>');
                    return false;
                }
                $.ajaxSetup(
                    {
                        headers:
                        {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
                });


                
                request = $.ajax({                                   
                    url: "editarHorarioProgramacionmedica",           
                    method: "POST",
                    data:{'horario':horario,'eliminados':eliminados,'idtopico':idtopico},
                    beforeSend: function() {
                        $("#disponibles").show();
                        $('#btnmodal_agregar').prop('disabled', true);
                        $('#guardarhorario').prop('disabled', true);
                        $(".spinner-border").fadeIn(200);　
                    },
                    success: function(data) {       
                        obj = JSON.parse(data);
                     

                        if (obj.status ==200){
                            $('#alerts3').html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">' +
                            '&times;</button>'+obj.message+'</div>');

                            window.setTimeout(function()
                                {
                                    $('#alerts').html('');
                                window.location.href = 'calendario?idtopico='+idtopico
                            },2000);

                        
                        }else{
                            $('#alerts3').html('<div class="alert alert-danger">' +
                            '<button type="button" class="close" data-dismiss="alert">' +
                            '&times;</button>'+obj.message+'</div>');
                            $('#guardarhorario').prop('disabled', false);


                        }                                                           
                    }              
                });
        });

 
        //////////buscar medico
        var buscando = null;
        
        $( "#generalSearch" ).change(function() {
            idprofesional=$("#generalSearch").val();
            nombresp = $('option:selected', this).attr('nombres');
            console.log(idprofesional);
            console.log(nombresp);
        });



        $('#buscador_profesional').click(function(){

            
            var idtipoprofesional=$("#especialidades_rb input[type='radio']:checked").val(); 
            console.log(idtipoprofesional);

            $.ajax({
                'url': "getProfesionalesDispo",
                'data': {'query':"",'fecha':dia,'hora_ini':hora_ini,'hora_fin':hora_fin,'idtipoprofesional':idtipoprofesional},
                beforeSend: function() {
                        $("#resultados").show();
                        $("#resultados").html("<div class='spinner-border spinner-border-sm' style='margin-right:10px;' role='status'> </div> Espere un momento por favor");                    
            
                    },
                'success': function(data) {
                    obj = JSON.parse(data);
                    var option ="<option value=''></option>";
                    $.each(obj.data.horarios, function(i, value) {
                        var nombres=value.nombres+'  '+ value.ape_paterno+' '+ value.ape_materno;

                        option += `
                            <option nombres="` + nombres + `" value="` + value.idprofesional + `">` + nombres + `</option>
                        `;

                    })

                    $('#generalSearch').removeAttr("disabled");
                    $('#resultados').hide();
                    $('#generalSearch').html(option);

                }
            })
        })





       /*  $('#generalSearch').keyup(function(){

            var query = $(this).val();
            if (buscando && buscando.readyState != 4) {
                buscando.abort();
            }
            var idtipoprofesional=$("#especialidades_rb input[type='radio']:checked").val(); 

            if(query !=""){
                buscando =$.ajax({
                    'url': "getProfesionalesDispo",
                    'data': {'query':query,'fecha':dia,'hora_ini':hora_ini,'hora_fin':hora_fin,'idtipoprofesional':idtipoprofesional},
                    beforeSend: function() {
                        $("#resultados").show();
                        $("#resultados").html("<div class='spinner-border spinner-border-sm' style='margin-right:10px;' role='status'> </div> Espere un momento por favor");                    
            
                    },
                    'success': function(data) {
                        obj = JSON.parse(data);
                        var contenido = '<ul class="list-group">';
                    
                        if(obj.status==200){
                            
                            $.each(obj.data.horarios, function(i, value) {
                                var nombres=value.nombres +' '+ value.ape_materno +' '+ value.ape_paterno;
                                contenido += `
                                    <li class="list-group-item" nombres=" ` + nombres + `" idprofesional=" ` + value.idprofesional + `">
                                    <div><b>` + nombres + `</b></div>                                                   
                                    </li>
                                                                        
                                `;
                            })


                        }else{
                            contenido = '<li class="list-group-item">'+obj.message+'</li>';

                        } 
                        contenido += '</ul>';
                        $('#resultados').html(contenido);

                        $(".list-group-item").click(function() {
                           
                            idprofesional = $(this).attr("idprofesional");
                            nombresp = $(this).attr("nombres");
                            $("#generalSearch").val(nombresp);
                           
                        
                        })
                        $(document).mouseup(function (e){
                            var container = $("#resultados");

                            if (container.has(e.target).length === 0) {
                                container.hide();
                            }else{
                                container.show();
                                
                            }
                        });

                    }
            
                })
               

            }else{
                setTimeout(function(){buscando.abort();}, 1000);
                $("#resultados").hide();  
            }                                                                                                                                                                                                                                         

            
       
        }); */

        //buscar reemplazo
        var buscandoReemplazo = null;
        var idprofesionalreemplazo;

        $('#especialidades input[type=checkbox]').change(function() {
            var e_check = [];
            $('#especialidades input:checked').each(function() {
                e_check.push($(this).val());
            });

            var e_uncheck = [];
            $('#especialidades input:unchecked').each(function() {
                e_uncheck.push($(this).val());
            });

            var calendario=calendar.getEvents();
            calendario.forEach(function(evento,index){
                if ( typeof evento.id !== "undefined" && evento.id && evento.extendedProps.nuevo==0 ) {
                    if($.inArray(evento.extendedProps.idespecialidad,e_uncheck)>=0){
                        evento.remove();
                    }else if($.inArray(evento.extendedProps.idespecialidad,e_check)>=0){
                        e_check.splice($.inArray(evento.extendedProps.idespecialidad,e_check), 1);
                    }
                }                
            });

            var eventos=[<?php 
                foreach ($calendario->programado as $item) {
                    echo '{
                        title: "'.$item->title.'",
                        id:"'.$item->idprogramacionmedica.'",
                        start: "'.$item->start.'", 
                        end: "'.$item->end.'",
                        idprofesional:"'.$item->idprofesional.'",
                        idespecialidad:"'.$item->idespecialidad.'",
                        className:"'.$item->className.'",
                        description: "",
                        popup:"Reemplazar",
                        nuevo:0,
                        editado:0
                    },';             
                }?> ];

            $.each(eventos, function( index, value ) {
                if($.inArray(value.idespecialidad,e_check)>=0){
                    calendar.addEvent(value);
                }
            });

        });


        
        $("#especialidades_rb input[type='radio']").change(function() {
            console.log("change");
            $('#generalSearch').attr("disabled", true);
        });

        $('#generalSearch_reemplazo').keyup(function(){

           var hora_ini_reemplazo=$("#hora_ini_reemplazo").val();
           var hora_fin_reemplazo=$("#hora_fin_reemplazo").val();

           console.log(hora_ini_reemplazo);
           console.log(hora_fin_reemplazo);

           console.log(idtipoprofesional);
            var query = $(this).val();

        

            if (buscandoReemplazo && buscandoReemplazo.readyState != 4) {
                buscandoReemplazo.abort();
            }

            if(query !=""){
                buscandoReemplazo =$.ajax({
                    'url': "getProfesionalesDispo",
                    'data': {'query':query,'fecha':dia,'hora_ini':hora_ini_reemplazo,'hora_fin':hora_fin_reemplazo, 'idtipoprofesional':idtipoprofesional},
                    beforeSend: function() {
                        $("#disponibles").show();
                        $("#disponibles").html("<div class='spinner-border spinner-border-sm' style='margin-right:10px;' role='status'> </div> Espere un momento por favor");                    

                    },
                    'success': function(data) {
                        obj = JSON.parse(data);
                        var contenido = '<ul class="list-group">';
                       
                        if(obj.status==200){
                            
                            $.each(obj.data.horarios, function(i, value) {
                                var nombres=value.nombres +' '+ value.ape_materno +' '+ value.ape_paterno;
                                contenido += `
                                    <li class="list-group-item" nombres=" ` + nombres + `" idprofesional=" ` + value.idprofesional + `">
                                    <div><b>` + nombres + `</b></div>                                                   
                                    </li>
                                                                        
                                `;
                            })


                        }else{
                            contenido = '<li class="list-group-item">'+obj.message+'</li>';

                        } 
                        contenido += '</ul>';
                        $('#disponibles').html(contenido);

                        $(".list-group-item").click(function() {
                        
                            idprofesionalreemplazo = $(this).attr("idprofesional");
                            nombresp = $(this).attr("nombres");
                            $("#generalSearch_reemplazo").val(nombresp);
                        
                        
                        })
                        $(document).mouseup(function (e){
                            var container = $("#disponibles");

                            if (container.has(e.target).length === 0) {
                                container.hide();
                            }else{
                                container.show();
                                
                            }
                        });

                    }

                })
            

            }else{
                setTimeout(function(){buscandoReemplazo.abort();}, 1000);
                $("#disponibles").hide();

            }           
            
                   
        });


     
    }
};
}();

jQuery(document).ready(function() {
KTCalendarBasic.init();
});



</script>