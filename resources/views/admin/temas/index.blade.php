@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/barraDePesquisa.css">
    <link rel="stylesheet" type="text/css" href="/css/temaRedacoes.css">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Temas de Redações</title>
@endsection

@section('conteudo')
@php
$isAdmin = $_SESSION['eh_admin'] === 'Professor';
@endphp

<main>
    <h1 class="titulo-pagina">Temas de Redações</h1>
    <hr class="titulo-linha">

    <section class="section-barra-de-pesquisa">
    <form method="GET" action="{{ route('admin.temas.search') }}">
    <label class="pesquisa" for="barra-pesquisa">
        <input type="text" id="barra-pesquisa" name="search" placeholder="Digite o tema." value="{{ request('search') }}">
        <button type="submit" id="pesquisar" name="pesquisar">
            <i class="material-icons lupa-pesquisa">search</i>
        </button>
    </label>
</form>

        <div class="selecionar">
            <label for="select" class="selecionar-retangulo">
                Filtros
                <input type="checkbox" name="select" id="select">
                <i class="material-icons">filter_list</i>
            </label>
            <ul class="selecionar-op" id="selecionar-op">
                <form action="">
                    <li><label for="mais-recentes"><input type="radio" name="filtro" id="mais-recentes">Mais Recentes</label></li>
                    <li><label for="mais-antigas"><input type="radio" name="filtro" id="mais-antigas">Mais Antigas</label></li>
                    <li><label for="enem"><input type="radio" name="filtro" id="enem">Enem</label></li>
                    <li><label for="fuvest"><input type="radio" name="filtro" id="fuvest">Fuvest</label></li>
                    <li><label for="vunesp"><input type="radio" name="filtro" id="vunesp">Vunesp</label></li>
                    <li><label for="unicamp"><input type="radio" name="filtro" id="unicamp">Unicamp</label></li>
                </form>
            </ul>
        </div>
    </section>

    @if ($isAdmin)
    <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
    <button class="botao">
        <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
        <div class="botao-expand">
            <a href="{{ route('admin.temas.adicionar') }}" class="botao-texto">Adicionar Tema</a>
        </div>
    </button>
    @endif

    <section class="container-tema">
        @foreach ($temas as $tema)
        <div class="tema-secao">
            @if ($isAdmin)
            <button class="botao-editar">
                <i class="material-icons">more_horizon</i>
                <div class="editar-opcoes">
                    <a href="{{ route('admin.temas.editar',$tema->id) }}" class="editar-opcoes-texto">Editar</a>
                    <hr>
                    <a href="{{ route('admin.temas.excluir',$tema->id) }}" class="editar-opcoes-texto">Excluir</a>
                </div>
            </button>
            @endif
            <div class="container-imagem">
                <img src="{{ $tema->imagem }}" alt="" class="imagem-tema">
            </div>
            <div class="frase-tematica">
                <p>{{ $tema->frase_tematica }}</p>
            </div>
            <div class="banca-ano">{{ $tema->banca_nome }}/{{ $tema->ano }}</div>
            <div class="spoiler">
                <p>{{ $tema->texto_apoio }}</p>
            </div>
        </div>
        @endforeach
    </section>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
    <script src="js/temaRedacoes.js"></script>
@endsection