@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <link rel="stylesheet" type="text/css" href="/css/temaRepertorio.css">
    <link rel="stylesheet" type="text/css" href="/css/bancoDeQuestoes.css">
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
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.questoes.adicionar')}}" class="botao-texto">Adicionar Questão</a>
            </div>
        </button>
        @endif

        <section class="temas"> 

            <div class="wrapper">
                <a href="{{ route('admin.questoes.gramatica')}}">
                    <img src="https://blog.educalar.com.br/wp-content/uploads/2017/10/gram%C3%A1tica-1.png" alt="gramatica" class="img-tema">
                    <div class="escrito">
                        <p>Gramática</p>
                    </div>
                </a>
            </div>
            
            <div class="wrapper">
                <a href="{{ route('admin.questoes.literatura')}}">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTz8FId1XeO_C8z2glJOnDHBHHCOyqcR-tDfQ&s" alt="literatura" class="img-tema">
                    <div class="escrito">
                        <p>Literatura</p>
                    </div>
                </a>
            </div>

            <div class="wrapper">
                <a href="{{ route('admin.questoes.interpretacao')}}">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTz8FId1XeO_C8z2glJOnDHBHHCOyqcR-tDfQ&s" alt="literatura" class="img-tema">
                    <div class="escrito">
                        <p>Interpretação de Texto</p>
                    </div>
                </a>
            </div>

        </section>
    </main>
    
    <script src="https://kit.fontawesome.com/c8b145fd82.js"></script>
@endsection