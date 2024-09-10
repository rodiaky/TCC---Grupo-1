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
                @csrf <!-- Token CSRF para proteção contra ataques -->

                <div class="inputbox">
                    <label for="nome">Nome do Aluno</label>
                    <input type="text" id="nome" name="nome" required>
                </div>

                <div class="inputbox">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="inputbox">
                    <label for="senha">Senha Provisória</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="select">
                    <div class="selected">
                        <span id="text-selected-turma" style="background-color: white;">Turma</span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            height="1em"
                            viewBox="0 0 512 512"
                            class="arrow"
                        >
                            <path
                                d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                            ></path>
                        </svg>
                    </div><!--selected-data-->

                    <div class="options">
                        <div>
                            <input id="turma-1" name="turma" type="radio" value="1" onClick="changeDay('Turma 1')" />
                            <label class="option" for="turma-1">Turma 1</label>
                        </div>

                        <div>
                            <input id="turma-2" name="turma" type="radio" value="2" onClick="changeDay('Turma 2')" />
                            <label class="option" for="turma-2">Turma 2</label>
                        </div>

                        <div>
                            <input id="turma-3" name="turma" type="radio" value="3" onClick="changeDay('Turma 3')" />
                            <label class="option" for="turma-3">Turma 3</label>
                        </div>

                        <div>
                            <input id="turma-4" name="turma" type="radio" value="4" onClick="changeDay('Turma 4')" />
                            <label class="option" for="turma-4">Turma 4</label>
                        </div>
                    </div><!--options-->
                </div><!--Select-->

                <!-- Mensagem de feedback -->
                <div class="mensagem" style="display: none;" id="mensagem-feedback">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    <span id="mensagem-texto"></span>
                </div>

                <div class="botoes">
                    <button type="reset" id="limpar" class="button">Limpar</button>
                    <button type="submit" id="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div><!--form-value-->
    </article>
</main>

<!-- Scripts de ionicons e funções de manipulação -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
    // Função para alterar a seleção de turma
    function changeDay(turma) {
    document.getElementById("text-selected-turma").textContent = turma;
    document.getElementById("selected-turma").value = turma; // Aqui, você está atribuindo o texto ao invés do valor
}


    // Verificar se existem mensagens de feedback e exibir na tela
    document.addEventListener('DOMContentLoaded', function () {
        var mensagemDiv = document.getElementById('mensagem-feedback');
        var mensagemTexto = document.getElementById('mensagem-texto');

        // Verifica se existe uma mensagem de sucesso na sessão
        @if(session('success'))
            mensagemTexto.textContent = "{{ session('success') }}";
            mensagemDiv.style.display = 'flex'; // Mostra a mensagem de sucesso
            mensagemDiv.querySelector('ion-icon').setAttribute('name', 'checkmark-circle-outline'); // Ícone de sucesso
        @endif

        // Verifica se existe uma mensagem de erro na sessão
        @if($errors->any())
            mensagemTexto.textContent = "Erro ao cadastrar o aluno. Verifique os dados e tente novamente.";
            mensagemDiv.style.display = 'flex'; // Mostra a mensagem de erro
            mensagemDiv.querySelector('ion-icon').setAttribute('name', 'alert-circle-outline'); // Ícone de erro
        @endif
    });

    // Validação do formulário (verifica se uma turma foi selecionada)
    function validateForm() {
        var selectedTurma = document.getElementById("selected-turma").value;
        var mensagemDiv = document.getElementById('mensagem-feedback');
        var mensagemTexto = document.getElementById('mensagem-texto');

        if (!selectedTurma) {
            mensagemTexto.textContent = 'Selecione uma turma antes de salvar.';
            mensagemDiv.style.display = 'flex'; // Mostra a mensagem de erro
            mensagemDiv.querySelector('ion-icon').setAttribute('name', 'alert-circle-outline'); // Ícone de erro
            return false; // Impede o envio do formulário
        }
        return true; // Permite o envio do formulário
    }
</script>
@endsection
