@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <title>Adicionar Questão</title>
@endsection

@section('conteudo')
    <main>
        <h1>Adicionar Questão</h1><hr>
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
                  <label for="txt-A">Alternativa A</label>
                  <textarea id="txt-A" class="textoAlternativa" name="alternativa_A" required>{{ isset($questoes->alternativa_A) ? $questoes->alternativa_A : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="txt-B">Alternativa B</label>
                  <textarea id="txt-B" class="textoAlternativa" name="alternativa_B" required>{{ isset($questoes->alternativa_B) ? $questoes->alternativa_B : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="txt-C">Alternativa C</label>
                  <textarea id="txt-C" class="textoAlternativa" name="alternativa_C" required>{{ isset($questoes->alternativa_C) ? $questoes->alternativa_C : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="txt-D">Alternativa D</label>
                  <textarea id="txt-D" class="textoAlternativa" name="alternativa_D" required>{{ isset($questoes->alternativa_D) ? $questoes->alternativa_D : '' }}</textarea>
                </div>
                <div class="inputbox">
                  <label for="txt-E">Alternativa E</label>
                  <textarea id="txt-E" class="textoAlternativa" name="alternativa_E">{{ isset($questoes->alternativa_E) ? $questoes->alternativa_E : '' }}</textarea>
                </div>

                <div id="inputboxAno" class="inputbox">
                    <label for="ano">Ano</label>
                    <input type="number" id="ano" name="ano" min="2000" value="{{ isset($questoes->ano) ? $questoes->ano : '2024' }}">
                </div>

                <div class="inputbox">
                    <label for="">Assunto</label>
                    <input type="text" name="assunto" value="{{ isset($questoes->assunto) ? $questoes->assunto : '' }}" required>
                </div>

                <div class="addAltQuestao">
                <!-- Script para alterar a alternativa selecionada -->
                <script>
                    function changeAlternativa(alternativa) {
                        document.getElementById("text-selected-alternativa").textContent = alternativa;
                        document.getElementById("resposta").value = alternativa;
                    }

                    function changeCategoria(categoria) {
                        document.getElementById("text-selected-categoria").textContent = categoria;
                        document.getElementById("disciplina").value = categoria;
                    }
                </script>

                <!-- Select para Alternativa -->
                <div id="alternativa" class="select">
                    <div class="selected">
                        <span id="text-selected-alternativa">Alternativa</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                        </svg>
                    </div>
                    <div id="primeiro" class="options">
                        <div>
                            <input id="alt-a" name="alternativa" type="radio" onclick="changeAlternativa('A')" />
                            <label class="option" for="alt-a" data-txt="A"></label>
                        </div>

                        <div>
                            <input id="alt-b" name="alternativa" type="radio" onclick="changeAlternativa('B')" />
                            <label class="option" for="alt-b" data-txt="B"></label>
                        </div>

                        <div>
                            <input id="alt-c" name="alternativa" type="radio" onclick="changeAlternativa('C')" />
                            <label class="option" for="alt-c" data-txt="C"></label>
                        </div>

                        <div>
                            <input id="alt-d" name="alternativa" type="radio" onclick="changeAlternativa('D')" />
                            <label class="option" for="alt-d" data-txt="D"></label>
                        </div>

                        <div>
                            <input id="alt-e" name="alternativa" type="radio" onclick="changeAlternativa('E')" />
                            <label class="option" for="alt-e" data-txt="E"></label>
                        </div>
                    </div>
                </div>

                <!-- Campo oculto para armazenar a alternativa selecionada (agora como resposta) -->
                <input type="hidden" name="resposta" id="resposta" value="{{ isset($questoes->resposta) ? $questoes->resposta : '' }}">

                <!-- Select para Categoria/Disciplina -->
                <div id="categoria" class="select">
                    <div class="selected">
                        <span id="text-selected-categoria">Categoria</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                        </svg>
                    </div>
                    <div class="options">
                        <div>
                            <input id="cat-1" name="disciplina" type="radio" onclick="changeCategoria('Gramática')" />
                            <label class="option" for="cat-1" data-txt="Gramática"></label>
                        </div>

                        <div>
                            <input id="cat-2" name="disciplina" type="radio" onclick="changeCategoria('Literatura')" />
                            <label class="option" for="cat-2" data-txt="Literatura"></label>
                        </div>

                        <div>
                            <input id="cat-3" name="disciplina" type="radio" onclick="changeCategoria('Interpretação de Texto')" />
                            <label class="option" for="cat-3" data-txt="Interpretação de Texto"></label>
                        </div>
                    </div>
                </div>

                <!-- Campo oculto para armazenar a disciplina selecionada -->
                <input type="hidden" name="disciplina" id="disciplina" value="{{ isset($questoes->disciplina) ? $questoes->disciplina : '' }}">


                  <div class="select"> <!--Select para banca-->
                        <div class="selected">
                            <script>
                                function changeBanca(banca, id) {
                                    document.getElementById("text-selected-banca").textContent = banca;
                                    document.getElementById("id_banca").value = id;
                                }
                            </script>
                            <span id="text-selected-banca">Banca</span>
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
                            @foreach($bancas as $id => $nome)
                                <div>
                                    <input id="banca-{{ $id }}" name="banca" type="radio" value="{{ $id }}" onclick="changeBanca('{{ $nome }}', '{{ $id }}')" {{ (isset($temas->id_banca) && $temas->id_banca == $id) ? 'checked' : '' }}/>
                                    <label class="option" for="banca-{{ $id }}" data-txt="{{ $nome }}"></label>
                                </div>
                            @endforeach
                            <input type="hidden" name="id_banca" id="id_banca" value="{{ isset($questoes->id_banca) ? $questoes->id_banca : '' }}">
                        </div><!--options-->
                    </div><!--Select para banca--> 

                 

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