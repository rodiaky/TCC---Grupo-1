@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="formularioUI.css">
    <link rel="stylesheet" type="text/css" href="formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="selecao.css">

    <title>Cadastro de Dados Pessoais</title>
@endsection

@section('conteudo')
    <main>
        <h1>Cadastro de Dados Pessoais</h1><hr>
    
        <article>
            <div class="form-value">
                <form action="">
                    <div class="inputbox">
                        <label for="">Nome</label> <!--DEVE SER PUXADO AUTOMATICAMENTE; ALUNO NAO DEVE PREENCHER-->
                        <input type="text" name="nome" disabled>
                    </div>
                    <div class="inputbox">
                        <label for="">Telefone (Aluno)</label>
                        <input type="number" name="telefone-aluno" required>  
                        <div  id="msg" class="mensagem">
                          <ion-icon name="alert-circle-outline"></ion-icon>
                          Número de telefone inválido
                        </div> 
                    </div>
                    <div class="inputbox">
                      <label for="">CPF</label>
                      <input type="number" name="cpf" required>   
                      <div  id="msg" class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Número de cpf inválido
                      </div>
                    </div>
                    <div class="inputbox">
                      <label for="">Data de Nascimento</label>
                      <input type="date" name="data-nascimento" required>   
                    </div>
                    <div class="inputbox">
                      <label for="">Nome do Responsável</label>
                      <input type="text" name="nome-responsavel" required>   
                    </div>
                    <div class="inputbox">
                      <label for="">Telefone (Responsável)</label>
                      <input type="number" name="telefone-responsavel" required>   
                      <div id="msg" class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Número de telefone inválido
                      </div>
                  </div>
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