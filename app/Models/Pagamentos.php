<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    protected $fillable = [ 'mes', 'ano', 'status_pagamento', 'valor', 'id_aluno'];
}
