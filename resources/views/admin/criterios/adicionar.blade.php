@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <title>Adicionar Critério</title>
@endsection

@section('conteudo')

    <main>
        <div class="container-titulo-seta">
            <div class="container-seta">
                <a href="{{ route('admin.criterios') }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Adicionar Critério</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
        <form action="{{ route('admin.criterios.salvar') }}" method="post" enctype="multipart/form-data" id="form-semana">
        {{ csrf_field() }}

                <div class="inputbox">
                    <label for="">Nome do Critério</label>
                    <input type="text" name="nome" value="{{ old('nome', $criterios->nome ?? '') }}" >
                </div>

                <div class="inputbox" id="descricao-crit">
                    <label for="">Descrição do Critério</label>
                    <textarea class="textoQuestao" name="descricao" >{{ old('descricao', $criterios->descricao ?? '') }}</textarea>
                </div>
                
                <div class="inputbox" id="nota-max">
                    <label for="">Nota Máxima do Critério</label>
                    <input type="number" name="nota_maxima_criterio" min="0" max="200" value="{{ old('nota_maxima_criterio', $criterios->nota_maxima_criterio ?? '') }}" >
                </div>

                <div class="addAltTema">
                    <div class="select"> <!--Select para banca-->
                        <div class="selected">
                            <script>
                                function changeBanca(banca, id) {
                                    document.getElementById("text-selected-banca").textContent = banca;
                                    document.getElementById("id_banca").value = id;
                                }
                            </script>
                            <span id="text-selected-banca">Banca</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach($bancas as $id => $nome)
                                <div>
                                    <input id="banca-{{ $id }}" name="banca" type="radio" value="{{ $id }}" onclick="changeBanca('{{ $nome }}', '{{ $id }}')" {{ old('id_banca', $criterios->id_banca ?? '') == $id ? 'checked' : '' }} />
                                    <label class="option" for="banca-{{ $id }}" data-txt="{{ $nome }}"></label>
                                </div>
                            @endforeach
                        </div><!--options-->
                    </div><!--Select para banca-->  
                    
                    <input type="hidden" name="id_banca" id="id_banca" value="{{ old('id_banca', $criterios->id_banca ?? '') }}">

                    @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                    @endif

                </div>

                <div class="botoes">
                    <button type="reset" name="limpar" id="limpar" class="button">Limpar</button>
                    <button type="submit" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
            document.getElementById('limpar').addEventListener('click', function(event) {
                event.preventDefault();  
                const campos = document.querySelectorAll('#form-banca input[type="text"], #form-banca input[type="number"]');
                campos.forEach(function(campo) {
                campo.value = '';  
             });
         });
    </script>

@endsection
