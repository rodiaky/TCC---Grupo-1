@extends('layouts._partials._cabecalho') 

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Atribuir Material</title>
@endsection

@section('conteudo')

<main>
    <div class="container-titulo-seta">
       <div class="container-seta">
            <a href="{{ route('professor.home') }}" class="seta-back">
                <i class="material-icons">arrow_back</i>
            </a>
        </div>
        <h1 class="titulo-pagina">Atribuir Material</h1>
    </div>
    <hr class="titulo-linha">
</main>

<article>
    <div class="form-value">
        <form action="{{ route('admin.atribuir.salvarMaterial') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="addAltRep">
                <!-- Select Semana -->
                <div class="select">
                    <div class="selected">
                        <span id="text-selected-semana">Semana</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                        </svg>
                    </div>
                    
                    <div class="options">
                        @foreach($semanas as $semana)
                            <div>
                                <input id="semana-{{ $semana->id }}" name="id_semana" type="radio" onclick="document.getElementById('text-selected-semana').textContent = '{{ $semana->nome }}';"/>
                                <label class="option" for="semana-{{ $semana->id }}">{{ $semana->nome }}</label>
                            </div>
                        @endforeach
                    </div><!--options-->
                    
                    <input type="hidden" id="id_semana" name="id_semana" value="" />
                </div><!--Select Semana-->

                <!-- Select Material -->
                <div class="select">
                    <div class="selected">
                        <span id="text-selected-material">Material</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                        </svg>
                    </div>
                    
                    <div class="options">
                        @foreach($materiais as $material)
                            <div>
                                <input id="material-{{ $material->id }}" name="id_material" type="radio" onclick="document.getElementById('text-selected-material').textContent = '{{ $material->nome }}';"/>
                                <label class="option" for="material-{{ $material->id }}">{{ $material->nome }}</label>
                            </div>
                        @endforeach
                    </div><!--options-->
                    
                    <input type="hidden" id="id_material" name="id_material" value="" />
                </div><!--Select Material-->
            </div><!--addAltRep-->
            

            @if ($errors->any())
                <div class="mensagem">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    Preencha todos os campos corretamente antes de avançar
                </div>
            @endif

            <div class="botoes">
                <button type="reset" id="limpar" class="button">Limpar</button>
                <button type="submit" class="button">Salvar</button>
            </div>
        </form>
    </div><!--form-value-->
</article>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection
