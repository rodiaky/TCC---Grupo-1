@extends('layout.site')
@section('titulo','Turmas')
@section('conteudo')
<div class='container'>
<h3 class='center'>Adicionar Turmas</h3>
<div class='row'>
    <form class="" action="{{route('admin.turmas.salvar')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @include('admin.turmas._form')
        <button class="btn deep-orange">Salvar</button>
@endsection