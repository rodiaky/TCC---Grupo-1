<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="/css/styleGeral.css">
    <link rel="stylesheet" type="text/css" href="/css/cabecalhoUI.css">
    <link rel="stylesheet" type="text/css" href="/css/cabecalhoLayout.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    @php
    $isAdmin = $_SESSION['eh_admin'] === 'Professor';
    @endphp

    @if ($isAdmin)
    <header>

        <div class="cabecalho">
            <!-- Botão de Abrir a sidebar -->
            <div class="menu"><i id="sidebar-abrir" class="material-icons">menu</i></div> <!--DIV menu-->

            <img class="logo" src="/img/logo.png" style="cursor: default"> 
            <div class="usuario"><i class="material-icons" href="#">account_circle</i></div> <!--DIV usuario-->
        </div>

            <nav id="sidebar" class="sidebar">

                <!-- Botão de Fechar a sidebar -->
                <i id="sidebar-fechar" class="material-icons">close</i>
    
                <div class="sidebar-conteudo">
    
                    <ul class="sidebar-lista">
    
                        <!-- Minha Conta -->
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-item-link">
                                <i class="material-icons">account_circle</i>
                                <span class="sidebar-link">Minha Conta</span>
                            </a>
                        </li>
    
                        <!-- Ínicio -->
                        <li class="sidebar-item">
                            <a href="{{ route('professor.home') }}" class="sidebar-item-link">
                                <i class="material-icons">home</i>
                                <span class="sidebar-link">Início</span>
                            </a>
                        </li>

                        <!-- Temas -->
                        <li class="sidebar-item">
                            <a href="{{ route('temaRedacoes') }}" class="sidebar-item-link">
                                <i class="material-icons">edit_square</i>
                                <span class="sidebar-link">Temas</span>
                            </a>
                        </li>

                        <!-- Reperórios -->
                        <li class="sidebar-item">
                            <a href="{{ route('repertorios') }}" class="sidebar-item-link">
                                <i class="material-icons">history_edu</i>
                                <span class="sidebar-link">Repertórios</span>
                            </a>
                        </li>
    
                        <!-- Materiais -->
                        <li class="sidebar-item">
                            <a href="{{ route('materiais') }}" class="sidebar-item-link">
                                <i class="material-icons">folder</i>
                                <span class="sidebar-link">Materiais</span>
                            </a>
                        </li>
                        
                        <!-- Banco de Questões -->
                        <li class="sidebar-item">
                            <a href="{{ route('admin.questoes') }}" class="sidebar-item-link">
                                <i class="material-icons">quiz</i>
                                <span class="sidebar-link">Banco de Questões</span>
                            </a>
                        </li>

                        <!-- Turmas -->
                        <li class="sidebar-item">
                            <a href="{{ route('professor.turmas') }}" class="sidebar-item-link">
                                <i class="material-icons">school</i>
                                <span class="sidebar-link">Turmas</span>
                            </a>
                        </li>
                    
                        <!-- Sair -->
                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class="sidebar-item-link">
                                <i class="material-icons">logout</i>
                                <span class="sidebar-link">Sair</span>
                            </a>
                        </li>
    
                    </ul>
                </div>
            </nav>
    </header>
    
    @else
    <header>

        <div class="cabecalho">
            <!-- Botão de Abrir a sidebar -->
            <div class="menu"><i id="sidebar-abrir" class="material-icons">menu</i></div> <!--DIV menu-->

            <img class="logo" src="/img/logo.png" style="cursor: default"> 
            <div class="usuario"><i class="material-icons" href="#">account_circle</i></div> <!--DIV usuario-->
        </div>

            <nav id="sidebar" class="sidebar">

                <!-- Botão de Fechar a sidebar -->
                <i id="sidebar-fechar" class="material-icons">close</i>
    
                <div class="sidebar-conteudo">
    
                    <ul class="sidebar-lista">
    
                        <!-- Minha Conta -->
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-item-link">
                                <i class="material-icons">account_circle</i>
                                <span class="sidebar-link">Minha Conta</span>
                            </a>
                        </li>
    
                        <!-- Ínicio -->
                        <li class="sidebar-item">
                            <a href="{{ route('aluno.home') }}" class="sidebar-item-link">
                                <i class="material-icons">home</i>
                                <span class="sidebar-link">Início</span>
                            </a>
                        </li>
                        <!-- Temas -->
                        <li class="sidebar-item">
                            <a href="{{ route('temaRedacoes') }}" class="sidebar-item-link">
                                <i class="material-icons">edit_square</i>
                                <span class="sidebar-link">Temas</span>
                            </a>
                        </li>
    
                        <!-- Materiais -->
                        <li class="sidebar-item">
                            <a href="{{ route('materiais') }}" class="sidebar-item-link">
                                <i class="material-icons">folder</i>
                                <span class="sidebar-link">Materiais</span>
                            </a>
                        </li>
    
                        <!-- Repertórios -->
                        <li class="sidebar-item">
                            <a href="{{ route('repertorios') }}" class="sidebar-item-link">
                                <i class="material-icons">history_edu</i>
                                <span class="sidebar-link">Repertórios</span>
                            </a>
                        </li>
                        
                        <!-- Banco de Questões -->
                        <li class="sidebar-item">
                            <a href="{{ route('admin.questoes') }}" class="sidebar-item-link">
                                <i class="material-icons">quiz</i>
                                <span class="sidebar-link">Banco de Questões</span>
                            </a>
                        </li>
    
                        <!-- Minhs Redações -->
                        <li class="sidebar-item">
                            <a href="{{ route('aluno.painel_redacoes') }}" class="sidebar-item-link">
                                <i class="material-icons">edit_document</i>
                                <span class="sidebar-link">Minhas Redações</span>
                            </a>
                        </li>
                    
                        <!-- Sair -->
                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class="sidebar-item-link">
                                <i class="material-icons">logout</i>
                                <span class="sidebar-link">Sair</span>
                            </a>
                        </li>
    
                    </ul>
                </div>
            </nav>
    </header>
   
@endif

    @yield('conteudo')
    <section id="sidebar-sombra" class="sidebar-sombra"></section>
    
    <script src="/js/cabecalho.js"></script>
</body>
</html>