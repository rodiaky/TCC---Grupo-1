@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/questoes.css') }}">   
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao2.css') }}">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
    <title>Questões</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp
    <main>
        <h1 class="titulo-pagina">Questões</h1>
        <hr class="titulo-linha">
        
        @if ($isAdmin)
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.questoes.adicionar') }}" class="botao-texto">Adicionar Questão</a>
            </div>
        </button>
        @endif

        <section class="selecionarFiltro sectionCinza">
            <h1 class="subtitulo">{{ $titulo }}</h1>
        </section>

        <section class="questao">
            @forelse ($questoes as $questao)
                <div class="sectionCinza">
                    <div class="superior">
                        <div class="nome">{{ $questao->vestibular }} ({{ $questao->ano }})</div>
                        @if ($isAdmin)
                        <button class="botao-editar">
                            <i class="material-icons">more_horizon</i>
                            <div class="editar-opcoes">
                                <a href="{{ route('admin.questoes.editar', $questao->id) }}" class="editar-opcoes-texto">Editar</a>
                                <hr>
                                <a href="{{ route('admin.questoes.excluir', $questao->id) }}" class="editar-opcoes-texto">Excluir</a>
                            </div>
                        </button>
                        @endif
                    </div>

                    <div class="texto">{{ $questao->enunciado }}</div>
                    
                    <ul class="alternativas">
                        <li>{{ $questao->alternativa_A }}</li>
                        <li>{{ $questao->alternativa_B }}</li>
                        <li>{{ $questao->alternativa_C }}</li>
                        <li>{{ $questao->alternativa_D }}</li>
                        <li>{{ $questao->alternativa_E }}</li>
                    </ul>

                    <button class="mostrar-resposta">
                        <div>Alternativa</div>
                        <div><i class="material-icons">arrow_forward_ios</i></div>
                    </button>
                </div>
                <div class="resposta-correta">{{ $questao->resposta }}</div>
            @empty
                <p>Nenhuma questão encontrada.</p>
            @endforelse
        </section>

        <!-- Pagination Links -->
        <div class="pagination">
            <div class="flex justify-between">
                {{-- Pagination Elements --}}
                <div>
                    {{-- Display page numbers --}}
                    @for ($i = 1; $i <= $questoes->lastPage(); $i++)
                        @if ($i == $questoes->currentPage())
                            <span class="active">{{ $i }}</span>
                        @else
                            <a href="{{ $questoes->url($i) }}" class="pagination-link">{{ $i }}</a>
                        @endif
                    @endfor
                </div>
            </div>
        </div>

    </main>
    
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
