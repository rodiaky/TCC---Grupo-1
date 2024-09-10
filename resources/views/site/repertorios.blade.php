@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <link rel="stylesheet" type="text/css" href="/css/repertorios.css">
    <link rel="stylesheet" type="text/css" href="/css/barraDePesquisa.css">
    <link rel="stylesheet" type="text/css" href="/css/repertoriosFiltros.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Repertórios</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp

    <main>
        <h1 class="titulo-pagina">Repertórios</h1>
        <hr class="titulo-linha">

        @if ($isAdmin)
        <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="" class="botao-texto">Adicionar Repertório</a>
            </div>
        </button>
        @endif

        <section class="section-barra-de-pesquisa">
        <form method="GET" action="{{ route('admin.repertorios.search') }}">
        <label class="pesquisa" for="barra-pesquisa">
            <input type="text" id="barra-pesquisa" name="search" placeholder="Digite o repertório." value="{{ request('search') }}">
            <button type="submit" id="pesquisar" >
                <i class="material-icons lupa-pesquisa">search</i>
            </button>
        </label>
    </section>

        <section class="section-filtros">
        @php
            $filters = [
            'filosofia' => ['fa-graduation-cap', ''],
            'sociologia' => ['fa-users', ''],
            'obra' => ['fa-book', 'Literária'],
            'estatistica' => ['fa-chart-simple', ''],
            'textos' => ['fa-scale-balanced', 'Legais'],
            'cinema' => ['fa-film', ''],
            'artes' => ['fa-palette', ''],
            'historia' => ['fa-landmark', ''],
            'atualidades' => ['fa-earth-americas', '']
            ];
        @endphp

        @foreach ($filters as $filter => [$icon, $extra])
            <label class="filtro" for="{{ $filter }}">
                <div class="circulo-filtro" id="{{ $filter }}-circulo">
                    <input type="radio" class="checkbox-filtro" id="{{ $filter }}" name="filtros">
                    <i class="fa-solid {{ $icon }}"></i>
                </div>
                <p class="texto-filtro">{{ ucfirst($filter) }} {{ $extra }}</p>
             </label>
        @endforeach

        </section>

        <section class="section-cards">
        @foreach ($repertorios as $repertorio)
            <article class="card-repertorio">
                <div class="container-imagem">
                    <img src="{{ $repertorio->imagem }}" alt="" class="imagem-repertorio">
                </div>
                <a href="{{ route('repertorios.vizualizar', ['id' => $repertorio->id]) }}" style="text-decoration: none; color: inherit;">
                    <h1 class="titulo-repertorio">
                        @php
                            $filterName = strtolower($repertorio->classificacao);
                            $icon = $filters[$filterName][0] ?? 'fa-question-circle'; // Ícone padrão caso o filtro não seja encontrado
                        @endphp
                        {{ ucfirst($repertorio->nome) }}
                    </h1>
                </a>

                <div class="tipo-repertorio">
                    <div id="tipo-{{ strtolower(str_replace(' ', '-', $repertorio->classificacao)) }}">
                        <i class="fa-solid {{ $icon }}"></i>
                        <p>{{ $repertorio->classificacao }}</p>
                    </div>
                </div>
                <div class="spoiler-repertorio">
                    <p>{{ $repertorio->descricao }}</p>
                </div>
                @if ($isAdmin)
                <button class="botao-editar botao-repertorio" onclick="event.preventDefault(); showOptions(this);">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="{{ route('repertorios.editar', ['id' => $repertorio->id]) }}" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="{{ route('repertorios.excluir', ['id' => $repertorio->id]) }}" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
            @endif
            </article>
        @endforeach
</section>
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
