@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/visualizarTema.css">
    <link rel="stylesheet" type="text/css" href="/css/Arquivo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Visualização de Repertório</title>
@endsection

@section('conteudo')
@php
$isAdmin = $_SESSION['eh_admin'] === 'Professor';
@endphp
<body>

    <main>

        <section class="container-tema">

            <div class="grid-layout">

                <div class="container-seta">
                    <a href="{{route('admin.temas')}}" class="seta-back">
                        <i class="material-icons seta-back"> arrow_back</i>
                    </a>
                </div>

                @if ($isAdmin)
                <div class="container-botao">
                    <button class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="{{ route('admin.temas.editar',$tema->id) }}" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="{{ route('admin.temas.excluir',$tema->id) }}" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                @endif

                <div class="container-imagem"><img src="{{ asset('assets/temas/' . $tema->imagem) }}" alt="" class="imagem-tema"></div> 
                <h1 class="titulo-tema">{{$tema->frase_tematica}}</h1>
                <div class="banca-tema">{{$tema->banca_nome}}/{{$tema->ano}}</div>
            </div>

            <iframe src="{{ route('pdf.mostrar', ['imageName' => ($tema->texto_apoio)]) }}"></iframe>

            @if (!$isAdmin)
            <form action="{{ route('admin.temas.store') }}" method="POST" enctype="multipart/form-data">
                
                @csrf
                <div class="upload">
                    <input type="file" class="arquivo" name="redacao_enviada" required>
                    <input type="hidden" name="id_tema" value="{{$tema->id}}">
                </div>
                
                <button type="submit" name="salvar" id="salvar" href="{{ route('admin.temas.store') }}">Salvar</button>
            
            </form>
            @endif

        </section>

    </main>
@endsection