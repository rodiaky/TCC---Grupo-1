@extends('layouts._partials._cabecalho')

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <!--link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/teste.css') }}">

    <title>Editar Material</title>

@endsection

@section('conteudo')

    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ route('admin.pastasMateriais) }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Material</h1>
        </div>
        <hr class="titulo-linha">
    </main>

    <article>
        <div class="form-value">
            <form action="{{ route('admin.materiais.atualizar', $materiais->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" name="categoria" value="Material">
            <input type="hidden" name="classificacao" value="">
                <div class="inputbox">
                    <label for="">Nome do material</label>
                    <input type="text" name="nome" value="{{ isset($materiais->nome) ? $materiais->nome : '' }}" required>
                </div>

                <label class="lbl-upload">Upload de arquivo</label>
                <div class="upload">
                    <input type="file" class="arquivo" id="arquivo" name="arquivo" onchange="showFileName(this)" style="display: none;">
                    <button type="button" class="custom-upload-button" onclick="document.getElementById('arquivo').click();">
                    Escolher Arquivo
                    </button>
    
                <!-- Aqui mostraremos o nome do arquivo ou mensagem caso nenhum arquivo tenha sido selecionado -->
                <span id="file-name">
                    {{ isset($materiais->descricao) && $materiais->descricao ? 'Arquivo atual: ' . $materiais->descricao : 'Nenhum arquivo carregado' }}
                </span>

                    <input type="hidden" name="id_tema" value="{{$materiais->id}}">
                    <input type="hidden" name="imagem" value="{{$materiais->descricao}}">
                </div>
                <script>
                    // Função para exibir o nome do arquivo quando selecionado
                    function showFileName(input) {
                        const fileName = input.files[0] ? input.files[0].name : 'Nenhum arquivo escolhido';
                        document.getElementById('file-name').textContent = fileName;
                    }
                </script>
                <br>

                    <!-- Select Tema -->
                    <div class="select"> 
                        <div class="selected">
                            <script>
                                function changeTheme(theme, id) {
                                    document.getElementById("text-selected-theme").textContent = theme;
                                    document.getElementById("selected-theme").value = theme; // Atualiza o valor do input hidden
                                    document.getElementById("id_pasta").value = id; // Atualiza o valor do input hidden para o ID
                                }
                            </script>
                            <span id="text-selected-theme">{{$materiais->nome_pasta}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        
                        <div class="options">
                            @foreach($pastas as $id => $nome)
                                <div>
                                    <input id="tema-{{ $id }}" name="tema" type="radio" onclick="changeTheme('{{ $nome }}', '{{ $id }}')" />
                                    <label class="option" for="tema-{{ $id }}" >{{ $nome }}</label>
                                </div>
                            @endforeach
                        </div><!--options-->
                        
                        <input type="hidden" id="selected-theme" name="selected-theme" value="" />
                        <input type="hidden" id="id_pasta" name="id_pasta" value="{{$materiais->id_pasta}}" /> <!-- Hidden input for ID -->
                    </div><!--Select Tema-->
     

                    @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                @endif
                  
                <div class="botoes">
                    <button type="button" name="limpar" id="limpar" class="button">Limpar</button>
                    <button type="submit" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


@endsection