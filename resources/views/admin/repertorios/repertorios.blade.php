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
    $currentFilter = request('filtros');
    @endphp

    <main>
        <h1 class="titulo-pagina">Repertórios</h1>
        <hr class="titulo-linha">

        @if ($isAdmin)
        <!-- BOTÃO "+" NO CANTO INFERIOR ESQUERDO -->
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.repertorios.adicionar') }}" class="botao-texto">Adicionar Repertório</a>
            </div>
        </button>
        @endif

        <section class="section-barra-de-pesquisa">
            <form method="GET" action="{{ route('admin.repertorios.search') }}" id="search-form">
                <label class="pesquisa" for="barra-pesquisa">
                    <input type="text" id="barra-pesquisa" name="search" placeholder="Digite o repertório." value="{{ request('search') }}">
                    <input type="hidden" name="id_pasta" value="{{ $id_pasta }}">
                    <input type="hidden" name="filtros" value="{{ $currentFilter }}">
                    <button type="submit" id="pesquisar">
                        <i class="material-icons lupa-pesquisa">search</i>
                    </button>
                </label>
            </form>
        </section>

        <form method="GET" action="{{ route('admin.repertorios.filtrar') }}" id="filter-form">
            <section class="section-filtros">
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

                @foreach ($filters as $filter => [$icon, $extra])
                    @php
                        $filtro = Str::slug($filter);
                        $concatenated = $extra ? ucfirst($filter) . ' ' . ucfirst($extra) : ucfirst($filter);
                        $isChecked = ($currentFilter === $concatenated) ? 'checked' : '';
                    @endphp
                    <label class="filtro" for="{{ $filtro }}">
                        <div class="circulo-filtro" id="{{ $filtro }}-circulo" onclick="submitFilterForm('{{ $concatenated }}');">
                            <input type="radio" class="checkbox-filtro" id="{{ $filtro }}" name="filtros" value="{{ $concatenated }}" {{ $isChecked }}>
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>
                        <p class="texto-filtro">{{ ucfirst($filter) }} {{ $extra }}</p>
                    </label>
                @endforeach

                <input type="hidden" name="id_pasta" value="{{ $id_pasta }}">
            </section>

            <section class="section-cards">
                @forelse ($repertorios as $repertorio)
                    <article class="card-repertorio">
                        <div class="container-imagem">
                            <img src="{{ $repertorio->imagem }}" alt="" class="imagem-repertorio">
                        </div>
                        <a href="{{ route('admin.repertorios.visualizar', ['id' => $repertorio->id, 'id_pasta' => $id_pasta]) }}" style="text-decoration: none; color: inherit;">
                            <h1 class="titulo-repertorio">
                                @php
                                
                                $filterName = strtolower(explode(' ', $repertorio->classificacao)[0]);

                                $icon = $filters[$filterName][0] ?? 'fa-question-circle'; // Ícone padrão caso o filtro não seja encontrado
                                @endphp
                                {{ ucfirst($repertorio->nome) }}
                            </h1>
                        </a>

                        <div class="tipo-repertorio">
                            <div id="tipo-{{ Str::slug($filterName) }}">
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
                                <a href="{{ route('admin.repertorios.editar', ['id' => $repertorio->id]) }}" class="editar-opcoes-texto">Editar</a>
                                <hr>
                                <a href="{{ route('admin.repertorios.excluir', ['id' => $repertorio->id]) }}" class="editar-opcoes-texto">Excluir</a>
                            </div>
                        </button>
                        @endif
                    </article>
                @empty
                    <p>Nenhum repertório encontrado.</p>
                @endforelse
            </section>
        </form>
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
    <script>
        function submitFilterForm(filter) {
            // Marca o rádio correspondente
            const radio = document.getElementById(filter);
            if (radio) {
                radio.checked = true; // Marca o input de rádio
            }
            document.getElementById('filter-form').submit(); // Envia o formulário de filtros
        }
    </script>
@endsection
