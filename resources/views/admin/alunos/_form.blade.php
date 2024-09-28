<div class="input-field">
    <input type="text" name="name" value="{{ isset($pessoa->name) ? $pessoa->name : ''}}">
    <label>Nome</label>
</div>
<div class="input-field">
    <input type="email" name="email" value="{{ isset($pessoa->email) ? $pessoa->email : '' }}">
    <label>Email</label>
</div>
<div class="input-field">
    <input type="password" name="password" value="{{isset($pessoa->password) ? $pessoa->password : ''}}">
    <label>Senha</label>
</div>
<div class="input-field">
    <input type="text" name="telefone" value="{{isset($pessoa->telefone) ? $pessoa->telefone : ''}}">
    <label>Telefone</label>
</div>
<div class="input-field">
    <input type="text" name="cpf" value="{{isset($pessoa->cpf) ? $pessoa->cpf : ''}}">
    <label>CPF</label>
</div>
<div class="file-field input-field">
    <div class="btn blue">
        <span>Imagem</span>
        <input type="file" name="arquivo">
    </div>
<div class="file-path-wrapper">
    <input class="file-path validate" type="text">
</div>
</div>
@if(isset($pessoa->imagem))
<div class="input-field">
<img width="150" src="{{asset($pessoa->imagem)}}" />
</div>
@endif
<div class="input-field">
    <input type="date" name="data_nascimento" value="{{isset($pessoa->data_nascimento) ? $pessoa->data_nascimento : ''}}">
    <label>Data de nascimento</label>
</div>
<div class="input-field">
    <label>Turmas</label><br>
    @foreach($turmas as $id => $nome)
        <p>
            <label>
                <input type="radio" name="id_turma" value="{{ $id }}" {{ (isset($pessoa->id_turma) && $pessoa->id_turma == $id) ? 'checked' : '' }}/>
                <span>{{ $nome }}</span>
            </label>
        </p>
    @endforeach
</div>



