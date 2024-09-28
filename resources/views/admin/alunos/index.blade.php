@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeralTabela.css">
    <link rel="stylesheet" type="text/css" href="/css/barraDePesquisa.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Crud Alunos</title>
@endsection

@section('conteudo')
    <main>

        <h1 class="titulo-pagina">Alunos - {{$nome_turma -> nome_turma}}</h1>
        <hr class="titulo-linha">

        <section class="section-barra-de-pesquisa">

            <label class="pesquisa" for="barra-pesquisa">
                <input type="text" id="barra-pesquisa" name="barra-pesquisa" placeholder="Digite o nome do aluno.">
                <button type="submit" id="pesquisar" name="pesquisar" value="">
                    <i class="material-icons lupa-pesquisa">search</i>
                </button>
            </label>

        </section>
        
        <section class="tabela">

            <div class="overflow">
                <table id="tabela">
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>

                    @foreach ($pessoas as $pessoa)
                        <tr>
                            <td class="imagem">
                                <img src="{{ $pessoa->foto }}" alt="" class="imagem-tabela"> <!-- Acesse a foto do usuário -->
                            </td>
                            <td class="alunos">{{ $pessoa->name }}</td> <!-- Acesse o nome do usuário -->
                            <td class="editar">
                                <a href="{{ route('professor.admin.alunos.editar', $pessoa->id) }}"> <!-- Use a propriedade correta para o ID do aluno -->
                                    <i class="material-icons icone-tabela">edit</i>
                                </a>
                            </td>
                            <td class="excluir">
                                <form action="{{ route('professor.admin.alunos.excluir', $pessoa->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button-excluir">
                                        <i class="material-icons icone-tabela">close</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </section>

    </main>
@endsection
