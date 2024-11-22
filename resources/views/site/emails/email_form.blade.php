<!-- email_form.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selecao.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Enviar E-mail</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body>

    <main style="margin-top:1.7rem">
        <div class="container-titulo-seta">
            <div class="container-seta">
                <a href="{{route('admin.turmas')}}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Alteração de Senha</h1>
        </div>
        <hr class="titulo-linha">
    </main>

    <!-- Exibe mensagem de sucesso -->
    @if(session('success'))
        <div style="color: green; background-color: lightgreen; padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Exibe mensagem de erro -->
    @if(session('error'))
        <div style="color: red; background-color: lightcoral; padding: 10px;">
            {{ session('error') }}
        </div>
    @endif

    <article>
        <div class="form-value">
            <!-- Formulário de envio de e-mail -->
            <form action="{{ route('send.email') }}" method="POST">
                @csrf
                <div class="inputbox">
                <label for="email">E-mail do Usuário:</label>
                <input type="email" name="email" id="email" required>
                </div>
                <div class="botoes"><button class="button" type="submit">Enviar</button></div>
            </form>
        </div>
</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>

</html>