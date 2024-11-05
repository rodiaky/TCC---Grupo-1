@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Editar Pagamento</title>
@endsection

@section('conteudo')
<main>
    <div class="container-titulo-seta">
        <div class="container-seta">
            <a href="{{ url()->previous() }}" class="seta-back">
                <i class="material-icons">arrow_back</i>
            </a>
        </div>
        <h1 class="titulo-pagina">Editar Pagamento</h1>
    </div>
    <hr class="titulo-linha">
</main>

<article>
    <div class="form-value">
        <form action="{{ route('admin.pagamentos.atualizar', ['id' => $pagamentos->id]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <input type="hidden" name="id_aluno" id="id_aluno" value="{{ $pagamentos->id_aluno ?? '' }}">

            <div class="inputbox">
                <label for="valor">Valor</label>
                <input type="text" name="valor" value="{{ $pagamentos->valor ?? '' }}" required>
            </div>

            <div class="inputbox">
                <label for="ano">Ano</label>
                <input type="text" name="ano" value="{{ $pagamentos->ano ?? '' }}" required>
            </div>

            <!-- Select Mês -->
            <div class="select">
                <div class="selected" onclick="toggleOptions('mes')">
                    <span id="text-selected-mes">{{ $pagamentos->mes ?? 'Selecionar Mês' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                    </svg>
                </div>
                <div class="options">
                    @foreach(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'] as $key => $mes)
                    <div>
                        <input id="mes-{{ $key + 1 }}" name="mes" type="radio" value="{{ $mes }}" onclick="changeSelected('mes', '{{ $mes }}')" {{ $pagamentos->mes == $mes ? 'checked' : '' }}>
                        <label class="option" for="mes-{{ $key + 1 }}">{{ $mes }}</label>
                    </div>
                    @endforeach
                </div>
                <input type="hidden" id="mes" name="mes" value="{{ $pagamentos->mes ?? '' }}">
            </div>
            <br><br>

            <!-- Select Status -->
            <div class="select">
                <div class="selected" onclick="toggleOptions('status')">
                    <span id="text-selected-status">{{ $pagamentos->status_pagamento ?? 'Selecionar Status' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                    </svg>
                </div>
                <div class="options">
                    <div>
                        <input id="status-1" name="status" type="radio" value="Pago" onclick="changeSelected('status', 'Pago')" {{ $pagamentos->status_pagamento == 'Pago' ? 'checked' : '' }}>
                        <label class="option" for="status-1">Pago</label>
                    </div>
                    <div>
                        <input id="status-2" name="status" type="radio" value="Não Pago" onclick="changeSelected('status', 'Não Pago')" {{ $pagamentos->status_pagamento == 'Não Pago' ? 'checked' : '' }}>
                        <label class="option" for="status-2">Não Pago</label>
                    </div>
                </div>
                <input type="hidden" id="status" name="status_pagamento" value="{{ $pagamentos->status_pagamento ?? '' }}"> <!-- Mudando para status_pagamento -->
            </div>

            <div class="mensagem">
                <ion-icon name="alert-circle-outline"></ion-icon>
                Preencha todos os campos antes de avançar
            </div>

            <div class="botoes">
                <button type="reset" id="limpar" class="button">Limpar</button>
                <button type="submit" class="button">Salvar</button>
            </div>
        </form>
    </div>
</article>

<script>
    function changeSelected(field, value) {
        document.getElementById("text-selected-" + field).textContent = value;
        document.getElementById(field).value = value;
    }
    function toggleOptions(field) {
        document.querySelector('.options').classList.toggle('active');
    }
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection
