@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="css/formularioLayout.css">
    <title>Cadastro de Aluno</title>
@endsection

@section('conteudo')
    <main>
        <h1>Adicionar Aluno</h1><hr>
    
        <article>
            <div class="form-value">
                <form action="">
                    <div class="inputbox">
                        <label for="">Nome do Aluno</label>
                        <input type="text" name="nome" required>
                    </div>
                    <div class="inputbox">
                        <label for="">E-mail</label>
                        <input type="email" name="email" required>   
                    </div>
                    <div class="inputbox">
                        <label for="">Senha Provisória</label>
                        <input type="password" name="senha" required>   
                    </div>
                    <div class="select-turma">
                        <label for="selecionar-turma" class="selecionar-seta">
                            <select name="selecionar-turma" id="selecionar-turma" class="turma">
                                <option value="1">Turma 1</option>
                                <option value="2">Turma 2</option>
                                <option value="3">Turma 3</option>
                                <option value="4">Turma 4</option>
                                <option value="5">Turma 5</option>
                            </select>
                        </label>
                    </div><!--select-->
                    <div class="botoes">
                        <button name="limpar" id="limpar" class="button">Limpar</button>
                        <button name="salvar" class="button">Salvar</button>
                    </div>
                </form>
            </div><!--form-value-->
            
        </article>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @endsection