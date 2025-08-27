<script>

var KTCalendarBasic = function() {

return {
    //main function to initiate the module
    init: function() {
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
        
        var dia;
        
        var hora_ini;
        var hora_fin;
        var horario=[];
        var eliminados=[];
        var eventoinfo;
        var count=0;

        var calendarEl = document.getElementById('kt_calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'local',
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            themeSystem: 'bootstrap',

            isRTL: KTUtil.isRTL(),

            header: {
                left: '',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
           

            views: {                    
                    timeGridWeek: { buttonText: 'Semana' },
                    timeGridDay: { buttonText: 'Dia' }
                },


            defaultView: 'timeGridWeek',
            defaultDate: TODAY,

            editable: false,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events:     [<?php 
                /*
            if($calendario->status==200){
                
                foreach ($calendario->data as $item) {
                    echo "{
                        title: '',
                        daysOfWeek: '".$item->dia."', 
                        daysOfWeek: [
                            '".$item->dia."'
                        ],
                        startTime: '".$item->hora_ini."',
                        endTime: '".$item->hora_fin."',
                        className: 'fc-event-success',
                        id:'".$item->idmedicohorario."',
                        nuevo:0,
                        editado:0,
                        overlap:false           

                     },";             
                }
                       
            }*/
            ?> ],

            eventClick: function(info) {

                if ( typeof info.event.id !== "undefined" && info.event.id) {                    

                    idprofesional=info.event.extendedProps.idprofesional;
                    idprogramacionmedica=info.event.id;
                    start=info.event.start.toISOString();
                    end=info.event.end.toISOString();
                    console.log(start);
                    dia =  start.split("T")[0];
                    nombres=info.event.title;           
                    eventoinfo=info.event;
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
                    $('#fecha_reemplazo').html(dia);               
                    $('#kt_modal_2').modal('show');
                } 

              },

            dateClick: function(info) {
            
               var element = $(info.el);
               data=info.dateStr;
               horario=[];

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

            /*eventResize:function(info){
                info.event.setExtendedProp( 'editado', 1 );
                console.log("Cambio");
            },

            eventDrop:function(info){
                info.event.setExtendedProp( 'editado', 1 );
                console.log("Cambio");
            }*/


        });

        

        calendar.render();

        $('#btnmodal_agregar').attr("disabled", true);


        $('#hora_ini').change(function () {
            var value = $(this).val();
            if (value.length == 0) {
                $('#btnmodal_agregar').attr("disabled", true);
            }else
            hora_ini=value;
            $('#btnmodal_agregar').removeAttr("disabled");

        });

        $('#hora_fin').change(function () {
            var value = $(this).val();
            if (value.length == 0 ) {
                $('#btnmodal_agregar').attr("disabled", true);
            }else
            hora_fin=value;

            $('#btnmodal_agregar').removeAttr("disabled");

        });

        $(document).on('click', "#guardarhorario", function(e){

               var calendario=calendar.getEvents();
               horario=[];
               calendario.forEach(function(evento,index){
                    var start =evento.start; // Or the date you'd like converted.
                    var start = new Date(start.getTime() - (start.getTimezoneOffset() * 60000)).toISOString();
                    var end =evento.end; // Or the date you'd like converted.
                    var end = new Date(end.getTime() - (end.getTimezoneOffset() * 60000)).toISOString();
                    hora_ini=start.split("T")[1];
                    hora_ini=hora_ini.split("Z")[0];
                    
                    hora_fin=end.split("T")[1];
                    hora_fin=hora_fin.split("Z")[0];

                    dia=start.split("T")[0];
                    dia=new Date(dia);
                    dia=dia.getDay()+1;

                    nuevo=evento.extendedProps.nuevo;
                    editado=evento.extendedProps.editado;

                     horario.push({
                        id : evento.id,
                        hora_ini: hora_ini,
                        display:evento.display,
                        hora_fin: hora_fin,
                        dia:dia,
                        nuevo:nuevo,
                        editado:editado
                    });                 
               });             
      
                var idprofesional=$("#idprofesional").val();

                if(horario.length==0){
                    $('#alerts3').html('<div class="alert alert-info">' +
                   '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>Debe ingresar el horario</div>');
                    return false;
                }
                
                request = $.ajax({                                   
                    url: "editarHorarioPersonalmedico",           

                    data:{'horario':horario,'eliminados':eliminados,'idprofesional':idprofesional},
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
                            window.setTimeout(function(){window.location.href = 'personalmedico?idsubfuncionalidad=6'},1000);

                        
                        }else{
                            $('#alerts3').html('<div class="alert alert-danger">' +
                            '<button type="button" class="close" data-dismiss="alert">' +
                            '&times;</button>'+obj.message+'</div>');
                            $('#guardarhorario').prop('disabled', false);
                        }                                                           
                    }              
                });   
        });


        $(document).on('click', "#btnmodal_agregar", function(e){

            var diassel = [];
            $('#dias input:checked').each(function() {
                diassel.push($(this).val());
            });

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
            

            if(hora_ini!=undefined && hora_ini!="" || hora_fin!=undefined && hora_fin!=""){
                
                dia_selec=new Date(dia);
                dia_selec=dia_selec.getDay()+1;
                $.each(diassel, function( index, value ) {
                  console.log(dia_selec);
                  
                    sumaresta=value-dia_selec;
                    fecrep=new Date(dia+'T'+hora_ini);
                    fecrep.setDate(fecrep.getDate() + sumaresta);
                    
                    dd = String(fecrep.getDate()).padStart(2, '0');
                    mm = String(fecrep.getMonth() + 1).padStart(2, '0'); //January is 0!
                    yyyy = fecrep.getFullYear();
                    fecharep = yyyy+ '-' + mm+ '-' + dd;

                    count=count+1;
                    calendar.addEvent( 
                        {
                            start: fecharep+'T'+hora_ini,
                            nuevo:1,
                            editado:0,
                            end: fecharep+'T'+hora_fin,
                            id:'_'+count,
                            overlap:false 
                        }
                    );

                        
                });


                $('#alerts').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Agregado exitosamente, guardar los cambios</div>');
                setTimeout(function() { $('#alerts').html('');},2000);

                hora_ini="";
                hora_fin="";
                idprofesional="";
                $("#generalSearch").val("");
                $('#hora_ini').val(hora_ini);
                $('#hora_fin').val(hora_fin);
                setTimeout(function() {$('#kt_modal_7').modal('toggle'); },2000);
                
            }

        });

        $(document).on('click', "#btnmodal_editar", function(e){

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

            if(hora_ini!=undefined && hora_ini!="" || hora_fin!=undefined && hora_fin!=""){

                console.log(start);
                eventoinfo.setDates( start, end );
                eventoinfo.setExtendedProp( 'editado', 1 );

                $('#alerts2').html('<div class="alert alert-success">' +
                '<button type="button" class="close" data-dismiss="alert">' +
                '&times;</button> Editado exitosamente, guardar los cambios</div>');
                setTimeout(function() { $('#alerts2').html('');},2000);

                hora_ini="";
                hora_fin="";
                idprofesional="";
                $("#generalSearch").val("");
                $('#hora_ini').val(hora_ini);
                $('#hora_fin').val(hora_fin);
                setTimeout(function() {$('#kt_modal_2').modal('toggle'); },2000);
                
            }
    
        });

        $(document).on('click', "#btnmodal_borrar", function(e){           
           if (eventoinfo.extendedProps.nuevo==0 ) {
                eliminados.push(eventoinfo.id);
            }    
           eventoinfo.remove();
        });


     
    }
};
}();

jQuery(document).ready(function() {
KTCalendarBasic.init();
});

</script>