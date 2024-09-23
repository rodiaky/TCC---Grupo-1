<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Semanas;


class HomeController extends Controller
{
    public function index() {

        $idUser = $_SESSION['id'];

        $redacoesCorrigidas = DB::table('redacoes')
        ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
        ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
        ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
        ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
        ->join('users', 'alunos.id_user', '=', 'users.id')
        ->select(
            'temas.frase_tematica as frase_tematica',
            'bancas.nome as banca_nome',
            'temas.ano as tema_ano'
        )
        ->where('redacoes.situacao_redacao', 'Corrigida')
        ->where('users.id', '=', $idUser)
        ->orderBy('redacoes.data_correcao', 'DESC')
        ->get();

        $semanas = Semanas::all();


        return view('site.aluno.home',compact('redacoesCorrigidas','semanas'));
    }
}
