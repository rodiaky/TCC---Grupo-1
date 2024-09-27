@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <title>Adicionar Questão</title>
    @endsection

@section('conteudo')
    <main>
      <div class="container-titulo-seta">
        <div class="container-seta">
              <a href="{{ route('admin.questoes') }}" class="seta-back">
                  <i class="material-icons">arrow_back</i>
              </a>
          </div>
          <h1 class="titulo-pagina">Adicionar Questão</h1>
      </div>
      <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
        <form action="{{ route('admin.questoes.salvar') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

                <div class="inputbox">
                    <label for="">Texto da questão</label>
                    <textarea class="textoQuestao" name="enunciado" required>{{ isset($questoes->enunciado) ? $questoes->enunciado : '' }}</textarea>
                </div>
                

                <div class="inputbox">
                  <label for="">Alternativa A</label>
                  <textarea id="alt-a" class="textoAlternativa" name="alternativa_A" required>{{ isset($questoes->alternativa_A) ? $questoes->alternativa_A : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="">Alternativa B</label>
                  <textarea id="alt-b" class="textoAlternativa" name="alternativa_B" required>{{ isset($questoes->alternativa_B) ? $questoes->alternativa_B : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="">Alternativa C</label>
                  <textarea id="alt-c" class="textoAlternativa" name="alternativa_C" required>{{ isset($questoes->alternativa_C) ? $questoes->alternativa_C : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="">Alternativa D</label>
                  <textarea id="alt-d" class="textoAlternativa" name="alternativa_D" required>{{ isset($questoes->alternativa_D) ? $questoes->alternativa_D : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="">Alternativa E</label>
                  <textarea id="alt-e" class="textoAlternativa" name="alternativa_E">{{ isset($questoes->alternativa_E) ? $questoes->alternativa_E : '' }}</textarea>
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="ano">Ano</label>
                    <input type="number" id="ano" name="ano" min="2000" value="{{ isset($questoes->ano) ? $questoes->ano : '2024' }}">
                </div>

                <div class="addAltQuestao">
                <div id="alternativa" class="select"> <!--Select para alternativa-->
                    <div class="selected">
                      <script>
                        function changeAlternativa(alternativa){
                          document.getElementById("text-selected-alternativa").textContent = alternativa;
                        }
                      </script>
                      <span id="text-selected-alternativa">Alternativa</span>
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
                    </div>
                    <div id="primeiro" class="options">
                      <div>
                        <input id="alt-a" name="alt-a" type="radio" checked="" onclick="changeAlternativa('A')"/>
                        <label class="option" for="alt-a" data-txt="A"></label>
                      </div>

                      <div>
                        <input id="alt-b" name="alt-b" type="radio" onclick="changeAlternativa('B')"/>
                        <label class="option" for="alt-b" data-txt="B"></label>
                      </div>

                      <div>
                        <input id="alt-c" name="alt-c" type="radio" onclick="changeAlternativa('C')"/>
                        <label class="option" for="alt-c" data-txt="C"></label>
                      </div>

                      <div>
                        <input id="alt-d" name="alt-d" type="radio" onclick="changeAlternativa('D')"/>
                        <label class="option" for="alt-d" data-txt="D"></label>
                      </div>
                      
                      <div>
                        <input id="alt-e" name="alt-e" type="radio" onclick="changeAlternativa('E')"/>
                        <label class="option" for="alt-e" data-txt="E"></label>
                      </div>
                    </div><!--options-->
                  </div><!--Select para alternativa-->  

                  
                  
                  <div  id="categoria" class="select"> <!--Select para categoria-->
                    <div class="selected">
                      <script>
                        function changeCategoria(categoria){
                          document.getElementById("text-selected-categoria").textContent = categoria;
                        }
                      </script>
                      <span id="text-selected-categoria">Categoria</span>
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
                    </div>
                    <div class="options">
                      <div>
                        <input id="cat-1" name="cat-1" type="radio" checked="" onclick="changeCategoria('Gramática')"/>
                        <label class="option" for="cat-1" data-txt="Gramática"></label>
                      </div>

                      <div>
                        <input id="cat-2" name="cat-2" type="radio" onclick="changeCategoria('Literatura')"/>
                        <label class="option" for="cat-2" data-txt="Literatura"></label>
                      </div>

                      <div>
                        <input id="cat-3" name="cat-3" type="radio" onclick="changeCategoria('Interpretação de texto')"/>
                        <label class="option" for="cat-3" data-txt="Interpretação de texto"></label>
                      </div>

                    </div><!--options-->
                  </div><!--Select para categoria-->

                 

                  <div id="assunto" class="select"> <!--Select para assunto-->
                    <div class="selected">
                      <script>
                        function changeAssunto(assunto){
                          document.getElementById("text-selected-assunto").textContent = assunto;
                        }
                      </script>
                      <span id="text-selected-assunto">Assunto</span>
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
                    </div>
                    <div class="options">
                      <div>
                        <input id="assunto-1" name="assunto-1" type="radio" checked="" onclick="changeAssunto('Assunto 1')"/>
                        <label class="option" for="assunto-1" data-txt="Assunto 1"></label>
                      </div>

                      <div>
                        <input id="assunto-2" name="assunto-2" type="radio" onclick="changeAssunto('Assunto 2')"/>
                        <label class="option" for="assunto-2" data-txt="Assunto 2"></label>
                      </div>

                      <div>
                        <input id="assunto-3" name="assunto-3" type="radio" onclick="changeAssunto('Assunto 3')"/>
                        <label class="option" for="assunto-3" data-txt="Assunto 3"></label>
                      </div>

                      <div>
                        <input id="assunto-4" name="assunto-4" type="radio" onclick="changeAlternativa('Assunto 4')"/>
                        <label class="option" for="assunto-4" data-txt="Assunto 4"></label>
                      </div>
                      
                      <div>
                        <input id="assunto-5" name="assunto-5" type="radio" onclick="changeAlternativa('Assunto 5')"/>
                        <label class="option" for="assunto-5" data-txt="Assunto 5"></label>
                      </div>
                    </div><!--options-->
                  </div><!--Select para assunto-->

                  <div class="mensagem">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    Preencha todos os campos antes de avançar 
                </div>

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
@endsection