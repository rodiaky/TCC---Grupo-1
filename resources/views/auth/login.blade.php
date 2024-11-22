<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginLayoutCelular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginLayoutTablet.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <link rel="shortcut icon" type="imagex/png" href="{{ asset('assets/img/iconePalavrear.ico') }}">
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
                        <input name="usuario" value="{{ old('usuario') }}" type="text" id="email">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input name="senha" value="{{ old('senha') }}" type="password" id="senha">
                        <label for="senha">Senha</label>
                    </div>
                    <div class="forget">
                        <a href="{{ route('send.email.form') }}">Esqueci a senha</a>
                    </div>
                    <button type="submit">Acessar a plataforma</button>
                </form>
            </div>

        </div>

        <div class="mensagem">
            @if(isset($erro) && $erro != '') 
                <div class="alerta">
                    <span class="material-icons">error_outline</span>
                    <p>{{ $erro }}</p>
                </div>
            @endif
            @if ($errors->any())
                
                @foreach ($errors->all() as $error)
                    <div class="alerta">
                        <span class="material-icons">error_outline</span>
                        <p>{{ $error }}</p>
                    </div>
                @endforeach
                
            @endif
        </div>

    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
</body>
</html>
