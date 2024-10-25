@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeralRetCinza.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materiaisPasta.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Materiais Pasta</title>
@endsection

@section('conteudo')
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp
    <main>
    <section class="conteudo">
    <div class="container-titulo-seta">
        <div class="container-seta">
            @if ($isAdmin)
            <a href="{{ route('admin.pastasMateriais') }}" class="seta-back">
                <i class="material-icons">arrow_back</i>
            </a>
            @else
            <a href="{{ url()->previous() }}" class="seta-back">
                <i class="material-icons">arrow_back</i>
            </a>
            @endif
        </div>
        <div class="escrito">
            <p>{{ $nome_pasta->nome }}</p>
        </div>
      </div>
      <hr>
            @forelse ($materiais as $material)
            <div class="branco hover">
                <a href="{{ route('pdf.show', ['imageName' => ($material->descricao)]) }}" target="_blank"><p class="nomeMaterial">{{$material->nome}}</p></a>
                @if ($isAdmin)
                <button type="button" class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="{{ route('admin.materiais.editar', ['id' => $material->id]) }}" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="{{ route('admin.materiais.excluir', ['id' => $material->id]) }}" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                @endif
            </div>
            @empty
                    <p>Nenhum material encontrado.</p>
                @endforelse

        </section>

    </main>
@endsection