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
                <a href="{{ route('temaRedacoes') }}"><img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card"></a>
                <div class="texto-card">Temas de Redações</div>
            </div>

            <!-- REPERTORIOS -->
            <div class="card">
                <a href="{{route('admin.temasRepertorios')}}"><img src="https://segredosdomundo.r7.com/wp-content/uploads/2021/01/45-personalidades-mais-importantes-e-influentes-de-todos-os-tempos-37-e1610752380360.jpg" alt="imagemRepertorio" class="imagem-card"></a>
                <div class="texto-card">Repertórios</div>
            </div>

            <!-- MATERIAIS -->
            <div class="card">
                <a href="{{ route('admin.pastasMateriais') }}"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSDaUfHGduhGapOSADboo67PDCiZkpAWdK1g&s" alt="" class="imagem-card"></a>
                <div class="texto-card">Materiais</div>
            </div>

            <!-- QUESTOES -->
            <div class="card">
                <a href="{{ route('admin.questoes') }}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Questões</div>
            </div>

            <!-- MINHAS REDACOES -->
            <div class="card">
                <a href="{{ route('aluno.painel_redacoes') }}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Minhas Redações</div>
            </div>

            <div class="card">
                <a href="{{ route('aluno.estatistica') }}"><img src="https://cdn-icons-png.flaticon.com/512/3832/3832383.png" alt="" class="imagem-card"></a>
                <div class="texto-card">Estatísticas</div>
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
                            <p>{{ $redacoes->texto_apoio}}</p>
                        </div>
                    </div>
                </a>
                @empty
                <p>Nenhuma redação corrigida.</p>
            @endforelse
                
        </section>

        <section class="semanas">
            <div id="cCarousel">
                <div class="arrow" id="prev"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="arrow" id="next"><i class="fa-solid fa-chevron-right"></i></div>
                <div id="carousel-vp">
                    <div id="cCarousel-inner">
                        @forelse ($semanas as $semana)
                            <label for="semana-{{ $loop->index }}" class="cCarousel-item">
                                <div class="texto-semana">{{ $semana->nome }}</div>
                                <!--<div class="texto-semana">{{ $semana->data_inicio }} a {{ $semana->data_fim }}</div>-->
                                <input type="radio" name="selecionar-semana" id="semana-{{ $loop->index }}" class="radio-carousel" value="{{ $semana->id }}" {{ $semana->id == $semanaSelecionada->id ? 'checked' : '' }}>
                            </label>
                        @empty
                            <p>Nenhuma semana disponível.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- ROTEIRO DE AULA -->
        <section class="section-cinza" id="roteiro">

            <div class="texto-section-cinza texto-section-cinza-subtitulo">Roteiro de Aula</div>
        
            <div class="texto-section-cinza">Temas da Semana</div>

            @foreach ($temaSemana as $tema)
            <div class="container-items-redacao">
                <a href="{{ route('admin.temas.visualizar', $tema->id) }}">
                    <div class="tema-secao hover">
                        <div class="container-imagem-tema">
                            <img src="{{$tema->imagem}}" alt="" class="imagem-tema">
                        </div>
                        <div class="frase-tematica">
                            <p>{{$tema->frase_tematica}}</p>
                        </div>
                        <div class="banca-ano">{{$tema->banca_nome}}/{{$tema->ano}}</div>
                        <div class="spoiler">
                            <p>{{$tema->texto_apoio}}</p>
                        </div>
                    </div>
                </a>
                @endforeach

            <div class="texto-section-cinza">Materiais de Apoio</div>

            <div class="container-items">

                <article class="card-materiais hover">
                    <div class="card-materiais-texto">Materiais</div>
                </article>

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
                <article class="repertorio-home card-repertorio hover">
                    <div class="container-imagem"><img src="{{ $repertorio->imagem }}" alt="" class="imagem-repertorio"></div>
                    <a href="{{ route('admin.repertorios.visualizar', ['id' => $repertorio->id, 'id_pasta' => $repertorio->id_pasta]) }}" style="text-decoration: none; color: inherit;">
                        <h1 class="titulo-repertorio">{{ ucfirst($repertorio->nome) }}</h1>
                    </a>
                    <div class="tipo-repertorio">
                        <div id="tipo-{{ Str::slug(strtolower(explode(' ', $repertorio->classificacao)[0])) }}">
                            <i class="fa-solid {{ $filters[strtolower(explode(' ', $repertorio->classificacao)[0])][0] ?? 'fa-question-circle' }}"></i>
                            <p>{{ $repertorio->classificacao }}</p>
                        </div>
                    </div>
                    <div class="spoiler-repertorio"><p>{{ $repertorio->descricao }}</p></div>
                </article>
                @endforeach
                

            </div>

        </section>

    </main>

    <script src="js/home.js"></script>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection