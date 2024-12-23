@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Cadastro de Aluno</title>
@endsection

@section('conteudo')

    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Cadastro de Aluno</h1>
        </div>
        <hr class="titulo-linha">
    </main>

    <article>
        <div class="form-value">
            <form action="{{ route('admin.alunos.salvar') }}" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
                @csrf

                <div class="inputbox">
                    <label for="nome">Nome do Aluno</label>
                    <input type="text" id="nome" name="name" >
                </div>

                <div class="inputbox">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" >
                </div>

                <div class="inputbox">
                    <label for="senha">Senha Provisória</label>
                    <input type="password" id="senha" name="password" >
                </div>

                <div class="select">
                        <div class="selected">
                            <script>
                                function changeTurma(nomeTurma, idTurma) {
                                    document.getElementById("text-selected-turma").textContent = nomeTurma;
                                    document.getElementById("id_turma").value = idTurma; // Atualiza o input hidden com o id da turma
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
                            @foreach($turmas as $id => $nome)
                                <div>
                                    <input id="turma-{{ $id }}" name="id_turma" type="radio" 
                                        value="{{ $id }}" 
                                        onClick="changeTurma('{{ $nome }}', '{{ $id }}')"
                                    />
                                    <label class="option" for="turma-{{ $id }}" data-txt="">{{ $nome }}</label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Input hidden para o ID da turma selecionada -->
                        <input type="hidden" id="id_turma" name="id_turma" value="{{ isset($alunos->id_turma) ? $alunos->id_turma : '' }}" />
                    </div><!--Select para turma-->
                    <br>
                    <label class="lbl-upload">Upload de imagem</label>
                    <div class="upload">
                        <input type="file" class="arquivo" id="arquivo" name="arquivo">
                    </div>
                    <br>

                    @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                @endif

                <div class="botoes">
                    <button type="reset" id="limpar" class="button">Limpar</button>
                    <button type="submit" id="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
                            
    </article>

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
        var selectedTurma = document.querySelector('input[name="id_turma"]:checked');
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