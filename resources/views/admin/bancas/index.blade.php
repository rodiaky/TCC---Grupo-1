@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeralTabela.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/barraDePesquisa.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/botao1.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Crud Bancas</title>
@endsection

@section('conteudo')


    <main>

        <h1 class="titulo-pagina">Bancas</h1>
        <hr class="titulo-linha">

 
        <button type="button" class="botao"> <!-- ajustar o CSS  -->
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="{{ route('admin.bancas.adicionar') }}" class="botao-texto">Adicionar Banca</a>
            </div>
        </button>
 

        <section class="section-barra-de-pesquisa">
            <label class="pesquisa" for="barra-pesquisa">
                <input type="text" id="barra-pesquisa" name="barra-pesquisa" placeholder="Digite a banca." aria-label="Pesquisar banca">
                <button type="submit" id="pesquisar" name="pesquisar" value="">
                    <i class="material-icons lupa-pesquisa">search</i>
                </button>
            </label>
        </section>
        
        @if($bancas->isNotEmpty())
            <section class="tabela">
                <div class="overflow">
                    <table id="tabela">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Nota máxima da banca</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                        @foreach ($bancas as $banca)
                            <tr>
                                <td class="semanaNome">{{ $banca->nome }}</td>
                                <td class="semanaDescricao">{{ $banca->nota_maxima_banca }}</td>
                                <td class="editar">
                                    <a href="{{ route('admin.bancas.editar', $banca->id) }}">
                                        <i class="material-icons icone-tabela">edit</i>
                                    </a>
                                </td>
                                <td class="excluir">
                                    <a href="{{ route('admin.bancas.excluir', $banca->id) }}">
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
                <p>Nenhuma banca cadastrado</p>
            </section>
        @endif

    </main>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>

    @endsection