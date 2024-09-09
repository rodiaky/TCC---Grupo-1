<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Perguntas;

class BancaQuestoesController extends Controller
{
    public function index()
    {
        // Obtenha as disciplinas (ou temas) da tabela perguntas
        $pastas = DB::table('perguntas')
            ->select('disciplina')
            ->distinct() // Para garantir que disciplinas duplicadas não sejam retornadas
            ->get();

        // Passe os dados para a visão
        return view('site.bancaDeQuestoes', compact('pastas'));
    }
}
