<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alteração de Senha Palavrear!</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #F9F9F9; margin: 0; color: #333;">

    <div class="container" style="padding: 20px">

        <h1 class="titulo" style="font-size: 1.2rem; font-weight: 700; color: #F46F20; margin-bottom: 1rem;">Sistema de
            Alteração de Senha Palavrear!</h1>

        <h1 class="ola" style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; color:#000000; margin:0">Olá!
        </h1>
        <p style="font-size: 1rem; color:#000000; margin:0">Bem-vindo ao nosso sistema de alteração de senhas. Estamos
            felizes em ter você conosco!</p>
        <p style="font-size: 1rem; color:#000000; margin:0">Aqui está a sua senha temporária para acessar o sistema:</p>
        <p style="font-size: .7rem; color:#000000; margin-top:.2rem">Se precisar de mais ajuda, entre em contato com nossa equipe
            de suporte.</p>
        <div class="senha"
            style="background-color: #F46F20; padding: .4rem .8rem; border-radius: .8rem; color: #FFF; font-size: 1.2rem; text-align: center; font-weight: 700; margin: 1rem auto; width:fit-content; height:fit-content">
            <b>{{ $senha }}</b>
        </div>

    </div>

</body>

</html>