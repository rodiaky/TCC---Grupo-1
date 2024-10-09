@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Editar repertório</title>
@endsection

@section('conteudo')
    <main>
        <!-- TEM QUE ARRUMAR -->
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Repertório</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
    <article>
        <div class="form-value">
            <form action="{{ route('admin.repertorios.atualizar', $repertorios->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="categoria" value="Repertório">
                <input type="hidden" name="url" id="url" value="{{ $url }}">
                
                <div class="inputbox">
                    <label for="">Título do repertório</label>
                    <input type="text" name="nome" value="{{ isset($repertorios->nome) ? $repertorios->nome : '' }}" required>
                </div>
                
                <div class="inputbox">
                    <label for="">Conteúdo</label>
                    <textarea class="content" name="descricao" required>{{ old('descricao', $repertorios->descricao) }}</textarea>
                </div>

                <label class="lbl-upload">Upload de imagem</label>
                    <div class="upload">
                        <input type="file" class="imagem" name="imagem" id="imagem">
                    </div>
              

                <div class="addAltRep">
                    <!-- Select Tema -->
                    <div class="select"> 
                        <div class="selected">
                            <script>
                                function changeTheme(theme, id) {
                                    document.getElementById("text-selected-theme").textContent = theme;
                                    document.getElementById("selected-theme").value = theme; // Atualiza o valor do input hidden
                                    document.getElementById("id_pasta").value = id; // Atualiza o valor do input hidden para o ID
                                }
                            </script>
                            <span id="text-selected-theme">{{$repertorios->nome_pasta}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        
                        <div class="options">
                            @foreach($temasRepertorios as $id => $nome)
                                <div>
                                    <input id="tema-{{ $id }}" name="tema" type="radio" onclick="changeTheme('{{ $nome }}', '{{ $id }}')" />
                                    <label class="option" for="tema-{{ $id }}" >{{ $nome }}</label>
                                </div>
                            @endforeach
                        </div><!--options-->
                        
                        <input type="hidden" id="selected-theme" name="selected-theme" value="" />
                        <input type="hidden" id="id_pasta" name="id_pasta" value="{{$repertorios->id_pasta}}" /> <!-- Hidden input for ID -->
                    </div><!--Select Tema-->

                    <!-- Select Categoria -->
                    <div class="select"> 
                        <div class="selected">
                            <script>
                                function changeCategory(categoria) {
                                    document.getElementById("text-selected-categoria").textContent = categoria;
                                    document.getElementById("classificacao").value = categoria; // Atualiza o valor do input hidden
                                }
                            </script>
                            <span id="text-selected-categoria">{{$repertorios->classificacao}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="arrow">
                                <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"></path>
                            </svg>
                        </div>
                        
                        <div class="options">
                            <div>
                                <input id="categoria-1" name="classificacao" type="radio" checked onclick="changeCategory('Artes')"/>
                                <label class="option" for="categoria-1" data-txt="Artes"></label>
                            </div>
                            <div>
                                <input id="categoria-2" name="classificacao" type="radio" onclick="changeCategory('Atualidades')"/>
                                <label class="option" for="categoria-2" data-txt="Atualidades"></label>
                            </div>
                            <div>
                                <input id="categoria-3" name="classificacao" type="radio" onclick="changeCategory('Cinema')"/>
                                <label class="option" for="categoria-3" data-txt="Cinema"></label>
                            </div>
                            <div>
                                <input id="categoria-4" name="classificacao" type="radio" onclick="changeCategory('Estatística')"/>
                                <label class="option" for="categoria-4" data-txt="Estatística"></label>
                            </div>
                            <div>
                                <input id="categoria-5" name="classificacao" type="radio" onclick="changeCategory('Filosofia')"/>
                                <label class="option" for="categoria-5" data-txt="Filosofia"></label>
                            </div>
                            <div>
                                <input id="categoria-6" name="classificacao" type="radio" onclick="changeCategory('História')"/>
                                <label class="option" for="categoria-6" data-txt="História"></label>
                            </div>
                            <div>
                                <input id="categoria-7" name="classificacao" type="radio" onclick="changeCategory('Obra Literária')"/>
                                <label class="option" for="categoria-7" data-txt="Obra literária"></label>
                            </div>
                            <div>
                                <input id="categoria-8" name="classificacao" type="radio" onclick="changeCategory('Sociologia')"/>
                                <label class="option" for="categoria-8" data-txt="Sociologia"></label>
                            </div>
                            <div>
                                <input id="categoria-9" name="classificacao" type="radio" onclick="changeCategory('Textos Legais')"/>
                                <label class="option" for="categoria-9" data-txt="Textos legais"></label>
                            </div>
                        </div><!--options-->

                        <input type="hidden" id="classificacao" name="classificacao" value="{{$repertorios->classificacao}}" />
                        <input type="hidden" id="categoria" name="categoria" value="Repertório" />
                    </div><!--Select Categoria-->
                </div><!--addAltRep-->
                
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

