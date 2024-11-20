@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/addAltTurma.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <title>Adicionar Turma</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
@endsection

@section('conteudo')
<main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{route('admin.turmas')}}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Adicionar Turma</h1>
        </div>
        <hr class="titulo-linha">
    </main>
        <article>
            <div class="form-value">
                <form id="form-turma" action="{{ route('admin.turmas.salvar') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    {{-- Campo Nome da Turma --}}
                    <div class="inputbox">
                        <label for="nome">Nome da Turma</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" >
                    </div>

                    {{-- Seleção de Dia --}}
                    <div id="dia" class="select">
                        <div class="selected">
                            <span id="text-selected-day">{{ old('dias_aula', 'Dia') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach(['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira'] as $key => $day)
                                <div>
                                    <input id="day-{{ $key }}" name="dias_aula" type="radio" 
                                           value="{{ $day }}" 
                                           onclick="changeDay('{{ $day }}')" 
                                           {{ old('dias_aula', 'Segunda-feira') == $day ? 'checked' : '' }} />
                                    <label class="option" for="day-{{ $key }}">{{ $day }}</label>
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" id="dias_aula" name="dias_aula" value="{{ old('dias_aula', 'Segunda-feira') }}" />
                    </div>

                    {{-- Horário de Entrada --}}
                    <div class="inputbox">
                        <label for="horario-entrada-input">Horário de Entrada</label>
                        <input type="text" id="horario-entrada-input" name="horario_entrada" 
                               value="{{ old('horario_entrada') }}" 
                                placeholder="HH:MM" class="horario">
                    </div>

                    {{-- Horário de Saída --}}
                    <div class="inputbox">
                        <label for="horario-saida-input">Horário de Saída</label>
                        <input type="text" id="horario-saida-input" name="horario_saida" 
                               value="{{ old('horario_saida') }}" 
                                placeholder="HH:MM" class="horario">
                    </div>

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
        $(document).ready(function() {
            // Máscara de horário
            $('.horario').mask('00:00');

            // Botão Limpar
            $('#limpar').on('click', function(event) {
                event.preventDefault();

                // Limpa todos os campos
                $('#form-turma')[0].reset();

                // Reseta o texto do select
                $('#text-selected-day').text('Dia');
                $('#msg-centro').hide();
            });
        });

        // Atualiza o texto do select ao selecionar um dia
        function changeDay(day) {
            $('#text-selected-day').text(day);
            $('#dias_aula').val(day);
        }
    </script>
@endsection
