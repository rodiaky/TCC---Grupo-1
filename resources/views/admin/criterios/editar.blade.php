@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <title>Editar Critério</title>
@endsection

@section('conteudo')
    <main>
        <div class="container-titulo-seta">
            <div class="container-seta">
                <a href="{{ route('admin.criterios') }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Critério</h1>
        </div>
        <hr class="titulo-linha">
    </main>

    <article>
        <div class="form-value">
            <form action="{{ route('admin.criterios.atualizar', $criterios->id) }}" method="post" enctype="multipart/form-data" id="form-criterio">
            {{ csrf_field() }}

                <div class="inputbox">
                    <label for="nome">Nome do Critério</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $criterios->nome ?? '') }}" >
                </div>


                <div class="inputbox" id="descricao-crit">
                    <label for="descricao">Descrição do Critério</label>
                    <textarea id="descricao" class="textoQuestao" name="descricao" >{{ old('descricao', $criterios->descricao ?? '') }}</textarea>
                </div>


                <div class="inputbox" id="nota-max">
                    <label for="nota_maxima_criterio">Nota Máxima do Critério</label>
                    <input type="number" id="nota_maxima_criterio" name="nota_maxima_criterio" min="0" max="200" value="{{ old('nota_maxima_criterio', $criterios->nota_maxima_criterio ?? '') }}" >
                </div>

     
                <div class="addAltTema">
                    <div class="select">
                        <div class="selected">
                            <span id="text-selected-banca">
                                {{ old('banca_nome', $criterios->banca_nome ?? 'Banca') }}
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach($bancas as $id => $nome)
                                <div>
                                    <input 
                                        id="banca-{{ $id }}" 
                                        name="id_banca" 
                                        type="radio" 
                                        value="{{ $id }}" 
                                        onclick="changeBanca('{{ $nome }}')" 
                                        {{ old('id_banca', $criterios->id_banca ?? '') == $id ? 'checked' : '' }}
                                    />
                                    <label class="option" for="banca-{{ $id }}">{{ $nome }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Exibição de Erros --}}
                @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar.
                    </div>
                @endif

                {{-- Botões de Ação --}}
                <div class="botoes">
                    <button type="reset" id="limpar" class="button">Limpar</button>
                    <button type="submit" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    {{-- Scripts --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function changeBanca(banca) {
            document.getElementById('text-selected-banca').textContent = banca;
        }

        document.getElementById('limpar').addEventListener('click', function(event) {
            event.preventDefault();

            // Limpar campos do formulário
            const campos = document.querySelectorAll('#form-criterio input[type="text"], #form-criterio input[type="number"], #form-criterio textarea');
            campos.forEach(campo => campo.value = '');

            // Desmarcar os radios e resetar o texto do select
            const radios = document.querySelectorAll('#form-criterio input[type="radio"]');
            radios.forEach(radio => radio.checked = false);
            document.getElementById('text-selected-banca').textContent = 'Selecione uma banca';
        });
    </script>
@endsection
