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

        
        @if (!empty($perfil->foto)) 
            <div class="container-img"><img src="{{ asset('assets/fotoPerfil/'.$perfil->foto) }}" alt=""></div>
        @endif
            
            <div class="info-pessoal">

                <div class="subtitulo"><h1>Informações Pessoais</h1>
                    <a href="{{ route($aluno ? 'admin.alunos.editar' : 'admin.professor.editar', ['id' => $idUser]) }}">
                        <i class="icon-perfil fa-solid fa-pen"></i>
                    </a>
                </div>
                <h2 class="info">Nome</h1>
                <div class="info-dado">{{$perfil->name}}</div>
                <h2 class="info">E-mail</h1>
                <div class="info-dado">{{$perfil->email}}</div>

                @if ($aluno)
                <div class="subtitulo"><h1>Informações de Turma</h1></div>
                <h2 class="info">Turma</h2>
                <div class="info-dado">{{$perfil->nome_turma}}</div>
                @endif

                <div class="subtitulo"><h1>Alterar Senha</h1><a href="{{ route('admin.alterar_senha') }}"> <i class="icon-perfil fa-solid fa-pen"></i></a></div>
            </div>

        </section>
    </main>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection