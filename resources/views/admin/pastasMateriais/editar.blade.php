@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/Arquivo.css">
    <title>Alterar tema de repertório</title>
@endsection

@section('conteudo')
    <main>
        <h1>Alterar tema de repertório</h1><hr>
    </main>

    <article>
        <div class="form-value">
        <form action="{{ route('admin.pastasMateriais.atualizar', $pastas->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
                <div class="inputbox">
                    <label for="">Nome do tema de repertório</label>
                    <input type="text" name="nome" value="{{ isset($pastas->nome) ? $pastas->nome : '' }}" required>
                </div>

                <label class="lbl-upload">Upload de imagem</label>
                <div class="upload">
                    <input type="file" accept="image/*" class="img-arquivo" name="img-repertorio" id="img-repertorio" >
                </div>

                <input type="hidden" name="tipo" value="Material">

                <div class="botoes">
                    <button name="limpar" id="limpar" class="button">Limpar</button>
                    <button name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
@endsection