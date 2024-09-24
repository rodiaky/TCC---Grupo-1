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
            'temas.texto_apoio as texto_apoio',
            'bancas.nome as banca_nome',
            'temas.ano as tema_ano',
            'temas.imagem as tema_imagem'
        )
        ->where('redacoes.situacao_redacao', 'Corrigida')
        ->where('users.id', '=', $idUser)
        ->orderBy('redacoes.data_correcao', 'DESC')
        ->get();

        $semanas = Semanas::orderBy('data_inicio', 'asc')->get();

        $dataAtual = now();


        $semanaSelecionada = $semanas->filter(function($semana) use ($dataAtual) {
            return $dataAtual->between($semana->data_inicio, $semana->data_fim);
        })->first();

    
        if (!$semanaSelecionada) {
            $semanaSelecionada = $semanas->last();
        }


        $temaSemana = DB::table('temas')
        ->join('semanas_temas', 'temas.id', '=', 'semanas_temas.id_tema')
        ->join('semanas', 'semanas.id', '=', 'semanas_temas.id_semana')
        ->join('bancas', 'bancas.id', '=', 'temas.id_banca') 
        ->select('temas.*', 'bancas.nome as banca_nome') 
        ->where('semanas.id', '=', $semanaSelecionada->id)
        ->get();


        $materialSemana = DB::table('materiais')
            ->join('semanas_materiais', 'materiais.id', '=', 'semanas_materiais.id_material')
            ->join('semanas', 'semanas.id', '=', 'semanas_materiais.id_semana')
            ->select('materiais.*')
            ->where('semanas.id', '=', $semanaSelecionada->id)
            ->where('materiais.categoria', "Material")
            ->get();
        
        $repertorioSemana = DB::table('materiais')
        ->join('semanas_materiais', 'materiais.id', '=', 'semanas_materiais.id_material')
        ->join('semanas', 'semanas.id', '=', 'semanas_materiais.id_semana')
        ->select('materiais.*')
        ->where('semanas.id', '=', $semanaSelecionada->id)
        ->where('materiais.categoria', "Repertório")
        ->get();

        return view('site.aluno.home',compact('redacoesCorrigidas','semanas','semanaSelecionada','temaSemana','materialSemana','repertorioSemana'));
    }
}
