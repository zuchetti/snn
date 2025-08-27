$("#uploadForm").on('submit', function(e){
    $(':submit').attr('disabled', 'disabled');
}) 

$(".numbers").bind('keypress', function(event) {
    var regex = new RegExp("^[0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
});



$('.decimales').on('input', function () {
  if(this.value!=undefined){
      this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
  }
});

$(".letras").keypress(function (key) {
  if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
      && (key.charCode < 65 || key.charCode > 90) //letras minusculas
      && (key.charCode != 45) //retroceso
      && (key.charCode != 241) //ñ
       && (key.charCode != 209) //Ñ
       && (key.charCode != 32) //espacio
       && (key.charCode != 225) //á
       && (key.charCode != 233) //é
       && (key.charCode != 237) //í
       && (key.charCode != 243) //ó
       && (key.charCode != 250) //ú
       && (key.charCode != 193) //Á
       && (key.charCode != 201) //É
       && (key.charCode != 205) //Í
       && (key.charCode != 211) //Ó
       && (key.charCode != 218) //Ú

      )
      return false;
});


$(".letrasyn").bind('keypress', function(event) {
  var regex = new RegExp("^[a-zA-Z0-9 ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
 }
});

