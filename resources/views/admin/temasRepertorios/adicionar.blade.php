@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <title>Adicionar Tema de Repertório</title>
@endsection

@section('conteudo')
    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ route('admin.temasRepertorios') }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Adicionar Tema de Repertório</h1>
        </div>
        <hr class="titulo-linha">
    </main>

    <article>
        <div class="form-value">
        <form action="{{ route('admin.temasRepertorios.salvar') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
                <div class="inputbox">
                    <label for="">Nome do tema de repertório</label>
                    <input type="text" name="nome" value="{{ isset($pastas->nome) ? $pastas->nome : '' }}" required>
                </div>

                <label class="lbl-upload">Upload de imagem</label>
                <div class="upload">
                    <input type="file" class="arquivo" id="arquivo" name="arquivo">
                </div>

                <input type="hidden" name="tipo" value="Repertório">


                <div class="botoes">
                    <button type="button" name="limpar" id="limpar" class="button">Limpar</button>
                    <button type="button" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
@endsection