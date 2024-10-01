<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterios extends Model
{
    use HasFactory;
    protected $fillable = ['nome','descricao', 'nota_maxima_criterio', 'id_banca'];

    public function redacoes()
    {
        return $this->belongsToMany(Redacoes::class, 'criterios_redacoes', 'id_criterio', 'id_redacao')
                    ->withPivot('nota_aluno_criterio')
                    ->withTimestamps();
    }
}
