$(document).ready(function(){
  dibujar();
});

function firmarOpen(){
$('#ModalFirma').modal('show');
}

function cerrarModal(){
$('#ModalFirma').modal('hide');
$('.edit-firma').removeClass('d-none');
$.LoadingOverlay("show", {
    fade  : [2000, 1000],
    zIndex          : 1500
});

setTimeout(() => {
  $.LoadingOverlay("hide");
}, 2000);

function convertCanvasToImage(canvas) {
  var image = canvas.toDataURL();
  return image;
}  

if(typeof detectarTrazado != "undefined"){
    var canvas = $("#canvas")[0];
    var firma = convertCanvasToImage(canvas);
}

setTimeout(() => {
  saveFirma(firma);
}, 2000);
console.log(firma);
}

function saveFirma(firma){
console.log(firma);
if(firma!="" && firma!=undefined ){
  $.ajaxSetup({
      headers: {
          'X-CSRF-Token': $('input[name="_token"]').val()
      }
  });

  $.ajax({
    url: 'sendFirma',        
    type: "POST",            
    data: {'base64':firma},
    beforeSend: function() {          
    },
  }).done(function(data) {
    $('#boton').prop('disabled', false);
  })  
} else {
    document.getElementById("modalCuerpo").innerHTML = "Debe realizar su firma Digital";
    $('#modalCarga').modal('show');
}
}

function dibujar(){
  var limpiar = document.getElementById("limpiar");
  var canvas = document.getElementById("canvas");
  var ctx = canvas.getContext("2d");
  var cw = canvas.width = 300,
    cx = cw / 2;
  var ch = canvas.height = 300,
    cy = ch / 2;
 
  var dibujar = false;
  var factorDeAlisamiento = 5;
  var Trazados = [];
  var puntos = [];
  ctx.lineJoin = "round";
 
  limpiar.addEventListener('click', function(evt) {
    detectarTrazado = undefined;
    dibujar = false;
    ctx.clearRect(0, 0, cw, ch);
    Trazados.length = 0;
    puntos.length = 0;
  }, false);
 
  canvas.addEventListener('mousedown', function(evt) {
    detectarTrazado = 1;
    dibujar = true;
    puntos.length = 0;
    ctx.beginPath();
  }, false);
 
  canvas.addEventListener('mouseup', function(evt) {
    redibujarTrazados();
  }, false);
 
  canvas.addEventListener("mouseout", function(evt) {
    redibujarTrazados();
  }, false);
 
  canvas.addEventListener("mousemove", function(evt) {
    if (dibujar) {
      var m = oMousePos(canvas, evt);
      puntos.push(m);
      ctx.lineTo(m.x, m.y);
      ctx.stroke();
    }
  }, false);

  // Eventos táctiles para dispositivos móviles
  canvas.addEventListener('touchstart', function(evt) {
    detectarTrazado = 1;
    dibujar = true;
    puntos.length = 0;
    ctx.beginPath();
    evt.preventDefault();
  }, false);
 
  canvas.addEventListener('touchend', function(evt) {
    redibujarTrazados();
    evt.preventDefault();
  }, false);
 
  canvas.addEventListener("touchmove", function(evt) {
    if (dibujar) {
      var m = oTouchPos(canvas, evt);
      puntos.push(m);
      ctx.lineTo(m.x, m.y);
      ctx.stroke();
    }
    evt.preventDefault();
  }, false);
 
  function reducirArray(n,elArray) {
    var nuevoArray = [];
    nuevoArray[0] = elArray[0];
    for (var i = 0; i < elArray.length; i++) {
      if (i % n == 0) {
        nuevoArray[nuevoArray.length] = elArray[i];
      }
    }
    nuevoArray[nuevoArray.length - 1] = elArray[elArray.length - 1];
    Trazados.push(nuevoArray);
  }
 
  function calcularPuntoDeControl(ry, a, b) {
    var pc = {}
    pc.x = (ry[a].x + ry[b].x) / 2;
    pc.y = (ry[a].y + ry[b].y) / 2;
    return pc;
  }
 
  function alisarTrazado(ry) {
    if (ry.length > 1) {
      var ultimoPunto = ry.length - 1;
      ctx.beginPath();
      ctx.moveTo(ry[0].x, ry[0].y);
      for (i = 1; i < ry.length - 2; i++) {
        var pc = calcularPuntoDeControl(ry, i, i + 1);
        ctx.quadraticCurveTo(ry[i].x, ry[i].y, pc.x, pc.y);
      }
      ctx.quadraticCurveTo(ry[ultimoPunto - 1].x, ry[ultimoPunto - 1].y, ry[ultimoPunto].x, ry[ultimoPunto].y);
      ctx.stroke();
    }
  }
 
  function redibujarTrazados(){
    dibujar = false;
    ctx.clearRect(0, 0, cw, ch);
    reducirArray(factorDeAlisamiento,puntos);
    for(var i = 0; i < Trazados.length; i++)
    alisarTrazado(Trazados[i]);
  }
 
  function oMousePos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    return { //objeto
      x: Math.round(evt.clientX - ClientRect.left),
      y: Math.round(evt.clientY - ClientRect.top)
    }
  }

  function oTouchPos(canvas, evt) {
    var ClientRect = canvas.getBoundingClientRect();
    var touch = evt.touches[0];
    return { //objeto
      x: Math.round(touch.clientX - ClientRect.left),
      y: Math.round(touch.clientY - ClientRect.top)
    }
  }
}