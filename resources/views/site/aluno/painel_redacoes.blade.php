@extends('layouts._partials._cabecalho')

@section('css')
    <title>Notas do Aluno com Linha de Média Acumulada</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estatistica.css') }}">
@endsection

@section('conteudo')
    <h1 class="subtitulo">Estatísticas</h1>
    <section class="mt-5 container-estatistica">
        <div class="row mb-3">
            <div id="selecionar-seta">
                <select id="examSelect" class="form-control selecionar">
                    <option value="1" {{ $examType === '1' ? 'selected' : '' }}>Fuvest</option>
                    <option value="7" {{ $examType === '7' ? 'selected' : '' }}>Enem</option>
                    <option value="6" {{ $examType === '6' ? 'selected' : '' }}>Unicamp</option>
                    <option value="5" {{ $examType === '5' ? 'selected' : '' }}>Vunesp</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="grafico">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/estatistica.js') }}"></script>
    </section>
@endsection
