@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/turmas.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Minhas Redações</title>
@endsection

@section('conteudo')

<main>

    <h1 class="titulo-pagina">Minhas Redações</h1>
    <hr class="titulo-linha">

    <section class="container-turmas">
 
    @php 
        $i = 0;
    @endphp

        @foreach ($redacoesPorBanca as $redacao)

            @php 
                $i++;
            @endphp

            <article class="turma">
                <div class="turma-retangulo toggleButton" data-target="drop{{$i}}">
                    <h1 class="titulo-cardTurmas">{{ $redacao->banca_nome }}</h1>
                    <i class="material-icons turma-seta">arrow_forward_ios</i>
                </div>
                
                <div class="turma-dropdown content" id="drop{{$i}}">

                    @foreach ($redacao->frases_tematicas as $index => $frase)
                        <a class="turma-horario" href="{{ route('redacao_corrigida', ['id' => $redacao->ids_redacoes[$index]]) }}">
                            {{ $frase }}
                        </a>
                    @endforeach

                </div>
            </article>
        @endforeach
    </section>
        
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/button.js') }}"></script>

@endsection
