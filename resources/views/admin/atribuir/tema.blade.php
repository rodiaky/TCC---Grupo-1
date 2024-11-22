@extends('layouts._partials._cabecalho')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semanaLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioLayout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/formularioUI.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleGeral.css') }}">

    <title>Atribuir Tema</title>
    @endsection

@section('conteudo')
<main>
    <div class="container-titulo-seta">
       <div class="container-seta">
            <a href="{{ route('professor.home') }}" class="seta-back">
                <i class="material-icons">arrow_back</i>
            </a>
        </div>
        <h1 class="titulo-pagina">Atribuir Tema</h1>
    </div>
    <hr class="titulo-linha">
</main>

<article>
    <div class="form-value">
        <form action="{{ route('admin.atribuir.salvarTema') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="infoSemana">
                    <label>Semanas</label>
                    <label class="lbl-semana">
                        <select name="id_semana" class="atribuir-semana">
                            @foreach($semanas as $semana)
                                <option value="{{ $semana->id }}">{{ $semana->nome }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="infoSemana">
                    <label>Temas</label>
                    <label class="lbl-material">
                        <select name="id_tema[]" class="atribuir-tema" multiple="multiple">
                            @foreach($temas as $tema)
                                <option value="{{ $tema->id }}">{{ $tema->frase_tematica }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                @if ($errors->any())
                    <div class="mensagem">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Preencha todos os campos corretamente antes de avançar
                    </div>
                @endif

                <div class="botoes">
                    <button type="submit" name="salvar" class="button">Salvar</button>
                </div>
            </form>
        </div>
    </article>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
    $(document).ready(function(){
        $('.atribuir-semana').select2();  // Mantenha o select2 apenas na semana se desejar a busca
        $('.atribuir-tema').select2(); // Aplica o select2 no campo de materiais (com busca)
      
        ordenarSemana();
        ordenarTema();
    });
    
    function ordenarSemana() {
        var itensOrdenados = $('.atribuir-semana option').sort(function (a, b) {
            return a.text < b.text ? -1 : 1;
        });
    
        $('.atribuir-semana').html(itensOrdenados);
    }
    
    function ordenarTema() {
        var itensOrdenados = $('.atribuir-tema option').sort(function (a, b) {
            return a.text < b.text ? -1 : 1;
        });
    
        $('.atribuir-tema').html(itensOrdenados);
    }
    </script>      
@endsection

