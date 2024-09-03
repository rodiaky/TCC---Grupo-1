@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="css/barraDePesquisa.css">
    <link rel="stylesheet" type="text/css" href="css/temaRedacoes.css">
    <link rel="stylesheet" type="text/css" href="css/botao1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Temas de Redações</title>
@endsection

@section('conteudo')
<main>
        <h1 class="titulo-pagina">Temas de Redações</h1>
        <hr class="titulo-linha">

        <section class="section-barra-de-pesquisa">

            <label class="pesquisa" for="barra-pesquisa">
                <input type="text" id="barra-pesquisa" name="barra-pesquisa" placeholder="Digite o repertório.">
                <button type="submit" id="pesquisar" name="pesquisar" value=""><i class="material-icons lupa-pesquisa">search</i></button>
            </label>

            <div class="selecionar">
                <label for="select" class="selecionar-retangulo">
                    Filtros 
                    <input type="checkbox" name="select" id="select">
                    <i class="material-icons">filter_list</i> 
                </label>
                <ul class="selecionar-op" id="selecionar-op">
                    <form action="">
                        <li><label for="mais-recentes"><input type="checkbox" name="filtro" id="mais-recentes">Mais Recentes</label></li>
                        <li><label for="mais-antigas"><input type="checkbox" name="filtro" id="mais-antigas">Mais Antigas</label></li>
                        <li><label for="enem"><input type="checkbox" name="filtro" id="enem">Enem</label></li>
                        <li><label for="fuvest"><input type="checkbox" name="filtro" id="fuvest">Fuvest</label></li>
                        <li><label for="vunesp"><input type="checkbox" name="filtro" id="vunesp">Vunesp</label></li>
                        <li><label for="unicamp"><input type="checkbox" name="filtro" id="unicamp">Unicamp</label></li>
                    </form>
                </ul>
            </div>

        </section>
        <!--Filtros-->
        <!--FALTA FILTRO!!!!-->

        <!-- BOTAO "+" NO CANTO INFERIOR ESQUERDO -->
        <button class="botao">
            <div class="botao-circulo"><i class="fa-solid fa-plus"></i></div>
            <div class="botao-expand">
                <a href="" class="botao-texto">Adicionar Tema</a>
            </div>
        </button>
     
        <section class="container-tema">

            <div class="tema-secao">
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                <div class="container-imagem"><img src="https://blog-static.petlove.com.br/wp-content/uploads/2018/05/westie.jpg" alt="" class="imagem-tema"></div>
                <div class="frase-tematica"><p>Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</p></div>
                <div class="banca-ano">Banca/Ano</div>
                <div class="spoiler"><p>Albertosaurus (sp., que significa "lagarto de Alberta" no Canadá), é um género de dinossauro carnívoro e bípede presente no fim do período Cretáceo. Media cerca de 8 a 9 metros de comprimento, 3 metros de altura e pesava menos de 2 toneladas. O Albertosaurus viveu na América do Norte e foi descoberto no ano de 1884 por Joseph Burr Tyrrell em Alberta, no Canadá, local ao qual deve seu nome.</p></div>
            </div>

            <div class="tema-secao">
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                <div class="container-imagem"><img src="https://blog-static.petlove.com.br/wp-content/uploads/2018/05/westie.jpg" alt="" class="imagem-tema"></div>
                <div class="frase-tematica"><p>Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</p></div>
                <div class="banca-ano">Banca/Ano</div>
                <div class="spoiler"><p>Albertosaurus (sp., que significa "lagarto de Alberta" no Canadá), é um género de dinossauro carnívoro e bípede presente no fim do período Cretáceo. Media cerca de 8 a 9 metros de comprimento, 3 metros de altura e pesava menos de 2 toneladas. O Albertosaurus viveu na América do Norte e foi descoberto no ano de 1884 por Joseph Burr Tyrrell em Alberta, no Canadá, local ao qual deve seu nome.</p></div>
            </div>

            <div class="tema-secao">
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                <div class="container-imagem"><img src="https://blog-static.petlove.com.br/wp-content/uploads/2018/05/westie.jpg" alt="" class="imagem-tema"></div>
                <div class="frase-tematica"><p>Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</p></div>
                <div class="banca-ano">Banca/Ano</div>
                <div class="spoiler"><p>Albertosaurus (sp., que significa "lagarto de Alberta" no Canadá), é um género de dinossauro carnívoro e bípede presente no fim do período Cretáceo. Media cerca de 8 a 9 metros de comprimento, 3 metros de altura e pesava menos de 2 toneladas. O Albertosaurus viveu na América do Norte e foi descoberto no ano de 1884 por Joseph Burr Tyrrell em Alberta, no Canadá, local ao qual deve seu nome.</p></div>
            </div>

            <div class="tema-secao">
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                <div class="container-imagem"><img src="https://blog-static.petlove.com.br/wp-content/uploads/2018/05/westie.jpg" alt="" class="imagem-tema"></div>
                <div class="frase-tematica"><p>Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</p></div>
                <div class="banca-ano">Banca/Ano</div>
                <div class="spoiler"><p>Albertosaurus (sp., que significa "lagarto de Alberta" no Canadá), é um género de dinossauro carnívoro e bípede presente no fim do período Cretáceo. Media cerca de 8 a 9 metros de comprimento, 3 metros de altura e pesava menos de 2 toneladas. O Albertosaurus viveu na América do Norte e foi descoberto no ano de 1884 por Joseph Burr Tyrrell em Alberta, no Canadá, local ao qual deve seu nome.</p></div>
            </div>

            <div class="tema-secao">
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                <div class="container-imagem"><img src="https://blog-static.petlove.com.br/wp-content/uploads/2018/05/westie.jpg" alt="" class="imagem-tema"></div>
                <div class="frase-tematica"><p>Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</p></div>
                <div class="banca-ano">Banca/Ano</div>
                <div class="spoiler"><p>Albertosaurus (sp., que significa "lagarto de Alberta" no Canadá), é um género de dinossauro carnívoro e bípede presente no fim do período Cretáceo. Media cerca de 8 a 9 metros de comprimento, 3 metros de altura e pesava menos de 2 toneladas. O Albertosaurus viveu na América do Norte e foi descoberto no ano de 1884 por Joseph Burr Tyrrell em Alberta, no Canadá, local ao qual deve seu nome.</p></div>
            </div>

            <div class="tema-secao">
                <button class="botao-editar">
                    <i class="material-icons">more_horizon</i>
                    <div class="editar-opcoes">
                        <a href="#" class="editar-opcoes-texto">Editar</a>
                        <hr>
                        <a href="#" class="editar-opcoes-texto">Excluir</a>
                    </div>
                </button>
                <div class="container-imagem"><img src="https://blog-static.petlove.com.br/wp-content/uploads/2018/05/westie.jpg" alt="" class="imagem-tema"></div>
                <div class="frase-tematica"><p>Desafios para o enfrentamento da invisibilidade do trabalho de cuidado realizado pela mulher no Brasil</p></div>
                <div class="banca-ano">Banca/Ano</div>
                <div class="spoiler"><p>Albertosaurus (sp., que significa "lagarto de Alberta" no Canadá), é um género de dinossauro carnívoro e bípede presente no fim do período Cretáceo. Media cerca de 8 a 9 metros de comprimento, 3 metros de altura e pesava menos de 2 toneladas. O Albertosaurus viveu na América do Norte e foi descoberto no ano de 1884 por Joseph Burr Tyrrell em Alberta, no Canadá, local ao qual deve seu nome.</p></div>
            </div>
        </section>

    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>
    <script src="js/temaRedacoes.js"></script>
@endsection