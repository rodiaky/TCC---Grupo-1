@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/botao2.css">
    <link rel="stylesheet" type="text/css" href="/css/materiais.css">
    <link rel="stylesheet" type="text/css" href="/css/temaRepertorio.css">
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
                <a href="{{ route('admin.temasRepertorios.adicionar') }}" class="botao-texto">Adicionar Tema</a>
                <hr id="linhaBotao">
                <a href="{{ route('admin.repertorios.adicionar')}}" class="botao-texto">Adicionar Repertório</a>
            </div>
        </button>
        @endif

        <section class="temas"> 

            @forelse ($pastas as $pasta)
            <div class="wrapper">
                <a href="{{ route('admin.repertorios', ['id' => $pasta->id]) }}">
                    <img src="/assets/{{$pasta->imagem}}" alt="" class="img-tema">
                </a>

                @if ($isAdmin)
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="{{ route('admin.temasRepertorios.editar',$pasta->id) }}" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="{{ route('admin.temasRepertorios.excluir',$pasta->id) }}" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                @endif
                <div class="escrito">
                        <p>{{ $pasta->nome }}</p>
                </div>
            </div>
            @empty
            <p>Nenhum tema disponível.</p>
            @endforelse

        </section>

    </main>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
