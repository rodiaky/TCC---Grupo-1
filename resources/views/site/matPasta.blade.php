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

            <i class="material-icons seta-voltar">arrow_back</i>

            <div class="escrito">
                <p>Nome da Pasta</p>
            </div>

            <div class="branco">
                <p class="nomeMaterial">Material</p>
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

            
            <div class="branco">
                <p class="nomeMaterial">Material</p>
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
            </div>

            
            <div class="branco">
                <p class="nomeMaterial">Material</p>
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
            </div>

            
            <div class="branco">
                <p class="nomeMaterial">Material</p>
            </div>

        </section>

    </main>
@endsection