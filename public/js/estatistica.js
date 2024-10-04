// script.js
var ctx = document.getElementById('myBarChart').getContext('2d');
var chart;

function fetchData(examType) {
    $.ajax({
        url: '', // URL do script PHP atual
        type: 'GET',
        data: { exam: examType, ajax: 'true' },
        dataType: 'json',
        success: function(data) {
            console.log('Dados recebidos:', data);

            if (data.length <= 1) {
                updateChart([], [], [], [], 0);
                return;
            }

            var labels = [];
            var studentGrades = [];
            var classAverages = [];
            var maxGrade = parseFloat(data[1][3]);
            var maxGradesArray = new Array(data.length - 1).fill(maxGrade);

            for (var i = 1; i < data.length; i++) {
                labels.push(data[i][0]);
                studentGrades.push(parseFloat(data[i][1]));
                classAverages.push(parseFloat(data[i][2]));
            }

            updateChart(labels, studentGrades, classAverages, maxGradesArray, maxGrade);
        },
        error: function(err) {
            console.error('Erro ao buscar os dados:', err);
            updateChart([], [], [], [], 0);
        }
    });
}

function updateChart(labels, studentGrades, classAverages, maxGradesArray, maxGrade) {
    var cumulativeAvgStudent = calculateCumulativeAverage(studentGrades);
    var cumulativeAvgClass = calculateCumulativeAverage(classAverages);

    if (chart) {
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels.length ? labels : [''],
            datasets: [
                {
                    label: 'Nota do Aluno',
                    data: studentGrades.length ? studentGrades : [0],
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    barThickness: 20
                },
                {
                    label: 'Média da Sala',
                    data: classAverages.length ? classAverages : [0],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    barThickness: 20
                },
                {
                    label: 'Média Acumulada do Aluno',
                    type: 'line',
                    data: cumulativeAvgStudent.length ? cumulativeAvgStudent : [0],
                    borderColor: 'rgba(255, 159, 64, 1)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1
                },
                {
                    label: 'Média Acumulada da Sala',
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
                    type: 'line',
                    data: maxGradesArray.length ? maxGradesArray : [0],
                    borderColor: 'rgba(255, 205, 86, 1)',
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1,
                    borderDash: [10, 5]
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: false,
                    grid: {
                        display: false
                    }
                },
                y: {
                    stacked: false,
                    beginAtZero: true,
                    suggestedMax: maxGrade + 1
                }
            },
            barPercentage: 0.8,
            categoryPercentage: 0.8,
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

function calculateCumulativeAverage(data) {
    var cumulative = [];
    var sum = 0;
    for (var i = 0; i < data.length; i++) {
        sum += data[i];
        cumulative.push(sum / (i + 1));
    }
    return cumulative;
}

// Inicializar com o valor padrão
fetchData($('#examSelect').val());

// Atualizar gráfico quando a seleção mudar
$('#examSelect').change(function() {
    fetchData($(this).val());
});
