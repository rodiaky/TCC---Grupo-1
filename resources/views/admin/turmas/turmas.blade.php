@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/turmas.css">
    <link rel="stylesheet" type="text/css" href="/css/botao1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Turmas</title>
@endsection

@section('conteudo')
    
    <main>
        <h1 class="titulo-pagina">Turmas</h1>
        <hr class="titulo-linha">

        <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.turmas.adicionar') }}" class="botao-texto">Adicionar Turma</a>
            </div>
        </button>

        <article class="container-turmas">
            @foreach($diasAula as $dia)
                <section class="turma">
                    <button class="turma-retangulo">
                        <h1 class="titulo-cardTurmas">{{ $dia->dias_aula }}</h1>
                        <i class="material-icons turma-seta">arrow_forward_ios</i>
                    </button>
                    
                    <div class="turma-dropdown">
                        @if (isset($turmasPorDia[$dia->dias_aula]))
                            @foreach($turmasPorDia[$dia->dias_aula] as $turma)
                                <a class="turma-horario" href="#">{{ $turma->nome }}</a>
                            @endforeach
                        @endif
                    </div>
                </section>
            @endforeach

        </article>
        
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
