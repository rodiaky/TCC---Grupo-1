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

            <!-- REDACOES -->
            <div class="card">
                <a href="{{ url('/painel_redacoes') }}"><img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card"></a>
                <div class="texto-card">Redações</div>
            </div>

            <!-- REPERTORIOS -->
            <div class="card">
                <a href="{{route('admin.temasRepertorios')}}"><img src="https://segredosdomundo.r7.com/wp-content/uploads/2021/01/45-personalidades-mais-importantes-e-influentes-de-todos-os-tempos-37-e1610752380360.jpg" alt="imagemRepertorio" class="imagem-card"></a>
                <div class="texto-card">Repertórios</div>
            </div>

            <!-- MATERIAIS -->
            <div class="card">
                <a href="{{ url('/materiais') }}"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSDaUfHGduhGapOSADboo67PDCiZkpAWdK1g&s" alt="" class="imagem-card"></a>
                <div class="texto-card">Materiais</div>
            </div>

            <!-- QUESTOES -->
            <div class="card">
                <a href="{{ route('admin.questoes') }}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Questões</div>
            </div>

        </section>

        <!-- REDACOES CORRIGIDAS -->
        <section class="section-cinza" id="ultimas-redacoes">

            <div class="texto-section-cinza">Últimas Redações Corrigidas</div>
            @forelse ($redacoesCorrigidas as $redacoes)
            <div class="container-items-redacao">

                <a href="">
                    <div class="tema-secao hover">
                        <div class="container-imagem">
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
                                <input type="radio" name="selecionar-semana" id="semana-{{ $loop->index }}" class="radio-carousel" value="{{ $semana->id }}">
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

            <div class="container-items-redacao">

                <a href="">
                    <div class="tema-secao hover">
                        <div class="container-imagem">
                            <img src="" alt="" class="imagem-tema">
                        </div>
                        <div class="frase-tematica">
                            <p>aaaaaaaaaaaaaaa</p>
                        </div>
                        <div class="banca-ano">aaaaaa</div>
                        <div class="spoiler">
                            <p></p>
                        </div>
                    </div>
                </a>

            <div class="texto-section-cinza">Materiais de Apoio</div>

            <div class="container-items">

                <article class="card-materiais hover">
                    <div class="card-materiais-texto">Materiais</div>
                </article>

                <article class="repertorio-home card-repertorio hover">
                    <div class="container-imagem"><img src="https://blog.polipet.com.br/wp-content/uploads/2024/01/pato-445x445.jpeg" alt="" class="imagem-repertorio"></div>
                    <h1 class="titulo-repertorio">Título</h1>
                    <div class="tipo-repertorio">
                        <div id="tipo-filosofia">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <p>Filosofia</p>
                        </div>
                    </div>
                    <div class="spoiler-repertorio"><p>Stegoceras é um gênero de dinossauro paquicefalossaurídeo (com cabeça de cúpula) que viveu no que hoje é a América do Norte durante o período Cretáceo Superior, há cerca de 77,5 a 74 milhões de anos. Os primeiros espécimes, de Alberta, Canadá, foram descritos em 1902, e a espécie-tipo Stegoceras validum foi baseada nestes restos. O nome genérico significa "telhado de chifre" e o nome específico significa "forte". Várias outras espécies foram inseridas no gênero ao longo dos anos, mas foram movidas posteriormente para outros gêneros ou consideradas sinônimos juniores. Atualmente apenas o S. validum e S. novomexicanum, nomeados em 2011 a partir de fósseis encontrados no Novo México, permanecem. A validade desse último táxon também foi debatida.</p></div>
                </article>

                <article class="repertorio-home card-repertorio hover">
                    <div class="container-imagem"><img src="https://blog.polipet.com.br/wp-content/uploads/2024/01/pato-445x445.jpeg" alt="" class="imagem-repertorio"></div>
                    <h1 class="titulo-repertorio">Título</h1>
                    <div class="tipo-repertorio">
                        <div id="tipo-artes">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <p>Artes</p>
                        </div>
                    </div>
                    <div class="spoiler-repertorio"><p>Stegoceras é um gênero de dinossauro paquicefalossaurídeo (com cabeça de cúpula) que viveu no que hoje é a América do Norte durante o período Cretáceo Superior, há cerca de 77,5 a 74 milhões de anos. Os primeiros espécimes, de Alberta, Canadá, foram descritos em 1902, e a espécie-tipo Stegoceras validum foi baseada nestes restos. O nome genérico significa "telhado de chifre" e o nome específico significa "forte". Várias outras espécies foram inseridas no gênero ao longo dos anos, mas foram movidas posteriormente para outros gêneros ou consideradas sinônimos juniores. Atualmente apenas o S. validum e S. novomexicanum, nomeados em 2011 a partir de fósseis encontrados no Novo México, permanecem. A validade desse último táxon também foi debatida.</p></div>
                </article>

            </div>

        </section>

    </main>

    <script src="js/home.js"></script>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
