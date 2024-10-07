@extends('layouts._partials._cabecalho')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">  
    <link rel="stylesheet" type="text/css" href="/css/temaRedacoes.css"> 
    <link rel="stylesheet" type="text/css" href="/css/repertorios.css">
    <link rel="stylesheet" type="text/css" href="/css/home.css">
    <link rel="stylesheet" type="text/css" href="/css/carrousselHome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>HOME</title>
@endsection

@section('conteudo')
<main>

    <!-- MENU -->
    <section class="menu-home">
        <!-- TEMA REDACOES -->
        <div class="card">
            <a href="{{ route('temaRedacoes') }}">
                <img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card">
            </a>
            <div class="texto-card">Temas de Redações</div>
        </div>

        <!-- REPERTORIOS -->
        <div class="card">
            <a href="{{route('admin.temasRepertorios')}}">
                <img src="https://segredosdomundo.r7.com/wp-content/uploads/2021/01/45-personalidades-mais-importantes-e-influentes-de-todos-os-tempos-37-e1610752380360.jpg" alt="imagemRepertorio" class="imagem-card">
            </a>
            <div class="texto-card">Repertórios</div>
        </div>

        <!-- ESTATÍSTICAS -->
        <div class="card">
            <a href="{{ route('aluno.estatistica') }}">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQElTwwYKc4LXiYe3nPA-MnM-hhH0V8EqZO_Q&s" alt="" class="imagem-card">
            </a>
            <div class="texto-card">Estatísticas</div>
        </div>

        <!-- MATERIAIS -->
        <div class="card">
            <a href="{{ route('admin.pastasMateriais') }}">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSDaUfHGduhGapOSADboo67PDCiZkpAWdK1g&s" alt="" class="imagem-card">
            </a>
            <div class="texto-card">Materiais</div>
        </div>

        <!-- QUESTOES -->
        <div class="card">
            <a href="{{ route('admin.questoes') }}">
                <img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card">
            </a>
            <div class="texto-card">Banco de Questões</div>
        </div>

        <!-- MINHAS REDACOES -->
        <div class="card">
            <a href="{{ url('/painel_redacoes') }}">
                <img src="https://m.media-amazon.com/images/S/aplus-media/vc/f70120c7-a5a8-4f96-b86e-6d1db6eaa559._CR0,0,300,300_PT0_SX300__.png" alt="" class="imagem-card">
            </a>
            <div class="texto-card">Minhas Redações</div>
        </div>
    </section>

    <!-- REDACOES CORRIGIDAS -->
    <section class="section-cinza" id="ultimas-redacoes">
        <div class="texto-section-cinza">Últimas Redações Corrigidas</div>
        @forelse ($redacoesCorrigidas as $redacao)

            <article class="tema-secao hover">
                <a href="{{ route('redacao_corrigida', $redacao->id_redacao) }}" class="container-info">

                    <div class="container-imagem-tema">
                        <img src="{{ $redacao->tema_imagem }}" alt="" class="imagem-tema"></img>
                    </div>
                    
                    <div class="frase-tematica">
                        <p>{{ $redacao->frase_tematica }}</p>
                    </div>

                    <div class="banca-ano">{{ $redacao->banca_nome }}/{{ $redacao->tema_ano }}</div>
                </a>
            </article>

        @empty
            <p>Nenhuma redação corrigida.</p>
        @endforelse
    </section>

   <section class="semanas">
    <form action="{{ route('aluno.home') }}" method="GET" id="semanaForm">
        <div id="cCarousel">
        @if(count($semanas) > 4)
            <div class="arrow" id="prev"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="arrow" id="next"><i class="fa-solid fa-chevron-right"></i></div>
            @endif
            <div id="carousel-vp">
                <div id="cCarousel-inner">
                    @forelse ($semanas as $semana)
                        <label for="semana-{{ $loop->index }}" class="cCarousel-item">
                            <div class="texto-semana">{{ $semana->nome }}</div>
                            <input type="radio" name="semana_id" id="semana-{{ $loop->index }}" class="radio-carousel" value="{{ $semana->id }}" {{ $semana->id == $semanaSelecionadaId ? 'checked' : '' }} onchange="document.getElementById('semanaForm').submit()">
                        </label>
                    @empty
                        <p>Nenhuma semana disponível.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </form>
</section>

    <!-- ROTEIRO DE AULA -->
    <section class="section-cinza" id="roteiro">
        <div class="texto-section-cinza texto-section-cinza-subtitulo">Roteiro de Aula</div>

        @if(!is_null($temaSemana) && $temaSemana->isNotEmpty())
            <div class="texto-section-cinza">Temas da Semana</div>
            @forelse ($temaSemana as $tema)

                <article class="tema-secao hover">

                    <a href="{{ route('admin.temas.visualizar', $tema->id) }}" class="container-info">

                        <div class="container-imagem-tema">
                            <img src="{{ $tema->imagem }}" alt="" class="imagem-tema"></img>
                        </div>
                        
                        <div class="frase-tematica">
                            <p>{{ $tema->frase_tematica }}</p>
                        </div>

                        <div class="banca-ano">{{ $tema->banca_nome }}/{{ $tema->ano }}</div>
                    </a>

                </article>
                
            @empty
                <p>Nenhum tema disponível.</p>
            @endforelse
        @endif

        @if((!is_null($materialSemana) && $materialSemana->isNotEmpty()) || (!is_null($repertorioSemana) && $repertorioSemana->isNotEmpty()))
            <div class="texto-section-cinza">Materiais de Apoio</div>
            @foreach ($materialSemana as $material)
                <div class="container-items">
                    <article class="card-materiais hover">
                        <div class="card-materiais-texto">{{ $material->nome }}</div>
                    </article>
                </div>
            @endforeach

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

            @foreach ($repertorioSemana as $repertorio)

                <article class="card-repertorio hover">

                    <a href="{{ route('admin.repertorios.visualizar', ['id' => $repertorio->id, 'id_pasta' => $repertorio->id_pasta]) }}" class="container-info">

                        <div class="container-imagem">
                            <img src="{{ $repertorio->imagem }}" alt="" class="imagem-repertorio">
                        </div>
                        
                        <h1 class="titulo-repertorio">{{ ucfirst($repertorio->nome) }}</h1>
                        
                        <div class="tipo-repertorio">
                            <div id="tipo-{{ Str::slug(strtolower(explode(' ', $repertorio->classificacao)[0])) }}">
                                <i class="fa-solid {{ $filters[strtolower(explode(' ', $repertorio->classificacao)[0])][0] ?? 'fa-question-circle' }}"></i>
                                <p>{{ $repertorio->classificacao }}</p>
                            </div>
                        </div>

                        <div class="spoiler-repertorio">
                            <p>{{ $repertorio->descricao }}</p>
                        </div>

                    </a>

                </article>

            @endforeach
        @endif
    </section>

</main>
@endsection

@section('js')
        <script src="js/home.js"></script>
        <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
