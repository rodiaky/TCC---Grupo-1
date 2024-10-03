@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/styleGeral.css">   
    <link rel="stylesheet" type="text/css" href="css/repertorios.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/carrousselHome.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>HOME</title>
@endsection

@section('conteudo')

    <main>

        <!-- MENU -->
        <section class="menu-home" id="menu-home-professor">

            <div class="card">
                <a href="{{ url('/redacoes_pendentes') }}"><img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card"></a>
                <div class="texto-card">Redações Pendentes</div>
            </div>

            <!-- TEMAS -->
            <div class="card">
            <a href="{{route('admin.temas')}}"><img src="https://blog.unipar.br/wp-content/uploads/2020/11/afa8d7c2f9d0641e8c65c20b46b92c00-1110x508.jpg" alt="imagemRedacao" class="imagem-card"> </a>
                <div class="texto-card">Temas</div>
            </div>

            <!-- REPERTORIOS -->
            <div class="card">
                <a href="{{route('admin.temasRepertorios')}}"><img src="https://segredosdomundo.r7.com/wp-content/uploads/2021/01/45-personalidades-mais-importantes-e-influentes-de-todos-os-tempos-37-e1610752380360.jpg" alt="imagemRepertorio" class="imagem-card"></a>
                <div class="texto-card">Repertórios</div>
            </div>
            
            <!-- MATERIAIS -->
            <div class="card">
                <a href="{{ route('admin.pastasMateriais') }}"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSDaUfHGduhGapOSADboo67PDCiZkpAWdK1g&s" alt="" class="imagem-card"></a>
                <div class="texto-card">Materiais</div>
            </div>

            <!-- QUESTOES -->
            <div class="card">
                <a href="{{route('admin.questoes')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Questões</div>
            </div>

            <!-- TURMAS -->
            <div class="card">
                <a href="{{route('admin.turmas')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Turmas</div>
            </div>
            
            <!-- CRITÉRIOS -->
            <div class="card">
                <a href="{{route('admin.criterios')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Critérios</div>
            </div>

            <!-- BANCAS -->
            <div class="card">
                <a href="{{route('admin.bancas')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Bancas</div>
            </div>

            <!-- SEMANAS -->
            <div class="card">
                <a href="{{route('admin.semanas')}}"><img src="https://blog.andresan.com.br/wp-content/uploads/2019/09/foto-generica-prova-shutterstock_widelg.jpg" alt="" class="imagem-card"></a>
                <div class="texto-card">Semanas</div>
            </div>

        </section>

    </main>

    <script src="js/home.js"></script>
    <script src="https://kit.fontawesome.com/c8b145fd82.js" crossorigin="anonymous"></script>

    @endsection