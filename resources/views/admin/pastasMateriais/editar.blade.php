@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/Arquivo.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <title>Editar Pasta</title>
@endsection

@section('conteudo')
    <main>
      <div class="container-titulo-seta">
        <div class="container-seta">
              <a href="{{ url()->previous() }}" class="seta-back">
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
                    <input type="text" name="nome" value="{{ isset($pastas->nome) ? $pastas->nome : '' }}" required>
                </div>

                <label class="lbl-upload">Upload de imagem</label>
                <div class="upload">
                        <input type="file" class="arquivo" id="arquivo" name="arquivo">
                        <input type="hidden" name="id_tema" value="{{$pastas->id}}">
                        <input type="hidden" name="imagem" value="{{$pastas->imagem}}">
                </div>
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