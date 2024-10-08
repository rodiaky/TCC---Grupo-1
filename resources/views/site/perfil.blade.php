@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/perfil.css') }}">
    <title>Meu Perfil</title>
@endsection

@section('conteudo')

    @php
    $aluno = $_SESSION['eh_admin'] === 'Aluno';
    @endphp

    <main>
        <h1 class="titulo-pagina">Meu Perfil</h1>
        <hr class="titulo-linha">

        <section class="container">

        

            <div class="container-img"><img src="{{ asset('assets/fotoPerfil/'.$perfil->foto) }}" alt=""></div>

            
            <div class="info-pessoal">

                <div class="subtitulo"><h1>Informações Pessoais</h1>@if ($aluno)<a href="{{ route('admin.alunos.editar', ['id' => $idUser]) }}"><i class="icon-perfil fa-solid fa-pen" ></i></a>@endif</div>
                <h2 class="info">Nome</h1>
                <div class="info-dado">{{$perfil->name}}</div>
                <h2 class="info">E-mail</h1>
                <div class="info-dado">{{$perfil->email}}</div>

                @if ($aluno)
                <div class="subtitulo"><h1>Informações de Turma</h1></div>
                <h2 class="info">Turma</h2>
                <div class="info-dado">{{$perfil->nome_turma}}</div>
                @endif

                <div class="subtitulo"><h1>Segurança</h1>@if ($aluno)<a href="{{ route('aluno.alterar_senha') }}"> <i class="icon-perfil fa-solid fa-pen"></i>@endif</a></div>
                <h2 class="info">Senha</h2>
                <div class="info-dado">{{$perfil->password}}</div>
            </div>

        </section>
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection