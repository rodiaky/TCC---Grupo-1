<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/loginUI.css">
    <link rel="stylesheet" type="text/css" href="css/loginLayout.css">
    <link rel="stylesheet" type="text/css" href="css/loginLayoutCelular.css">
    <link rel="stylesheet" type="text/css" href="css/loginLayoutTablet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Login</title>
</head>
<body>
    <section>
        <div class="form-box">

            <div class="container-seta">
                <a href="{{ route('welcome') }}" class="seta-back">
                    <i class="material-symbols-outlined">arrow_back</i>
                </a>
            </div>

            <div class="form-value">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <h2 class="login">Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input name="usuario" value="{{ old('usuario') }}" type="text">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input name="senha" value="{{ old('senha') }}" type="password">
                        <label for="">Senha</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Lembrar-me</label>
                        <a href="#">Esqueci a senha</a>
                    </div>
                    <button type="submit">Acessar a plataforma</button>
                </form>
            </div>
            <div class="mensagem">
            <div id="msg-centro" class="mensagem">
    @if(isset($erro) && $erro != '')
        <ion-icon name="alert-circle-outline"></ion-icon>
        {{ $erro }}
    @endif
    @if ($errors->any())
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

            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
</body>
</html>
