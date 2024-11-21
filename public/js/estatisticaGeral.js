// Função para limitar caracteres
function limitarCaracteres(label, limite) {
    if (label.length > limite) {
        return label.substring(0, limite) + '...';
    }
    return label;
}

// Inicializar gráfico
var ctx = document.getElementById('myBarChart').getContext('2d');
var chart;

// Função para buscar dados via AJAX
function fetchData(examType) {
    $.ajax({
        url: '', // URL do script PHP atual
        type: 'GET',
        data: { exam: examType, ajax: 'true' },
        dataType: 'json',
        success: function(data) {
            console.log('Dados recebidos:', data);

            if (data.length <= 1) {
                updateChart([], [], [], 0);
                return;
            }

            var labels = [];
            var classAverages = [];
            var maxGrade = parseFloat(data[1][2]);  // Corrigido para pegar o índice certo
            var maxGradesArray = new Array(data.length - 1).fill(maxGrade);

            // Preenchendo os dados de rótulos e médias
            for (var i = 1; i < data.length; i++) {
                labels.push(limitarCaracteres(data[i][0], 25));  // Limitar caracteres dos rótulos
                classAverages.push(parseFloat(data[i][1]));  // Média da turma para cada frase temática
            }

            // Calcular a média acumulada
            var cumulativeAvgClass = calculateCumulativeAverage(classAverages);

            // Atualizar o gráfico com os novos dados
            updateChart(labels, classAverages, cumulativeAvgClass, maxGradesArray, maxGrade);
        },
        error: function(err) {
            console.error('Erro ao buscar os dados:', err);
            updateChart([], [], [], 0);
        }
    });
}

// Função para atualizar o gráfico
function updateChart(labels, classAverages, cumulativeAvgClass, maxGradesArray, maxGrade) {
    if (chart) {
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.length ? labels : [''],
            datasets: [
                {
                    label: 'Média dos Alunos',
                    data: classAverages.length ? classAverages : [0],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    barThickness: 20
                },
                {
                    label: 'Média Acumulada dos Alunos',
                    type: 'line',
                    data: cumulativeAvgClass.length ? cumulativeAvgClass : [0],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1
                },
                {
                    label: 'Nota Máxima',
                type: 'line',  // Garantir que seja uma linha e não uma barra
                data: maxGradesArray.length ? maxGradesArray : [0],
                borderColor: 'rgba(255, 205, 86, 1)',  // Cor da linha pontilhada
                backgroundColor: 'rgba(255, 205, 86, 0.2)',
                borderWidth: 2,
                fill: false,
                tension: 0.1,
                borderDash: [10, 5],  // Aqui aplicamos a linha pontilhada
                }
                
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: maxGrade + 1
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw.toFixed(2);
                        }
                    }
                }
            }
        }
    });
}

// Função para calcular a média acumulada da turma
function calculateCumulativeAverage(averages) {
    var cumulative = [];
    var sum = 0;
    for (var i = 0; i < averages.length; i++) {
        sum += averages[i];
        cumulative.push(sum / (i + 1));  // Calcula a média cumulativa
    }
    return cumulative;
}

// Ao carregar a página, busca os dados para o tipo de exame inicial
$(document).ready(function() {
    var examType = $('#examSelect').val();
    fetchData(examType);

    // Quando mudar a seleção de banco, busca novos dados
    $('#examSelect').change(function() {
        fetchData($(this).val());
    });
});