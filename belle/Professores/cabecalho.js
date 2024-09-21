document.getElementById('sidebar-abrir').addEventListener('click', function () {
  document.getElementById('sidebar').classList.toggle('sidebar-aberta'),
  document.getElementById('sidebar-sombra').classList.toggle('sidebar-sombra-aberta')
});

document.getElementById('sidebar-fechar').addEventListener('click', function () {
  document.getElementById('sidebar').classList.toggle('sidebar-aberta'),
  document.getElementById('sidebar-sombra').classList.toggle('sidebar-sombra-aberta')
});

document.getElementById('sidebar-sombra').addEventListener('click', function () {
  document.getElementById('sidebar').classList.remove('sidebar-aberta'),
  document.getElementById('sidebar-sombra').classList.remove('sidebar-sombra-aberta')
});

