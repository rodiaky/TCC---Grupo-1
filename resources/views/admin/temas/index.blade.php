@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/barraDePesquisa.css">
    <link rel="stylesheet" type="text/css" href="/css/temaRedacoes.css">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <link rel="stylesheet" type="text/css" href="/css/pagination.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Temas de Redações</title>
@endsection

@section('conteudo')
@php
$isAdmin = $_SESSION['eh_admin'] === 'Professor';
$currentFilter = request('filtros');
@endphp

<main class="grid-geral">
    <h1 class="titulo-pagina">Temas de Redações</h1>
    <hr class="titulo-linha">

    @if ($isAdmin)
    <button class="botao">
        <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
        <div class="botao-expand">
            <a href="{{ route('admin.temas.adicionar') }}" class="botao-texto">Adicionar Tema</a>
        </div>
    </button>
    @endif

    <section class="section-barra-de-pesquisa">
        <form method="GET" action="{{ route('admin.temas.search') }}">
            <label class="pesquisa" for="barra-pesquisa">
                <input type="text" id="barra-pesquisa" name="search" placeholder="Digite o tema." value="{{ request('search') }}">
                <button type="submit" id="pesquisar">
                    <i class="material-icons lupa-pesquisa">search</i>
                </button>
            </label>
        </form>
    </section>

    <section class="container-tema">
        @forelse ($temas as $tema)
        
        
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
                
                <div class="container-imagem-tema">
<<<<<<< Updated upstream
                    <img src="{{ $tema->imagem }}" alt="" class="imagem-tema"></img>
=======
                    <img src="/assets/{{ $tema->imagem }}" alt="" class="imagem-tema">
>>>>>>> Stashed changes
                </div>
                
                <div class="frase-tematica">
                    <p><a href="{{ route('admin.temas.visualizar', $tema->id) }}">{{ $tema->frase_tematica }}</a></p>
                </div>
                <div class="banca-ano">{{ $tema->banca_nome }}/{{ $tema->ano }}</div>
                <div class="spoiler">
                    <p>{{ $tema->texto_apoio }}</p>
                </div>
            </div>
            
       
        @empty
            <p>Nenhum tema encontrado.</p>
        @endforelse
    </section>

    <!-- Pagination Links -->
    <div class="pagination">
        <div class="flex justify-between">
            {{-- Pagination Elements --}}
            <div class="links">
                {{-- Exibe os números das páginas --}}
                @for ($i = 1; $i <= $temas->lastPage(); $i++)
                    @if ($i == $temas->currentPage())
                        <div class="active"><span>{{ $i }}</span></div>
                    @else
                        <a class="pagination-link" href="{{ $temas->url($i) }}">{{ $i }}</a>
                    @endif
                @endfor
            </div>
        </div>
    </div>

</main>

<script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
