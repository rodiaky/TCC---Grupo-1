$(document).ready(function(){
  $('.atribuir-semana').select2();

  $('.atribuir-material').select2();

  ordenarSemana();
  ordenarMaterial();
});

function ordenarSemana() {
  var itensOrdenados = $('.atribuir-semana option').sort(function (a, b) {
      return a.text < b.text ? -1 : 1;
  });

  $('.atribuir-semana').html(itensOrdenados);
}


function ordenarMaterial() {
  var itensOrdenados = $('.atribuir-material option').sort(function (a, b) {
      return a.text < b.text ? -1 : 1;
  });

  $('.atribuir-material').html(itensOrdenados);
}


