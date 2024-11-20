@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <title>Adicionar Pasta</title>
@endsection

@section('conteudo')
    <main>
      <div class="container-titulo-seta">
        <div class="container-seta">
              <a href="{{ route('admin.pastasMateriais') }}" class="seta-back">
                  <i class="material-icons">arrow_back</i>
              </a>
          </div>
          <h1 class="titulo-pagina">Adicionar Pasta</h1>
      </div>
      <hr class="titulo-linha">
    </main>

    <article>
        <div class="form-value">
        <form action="{{ route('admin.pastasMateriais.salvar') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
                <div class="inputbox">
                    <label for="">Nome da pasta</label>
                    <input type="text" name="nome" value="{{ old('nome', isset($pastas->nome) ? $pastas->nome : '') }}" >
                </div>

                <label class="lbl-upload">Upload de imagem</label>
                <div class="upload">
                    <input type="file" class="arquivo" id="arquivo" name="arquivo">
                </div>

                @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                @endif


                <div class="botoes">
                    <button type="reset" name="limpar" id="limpar" class="button">Limpar</button>
                    <button type="sumbit" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


@endsection