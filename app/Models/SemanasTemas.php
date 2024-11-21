<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemanasTemas extends Model
{
    protected $fillable = ['id_semana', 'id_tema'];
    protected $primaryKey = ['id_semana', 'id_tema'];
    public $incrementing = false;
    protected $keyType = 'array';  
}
