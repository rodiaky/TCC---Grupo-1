<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redacoes extends Model
{
    use HasFactory;
    protected $fillable = ['redacao_enviada', 'redacao_corrigida', 'situacao_redacao', 'nota_aluno_redacao', 
                           'comentario', 'data_envio', 'data_correcao', 'id_aluno', 'id_banca', 'id_tema',
                           'id_funcionario', 'id_turma'];
}
