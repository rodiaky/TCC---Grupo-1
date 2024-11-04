@extends('layouts._partials._cabecalho')

@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <title>Alterar Senha</title>
@endsection

@section('conteudo')
    <main>
        <div class="container-titulo-seta">
           <div class="container-seta">
                <a href="{{ url()->previous() }}" class="seta-back">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
            <h1 class="titulo-pagina">Alterar Senha</h1>
        </div>
        <hr class="titulo-linha">

        <article>
            <div class="form-value">
                <form action="{{ route('admin.alterar_senha.update') }}" method="POST">
                    @csrf

                    <div class="inputbox">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ $email }}" required readonly>
                    </div>
                    <div class="inputbox">
                        <label for="novaSenha">Nova Senha</label>
                        <input type="password" id="novaSenha" name="novaSenha" required>
                    </div>
                    <div class="inputbox">
                        <label for="novaSenha_confirmation">Confirmar Senha</label>
                        <input type="password" id="novaSenha_confirmation" name="novaSenha_confirmation" required>
                        <input type="hidden" name="url" id="url" value="{{$url}}">
                    </div>

                    <!-- Mensagem de Sucesso -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Mensagem de Erro -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Mensagens de Validação -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="botoes">
                        <button type="reset" id="limpar" class="button">Limpar</button>
                        <button type="submit" class="button">Salvar</button>
                    </div>
                </form>
            </div>
        </article>
    </main>
@endsection
