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
    <title>Login</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action={{ route('login') }} method="post">
                @csrf
                    <h2 class="login">Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input name="usuario" value="{{ old('usuario') }}" type="text"> 
                        {{ $errors->has('usuario') ? $errors->first('usuario') : '' }}
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input name="senha" value="{{ old('senha') }}" type="password">
                        {{ $errors->has('senha') ? $errors->first('senha') : '' }}
                        <label for="">Senha</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Lembrar-me</label><a href="#">Esqueci a senha</a>
                    </div>
                    <button type="submit">Acessar a plataforma</button>
                </form>
            </div>
            <div class="mensagem">
                <ion-icon name="alert-circle-outline"></ion-icon>
                    {{ isset($erro) && $erro != '' ? $erro : '' }}
                </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>