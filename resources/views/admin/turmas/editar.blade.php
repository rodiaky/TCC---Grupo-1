@extends('layout.site')
@section('titulo','Turmas')
@section('conteudo')
<div class='container'>
<h3 class='center'>Editando Turmas</h3>
<div class='row'>
    <form class="" action="{{route('admin.turmas.atualizar', $linha->id)}}" method="get" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="get">
        @include('admin.turmas._form')
        <button class="btn deep-orange">Atualizar</button>
@endsection