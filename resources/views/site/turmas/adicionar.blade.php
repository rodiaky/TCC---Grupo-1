@extends('layouts._partials._cabecalho')

@section('css')
    <link rel="stylesheet" type="text/css" href="css/formularioUI.css">
    <link rel="stylesheet" type="text/css" href="css/formularioLayout.css">
@endsection

@section('conteudo')
<div class='container'>
    <div class='row'>
        <!-- Formulário para adicionar uma turma -->
        <form action="{{ route('site.turmas.salvar') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('site.turmas._form')
            <button type="button" type="submit" name="salvar" class="button">Salvar</button>
        </form>
    </div>
</div>
@endsection
