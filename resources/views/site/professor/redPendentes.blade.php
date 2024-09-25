@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeralRetCinza.css">
    <link rel="stylesheet" type="text/css" href="/css/redacoesPendentes.css">
    <title>Redações Pendentes</title>
@endsection

@section('conteudo')
    <main>
        <h1 class="titulo-pagina">Redações Pendentes</h1>
        <hr class="titulo-linha">

        <section class="conteudo">

            <div class="escrito">
                <p>Geral</p>
            </div>

            @foreach ($redacoes as $redacao)
            <a href="{{url('/view', $redacao->id)}}">
                <div class="branco hover">
                    <div class="banca">
                        <p class="txt1">{{ $redacao->banca_nome }} </p>
                        <p>-</p>
                        <p class="txt2">{{ $redacao->frase_tematica }}</p>
                    </div>
                    <hr>
                    <div class="nomeHorario">
                        <p>{{ $redacao->nome }}</p>
                        <p>Entrada: {{ $redacao->horario_entrada }} - Saída: {{ $redacao->horario_saida }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </section>
@endsection