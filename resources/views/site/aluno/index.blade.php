@extends('app.layouts.basico')

@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listagem de pessoas</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('aluno.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pessoas as $pessoa)
                            <tr>
                                <td>{{ $pessoa->nome }}</td>
                                <td>{{ $pessoa->email }}</td>
                                <td>{{ $pessoa->senha }}</td>
                                <td><a href="{{ route('aluno.show', ['aluno' => $pessoa->id ]) }}">Visualizar</a></td>
                                <td>
                                    <form id="form_{{ $pessoa->id }}" method="post" action="{{ route('aluno.destroy', ['aluno' => $pessoa->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                        <a href="#" onclick="document.getElementById('form_{{ $pessoa->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('aluno.edit', ['aluno' =>$pessoa->id ]) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $pessoas->appends($request)->links() }}

                <!--
                <br>
                {{ $pessoas->count() }} - Total de registros por página
                <br>
                {{ $pessoas->total() }} - Total de registros da consulta
                <br>
                {{ $pessoas->firstItem() }} - Número do primeiro registro da página
                <br>
                {{ $pessoas->lastItem() }} - Número do último registro da página

                -->
                <br>
                Exibindo {{ $pessoas->count() }} alunos de {{ $pessoas->total() }} (de {{ $pessoas->firstItem() }} a {{ $pessoas    ->lastItem() }})
            </div>
        </div>

    </div>

@endsection
