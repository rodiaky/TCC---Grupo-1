@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Editar Pagamento</title>
@endsection

@section('conteudo')

<!-- TEM QUE ARRUMAR -->
    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Pagamento</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
            <form action="{{ route('admin.pagamentos.atualizar', $pagamentos->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="inputbox">
                    <label for="">Valor</label>
                    <input type="text" name="valor" value="{{ isset($pagamentos->valor) ? $pagamentos->valor : '' }}" required>
                </div>

                <div class="inputbox">
                    <label for="">Ano</label>
                    <input type="text" name="ano" value="{{ isset($pagamentos->ano) ? $pagamentos->ano : '' }}" required>
                </div>
                
                

            
                    <!-- Select Categoria -->
                    <div class="select"> 
                        <div class="selected">
                            <script>
                                function changeCategory(mes) {
                                    document.getElementById("text-selected-mes").textContent = mes;
                                    document.getElementById("mes").value = mes; // Atualiza o valor do input hidden
                                }
                            </script>
                            <span id="text-selected-mes">{{$pagamentos->mes}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        
                        <div class="options">
                            <div>
                                <input id="mes-1" name="mes" type="radio" checked onclick="changeCategory('Janeiro')"/>
                                <label class="option" for="mes-1" data-txt="Janeiro"></label>
                            </div>
                            <div>
                                <input id="mes-2" name="mes" type="radio" onclick="changeCategory('Fevereiro')"/>
                                <label class="option" for="mes-2" data-txt="Fevereiro"></label>
                            </div>
                            <div>
                                <input id="mes-3" name="mes" type="radio" onclick="changeCategory('Março')"/>
                                <label class="option" for="mes-3" data-txt="Março"></label>
                            </div>
                            <div>
                                <input id="mes-4" name="mes" type="radio" onclick="changeCategory('Abril')"/>
                                <label class="option" for="mes-4" data-txt="Abril"></label>
                            </div>
                            <div>
                                <input id="mes-5" name="mes" type="radio" onclick="changeCategory('Maio')"/>
                                <label class="option" for="mes-5" data-txt="Maio"></label>
                            </div>
                            <div>
                                <input id="mes-6" name="mes" type="radio" onclick="changeCategory('Junho')"/>
                                <label class="option" for="mes-6" data-txt="Junho"></label>
                            </div>
                            <div>
                                <input id="mes-7" name="mes" type="radio" onclick="changeCategory('Julho')"/>
                                <label class="option" for="mes-7" data-txt="Julho"></label>
                            </div>
                            <div>
                                <input id="mes-8" name="mes" type="radio" onclick="changeCategory('Agosto')"/>
                                <label class="option" for="mes-8" data-txt="Agosto"></label>
                            </div>
                            <div>
                                <input id="mes-9" name="mes" type="radio" onclick="changeCategory('Setembro')"/>
                                <label class="option" for="mes-9" data-txt="Setembro"></label>
                            </div>
                            <div>
                                <input id="mes-10" name="mes" type="radio" onclick="changeCategory('Outubro')"/>
                                <label class="option" for="mes-10" data-txt="Outubro"></label>
                            </div>
                            <div>
                                <input id="mes-11" name="mes" type="radio" onclick="changeCategory('Novembro')"/>
                                <label class="option" for="mes-11" data-txt="Novembro"></label>
                            </div>
                            <div>
                                <input id="mes-12" name="mes" type="radio" onclick="changeCategory('Dezembro')"/>
                                <label class="option" for="mes-12" data-txt="Dezembro"></label>
                            </div>
                        </div><!--options-->

                        <input type="hidden" id="mes" name="mes" value="{{ isset($pagamentos->mes) ? $pagamentos->mes : '' }}" />
                    </div><!--Select Categoria-->

                    <br>


                    <div class="select"> 
                        <div class="selected">
                            <script>
                                function changeCategory(status) {
                                    document.getElementById("text-selected-status").textContent = status;
                                    document.getElementById("status").value = status; // Atualiza o valor do input hidden
                                }
                            </script>
                            <span id="text-selected-mes">{{$pagamentos->status_pagamento}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        
                        <div class="options">
                            <div>
                                <input id="status-1" name="status" type="radio" checked onclick="changeCategory('Pago')"/>
                                <label class="option" for="status-1" data-txt="Pago"></label>
                            </div>
                            <div>
                                <input id="status-2" name="status" type="radio" onclick="changeCategory('Não Pago')"/>
                                <label class="option" for="status-2" data-txt="Não Pago"></label>
                            </div>
                        </div><!--options-->

                        <input type="hidden" id="status" name="status" value="{{ isset($pagamentos->status_pagamento) ? $pagamentos->status_pagamento : '' }}" />
                        <input type="hidden" id="id_aluno" name="id_aluno" value="{{ isset($pagamentos->id_aluno) ? $pagamentos->id_aluno : '' }}" />
                    </div><!--Select Categoria-->
               
            

                <div class="mensagem">
                    <ion-icon name="alert-circle-outline"></ion-icon>
                    Preencha todos os campos antes de avançar
                </div>

                <div class="botoes">
                    <button type="reset" id="limpar" class="button">Limpar</button>
                    <button type="submit" class="button">Salvar</button>
                </div>
            </form>
        </div><!--form-value-->
    </article>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection
