<?php
// Conectar ao banco de dados
// Aqui você deve incluir o código para conectar ao seu banco de dados. Exemplo:
// include 'db_connect.php';

// Verifica se o tipo de prova foi enviado via GET
$examType = $_GET['exam'] ?? '1'; // Valor padrão se não for fornecido

// Consultar os dados baseados no tipo de prova selecionado
$notas = DB::table('redacoes')
    ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
    ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
    ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
    ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
    ->select('redacoes.nota_aluno_redacao as nota', 'temas.frase_tematica as frase_tematica', 'redacoes.id_tema as id_tema', 'bancas.nome', 'turmas.id as id_turma', 'redacoes.id_banca as id_banca', 'bancas.nota_maxima_banca as nota_maxima')
    ->where('redacoes.id_banca', $examType) // Filtrar por tipo de prova
    ->where('redacoes.id_aluno', 2)
    ->orderBy('redacoes.nota_aluno_redacao', 'asc') // Ordenar por nota em ordem crescente
    ->get();

$firstNota = $notas->first(); // Obtém o primeiro item da coleção
$id_turma = $firstNota->id_turma ?? 0; // Usa um valor padrão se não houver itens
$id_banca = $firstNota->id_banca ?? 0; // Usa um valor padrão se não houver itens

// Calcular média da turma para cada tema com base no id_banca e id_tema
$temas = $notas->pluck('id_tema')->unique();
$medias = [];
foreach ($temas as $tema) {
    $mediaSala = DB::table('redacoes')
        ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
        ->where('alunos.id_turma', $id_turma)
        ->where('redacoes.id_tema', $tema)
        ->where('redacoes.id_banca', $id_banca)
        ->select(DB::raw('AVG(redacoes.nota_aluno_redacao) as media'))
        ->first();
    $medias[$tema] = $mediaSala->media ?? 0; // Default to 0 if no data
}

// Obter a nota máxima da tabela bancas para o id_banca selecionado
$notaMaxima = DB::table('bancas')
    ->where('id', $id_banca)
    ->value('nota_maxima_banca') ?? 0; // Default to 0 if no data

// Preparar dados para JavaScript
$notasArray = [];
$notasArray[] = ['Frase Temática', 'Nota do Aluno', 'Média da Sala', 'Nota Máxima']; // Cabeçalho
foreach ($notas as $nota) {
    $notasArray[] = [
        $nota->frase_tematica,
        number_format($nota->nota, 2), // Formatar a nota do aluno com 2 casas decimais
        number_format($medias[$nota->id_tema], 2), // Formatar a média da sala com 2 casas decimais
        $notaMaxima // Adicionar a nota máxima no resultado
    ];
}

// Verifica se há uma requisição AJAX para fornecer dados
if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    echo json_encode($notasArray);
    exit;
}
?>
@extends('layouts._partials._cabecalho')

@section('css')
    <title>Notas do Aluno com Linha de Média Acumulada</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estatistica.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('conteudo')
    <h1 class="subtitulo">Estatísticas</h2>
    <section class="mt-5 container-estatistica">
        
        <div class="row mb-3">
            <div id="selecionar-seta" class="">
                <select id="examSelect" class="form-control selecionar">
                    <option value="1" <?php if ($examType === '1') echo 'selected'; ?>>Fuvest</option>
                    <option value="7" <?php if ($examType === '7') echo 'selected'; ?>>Enem</option>
                    <option value="6" <?php if ($examType === '6') echo 'selected'; ?>>Unicamp</option>
                    <option value="5" <?php if ($examType === '5') echo 'selected'; ?>>Vunesp</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class=" grafico">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </section>

    <script>
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var chart;

    function fetchData(examType) {
        $.ajax({
            url: '', // URL do script PHP atual
            type: 'GET',
            data: { exam: examType, ajax: 'true' },
            dataType: 'json',
            success: function(data) {
                console.log('Dados recebidos:', data); // Debugging
                var labels = [];
                var studentGrades = [];
                var classAverages = [];
                var maxGrade = parseFloat(data[1][3]); // Nota máxima (é a mesma para todas as frases)
                var maxGradesArray = new Array(data.length - 1).fill(maxGrade); // Array para a linha da nota máxima

                for (var i = 1; i < data.length; i++) { // Ignorar o cabeçalho
                    labels.push(data[i][0]);
                    studentGrades.push(parseFloat(data[i][1]));
                    classAverages.push(parseFloat(data[i][2]));
                }

                console.log('Nota máxima:', maxGrade); // Debugging

                // Atualizar gráfico
                updateChart(labels, studentGrades, classAverages, maxGradesArray, maxGrade);
            },
            error: function(err) {
                console.error('Erro ao buscar os dados:', err);
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
                labels: labels,
                datasets: [
                    {
                        label: 'Nota do Aluno',
                        data: studentGrades,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        barThickness: 20
                    },
                    {
                        label: 'Média da Sala',
                        data: classAverages,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        barThickness: 20
                    },
                    {
                        label: 'Média Acumulada do Aluno',
                        type: 'line',
                        data: cumulativeAvgStudent,
                        borderColor: 'rgba(255, 159, 64, 1)',
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    },
                    {
                        label: 'Média Acumulada da Sala',
                        type: 'line',
                        data: cumulativeAvgClass,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1
                    },
                    {
                        label: 'Nota Máxima',
                        type: 'line',
                        data: maxGradesArray,
                        borderColor: 'rgba(255, 205, 86, 1)',
                        backgroundColor: 'rgba(255, 205, 86, 0.2)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.1,
                        borderDash: [10, 5] // Linha pontilhada
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
                        suggestedMax: maxGrade + 1 // Ajuste conforme necessário para adicionar uma margem
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
    </script>
@endsection
