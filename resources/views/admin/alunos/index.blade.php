@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeralTabela.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/barraDePesquisa.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao1.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Crud Alunos</title>
@endsection

@section('conteudo')


    <main>
    <div class="container-titulo-seta">
        <div class="container-seta">
              <a href="{{ route('admin.turmas') }}" class="seta-back">
                  <i class="material-icons">arrow_back</i>
              </a>
          </div>
          <h1 class="titulo-pagina">Alunos - {{ $nome_turma ? $nome_turma : 'Turma não encontrada' }}</h1>
      </div>
    <hr class="titulo-linha">

 
        <button type="button" class="botao"> <!-- ajustar o CSS  -->
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.alunos.adicionar') }}" class="botao-texto">Adicionar Aluno</a>
            </div>
        </button>
 

        
        
        @if($pessoas->isNotEmpty())
            <section class="tabela">
                <div class="overflow">
                    <table id="tabela">
                        <tr>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                        @foreach ($pessoas as $pessoa)
                            <tr>
                                <td class="imagem">
                                    <img src="{{ $pessoa->foto }}" alt="Foto de {{ $pessoa->name }}" class="imagem-tabela">
                                </td>
                                <td class="alunos"><a href="{{ route('admin.turmas.aluno', ['id' => $pessoa->id]) }}">{{ $pessoa->name }}</a></td>
                                <td class="alunos">{{ $pessoa->email }}</td>
                                <td class="editar">
                                    <a href="{{ route('admin.alunos.editar', $pessoa->id) }}">
                                        <i class="material-icons icone-tabela">edit</i>
                                    </a>
                                </td>
                                <td class="excluir">
                                    <form action="{{ route('professor.admin.alunos.excluir', $pessoa->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir {{ $pessoa->name }}?');">
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
        @else
            <section class="tabela">
                <p>Nenhum aluno cadastrado</p>
            </section>
        @endif

    </main>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
@endsection
