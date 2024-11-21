@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/teste.css') }}">
    <title>Editar Pasta</title>
@endsection

@section('conteudo')
    <main>
        <div class="container-titulo-seta">
            <div class="container-seta">
                <a href="{{ route('admin.pastasMateriais')}}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Pasta</h1>
        </div>
        <hr class="titulo-linha">
    </main>

    <article>
        <div class="form-value">
            <form action="{{ route('admin.pastasMateriais.atualizar', $pastas->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="inputbox">
                    <label for="">Nome da pasta</label>
                    <input type="text" name="nome" value="{{ old('nome', isset($pastas->nome) ? $pastas->nome : '') }}" >
                </div>

                <label class="lbl-upload">Upload de imagem</label>
                <div class="upload">
                    <input type="file" class="arquivo" id="arquivo" name="arquivo" onchange="showFileName(this)" style="display: none;">
                    
                    <!-- Botão personalizado para abrir o seletor de arquivos -->
                    <button type="button" class="custom-upload-button" onclick="document.getElementById('arquivo').click();">
                        Escolher Arquivo
                    </button>

                    <!-- Exibição do nome do arquivo ou mensagem padrão -->
                    <span id="file-name">
                        {{ old('arquivo', isset($pastas->imagem) && $pastas->imagem ? 'Arquivo atual: ' . $pastas->imagem : 'Nenhum arquivo carregado') }}
                    </span>

                    <!-- Campos hidden para armazenar dados existentes -->
                    <input type="hidden" name="id_tema" value="{{ $pastas->id }}">
                    <input type="hidden" name="imagem" value="{{ old('arquivo', isset($pastas->imagem) && $pastas->imagem ? $pastas->imagem : '') }}">

                </div>

                <script>
                    // Função para exibir o nome do arquivo quando selecionado
                    function showFileName(input) {
                        const fileName = input.files[0] ? input.files[0].name : 'Nenhum arquivo escolhido';
                        document.getElementById('file-name').textContent = fileName;
                    }

                    function limparFormulario(event) {
                        event.preventDefault(); 
    
                        document.querySelector("input[name='nome']").value = '';
                        document.querySelector("input[name='imagem']").value = '';
                     
                        document.getElementById('file-name').textContent = 'Nenhum arquivo escolhido';
                       
                        document.getElementById('imagem').value = '';
                        
                    }

                </script>
                @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                @endif
                <div class="botoes">
                    <button type="button" name="limpar" id="limpar" class="button" onclick="limparFormulario(event)">Limpar</button>
                    <button type="submit" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
@endsection

