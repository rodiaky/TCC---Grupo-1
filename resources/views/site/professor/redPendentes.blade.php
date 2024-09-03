<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/redacoesPendentes.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeralRetCinza.css">
    <title>Redações Pendentes</title>
</head>
<body>
    <main>
        <h1 class="titulo-pagina">Redações Pendentes</h1>
        <hr class="titulo-linha">

        <section class="conteudo">

            <div class="escrito">
                <p>Particulares / Turma</p>
            </div>

            @foreach ($redacoes as $redacao)
            <div class="branco" >
                <a href="{{url('/view', $redacao->id)}}">
                <p class="banca">{{ $redacao->banca_nome }} - {{ $redacao->frase_tematica }}</p>
                <hr>
                <div class="nomeHorario">
                    <p>{{ $redacao->nome }}</p>
                    <p>Entrada: {{ $redacao->horario_entrada }} - Saída: {{ $redacao->horario_saida }}</p>
                </div>
            </div>
            @endforeach       
        </section>
    </main>
</body>
</html>