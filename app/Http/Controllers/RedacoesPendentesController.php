<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Redacoes;
use App\Models\Temas;
use App\Models\Bancas;
use App\Models\Turmas;
use App\Models\User;

class RedacoesPendentesController extends Controller
{
    public function index(){
        $redacoes = DB::table('redacoes')
        ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
        ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
        ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
        ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
        ->join('users', 'alunos.id_user', '=', 'users.id') // Fixed table name and field names
        ->select(
            'temas.frase_tematica as frase_tematica',
            'users.name as nome', // Fixed table name
            'turmas.horario_entrada as horario_entrada',
            'turmas.horario_saida as horario_saida',
            'bancas.nome as banca_nome'
        )
        ->where('redacoes.situacao_redacao', 'Pendente') // Added a condition as an example; adjust as needed
        ->get();

        return view('site.professor.redPendentes', compact('redacoes'));
    }
}
