<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/visualizarTema.css">
    <link rel="stylesheet" type="text/css" href="/css/Arquivo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Visualização de Repertório</title>
</head>
@php
$isAdmin = $_SESSION['eh_admin'] === 'Professor';
@endphp
<body>

    <main>

        <section class="container-tema">

            <div class="grid-layout">

                <div class="container-seta">
                    <i class="material-icons seta-back"> arrow_back</i>
                </div>
                @if ($isAdmin)
                <div class="container-botao">
                    <button class="botao-editar">
                        <i class="material-icons">more_horizon</i>
                        <div class="editar-opcoes">
                            <a href="" class="editar-opcoes-texto">Editar</a>
                            <hr>
                            <a href="#" class="editar-opcoes-texto">Excluir</a>
                        </div>
                    </button>
                </div>
                @endif

                <div class="container-imagem"><img src="{{$tema->imagem}}" alt="" class="imagem-tema"></div> 
                <h1 class="titulo-tema">{{$tema->frase_tematica}}</h1>
                <div class="banca-tema">{{$tema->banca_nome}}</div>
            </div>
            
            <div class="container-texto">
                <p>{{$tema->texto_apoio}}</p>
            </div>

            <form action="{{ route('admin.temas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="upload">
                <input type="file" class="arquivo" name="redacao_enviada" required>
                <input type="hidden" name="id_tema" value="{{$tema->id}}">
            </div>
            

            <br>
            <br>
            <button type="submit" name="salvar" id="salvar" href="{{ route('admin.temas.store') }}">Salvar</button>

            </form>
        </section>

    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
</body>
</html>