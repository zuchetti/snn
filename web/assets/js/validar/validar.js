///validar solo numeros
function valideKey(evt) {
    var code = evt.which ? evt.which : evt.keyCode;
    if (code == 8) {
        //backspace
        return true;
    } else if (code >= 48 && code <= 57) {
        //is a number
        return true;
    } else {
        return false;
    }
}


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


$('.decimales').on('input', function () {
    this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
 });
