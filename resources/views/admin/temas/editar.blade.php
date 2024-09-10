@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <title>Editar Tema</title>
@endsection

@section('conteudo')
    <main>
        <h1>Editar Tema</h1><hr>
    </main>
    
    <article>
        <div class="form-value">
            <form action="{{ route('admin.temas.atualizar', $temas->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="inputbox">
                    <label for="frase_tematica">Frase temática</label>
                    <input type="text" id="frase_tematica" name="frase_tematica" value="{{ isset($temas->frase_tematica) ? $temas->frase_tematica : '' }}" required>
                </div>

                <div class="inputbox">
                    <label for="textoApoio">Textos de apoio</label>
                    <textarea id="textoApoio" class="content" name="texto_apoio" required>{{ isset($temas->texto_apoio) ? $temas->texto_apoio : '' }}</textarea>
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="ano">Ano</label>
                    <input type="number" id="ano" name="ano" min="2000" value="{{ isset($temas->ano) ? $temas->ano : '2024' }}">
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
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                height="1em"
                                viewBox="0 0 512 512"
                                class="arrow"
                            >
                                <path
                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                                ></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach($bancas as $id => $nome)
                                <div>
                                    <input id="banca-{{ $id }}" name="banca" type="radio" value="{{ $id }}" onclick="changeBanca('{{ $nome }}', '{{ $id }}')" {{ (isset($temas->id_banca) && $temas->id_banca == $id) ? 'checked' : '' }}/>
                                    <label class="option" for="banca-{{ $id }}" data-txt="{{ $nome }}"></label>
                                </div>
                            @endforeach
                        </div><!--options-->
                    </div><!--Select para banca-->  

                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos antes de avançar 
                    </div>
                </div>

                <!-- Campo oculto para id_banca -->
                <input type="hidden" name="id_banca" id="id_banca" value="{{ isset($temas->id_banca) ? $temas->id_banca : '' }}">

                <div class="botoes">
                    <button type="reset" name="limpar" id="limpar" class="button">Limpar</button>
                    <button type="submit" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection