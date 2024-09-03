@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="css/redacoesPendentes.css">
    <link rel="stylesheet" type="text/css" href="css/styleGeralRetCinza.css">
    <title>Redações Pendentes</title>
@endsection

@section('conteudo')
    <main>
        <h1 class="titulo-pagina">Redações Pendentes</h1>
        <hr class="titulo-linha">

        <section class="conteudo">

            <div class="escrito">
                <p>Particulares / Turma</p>
            </div>

            @foreach ($redacoes as $redacao)
            <div class="branco">
                <p class="banca">{{ $redacao->banca_nome }} - {{ $redacao->frase_tematica }}</p>
                <hr>
                <div class="nomeHorario">
                    <p>{{ $redacao->nome }}</p>
                    <p>Entrada: {{ $redacao->horario_entrada }} - Saída: {{ $redacao->horario_saida }}</p>
                </div>
            </div>
            @endforeach

        </section>

    </main>
@endsection
