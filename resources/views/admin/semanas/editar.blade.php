@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <title>Editar Semana</title>
    @endsection

@section('conteudo')
    <main>
        <h1>Editar Semana</h1><hr>
    </main>
    
    <article>
        <div class="form-value">
        <form action="{{ route('admin.semanas.atualizar', $semanas->id) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

                <div class="inputbox">
                    <label for="nome-semana">Nome da semana</label>
                    <input type="text" name="nome" value="{{ isset($semanas->nome) ? $semanas->nome : '' }}" required>
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="data-inicio">Data de início</label>
                    <input type="text" id="data-inicio" name="data_inicio" value="{{ isset($semanas->data_inicio) ? $semanas->data_inicio : '' }}" required placeholder="dd/mm/yyyy">
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="data-fim">Data de fim</label>
                    <input type="text" id="data-fim" name="data_fim" value="{{ isset($semanas->data_fim) ? $semanas->data_fim : '' }}" required placeholder="dd/mm/yyyy">
                </div>

                <div class="inputbox">
                    <label for="descricao-semana">Descrição</label>
                    <textarea id="textoDescricao" class="textoQuestao" name="descricao" required>{{ old('descricao', $semanas->descricao) }}</textarea>
                </div>

                  <div class="mensagem">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    Preencha todos os campos antes de avançar
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
    </script>
@endsection