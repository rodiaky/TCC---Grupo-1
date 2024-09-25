<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pastas extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem', 'tipo']; 
}
