@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <title>Cadastro de Aluno</title>
@endsection

@section('conteudo')
<main>
    <h1>Adicionar Aluno</h1><hr>

    <article>
        <div class="form-value">
            <form action="{{ route('professor.cadastroAluno.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf

                <div class="inputbox">
                    <label for="nome">Nome do Aluno</label>
                    <input type="text" id="nome" name="nome" >
                </div>

                <div class="inputbox">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" >
                </div>

                <div class="inputbox">
                    <label for="senha">Senha Provisória</label>
                    <input type="password" id="senha" name="senha" >
                </div>

                <div class="select">
                    <div class="selected">
                        <span id="text-selected-turma" style="background-color: white;">Turma</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                        </svg>
                    </div>

                    <div class="options">
                        @foreach ($turmas as $turma)
                            <div>
                                <input id="turma-{{ $turma->id }}" name="turma" type="radio" value="{{ $turma->id }}" onClick="changeDay('{{ $turma->nome }}')" />
                                <label class="option" for="turma-{{ $turma->id }}">{{ $turma->nome }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mensagem" style="display: none;" id="mensagem-feedback">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    <span id="mensagem-texto"></span>
                </div>

                <div class="botoes">
                    <button type="reset" id="limpar" class="button">Limpar</button>
                    <button type="submit" id="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>
</main>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    function changeDay(turma) {
        document.getElementById("text-selected-turma").textContent = turma;
    }

    document.addEventListener('DOMContentLoaded', function () {
        var mensagemDiv = document.getElementById('mensagem-feedback');
        var mensagemTexto = document.getElementById('mensagem-texto');

        @if(session('success'))
            mensagemTexto.textContent = "{{ session('success') }}";
            mensagemDiv.style.display = 'flex';
            mensagemDiv.querySelector('ion-icon').setAttribute('name', 'checkmark-circle-outline');
        @endif

        @if($errors->any())
            mensagemTexto.textContent = "Erro ao cadastrar o aluno. Verifique os dados e tente novamente.";
            mensagemDiv.style.display = 'flex';
            mensagemDiv.querySelector('ion-icon').setAttribute('name', 'alert-circle-outline');
        @endif
    });

    function validateForm() {
        var selectedTurma = document.querySelector('input[name="turma"]:checked');
        var mensagemDiv = document.getElementById('mensagem-feedback');
        var mensagemTexto = document.getElementById('mensagem-texto');

        if (!selectedTurma) {
            mensagemTexto.textContent = 'Selecione uma turma antes de salvar.';
            mensagemDiv.style.display = 'flex';
            mensagemDiv.querySelector('ion-icon').setAttribute('name', 'alert-circle-outline');
            return false;
        }
        return true;
    }
</script>
@endsection
