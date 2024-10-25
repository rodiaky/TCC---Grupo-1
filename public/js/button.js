// Seleciona todos os botões e conteúdos
const toggleButtons = document.querySelectorAll(".toggleButton");
const contents = document.querySelectorAll(".content");

// Função para mostrar o conteúdo correspondente
function showContent(targetId) {
    contents.forEach(content => {
        if (content.id === targetId) {
            content.style.display = "flex"; // Exibe o conteúdo selecionado
        } else {
            content.style.display = "none"; // Esconde outros conteúdos
        }
    });
}

// Adiciona eventos de clique e toque para cada botão
toggleButtons.forEach(button => {
    button.addEventListener("click", (event) => {
        event.stopPropagation();
        const targetId = button.getAttribute("data-target");
        showContent(targetId);
    });
    button.addEventListener("touchstart", (event) => {
        event.stopPropagation();
        const targetId = button.getAttribute("data-target");
        showContent(targetId);
    });
});

// Impede que o conteúdo desapareça ao clicar/tocar dentro dele
contents.forEach(content => {
    content.addEventListener("click", (event) => {
        event.stopPropagation();
    });
    content.addEventListener("touchstart", (event) => {
        event.stopPropagation();
    });
});

// Esconde todos os conteúdos ao clicar/tocar fora
document.addEventListener("click", () => {
    contents.forEach(content => content.style.display = "none");
});
document.addEventListener("touchstart", () => {
    contents.forEach(content => content.style.display = "none");
});