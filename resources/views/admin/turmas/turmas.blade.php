@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/turmas.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao1.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Turmas</title>
@endsection

@section('conteudo')
    
    <main>
        <h1 class="titulo-pagina">Turmas</h1>
        <hr class="titulo-linha">

        <button type="button" class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.turmas.adicionar') }}" class="botao-texto">Adicionar Turma</a>
            </div>
        </button>

        <section class="container-turmas">

            @php 
                $i = 0;
            @endphp

            @foreach($diasAula as $dia)

                @php 
                    $i++;
                @endphp

                <article class="turma">
                    <div class="turma-retangulo toggleButton" data-target ="drop{{$i}}">
                        <h1 class="titulo-cardTurmas">{{ $dia->dias_aula }}</h1>
                        <i class="material-icons turma-seta">arrow_forward_ios</i>
                    </div>
                    
                    <div class="turma-dropdown content" id="drop{{$i}}">
                        @if (!empty($turmasPorDia[$dia->dias_aula]))
                            @foreach($turmasPorDia[$dia->dias_aula] as $turma)
                                <a class="turma-horario" href="{{ route('admin.alunos', ['id' => $turma->id]) }}">{{ $turma->nome }}</a>
                            @endforeach
                        @else
                            <p>Nenhuma turma cadastrada para este dia.</p>
                        @endif
                    </div>
                </article>
            @endforeach
        </section>
        
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/button.js') }}"></script>
@endsection
