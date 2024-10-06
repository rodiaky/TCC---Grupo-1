@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/minhasRedacoesUI.css">
    <link rel="stylesheet" type="text/css" href="/css/minhasRedacoesLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/minhasRedacoesLayoutCelular.css">
    <link rel="stylesheet" type="text/css" href="/css/minhasRedacoesLayoutTablet.css">
    <link rel="stylesheet" type="text/css" href="/css/minhasRedacoesLayoutDesktop.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Minhas Redações</title>
@endsection

@section('conteudo')
    <!-- Título: Minhas Redações -->
    <h1 class="titulo-pagina">Minhas Redações</h1>
    <hr class="titulo-linha">

    <!-- Seção container minhas redações -->
    <article class="container-minhas-red">
        
        @foreach ($redacoesPorBanca as $redacao)
            <section class="banca">
                <button class="banca-retangulo">
                    <h1 class="titulo-cardBanca">{{ $redacao->banca_nome }}</h1>
                    <i class="material-icons banca-seta">arrow_forward_ios</i>
                </button>
                
                <div class="banca-dropdown">
                    @foreach ($redacao->frases_tematicas as $index => $frase)
                        <a class="tema" href="{{ route('redacao_corrigida', ['id' => $redacao->ids_redacoes[$index]]) }}">
                            {{ $frase }}
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach

    </article>
@endsection
