@extends('app.layouts.basico')

@section('conteudo')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <title>Esqueci a senha</title>
</head>
<body>
    <main>
        <h1>Esqueci a senha</h1><hr>
    
        <article>
            <div class="form-value">
                <form action="">
                    <div class="inputbox">
                        <label for="">E-mail</label>
                        <input type="email" name="email">   
                    </div>
                      <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Selecione uma opção antes de avançar
                    </div>
                    
                    <div class="botoes">
                        <button type="sumbit" name="salvar" class="button">Salvar</button>
                    </div>
                </form>
            </div><!--form-value-->
            
        </article>
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection