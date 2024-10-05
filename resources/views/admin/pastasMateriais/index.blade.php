@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <link rel="stylesheet" type="text/css" href="/css/materiais.css">
    <link rel="stylesheet" type="text/css" href="/css/temaRepertorio.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Materiais</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp
   
    <main>
        <h1 class="titulo-pagina">Materiais</h1>
        <hr class="titulo-linha">

        @if ($isAdmin)
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.pastasMateriais.adicionar') }}" class="botao-texto">Adicionar Pasta</a>
                <hr id="linhaBotao">
                <a href="{{ route('admin.materiais.adicionar')}}" class="botao-texto">Adicionar Material</a>
            </div>
        </button>
        @endif

        <section class="pastas"> 
        @forelse ($pastas as $pasta)

            
                <div class="wrapper">
                    <div class="quadrado">
                        <a href="{{ route('admin.materiais', ['id' => $pasta->id]) }}">                       
                            <img src="/assets/{{$pasta->imagem}}" alt="" class="img-tema">
                        </a>
                    @if ($isAdmin)
                        <button class="botao-editar">
                            <i class="material-icons">more_horizon</i>
                            <div class="editar-opcoes">
                                <a href="{{ route('admin.pastasMateriais.editar',$pasta->id) }}" class="editar-opcoes-texto">Editar</a>
                                <hr>
                                <a href="{{ route('admin.pastasMateriais.excluir',$pasta->id) }}" class="editar-opcoes-texto">Excluir</a>
                            </div>
                        </button>
                    @endif
                    </div>
                    <div class="escrito">
                        <p>{{ $pasta->nome }}</p>
                    </div>
                </div>

            @empty
            <p>Nenhuma pasta disponível.</p>
            @endforelse
            
        </section>

    </main>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection