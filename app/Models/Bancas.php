<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bancas extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'nota_maxima_banca'];
}
