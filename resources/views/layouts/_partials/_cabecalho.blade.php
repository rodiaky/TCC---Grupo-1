<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cabecalhoUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cabecalhoLayout.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="shortcut icon" type="imagex/png" href="{{ asset('assets/img/iconePalavrear.ico') }}">
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

            <a href="{{ route('professor.home') }}" class="container-logo"><img class="logo" src="{{ asset('assets/img/logo.svg') }}"></a>
            <a href="{{ route('perfil.professor') }}" class="usuario"><i class="material-icons">account_circle</i></a> <!--DIV usuario-->
        </div>

            <nav id="sidebar" class="sidebar">

                <!-- Botão de Fechar a sidebar -->
                <i id="sidebar-fechar" class="material-icons">close</i>
    
                <div class="sidebar-conteudo">
    
                    <ul class="sidebar-lista">
    
                        <!-- Minha Conta -->
                        <li class="sidebar-item">
                            <a href="{{ route('perfil.professor') }}" class="sidebar-item-link">
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

                        <!-- Redações Pendentes -->
                        <li class="sidebar-item">
                            <a href="{{ url('/redacoes_pendentes') }}" class="sidebar-item-link">
                                <i class="material-icons">notification_important</i>
                                <span class="sidebar-link">Redações Pendentes</span>
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
                            <a href="{{ route('admin.temasRepertorios') }}" class="sidebar-item-link">
                                <i class="material-icons">history_edu</i>
                                <span class="sidebar-link">Repertórios</span>
                            </a>
                        </li>
    
                        <!-- Materiais -->
                        <li class="sidebar-item">
                            <a href="{{ route('admin.pastasMateriais') }}" class="sidebar-item-link">
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
                            <a href="{{ route('admin.turmas') }}" class="sidebar-item-link">
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

            <a href="{{ route('aluno.home') }}" class="container-logo"><img class="logo" src="{{asset('assets/img/logo.svg')}}"></a>
            <a href="{{ route('perfil.aluno') }}" class="usuario"><i class="material-icons">account_circle</i></a> <!--DIV usuario-->
        </div>

            <nav id="sidebar" class="sidebar">

                <!-- Botão de Fechar a sidebar -->
                <i id="sidebar-fechar" class="material-icons">close</i>
    
                <div class="sidebar-conteudo">
    
                    <ul class="sidebar-lista">
    
                        <!-- Minha Conta -->
                        <li class="sidebar-item">
                            <a href="{{ route('perfil.aluno') }}" class="sidebar-item-link">
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
                                <span class="sidebar-link">Temas de Redações</span>
                            </a>
                        </li>

                        <!-- Repertórios -->
                        <li class="sidebar-item">
                            <a href="{{ route('admin.temasRepertorios') }}" class="sidebar-item-link">
                                <i class="material-icons">history_edu</i>
                                <span class="sidebar-link">Repertórios</span>
                            </a>
                        </li>

                        <!-- Estatísticas -->
                        <li class="sidebar-item">
                            <a href="{{ route('aluno.estatistica') }}" class="sidebar-item-link">
                                <i class="material-icons">insert_chart</i>
                                <span class="sidebar-link">Estatísticas</span>
                            </a>
                        </li>
    
                        <!-- Materiais -->
                        <li class="sidebar-item">
                            <a href="{{ route('admin.pastasMateriais') }}" class="sidebar-item-link">
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
    
    <script src="{{asset ('js/cabecalho.js')}}"></script>
</body>
</html>