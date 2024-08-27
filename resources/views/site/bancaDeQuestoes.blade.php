@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="css/botao1.css">
    <link rel="stylesheet" type="text/css" href="css/temaRepertorio.css">
    <link rel="stylesheet" type="text/css" href="css/bancoDeQuestoes.css">
    <title>Banco de Questões</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp
    <main>
        <h1 class="titulo-pagina">Banco de Questões</h1>
        <hr class="titulo-linha">

        @if ($isAdmin)
        <!-- BOTÃO "+" NO CANTO INFERIOR ESQUERDO -->
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="" class="botao-texto">Adicionar Questão</a>
            </div>
        </button>
        @endif

        <section class="temas">
            @foreach ($pastas as $pasta)
                <div class="wrapper">
                    <!-- Adapte o código de acordo com a URL real da imagem -->
                    <img src="https://via.placeholder.com/150" alt="{{ $pasta->disciplina }}" class="img-tema">
                    <div class="escrito">
                        <p>{{ $pasta->disciplina }}</p>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
    
    <script src="https://kit.fontawesome.com/c8b145fd82.js"></script>
@endsection
