<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perguntas;

class QuestoesController extends Controller
{
    public function index() {
        $questoes = DB::table('perguntas')
        ->select('perguntas.*') // Select all fields from temas and banca name
        ->get();

    return view('site.questoes', compact('questoes'));
    }
}
