@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <title>Editar Banca</title>
    @endsection

@section('conteudo')
    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ route('admin.bancas') }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Banca</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
        <form action="{{ route('admin.bancas.atualizar', $bancas->id) }}" method="post" enctype="multipart/form-data" id="form-banca">
                {{ csrf_field() }}

                <div class="inputbox">
                    <label for="">Nome da Banca</label>
                    <input type="text" name="nome" value="{{ isset($bancas->nome) ? $bancas->nome : '' }}" >
                </div>
                
                <div class="inputbox" id="nota-max">
                    <label for="">Nota Máxima da Banca</label>
                    <input type="number" name="nota_maxima_banca" min="0" max="1000" value="{{ isset($bancas->nota_maxima_banca) ? $bancas->nota_maxima_banca : '' }}" >
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
            document.getElementById('limpar').addEventListener('click', function(event) {
                event.preventDefault();  
                const campos = document.querySelectorAll('#form-banca input[type="text"], #form-banca input[type="number"]');
                campos.forEach(function(campo) {
                campo.value = '';  
             });
         });
    </script>
    @endsection