@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/temaRepertorio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bancoDeQuestoes.css') }}">
    <title>Banco de Questões</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp

    <main>
        <h1 class="titulo-pagina">Banco de Questões</h1>
        <hr class="titulo-linha">

        <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
        @if ($isAdmin)
        <button type="button" class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.questoes.adicionar')}}" class="botao-texto">Adicionar Questão</a>
            </div>
        </button>
        @endif

        <section class="temas"> 

            <div class="wrapper">
                <a href="{{ route('admin.questoes.gramatica')}}">
                    <img src="{{ asset('assets/img/gramatica.png') }}" alt="gramatica" class="img-tema">
                    <div class="escrito">
                        <p>Gramática</p>
                    </div>
                </a>
            </div>
            
            <div class="wrapper">
                <a href="{{ route('admin.questoes.literatura')}}">
                    <img src="{{ asset('assets/img/literatura.png') }}" alt="literatura" class="img-tema">
                    <div class="escrito">
                        <p>Literatura</p>
                    </div>
                </a>
            </div>

            <div class="wrapper">
                <a href="{{ route('admin.questoes.interpretacao')}}">
                    <img src="{{ asset('assets/img/intertexto.png') }}" alt="literatura" class="img-tema">
                    <div class="escrito">
                        <p>Interpretação de Texto</p>
                    </div>
                </a>
            </div>

        </section>
    </main>
    
    <script src="https://kit.fontawesome.com/c8b145fd82.js"></script>
@endsection