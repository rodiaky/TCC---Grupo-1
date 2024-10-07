@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <title>Editar Aluno</title>
@endsection

@section('conteudo')
    @php
    $aluno = $_SESSION['eh_admin'] === 'Aluno';
    @endphp

    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Aluno</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
        <article>
            <div class="form-value">
            <form action="{{ route('admin.alunos.atualizar', $alunos->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="inputbox">
                        <label for="">Nome do Aluno</label>
                        <input type="text" name="name" value="{{ isset($alunos->name) ? $alunos->name : '' }}" required>
                    </div>
                    <div class="inputbox">
                        <label for="">E-mail</label>
                        <input type="email" name="email" value="{{ isset($alunos->email) ? $alunos->email : '' }}" required>   
                    </div>
                    <div class="select">
                        <div class="selected">
                            <script>
                                function changeTurma(nomeTurma, idTurma) {
                                    document.getElementById("text-selected-turma").textContent = nomeTurma;
                                    document.getElementById("id_turma").value = idTurma; // Atualiza o input hidden com o id da turma
                                }
                            </script>
                            <span id="text-selected-turma" style="background-color: white;">{{$alunos->nome_turma}}</span>
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
                                        {{ $aluno ? 'disabled' : '' }} />

                                <label class="option" for="turma-{{ $id }}" data-txt="">{{ $nome }}</label>

                                </div>
                            @endforeach
                        </div>

                        <!-- Input hidden para o ID da turma selecionada -->
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                        <input type="hidden" id="id_turma" name="id_turma" value="{{ $alunos->id_turma }}" />
                    </div><!--Select para turma-->




                      <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Selecione uma opção antes de avançar
                    </div>
                    
                    <div class="botoes">
                        <button name="limpar" id="limpar" class="button">Limpar</button>
                        <button name="salvar" class="button">Salvar</button>
                    </div>
                </form>
            </div><!--form-value-->
            
        </article>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection