@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="css/turmas.css">
    <link rel="stylesheet" type="text/css" href="css/botao1.css">
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
                <a href="{{ route('site.turmas.adicionar')}}" class="botao-texto">Adicionar Turma</a>
            </div>
        </button>

        <article class="container-turmas">

            <section class="turma">
                <button class="turma-retangulo">
                    <h1 class="titulo-cardTurmas">Particulares</h1>
                </button>
            </section>

            <section class="turma">
                
                <button class="turma-retangulo">
                    <h1 class="titulo-cardTurmas">Segunda-feira</h1>
                    <i class="material-icons turma-seta">arrow_forward_ios</i>
                </button>
                
                <div class="turma-dropdown">
                    <a class="turma-horario" href="https://pt.wikipedia.org/wiki/Wikip%C3%A9dia:P%C3%A1gina_principal">Horário</a>
                    <a class="turma-horario" href="#">AAAAAAAAAA</a>
                </div>
            </section>

            <section class="turma">
                <button class="turma-retangulo">
                    <h1 class="titulo-cardTurmas">Terça-feira</h1>
                    <i class="material-icons turma-seta">arrow_forward_ios</i>
                </button>
                
                <div class="turma-dropdown">
                    <a class="turma-horario" href="#">Horário</a>
                    <a class="turma-horario" href="#">Horário</a>
                </div>
            </section>

            <section class="turma">
                <button class="turma-retangulo">
                    <h1 class="titulo-cardTurmas">Quarta-feira</h1>
                    <i class="material-icons turma-seta">arrow_forward_ios</i>
                </button>
                
                <div class="turma-dropdown">
                    <a class="turma-horario" href="#">Horário</a>
                    <a class="turma-horario" href="#">Horário</a>
                </div>
            </section>

            <section class="turma">
                <button class="turma-retangulo">
                    <h1 class="titulo-cardTurmas">Quinta-feira</h1>
                    <i class="material-icons turma-seta">arrow_forward_ios</i>
                </button>
                
                <div class="turma-dropdown">
                    <a class="turma-horario" href="#">Horário</a>
                    <a class="turma-horario" href="#">Horário</a>
                </div>
            </section>

            <section class="turma">
                <button class="turma-retangulo">
                    <h1 class="titulo-cardTurmas">Sexta-feira</h1>
                    <i class="material-icons turma-seta">arrow_forward_ios</i>
                </button>
                
                <div class="turma-dropdown">
                    <a class="turma-horario" href="#">Horário</a>
                    <a class="turma-horario" href="#">Horário</a>
                </div>
            </section>

        </article>
        
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection