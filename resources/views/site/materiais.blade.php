@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materiais.css') }}">
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
        <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
        <button type="button" class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="" class="botao-texto">Adicionar Pasta</a>
            </div>
        </button>
        @endif

        <section class="pastas"> 

            <div class="wrapper">
                <div class="quadrado">
                @if ($isAdmin)
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                @endif
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>

            <div class="wrapper">
                <div class="quadrado">
                    <button type="button" class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="#" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                <div class="escrito">
                    <p>Nome da Pasta</p>
                </div>
            </div>
        </section>

    </main>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection