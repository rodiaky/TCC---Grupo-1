@extends('layouts._partials._cabecalho')
@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">  
    <link rel="stylesheet" type="text/css" href="/css/temaRedacoes.css"> 
    <link rel="stylesheet" type="text/css" href="css/repertorios.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/carrousselHome.css">
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
            <div class="texto-card">Questões</div>
        </div>

        <!-- MINHAS REDACOES -->
        <div class="card">
            <a href="{{ url('/painel_redacoes') }}">
                <img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card">
            </a>
            <div class="texto-card">Minhas Redações</div>
        </div>
    </section>

    <!-- REDACOES CORRIGIDAS -->
    <section class="section-cinza" id="ultimas-redacoes">
        <div class="texto-section-cinza">Últimas Redações Corrigidas</div>
        @forelse ($redacoesCorrigidas as $redacoes)
        <div class="container-items-redacao">
            <a href="{{ route('redacao_corrigida', $redacoes->id_redacao) }}">
                <div class="tema-secao hover">
                    <div class="container-imagem-tema">
                        <img src="{{ $redacoes->tema_imagem }}" alt="{{ $redacoes->tema_imagem }}" class="imagem-tema">
                    </div>
                    <div class="frase-tematica">
                        <p>{{ $redacoes->frase_tematica }}</p>
                    </div>
                    <div class="banca-ano">{{ $redacoes->banca_nome }}/{{ $redacoes->tema_ano }}</div>
                    <div class="spoiler">
                        <p>{{ $redacoes->texto_apoio }}</p>
                    </div>
                </div>
            </a>
        </div>
        @empty
            <p>Nenhuma redação corrigida.</p>
        @endforelse
    </section>

    <section class="semanas">
        <form action="{{ route('home') }}" method="GET">
            <div id="cCarousel">
                <div class="arrow" id="prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="arrow" id="next"><i class="fa-solid fa-chevron-right"></i></div>
                <div id="carousel-vp">
                    <div id="cCarousel-inner">
                        @forelse ($semanas as $semana)
                            <label for="semana-{{ $loop->index }}" class="cCarousel-item">
                                <div class="texto-semana">{{ $semana->nome }}</div>
                                <input type="radio" name="semana_id" id="semana-{{ $loop->index }}" class="radio-carousel" value="{{ $semana->id }}" {{ $semana->id == $semanaSelecionadaId ? 'checked' : '' }} onchange="this.form.submit()">
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
    <section class="section-branca">
        <div class="container-roteiro-aula">
            <div class="texto-roteiro-aula">Roteiro de Aula da Semana:</div>
            @forelse ($temaSemana as $tema)
                <div class="item-roteiro">
                    <h3>{{ $tema->titulo }}</h3>
                    <p>{{ $tema->descricao }}</p>
                </div>
            @empty
                <p>Nenhum tema disponível para esta semana.</p>
            @endforelse
        </div>
    </section>

    <!-- MATERIAIS -->
    <section class="section-branca">
        <div class="container-materiais">
            <div class="texto-materiais">Materiais da Semana:</div>
            @forelse ($materialSemana as $material)
                <div class="item-material">
                    <h4>{{ $material->titulo }}</h4>
                    <a href="{{ $material->link }}">Baixar Material</a>
                </div>
            @empty
                <p>Nenhum material disponível para esta semana.</p>
            @endforelse
        </div>
    </section>

    <!-- REPERTÓRIOS -->
    <section class="section-branca">
        <div class="container-repertorios">
            <div class="texto-repertorios">Repertórios da Semana:</div>
            @forelse ($repertorioSemana as $repertorio)
                <div class="item-repertorio">
                    <h4>{{ $repertorio->titulo }}</h4>
                    <a href="{{ $repertorio->link }}">Baixar Repertório</a>
                </div>
            @empty
                <p>Nenhum repertório disponível para esta semana.</p>
            @endforelse
        </div>
    </section>

</main>
@endsection

@section('js')
    <script src="js/home.js"></script>
@endsection
