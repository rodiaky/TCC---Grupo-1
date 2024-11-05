@extends('layouts._partials._cabecalho')

@section('css')
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estatistica.css') }}">
    <title>Estatísticas</title>
@endsection

@section('conteudo')
<main>
    <h1 class="titulo-pagina">Estatísticas</h1>
    <hr class="titulo-linha">

    <section class="mt-5 container-estatistica">
        <div class="row mb-3">
            <div id="selecionar-seta">
                <select id="examSelect" class="form-control selecionar">
                @foreach($bancas as $banca)
                    <option value="{{ $banca->id }}" 
                        {{ $examType == $banca->id ? 'selected' : '' }}>
                        {{ $banca->nome }}
                    </option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="grafico">
            <canvas id="myBarChart"></canvas>
        </div>
    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/estatistica.js') }}"></script>
@endsection
