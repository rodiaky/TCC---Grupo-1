@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeralCardsDropdown.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeralTabela.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/aluno.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/estatistica.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Aluno</title>
@endsection

@section('conteudo')
    
    <main>

        <!-- INFORMACOES DO ALUNO -->
        <h1 class="subtitulo">Informações do Aluno</h1>
        <section class="info-aluno">
            <div class="container-imagem"><img src="{{ asset('assets/fotoPerfil/'.$user->foto) }}" alt=""></div>
            <div class="container-info">
                <div class="nome-aluno">{{ $user->name }}</div>
                <div class="email-aluno">{{ $user->email }}</div>
                <div class="container-turma"></div><div class="turma-aluno">{{ $turma->dias_aula }} - {{ $turma->horario_entrada }}</div>
            </div>
        </section>

        <!-- DESEMPENHO  -->
        <h1 class="subtitulo">Desempenho do Aluno</h1>
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

            <div class="grafico">
                <canvas id="myBarChart"></canvas>
            </div>
        </section>

        <!-- REDACOES -->
        <h1 class="subtitulo">Redações</h1>
        <section class="container-cards">

        @foreach ($redacoesPorBanca as $redacao)
            <article class="card">
                <button type="button" class="card-retangulo">
                    <h1 class="titulo-card">{{ $redacao->banca_nome }}</h1>
                    <i class="material-icons card-seta">arrow_forward_ios</i>
                </button>
                
                <div class="card-dropdown">

                    @foreach ($redacao->frases_tematicas as $index => $frase)
                        <a class="card-option" href="{{ route('redacao_corrigida', ['id' => $redacao->ids_redacoes[$index]]) }}">
                            {{ $frase }}
                        </a>
                    @endforeach

                </div>
            </article>
        @endforeach

        </section>
        
        <!-- REGISTRO DE PAGAMENTO -->
<h1 class="subtitulo">Registro de Pagamento</h1>

<!-- TABELA DE PAGAMENTO -->
<h1 class="subtitulo">Tabela de Pagamento</h1>
<section class="tabela">

    <div class="overflow">

        <table id="tabela">
            <tr>
                <th>Mês</th>
                <th>Pagamento</th>
                <th>Valor</th>
                <th>Excluir</th>
            </tr>
            @foreach ($pagamentos as $pagamento)
            <tr>
                <td class="mes">{{ $pagamento->mes }}</td>
                <td class="pagamento">{{ $pagamento->status_pagamento }}</td>
                <td class="valor">R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                <td class="excluir">
                    <i class="material-icons icone-tabela">close</i>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</section>

    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/estatistica.js') }}"></script>
    <script src="{{ asset('js/cardsDropdown.js') }}"></script>
@endsection