<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turmas extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'horario_entrada', 'horario_saida', 'dias_aula', 'quantidade_aluno', 'id_funcionario'];
}
