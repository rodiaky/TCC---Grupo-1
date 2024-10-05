<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Semanas;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $idUser = $_SESSION['id'];

        // Obtenha as redações corrigidas
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
                'temas.imagem as tema_imagem',
                'redacoes.id as id_redacao'
            )
            ->where('redacoes.situacao_redacao', 'Corrigida')
            ->where('users.id', '=', $idUser)
            ->orderBy('redacoes.data_correcao', 'DESC')
            ->take(3) 
            ->get();

        // Obtenha todas as semanas
        $semanas = Semanas::orderBy('nome', 'asc')->get();

        // Se uma semana foi selecionada, utilize seu ID, caso contrário, use a primeira
        $semanaSelecionadaId = $request->input('semana_id', $semanas->first()->id);

        // Obtenha os dados da semana selecionada
        $temaSemana = $this->obterTemasDaSemana($semanaSelecionadaId);
        $materialSemana = $this->obterMateriaisDaSemana($semanaSelecionadaId, "Material");
        $repertorioSemana = $this->obterMateriaisDaSemana($semanaSelecionadaId, "Repertório");

        return view('site.aluno.home', compact('redacoesCorrigidas', 'semanas', 'semanaSelecionadaId', 'temaSemana', 'materialSemana', 'repertorioSemana'));
    }

    // Métodos auxiliares
    private function obterTemasDaSemana($semanaId)
    {
        return DB::table('temas')
            ->join('semanas_temas', 'temas.id', '=', 'semanas_temas.id_tema')
            ->join('semanas', 'semanas.id', '=', 'semanas_temas.id_semana')
            ->join('bancas', 'bancas.id', '=', 'temas.id_banca') 
            ->select('temas.*', 'bancas.nome as banca_nome') 
            ->where('semanas.id', '=', $semanaId)
            ->get();
    }

    private function obterMateriaisDaSemana($semanaId, $categoria)
    {
        return DB::table('materiais')
            ->join('semanas_materiais', 'materiais.id', '=', 'semanas_materiais.id_material')
            ->join('semanas', 'semanas.id', '=', 'semanas_materiais.id_semana')
            ->select('materiais.*')
            ->where('semanas.id', '=', $semanaId)
            ->where('materiais.categoria', $categoria)
            ->get();
    }

    
}
