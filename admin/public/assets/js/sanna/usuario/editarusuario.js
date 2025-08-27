"use strict";

    $(document).on('click', "#submit", function(e){


            var nombre=($("#nombre").val());
            var apellidos=($("#apellidos").val());
            var email=($("#email").val());
            var dni=($("#dni").val());
            var pass=($("#pass").val());
            var idrol=($("#idrol").val());
            var id=($("#id").val());
            var hash=($("#pass").attr("passorigi"));
            var pass2=($("#pass2").val());
            
            console.log(pass);
            console.log(pass2);
      
            
            if(pass==pass2){
                var request = $.ajax({                                   
                    url: "posteditarusuario",           
                    data:{'nombre':nombre, 
                        'apellidos':apellidos,
                        'email':email,
                        'dni':dni,
                        'pass':pass,
                        'idrol':idrol,
                        'id':id,
                        'hash':hash
                        },
                    beforeSend: function() {                           //cargando
                    $("#alertaa").html("<ul class='list-group'> <li class='list-group-item'><div class='spinner-border cargando' role='status'> </div> Espere un momento por favor</li></ul>");                    
                     },success: function(data) {       
                        $('#alertaa').html(""); 
                              
                        var obj = JSON.parse(data);
                        console.log(obj);
                        if (obj.status ==200){ 

                           $('#alertaa').html("<div class='alert alert-solid-success alert-bold' role='alert' id='succes'> <div class='alert-text'>Se editó el usuario</div> </div>"); 
                           var delay = 1000; 
                            setTimeout(function(){ location.href='usuarios?idfuncionalidad=18'; }, delay);
                        }else{ console.log("malpues");$('#alertaa').html("<div class='alert alert-solid-danger alert-bold' role='fail'><div class='alert-text'>Ocurrio un error, no se editó el usuario</div></div>");}                                                           
                    }              
                }); }else $('#alertaa').html("<div class='alert alert-solid-danger alert-bold' role='fail'><div class='alert-text'>Las contraseñas deben ser iguales</div></div>");
        });

           



