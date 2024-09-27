@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/addAltTurma.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <title>Adicionar e alterar turma</title>
@endsection

@section('conteudo')
    <main>
        <h1>Extends (Adicionar/alterar turma)</h1><hr>
    <article>
        <div class="form-value">
        <form class="" action="{{route('admin.turmas.salvar')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

              <div class="inputbox">
                <label for="">Nome da Turma</label>
                <input type="text" name="nome-turma" value="{{ isset($linha->nome) ? $linha->nome : ''}}" >
              </div>
              <br>
                <div class="addAltTurma">
                    <div id="dia" class="select">
                        <div class="selected">
                          <script>
                            function changeDay(day){
                              document.getElementById("text-selected-day").textContent = day;
                            }
                          </script>
                          <span id="text-selected-day">Dia</span>
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
                            <input id="day-1" name="day-1" type="radio" checked="" onClick="changeDay('Segunda-feira')"/>
                            <label class="option" for="day-1" data-txt="Segunda-feira"></label>
                          </div>

                          <div>
                            <input id="data-2" name="data-2" type="radio" onClick="changeDay('Terça-feira')"/>
                            <label class="option" for="data-2" data-txt="Terça-feira"></label>
                          </div>

                          <div>
                            <input id="data-3" name="data-3" type="radio" onClick="changeDay('Quarta-feira')"/>
                            <label class="option" for="data-3" data-txt="Quarta-feira"></label>
                          </div>

                          <div>
                            <input id="data-4" name="data-4" type="radio" onClick="changeDay('Quinta-feira')"/>
                            <label class="option" for="data-4" data-txt="Quinta-feira"></label>
                          </div>

                          <div>
                            <input id="data-5" name="data-5" type="radio" onClick="changeDay('Sexta-feira')"/>
                            <label class="option" for="data-5" data-txt="Sexta-feira"></label>
                          </div>
                        </div><!--options-->
                      </div><!--Select para dia-->
                     
                      <div id="horario" class="select"> <!--Select para horário-->
                        <div class="selected">
                          <script>
                            function changeHour(hour){
                              document.getElementById("text-selected-hour").textContent = hour;
                            }
                          </script>
                          <span id="text-selected-hour">Horário</span>
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
                            <input id="hour-1" name="hour-1" type="radio" checked="" onclick="changeHour('Horário 1')"/>
                            <label class="option" for="hour-1" data-txt="Horário 1"></label>
                          </div>

                          <div>
                            <input id="hour-2" name="hour-2" type="radio" onclick="changeHour('Horário 2')"/>
                            <label class="option" for="hour-2" data-txt="Horário 2"></label>
                          </div>

                          <div>
                            <input id="hour-3" name="hour-3" type="radio" onclick="changeHour('Horário 3')"/>
                            <label class="option" for="hour-3" data-txt="Horário 3"></label>
                          </div>

                          <div>
                            <input id="hour-4" name="hour-4" type="radio" onclick="changeHour('Horário 4')"/>
                            <label class="option" for="hour-4" data-txt="Horário 4"></label>
                          </div>
                        </div><!--options-->
                      </div><!--Select para horário-->
                </div><!--addAltTurma-->

                <div id="msg-centro" class="mensagem">
    @if($errors->any())
        <ul style="list-style-type: none; padding: 0; margin: 0;">
            @foreach ($errors->all() as $error)
                <li>
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    @endif
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