<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perguntas extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'enunciado', 'alternativa_A', 'alternativa_B', 'alternativa_C', 'alternativa_D', 
    'alternativa_E', 'resposta', 'disciplina', 'assunto', 'ano', 'id_banca'];
}
