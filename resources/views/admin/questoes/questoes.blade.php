@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/questoes.css') }}">   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao1.css') }}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pagination.css') }}">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
    <title>Questões</title>
@endsection

@section('conteudo')
    @php 
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp
    <main class="grid-geral">

        <div class="container-titulo-seta">
            <div class="container-seta">
                    <a href="{{ url()->previous() }}" class="seta-back">
                        <i class="material-icons">arrow_back</i>
                    </a>
                </div>
                <h1 class="titulo-pagina">Questões</h1>
        </div>
        <hr class="titulo-linha">
            
        @if ($isAdmin)
        <button type="button" class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.questoes.adicionar') }}" class="botao-texto">Adicionar Questão</a>
            </div>
        </button>
        @endif

        <section class="selecionarFiltro sectionCinza">
            <h1 class="subtitulo">{{ $titulo }}</h1>
        </section>

        <section>
            @forelse ($questoes as $questao)
            <article class="questao">
                <div class="sectionCinza">
                    <div class="superior">
                        <div class="nome">{{ $questao->banca_nome }} ({{ $questao->ano }})</div>
                        @if ($isAdmin)
                        <button type="button" class="botao-editar">
                            <i class="material-icons">more_horizon</i>
                            <div class="editar-opcoes">
                                <a href="{{ route('admin.questoes.editar', $questao->id) }}" class="editar-opcoes-texto">Editar</a>
                                <hr>
                                <a href="{{ route('admin.questoes.excluir', $questao->id) }}" class="editar-opcoes-texto">Excluir</a>
                            </div>
                        </button>
                        @endif
                    </div>
                    <div class="texto"><pre>{{ $questao->enunciado }}</pre></div>
                    
                    <ul class="alternativas">
                        <li>{{ $questao->alternativa_A }}</li>
                        <li>{{ $questao->alternativa_B }}</li>
                        <li>{{ $questao->alternativa_C }}</li>
                        <li>{{ $questao->alternativa_D }}</li>
                        @if ($questao->alternativa_E)<li>{{ $questao->alternativa_E }}</li>@endif
                    </ul>
                    <button type="button" class="mostrar-resposta">
                        <div>Alternativa</div>
                        <div><i class="material-icons">arrow_forward_ios</i></div>
                    </button>
                </div>
                <div class="resposta-correta">{{ $questao->resposta }}</div>
            </article>
                @empty
                    <p>Nenhuma questão encontrada.</p>
            @endforelse
        </section>

        <!-- Pagination Links -->
        <div class="pagination">
            <div class="flex justify-between">
                {{-- Pagination Elements --}}
                <div class="links">
                    {{-- Exibe os números das páginas --}}
                    @for ($i = 1; $i <= $questoes->lastPage(); $i++)
                        @if ($i == $questoes->currentPage())
                            <div class="active"><span>{{ $i }}</span></div>
                        @else
                            <a class="pagination-link" href="{{ $questoes->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

    </main>
    
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
