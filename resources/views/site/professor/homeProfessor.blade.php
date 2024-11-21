@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/temaRedacoes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/repertorios.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/carrousselHome.css') }}">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Home</title>
@endsection

@section('conteudo')

    <main>

     <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
     <button type="button" class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.atribuir.adicionarTema') }}" class="botao-texto">Atribuir Tema</a>
                <hr id="linhaBotao">
                <a href="{{ route('admin.atribuir.adicionarMaterial')}}" class="botao-texto">Atribuir Material</a>
                <hr id="linhaBotao">
                <a href="{{ route('admin.atribuir.adicionarRepertorio')}}" class="botao-texto">Atribuir Repertório</a>
            </div>
        </button>

        <!-- MENU -->
        <section class="menu-home" id="menu-home-professor">

            <div class="card">
                <a href="{{ url('/redacoes_pendentes') }}"><img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card"></a>
                <div class="texto-card">Redações Pendentes</div>
            </div>

            <!-- TEMAS -->
            <div class="card">
            <a href="{{route('admin.temas')}}"><img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card"> </a>
                <div class="texto-card">Temas</div>
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
                <a href="{{route('admin.questoes')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Banco de Questões</div>
            </div>

            <!-- TURMAS -->
            <div class="card">
                <a href="{{route('admin.turmas')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Turmas</div>
            </div>
            
            <!-- CRITÉRIOS -->
            <div class="card">
                <a href="{{route('admin.criterios')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Critérios</div>
            </div>

            <!-- BANCAS -->
            <div class="card">
                <a href="{{route('admin.bancas')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Bancas</div>
            </div>

            <!-- SEMANAS -->
            <div class="card">
                <a href="{{route('admin.semanas')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Semanas</div>
            </div>

        </section>


        <section class="semanas card_wrapper">
        <form action="{{ route('professor.home') }}" method="GET" id="semanaForm" class="container">
            <div id="cCarousel row">
                <div class="col-12">
                    <div class="owl-carousel slider_carousel">

                        @forelse ($semanas as $semana)
                            <label for="semana-{{ $loop->index }}" class="cCarousel-item card-box">
                                <div class="texto-semana">{{ $semana->nome }}</div>
                                <input type="radio" name="semana_id" id="semana-{{ $loop->index }}" class="radio-carousel"
                                    value="{{ $semana->id }}" {{ $semana->id == $semanaSelecionadaId ? 'checked' : '' }}
                                    onchange="document.getElementById('semanaForm').submit()">
                            </label>
                        @empty
                            <div class="alerta">
                                <span class="material-icons">error_outline</span>
                                <p>Nenhuma semana disponível.</p>
                            </div>
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
                            <img src="{{ asset('assets/temas/' . $tema->imagem) }}" alt="" class="imagem-tema"></img>
                        </div>

                        <div class="frase-tematica">
                            <p>{{ $tema->frase_tematica }}</p>
                        </div>

                        <div class="banca-ano">{{ $tema->banca_nome }}/{{ $tema->ano }}</div>
                    </a>
                    <a href="{{ route('admin.atribuir.excluirTema', ['id_semana' => $semanaSelecionadaId, 'id_tema' => $tema->id]) }}">
                            <i class="material-icons icone-tabela">close</i>
                     </a>

                </article>

            @empty
                <div class="alerta">
                    <span class="material-icons">error_outline</span>
                    <p>Nenhum tema disponível.</p>
                </div>
            @endforelse
        @endif

        @if((!is_null($materialSemana) && $materialSemana->isNotEmpty()) || (!is_null($repertorioSemana) && $repertorioSemana->isNotEmpty()))
                <div class="texto-section-cinza">Materiais de Apoio</div>
                @foreach ($materialSemana as $material)
                    <div class="container-items">
                        <article class="card-materiais hover">
                            <a href="{{ route('pdf.show', ['imageName' => ($material->descricao)]) }}" target="_blank">
                                <p class="nomeMaterial">{{$material->nome}}</p>
                            </a>
                            <a href="{{ route('admin.atribuir.excluirMaterial', ['id_semana' => $semanaSelecionadaId, 'id_material' => $material->id]) }}">
                            <i class="material-icons icone-tabela">close</i>
                     </a>
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

                        <a href="{{ route('admin.repertorios.visualizar', ['id' => $repertorio->id, 'id_pasta' => $repertorio->id_pasta]) }}"
                            class="container-info">

                            <div class="container-imagem">
                                <img src="{{ asset('assets/repertorios/' . $repertorio->imagem) }}" alt=""
                                    class="imagem-repertorio">
                            </div>

                            <h1 class="titulo-repertorio">{{ ucfirst($repertorio->nome) }}</h1>

                            <div class="tipo-repertorio">
                                <div id="tipo-{{ Str::slug(strtolower(explode(' ', $repertorio->classificacao)[0])) }}">
                                    <i
                                        class="fa-solid {{ $filters[strtolower(explode(' ', $repertorio->classificacao)[0])][0] ?? 'fa-question-circle' }}"></i>
                                    <p>{{ $repertorio->classificacao }}</p>
                                </div>
                            </div>

                            <div class="spoiler-repertorio">
                                <p>{{ $repertorio->descricao }}</p>
                            </div>

                        </a>

                        <a href="{{ route('admin.atribuir.excluirMaterial', ['id_semana' => $semanaSelecionadaId, 'id_material' => $repertorio->id]) }}">
                            <i class="material-icons icone-tabela">close</i>
                     </a>

                    </article>

                @endforeach
        @endif
    </section>

    </main>

  
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>

    <script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script>

    function slider_carouselInit() {
        $('.owl-carousel.slider_carousel').owlCarousel({
            dots: false,
            loop: true,
            margin: 30,
            stagePadding: 2,
            autoplay: false,
            nav: true,
            navText: ["<i class='fa-solid fa-chevron-left'></i>", "<i class='fa-solid fa-chevron-right'></i>"],
            autoplayTimeout: 1500,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 3,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                }
            }
        });
    }
    slider_carouselInit();

</script>

@endsection

@section('js')

<script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Procura o elemento selecionado
        var selectedRadio = document.querySelector('input[name="semana_id"]:checked');
        if (selectedRadio) {
            // Rola até o elemento no meio da tela
            selectedRadio.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    });

</script>

@endsection