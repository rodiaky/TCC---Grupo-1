@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/visualizarRepertorio.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Visualização de Repertório</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp

    @php
        $filters = [
            'filosofia' => ['fa-graduation-cap', ''],
            'sociologia' => ['fa-users', ''],
            'obra' => ['fa-book', 'Literária'],
            'estatística' => ['fa-chart-simple', ''],
            'textos' => ['fa-scale-balanced', 'Legais'],
            'cinema' => ['fa-film', ''],
            'artes' => ['fa-palette', ''],
            'história' => ['fa-landmark', ''],
            'atualidades' => ['fa-earth-americas', '']
        ];
    @endphp

    <main>

        <!-- Container Repertório -->
        <section class="container-repertorio">

            <div class="grid-layout">

                <!-- Set Back Button -->
                <div class="container-seta">
                @if ($isAdmin)
                <a href="{{ route('admin.repertorios', ['id' => $id_pasta]) }}" class="seta-back">
                        <i class="material-icons">arrow_back</i>
                    </a>
                @else
                <a href="{{ url()->previous() }}" class="seta-back">
                        <i class="material-icons">arrow_back</i>
                    </a>
                @endif
                </div>

                @if ($isAdmin)
                <div class="container-botao">
                    <button class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="{{ route('admin.repertorios.editar', ['id' => $repertorio->id]) }}" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="{{ route('admin.repertorios.excluir', ['id' => $repertorio->id]) }}" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                @endif

                <div class="container-imagem">
                    <img src="{{ $repertorio->imagem }}" alt="{{ $repertorio->nome }}" class="imagem-repertorio">
                </div> 
                <h1 class="titulo-repertorio">{{ $repertorio->nome }}</h1>
                <div class="tema-repertorio">
                    <div class="tipo-repertorio">
                        @php
                        $filterName = strtolower(explode(' ', $repertorio->classificacao)[0]); // Normaliza o nome do filtro
                        $icon = $filters[$filterName][0] ?? 'fa-question-circle'; // Ícone padrão se o filtro não for encontrado
                        @endphp
                        <div id="tipo-{{ $filterName }}">
                            <i class="fa-solid {{ $icon }}"></i>
                            <p>{{ ucfirst($repertorio->classificacao) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-texto">
                <p>{{ $repertorio->descricao }}</p>
            </div>

        </section>

    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
