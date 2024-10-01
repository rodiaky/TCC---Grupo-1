@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/styleGeralTabela.css">
    <link rel="stylesheet" type="text/css" href="/css/barraDePesquisa.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Crud Criterios</title>
@endsection

@section('conteudo')


    <main>

        <h1 class="titulo-pagina">Criterios</h1>
        <hr class="titulo-linha">

 
        <button class="botao"> <!-- ajustar o CSS  -->
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.criterios.adicionar') }}" class="botao-texto">Adicionar Critério</a>
            </div>
        </button>
 

        <section class="section-barra-de-pesquisa">
            <label class="pesquisa" for="barra-pesquisa">
                <input type="text" id="barra-pesquisa" name="barra-pesquisa" placeholder="Digite o nome do aluno." aria-label="Pesquisar aluno">
                <button type="submit" id="pesquisar" name="pesquisar" value="">
                    <i class="material-icons lupa-pesquisa">search</i>
                </button>
            </label>
        </section>
        
        @if($criterios->isNotEmpty())
            <section class="tabela">
                <div class="overflow">
                    <table id="tabela">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nota máxima</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Banca</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                        @foreach ($criterios as $criterio)
                            <tr>
                                <td class="alunos">{{ $criterio->nome }}</td>
                                <td class="alunos">{{ $criterio->nota_maxima_criterio }}</td>
                                <td class="alunos">{{ $criterio->descricao }}</td>
                                <td class="alunos">{{ $criterio->banca_nome }}</td>
                                <td class="editar">
                                    <a href="{{ route('admin.criterios.editar', $criterio->id) }}">
                                        <i class="material-icons icone-tabela">edit</i>
                                    </a>
                                </td>
                                <td class="excluir">
                                    <a href="{{ route('admin.criterios.excluir', $criterio->id) }}">
                                            <i class="material-icons icone-tabela">close</i>
                                        </a>
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
@endsection
