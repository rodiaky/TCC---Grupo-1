@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <title>Adicionar Banca</title>
@endsection

@section('conteudo')

    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ route('admin.bancas') }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Adicionar Banca</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
            <form action="{{ route('admin.bancas.salvar') }}" method="post" enctype="multipart/form-data" id="form-banca">
                {{ csrf_field() }}

                <div class="inputbox">
                    <label for="">Nome da Banca</label>
                    <input type="text" name="nome" value="{{ old('nome', isset($bancas->nome) ? $bancas->nome : '') }}" >
                </div>
                
                <div class="inputbox" id="nota-max">
                    <label for="">Nota Máxima da Banca</label>
                    <input type="number" name="nota_maxima_banca" min="0" max="1000" value="{{ old('nota_maxima_banca', isset($bancas->nota_maxima_criterio) ? $bancas->nota_maxima_criterio : '') }}" >
                </div>

                @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                @endif

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
        // Limpa os campos do formulário diretamente
        document.getElementById('limpar').addEventListener('click', function(event) {
            event.preventDefault();  // Impede o comportamento padrão do reset

            // Limpa os campos do formulário
            document.getElementById('form-banca').reset();
        });
    </script>

@endsection
