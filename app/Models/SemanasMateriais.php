<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemanasMateriais extends Model
{

     protected $fillable = ['id_semana', 'id_material'];
     protected $primaryKey = ['id_semana', 'id_material'];
     public $incrementing = false;
     protected $keyType = 'array';  
}
