<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiais extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nome', 'categoria', 'classificacao', 'id_semana'];
}
