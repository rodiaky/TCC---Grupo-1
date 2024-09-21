@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="css/perfil.css">
    <title>Meu Perfil</title>
@endsection

@section('conteudo')

    <main>
        <h1 class="titulo-pagina">Meu Perfil</h1>
        <hr>

        <section class="container">

            <div class="container-img"><img src="https://s2-ge.glbimg.com/rmHLMIPB3IZ4oVDP13yaaV0Xfqo=/0x0:510x346/984x0/smart/filters:strip_icc()/i.s3.glbimg.com/v1/AUTH_bc8228b6673f488aa253bbcb03c80ec5/internal_photos/bs/2020/P/L/GH725aRLawHtZvCwGQRw/912-cristiano-ronaldo-real-madrid-champons-league-getty.jpg" alt=""></div>
            
            <div class="info-pessoal">

                <div class="subtitulo"><h1>Informações Pessoais</h1><i class="fa-solid fa-pen"></i></div>
                <h2 class="info">Nome</h1>
                <div class="info-dado">{{$perfil->name}}</div>
                <h2 class="info">E-mail</h1>
                <div class="info-dado">{{$perfil->email}}</div>

                <div class="subtitulo"><h1>Informações de Turma</h1><i class="fa-solid fa-pen"></i></div>
                <h2 class="info">Turma</h2>
                <div class="info-dado">{{$perfil->nome_turma}}</div>

                <div class="subtitulo"><h1>Segurança</h1><i class="fa-solid fa-pen"></i></div>
                <h2 class="info">Senha</h2>
                <div class="info-dado">r{{$perfil->password}}</div>
            </div>

        </section>
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection