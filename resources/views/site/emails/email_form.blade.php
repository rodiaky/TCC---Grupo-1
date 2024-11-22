<!-- email_form.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar E-mail</title>
</head>
<body>
    <h1>Envie um e-mail para o usuário</h1>
    
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

    <!-- Formulário de envio de e-mail -->
    <form action="{{ route('send.email') }}" method="POST">
        @csrf
        <label for="email">E-mail do Usuário:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Enviar E-mail</button>
    </form>
</body>
</html>
