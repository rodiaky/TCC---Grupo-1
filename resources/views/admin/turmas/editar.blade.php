@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/addAltTurma.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <title>Editar Turma</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endsection

@section('conteudo')
    <main>
        <h1>Editar Turma</h1><hr>
        <article>
            <div class="form-value">
            <form action="{{ route('admin.turmas.salvar') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="inputbox">
                        <label for="">Nome da Turma</label>
                        <input type="text" name="nome" value="{{ isset($turmas->nome) ? $turmas->nome : '' }}" required>
                    </div>
                  
                   
            <div id="dia" class="select">
              <div class="selected">
                  <script>
                      function changeDay(day) {
                          document.getElementById("text-selected-day").textContent = day;
                          document.getElementById("dias_aula").value = day; // Atualiza o input hidden
                      }
                  </script>
                  <span id="text-selected-day">{{ isset($turmas->dias_aula) ? $turmas->dias_aula : '' }}</span>
                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                      <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                  </svg>
              </div>
              <div class="options">
                  <div>
                      <input id="day-1" name="dias_aula" type="radio" checked="" onClick="changeDay('Segunda-feira')"/>
                      <label class="option" for="day-1" data-txt="Segunda-feira"></label>
                  </div>
                  <div>
                      <input id="data-2" name="dias_aula" type="radio" onClick="changeDay('Terça-feira')"/>
                      <label class="option" for="data-2" data-txt="Terça-feira"></label>
                  </div>
                  <div>
                      <input id="data-3" name="dias_aula" type="radio" onClick="changeDay('Quarta-feira')"/>
                      <label class="option" for="data-3" data-txt="Quarta-feira"></label>
                  </div>
                  <div>
                      <input id="data-4" name="dias_aula" type="radio" onClick="changeDay('Quinta-feira')"/>
                      <label class="option" for="data-4" data-txt="Quinta-feira"></label>
                  </div>
                  <div>
                      <input id="data-5" name="dias_aula" type="radio" onClick="changeDay('Sexta-feira')"/>
                      <label class="option" for="data-5" data-txt="Sexta-feira"></label>
                  </div>
              </div>

              <!-- Input hidden para o dia selecionado -->
              <input type="hidden" id="dias_aula" name="dias_aula" value="Segunda-feira" />
          </div><!--Select para dia-->
                        
                        
                   
                    <br>
                    <div class="inputbox">
                        <label for="horario-entrada-input">Horário de Entrada</label>
                        <input type="text" id="horario-entrada-input" name="horario_entrada" value="{{ isset($turmas->horario_entrada) ? $turmas->horario_entrada : '' }}" required placeholder="HH:MM" class="horario">
                    </div>

                    <div class="inputbox">
                        <label for="horario-saida-input">Horário de Saída</label>
                        <input type="text" id="horario-saida-input" name="horario_saida" value="{{ isset($turmas->horario_saida) ? $turmas->horario_saida : '' }}" required placeholder="HH:MM" class="horario">
                    </div>

                    <script>
                        $(document).ready(function(){
                            $('#horario-entrada-input').mask('00:00');
                            $('#horario-saida-input').mask('00:00');
                        });
                    </script>

                    <div id="msg-centro" class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos antes de avançar
                    </div>

                    <div class="botoes">
                        <button name="limpar" id="limpar" class="button">Limpar</button>
                        <button name="salvar" class="button">Salvar</button>
                    </div>
                </form>
            </div>
        </article>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection