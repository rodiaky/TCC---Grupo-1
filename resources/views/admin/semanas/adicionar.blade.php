@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <title>Adicionar Semana</title>
    @endsection

@section('conteudo')

    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ route('admin.semanas') }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Adicionar Semana</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
        <form action="{{ route('admin.semanas.salvar') }}" method="post" enctype="multipart/form-data" id="form-semana">
                {{ csrf_field() }}

                <div class="inputbox">
                    <label for="nome-semana">Nome da semana</label>
                    <input type="text" name="nome"  value="{{ old('nome') }}" >
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="data-inicio">Data de início</label>
                    <input type="text" id="data_inicio" name="data_inicio" value="{{ old('data_inicio') }}" placeholder="dd/mm/yyyy">
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="data-fim">Data de fim</label>
                    <input type="text" id="data_fim" name="data_fim" value="{{ old('data_fim') }}"  placeholder="dd/mm/yyyy">
                </div>

                <div class="inputbox">
                    <label for="descricao-semana">Descrição</label>
                    <textarea id="textoDescricao" class="textoQuestao" name="descricao" >{{ old('descricao') }}</textarea>
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
    <script>
        function aplicarMascaraData(input) {
            let valor = input.value;
            if (/\D\/$/.test(valor)) valor = valor.slice(0, -1); // Remove qualquer caractere inválido

            let partes = valor.replace(/\D/g, "").match(/(\d{1,2})(\d{1,2})?(\d{1,4})?/);

            if (!partes) return input.value = "";

            let resultado = partes[1] ? partes[1] : "";
            if (partes[2]) resultado += "/" + partes[2];
            if (partes[3]) resultado += "/" + partes[3];

            input.value = resultado;
        }

        document.getElementById('data_inicio').addEventListener('input', function() {
            aplicarMascaraData(this);
        });

        document.getElementById('data_fim').addEventListener('input', function() {
            aplicarMascaraData(this);
        });

        document.getElementById('limpar').addEventListener('click', function(event) {
            event.preventDefault();

            const campos = document.querySelectorAll('#form-semana input[type="text"], #form-semana textarea');
            campos.forEach(function(campo) {
                campo.value = '';  // Limpa o conteúdo de cada campo
            });
        });
    </script>
@endsection