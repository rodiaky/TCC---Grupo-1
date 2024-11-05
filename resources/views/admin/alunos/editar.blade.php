@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Editar Aluno</title>
@endsection

@section('conteudo')

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
                            
                            <span id="text-selected-turma">{{$alunos->nome_turma}}</span>

                        </div><!--selected-data-->

                        
                        <!-- Input hidden para o ID da turma selecionada -->
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                        <input type="hidden" id="id_turma" name="id_turma" value="{{ $alunos->id_turma }}" />
                    </div><!--Select para turma-->
                    <br>
                    <label class="lbl-upload">Upload de imagem</label>
                    <div class="upload">
                    <input type="file" class="arquivo" id="arquivo" name="arquivo" onchange="showFileName(this)" style="display: none;">
                        <button type="button" class="custom-upload-button" onclick="document.getElementById('arquivo').click();">
                        Escolher Arquivo
                        </button>
                        <span id="file-name">
                        {{ isset($alunos->foto) && $alunos->foto ? 'Arquivo atual: ' . $alunos->foto : 'Nenhum arquivo carregado' }}
                        </span>
                        <input type="hidden" name="id_aluno" value="{{$alunos->id}}">
                        <input type="hidden" name="foto" value="{{$alunos->foto}}">
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                    </div>
                    <script>
                        // Função para exibir o nome do arquivo quando selecionado
                        function showFileName(input) {
                        const fileName = input.files[0] ? input.files[0].name : 'Nenhum arquivo escolhido';
                        document.getElementById('file-name').textContent = fileName;
                        }
                    </script>


                      <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Selecione uma opção antes de avançar
                    </div>
                    
                    <div class="botoes">
                        <button type="reset" name="limpar" id="limpar" class="button">Limpar</button>
                        <button type="submit" name="salvar" class="button">Salvar</button>
                    </div>
                </form>
            </div><!--form-value-->
            
        </article>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection