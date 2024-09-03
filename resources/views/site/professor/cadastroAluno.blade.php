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
                    <script>
    function changeDay(turma) {
        document.getElementById("text-selected-turma").textContent = turma;
        document.getElementById("selected-turma").value = turma; // Atualiza o valor do input escondido
        document.querySelector('.mensagem').style.display = 'none'; // Oculta a mensagem de erro
    }

    function validateForm() {
        var selectedTurma = document.getElementById("selected-turma").value;
        var mensagemDiv = document.querySelector('.mensagem');
        var mensagemTexto = document.getElementById('mensagem-texto');

        if (!selectedTurma) {
            mensagemTexto.textContent = 'Selecione uma turma antes de salvar.';
            mensagemDiv.style.display = 'flex'; // Mostra a mensagem de erro
            return false; // Impede o envio do formulário
        }
        return true; // Permite o envio do formulário
    }
</script>

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
                            <input id="turma-1" name="turma" type="radio" value="1" onClick="changeDay('Turma 1')"/>
                            <label class="option" for="turma-1" data-txt="Turma 1"></label>
                        </div>

                        <div>
                            <input id="turma-2" name="turma" type="radio" value="2" onClick="changeDay('Turma 2')"/>
                            <label class="option" for="turma-2" data-txt="Turma 2"></label>
                        </div>

                        <div>
                            <input id="turma-3" name="turma" type="radio" value="3" onClick="changeDay('Turma 3')"/>
                            <label class="option" for="turma-3" data-txt="Turma 3"></label>
                        </div>

                        <div>
                            <input id="turma-4" name="turma" type="radio" value="4" onClick="changeDay('Turma 4')"/>
                            <label class="option" for="turma-4" data-txt="Turma 4"></label>
                        </div>
                    </div><!--options-->

                    <!-- Input escondido para armazenar o valor da turma selecionada -->
                    <input type="hidden" id="selected-turma" name="turma" value="">
                </div><!--Select-->

                <div class="mensagem" style="display: none;">
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

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection
