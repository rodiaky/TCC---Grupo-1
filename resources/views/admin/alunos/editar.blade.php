@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="/css/formularioLayout.css">
    <link rel="stylesheet" type="text/css" href="/css/selecao.css">
    <title>Editar Aluno Particular</title>
@endsection

@section('conteudo')
    <main>
        <h1>Editar Aluno Particular</h1>
        <hr>
    </main>

    <article>
        <div class="form-value">
            <form action="{{ route('professor.admin.alunos.atualizar', $pessoa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="inputbox">
                    <label for="">Nome do Aluno</label>
                    <input type="text" name="name" value="{{ $pessoa->name }}" required>
                </div>

                <div class="select">
                    <label for="">Turma</label>
                    <select name="id_turma" required>
                        @foreach ($turmas as $id => $nome)
                            <option value="{{ $id }}" {{ $pessoa->id_turma == $id ? 'selected' : '' }}>{{ $nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mensagem">
    <ion-icon name="alert-circle-outline"></ion-icon>
    @if (session('success'))
        {{ session('success') }}
    @elseif (session('error'))
        {{ session('error') }}
    @endif
</div>

                
                <div class="botoes">
                    <button type="reset" class="button">Limpar</button>
                    <button type="submit" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
@endsection
