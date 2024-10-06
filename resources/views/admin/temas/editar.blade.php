@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/visualizarTema.css">
    <title>Editar Tema</title>
@endsection

@section('conteudo')
    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Tema</h1>
        </div>
        <hr class="titulo-linha">
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
                    <textarea id="textoApoio" class="content" name="texto_apoio" required>{{ old('texto_apoio', $temas->texto_apoio) }}</textarea>
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
                            <span id="text-selected-banca">{{$temas->nome_banca}}</span>  <!--Fazer o inner join e puxar banca_nome-->
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
                    <br>

                    
                    <div class="upload">
                        <input type="file" class="arquivo" id="arquivo" name="arquivo">
                        <input type="hidden" name="id_tema" value="{{$temas->id}}">
                        <input type="hidden" name="imagem" value="{{$temas->imagem}}">
                    </div>

                     @if($temas->imagem)
                    <div class="preview">
                        <img src="{{ asset('assets/temas/' . $temas->imagem) }}" alt="Imagem do tema" style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif

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