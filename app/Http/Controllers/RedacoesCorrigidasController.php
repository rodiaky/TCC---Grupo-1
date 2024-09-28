<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedacoesCorrigidasController extends Controller
{
    public function view($id)
    {
            $redacao = DB::table('redacoes')
            ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
            ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
            ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->join('users', 'alunos.id_user', '=', 'users.id')
            ->select(
                'temas.frase_tematica as frase_tematica',
                'users.name as nome_aluno',
                'bancas.nome as banca_nome',
                'turmas.nome as turma_nome', 
                'redacoes.id as id',
                'redacoes.redacao_enviada as redacao_enviada',
                'redacoes.comentario as comentario',
                'redacoes.nota_aluno_redacao as nota_aluno_redacao',
                'redacoes.redacao_corrigida as redacao_corrigida'
            )
            ->where('redacoes.id', $id)
            ->first();  
    
        $criterios = DB::table('criterios')
            ->join('bancas', 'criterios.id_banca', '=', 'bancas.id')
            ->join('redacoes', 'redacoes.id_banca', '=', 'bancas.id')
            ->leftJoin('criterios_redacoes', function($join) use ($id) {
                $join->on('criterios.id', '=', 'criterios_redacoes.id_criterio')
                     ->where('criterios_redacoes.id_redacao', '=', $id);
            })
            ->where('redacoes.id', '=', $id)
            ->select('criterios.nome', 'criterios.id', 'criterios.descricao', 'criterios_redacoes.nota_aluno_criterio')
            ->get();
    
            return view('site.aluno.redCorrigida', compact('redacao', 'criterios'));
         }
    
}
