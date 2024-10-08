<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="css/formularioLayout.css">
    <title>Adicionar e Alterar Turma</title>
</head>
<body>
    <main>
        <h1>Adicionar/Alterar Turma</h1><hr>
    </main>

    <article>
        <div class="form-value">
            <form action="{{ route('site.turmas.salvar') }}" method="POST">
                @csrf
                <div class="addAltTurma">
                    <!-- Select para dia -->
                    <div id="dia" class="select">
                        <div class="selected">
                            <span id="text-selected-day" style="background-color: white;">Dia</span>
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
                                <input id="day-1" name="dia" type="radio" value="Segunda-feira" checked onclick="changeDay('Segunda-feira')"/>
                                <label class="option" for="day-1">Segunda-feira</label>
                            </div>
                            <div>
                                <input id="day-2" name="dia" type="radio" value="Terça-feira" onclick="changeDay('Terça-feira')"/>
                                <label class="option" for="day-2">Terça-feira</label>
                            </div>
                            <div>
                                <input id="day-3" name="dia" type="radio" value="Quarta-feira" onclick="changeDay('Quarta-feira')"/>
                                <label class="option" for="day-3">Quarta-feira</label>
                            </div>
                            <div>
                                <input id="day-4" name="dia" type="radio" value="Quinta-feira" onclick="changeDay('Quinta-feira')"/>
                                <label class="option" for="day-4">Quinta-feira</label>
                            </div>
                            <div>
                                <input id="day-5" name="dia" type="radio" value="Sexta-feira" onclick="changeDay('Sexta-feira')"/>
                                <label class="option" for="day-5">Sexta-feira</label>
                            </div>
                        </div><!--options-->
                    </div><!--Select para dia-->

                    <!-- Select para horário -->
                    <div id="horario" class="select">
                        <div class="selected">
                            <span id="text-selected-hour" style="background-color: white;">Horário</span>
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
                                <input id="hour-1" name="horario" type="radio" value="Horário 1" checked onclick="changeHour('Horário 1')"/>
                                <label class="option" for="hour-1">Horário 1</label>
                            </div>
                            <div>
                                <input id="hour-2" name="horario" type="radio" value="Horário 2" onclick="changeHour('Horário 2')"/>
                                <label class="option" for="hour-2">Horário 2</label>
                            </div>
                            <div>
                                <input id="hour-3" name="horario" type="radio" value="Horário 3" onclick="changeHour('Horário 3')"/>
                                <label class="option" for="hour-3">Horário 3</label>
                            </div>
                            <div>
                                <input id="hour-4" name="horario" type="radio" value="Horário 4" onclick="changeHour('Horário 4')"/>
                                <label class="option" for="hour-4">Horário 4</label>
                            </div>
                        </div><!--options-->
                    </div><!--Select para horário-->

                    <!-- Outros campos do formulário -->
                    <input type="text" name="nome" placeholder="Nome da Turma" required>
                    <textarea name="descricao" placeholder="Descrição"></textarea>

                </div><!--addAltTurma-->
                <div class="botoes">
                    <button type="button" type="reset" class="button">Limpar</button>
                    <button type="button" type="submit" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>
    <script>
        function changeDay(day) {
            document.getElementById("text-selected-day").textContent = day;
        }

        function changeHour(hour) {
            document.getElementById("text-selected-hour").textContent = hour;
        }
    </script>
</body>
</html>
