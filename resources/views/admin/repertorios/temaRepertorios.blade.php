@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/temaRepertorio.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Repertórios</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp
   
    <main>
        <h1 class="titulo-pagina">Temas dos Repertórios</h1>
        <hr class="titulo-linha">

        @if ($isAdmin)
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="#" class="botao-texto">Adicionar Tema</a>
                <hr id="linhaBotao">
                <a href="#" class="botao-texto">Adicionar Repertório</a>
            </div>
        </button>
        @endif

        <section class="temas"> 

            @forelse ($pastas as $pasta)
            <div class="wrapper">
                <a href="{{ route('admin.repertorios', ['id' => $pasta->id]) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ $pasta->imagem }}" alt="Imagem do tema" class="img-tema">
                    <div class="escrito">
                        <p>{{ $pasta->nome }}</p>
                    </div>
                </a>

                @if ($isAdmin)
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                @endif
                
            </div>
            @empty
            <p>Nenhum tema disponível.</p>
            @endforelse

        </section>

    </main>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
