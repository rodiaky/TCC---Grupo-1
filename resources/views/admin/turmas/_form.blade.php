<div class="input-field">
<input type="text" name="nome" value="{{ isset($linha->nome) ? $linha->nome : ''}}">
<label>Nome da turma</label>
</div>
<div class="input-field">
<input type="time" name="horario_entrada" value="{{ isset($linha->horario_entrada) ? $linha->horario_entrada : ''}}">
<label>Horário de entrada</label>
</div>
<div class="input-field">
<input type="time" name="horario_saida" value="{{ isset($linha->horario_saida) ? $linha->horario_saida : ''}}">
<label>Horário de saída</label>
</div>
<div class="input-field">
<input type="text" name="dias_aula" value="{{ isset($linha->dias_aula) ? $linha->dias_aula : ''}}">
<label>Dias de aula</label>
</div>
<div class="input-field">
<input type="text" name="quantidade_aluno" value="{{ isset($linha->quantidade_aluno) ? $linha->quantidade_aluno : ''}}">
<label>Quantidade máxima de alunos</label>
</div>

<div class="input-field">
    <label>Professores</label><br>
    @foreach($professores as $professor)
        <p>
            <label>
                <input type="radio" name="id_funcionario" value="{{ $professor->id }}" {{ (isset($linha->id_funcionario) && $linha->id_funcionario == $professor->id) ? 'checked' : '' }}/>
                <span>{{ $professor->name }}</span>
            </label>
        </p>
    @endforeach
</div>