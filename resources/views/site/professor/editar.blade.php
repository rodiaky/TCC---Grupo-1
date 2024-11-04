@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Arquivo.css') }}">
    <title>Editar Aluno</title>
@endsection

@section('conteudo')

    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Editar Professor</h1>
        </div>
        <hr class="titulo-linha">
    </main>
    
        <article>
            <div class="form-value">
            <form action="{{ route('admin.professor.atualizar', $professor->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                    <div class="inputbox">
                        <label for="">Nome do Aluno</label>
                        <input type="text" name="name" value="{{ isset($professor->name) ? $professor->name : '' }}" required>
                    </div>
                    <div class="inputbox">
                        <label for="">E-mail</label>
                        <input type="email" name="email" value="{{ isset($professor->email) ? $professor->email : '' }}" required>   
                    </div>

                        <!-- Input hidden para o ID da turma selecionada -->
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                    <br>
                    <label class="lbl-upload">Upload de imagem</label>
                    <div class="upload">
                        <input type="file" class="arquivo" id="arquivo" name="arquivo">
                        <input type="hidden" name="id_aluno" value="{{$professor->id}}">
                        <input type="hidden" name="foto" value="{{$professor->foto}}">
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                    </div>

                      <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Selecione uma opção antes de avançar
                    </div>
                    
                    <div class="botoes">
                        <button type="reset" name="limpar" id="limpar" class="button">Limpar</button>
                        <button type="submit" name="salvar" class="button">Salvar</button>
                    </div>
                </form>
            </div><!--form-value-->
            
        </article>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection