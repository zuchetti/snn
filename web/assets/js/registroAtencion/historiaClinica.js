$('.generar').click( function() {

    
    var fec_atencion = $("#fec_atencion").val();
    var hora_atencion = $("#hora_atencion").val();
    var fech = $("#fec_atencion").val()+' '+$("#hora_atencion").val();
    var domicilio = $("#domicilio").val();
    var quirurgico = $("#quirurgico").val();
    var padres = $("#padres").val();
    var abuelos = $("#abuelos").val();
    var hermanos = $("#hermanos").val();
    var conyugue = $("#conyugue").val();
    var alergias = $("#alergias").val();
    var persona_responsable = $("#persona_responsable").val();
    var tlf_casa_paciente = $("#tlf_casa_paciente").val();
    var celular_responsble = $("#celular_responsble").val();
    var grupos_factorh = $("#grupos_factorh").val();

    if(alergias=="" || persona_responsable=="" || tlf_casa_paciente == "" || celular_responsble == "" || grupos_factorh ==""){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Complete la información de emergencia </strong></div>');
        return false;
    }

    var telf_1 = $("#telf_1").val();
    var correo = $("#correo").val();

    var codigo = $("#codigo").val();
    var codigo_afi = $("#codigo_afi").val();
    var idioma = $("#idioma").val();
    var estadocivil = $("#estadocivil").val();
    var gradoinstitucion = $("#gradoinstitucion").val();
    var ocupacion = $("#ocupacion").val();
    var procedencia = $("#procedencia").val();
    var etnia = $("#etnia").val();
    var texto = $("#texto").val();
    var religion = $("#religion").val();

    var idtiposeguro = $("#idtiposeguro").val();

     
    
    if(idtiposeguro=="" || idtiposeguro==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el tipo de seguro </strong></div>');
        return false;
    }

   

    var no_patologico=[];
    var patologicos=[];

    $("[name='no_patologico'").each(function () {
        if (this.checked) {
            no_patologico.push({
                id:$(this).val(),
                nombre: $(this).attr('nombre'),
                txt:  $(this).attr('txt')

            }); 
         }
    })

    if (contarotros==1 && (texto=="" || texto==undefined)) {
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Ingrese otros </strong></div>');
        return false;
    }
    
    $("[name='patologicos'").each(function () {
        if (this.checked && $(this).val()==8) {
            $('#patologicos7').attr('txt', texto);

         }
    })

    $("[name='patologicos'").each(function () {
        if (this.checked) {
            patologicos.push({
                id:$(this).val(),
                nombre: $(this).attr('nombre'),
                txt:  $(this).attr('txt')
            }); 
         }
    })

   
    if(estadocivil=="" || estadocivil==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Seleccione el estado civil  </strong></div>');
        return false;
    }

 
  
    if(domicilio=="" || domicilio==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el domicilio </strong></div>');
        return false;
    }

    if(telf_1=="" || telf_1==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el número de celular </strong></div>');
        return false;
    }
    if(correo=="" || correo==undefined){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Ingrese el correo electrónico </strong></div>');
        return false;
    }


    if(padres=="" || abuelos =="" || hermanos=="" || conyugue==""){
        $('#alerts').html('<div class="alert alert-info">' +
        '<button type="button" class="close" data-dismiss="alert">' +
        '&times;</button> Completa o niega la información de antecedentes quirúrgicos </strong></div>');
        return false;
    }
    if(padres==""){
        padres="NIEGA";
    }
    if(abuelos==""){
        abuelos="NIEGA";
    }
    if(hermanos==""){
        hermanos="NIEGA";
    }
    if(padres==""){
        conyugue="NIEGA";
    }
    
    
    
    var autorizacion = $('input[name="autorizacion"]:checked').val();

    $()

    if(autorizacion=="" || autorizacion==undefined || autorizacion==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Debe autorizar el uso de tus datos personales </strong></div>');
        return false;
    }

    if(no_patologico.length ==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Completa la información no patológica </strong></div>');
        return false;
    }
    if(patologicos.length ==0){
        $('#alerts').html('<div class="alert alert-info">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button> Completa la información  patológica </strong></div>');
        return false;
    }


   //console.log(autorizacion);
   //return false;

    $.ajax({
        'url': "save_history_session",
        'data':{'fec_atencion':fech,'domicilio':domicilio,'quirurgico':quirurgico,
        'padres':padres,'abuelos':abuelos,'hermanos':hermanos,'conyugue':conyugue,
        'alergias':alergias,'persona_responsable':persona_responsable,'tlf_casa_paciente':tlf_casa_paciente,
        'celular_responsble':celular_responsble,'no_patologico':no_patologico,'patologicos':patologicos,
        'grupos_factorh':grupos_factorh,'telf_1':telf_1,'correo':correo,'codigo':codigo,'codigo_afi':codigo_afi,
        'idioma':idioma,'estadocivil':estadocivil,'gradoinstitucion':gradoinstitucion,'ocupacion':ocupacion,
        'procedencia':procedencia,'etnia':etnia,'religion':religion,'idtiposeguro':idtiposeguro,
        'autorizacion':autorizacion},
        beforeSend: function() {
            $('#boton').prop('disabled', true);  
            $(".spinner-border").fadeIn(200);　
        }
    }).done( function(data) {
        $(".spinner-border").hide();　
      

        if(data == 'ok'){

     
            $('#boton').prop('disabled', true);

            var contentModal = "";
            contentModal += 
            `<div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-check"></i>
                </div>

                <div id="textM">
                    <div>Datos guardados</div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <a href="diagnostico" id="aceptar" class="btn" >Aceptar</a>
                    </div>
                </div>
            </div>
            `;
            $("#exampleModal").modal("show");
            $('#contentModal').html(contentModal);
          
            //window.setTimeout(function(){window.location.href = 'diagnostico'},1000);

        }
 
       
    })



})

var autorizacion;
$('#autorizacion').change(function() {

    if (this.checked) {
        $('#autorizacion').val(1)
    }else{
        $('#autorizacion').val(0)

    }
});

$(document).on('change','#qniega',function(){

   if( $(this).prop('checked')){
    if($('#activeq').val()==0){
        $('#quirurgico').val('Niega');
    }
        $('#quirurgico').attr('Disabled',true);
    }else{
        if($('#activeq').val()==0){
        $('#quirurgico').val('');
        }
        $('#quirurgico').attr('Disabled',false);
    }
})

$(document).on('change','#aqniega',function(){

    if( $(this).prop('checked')){
        // if($('#activeaq').val()==0){
        //     $('#padres').val('Niega');
        //     $('#abuelos').val('Niega');
        //     $('#hermanos').val('Niega');
        //     $('#conyugue').val('Niega');
        // }
         
        $('#padres').val('Niega');
        $('#abuelos').val('Niega');
        $('#hermanos').val('Niega');
        $('#conyugue').val('Niega');

         $('#padres').attr('Disabled',true);
         $('#abuelos').attr('Disabled',true);
         $('#hermanos').attr('Disabled',true);
         $('#conyugue').attr('Disabled',true);
         
     }else{
        if($('#activeaq').val()==0){
            $('#padres').val('');
            $('#abuelos').val('');
            $('#hermanos').val('');
            $('#conyugue').val('');
        }

        $('#padres').attr('Disabled',false);
        $('#abuelos').attr('Disabled',false);
        $('#hermanos').attr('Disabled',false);
        $('#conyugue').attr('Disabled',false);
     }
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

var contarotros;
$('#patologicos7').change(function() {

    if (this.checked && $(this).val()==8) {
        contarotros=1;
        $('.divotros').show();
    }else{
        contarotros=0;
        $('.divotros').hide();
    }
});

$('.update').click( function() {

    $('#etnia').prop('disabled', false);
    $('#idioma').prop('disabled', false);
    $('#religion').prop('disabled', false);
    // $('#estadocivil').prop('disabled', false);
    $('#gradoinstitucion').prop('disabled', false);
    $('#ocupacion').prop('disabled', false);
    $('#procedencia').prop('disabled', false);
    $('#domicilio').prop('disabled', false);
    $('#telf_1').prop('disabled', false);
    $('.form-check-input').prop('disabled', false);
    $('#texto').prop('disabled', false);
    $('#quirurgico').prop('disabled', false);
    $('#padres').prop('disabled', false);
    $('#abuelos').prop('disabled', false);
    $('#hermanos').prop('disabled', false);
    $('#conyugue').prop('disabled', false);
    $('#alergias').prop('disabled', false);
    $('#aqniega').prop('disabled', false);
    $('#qniega').prop('disabled', false);
    $('#alergias').prop('disabled', false);
    $('#persona_responsable').prop('disabled', false);
    $('#grupos_factorh').prop('disabled', false);
    $('#celular_responsble').prop('disabled', false);
    $('#tlf_casa_paciente').prop('disabled', false);
    // $('#idtiposeguro').prop('disabled', false);
    $('#correo').prop('disabled', false);



})


function checknopatologico(checkbox) {
    // Desmarcar y deshabilitar todos los checkboxes con el mismo nombre
    const checkboxes = document.querySelectorAll('input[name="no_patologico"]');
    if (checkbox.checked && checkbox.value !== "100") {
        // Deshabilitar el checkbox con valor 100
        const checkbox100 = document.querySelector('input[name="no_patologico"][value="100"]');
        if (checkbox100) {
          checkbox100.disabled = true;
        }
        
      } else {
        // Habilitar todos los checkboxes
        checkboxes.forEach((cb) => {
            if(checkbox.checked){
                if(cb.value=="100"){
                    cb.disabled = false;
                }else{
                    cb.disabled = true;
                    cb.checked=false;
                }
            }else{
                cb.disabled = false;
                cb.checked=false;
            }
            
         
        });
        console.log('entra 2');
      }
  }

  function checkpatologico(checkbox) {
    // Desmarcar y deshabilitar todos los checkboxes con el mismo nombre
    const checkboxes = document.querySelectorAll('input[name="patologicos"]');
    if (checkbox.checked && checkbox.value !== "100") {
        // Deshabilitar el checkbox con valor 100
        const checkbox100 = document.querySelector('input[name="patologicos"][value="100"]');
        if (checkbox100) {
          checkbox100.disabled = true;
        }
        
      } else {
        // Habilitar todos los checkboxes
        checkboxes.forEach((cb) => {
            if(checkbox.checked){
                if(cb.value=="100"){
                    cb.disabled = false;
                    $('.divotros').css('display','none');
                }else{
                    cb.disabled = true;
                    cb.checked=false;
                }
            }else{
                cb.disabled = false;
                cb.checked=false;
            }
            
         
        });
        console.log('entra 2');
      }
  }
