document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('select');
    const ignoreDiv = document.getElementById('selecionar-op');
    const label = document.querySelector('label[for="select"]');

    // Evento para alternar a checkbox ao clicar na label
    label.addEventListener('click', function(event) {
        checkbox.checked = !checkbox.checked;
        event.preventDefault(); // Evita o comportamento padrão de alterar o estado da checkbox
    });

    // Evento para desmarcar a checkbox ao clicar fora dela e da div ignorada
    document.addEventListener('click', function(event) {
        if (event.target !== checkbox && !ignoreDiv.contains(event.target) && event.target !== label) {
            checkbox.checked = false;
        }
    });
});