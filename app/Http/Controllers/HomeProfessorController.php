<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Semanas;

class HomeProfessorController extends Controller
{
    public function index(Request $request) {
        $semanas = Semanas::orderBy('nome', 'asc')->get();

      
        $semanaSelecionadaId = $request->input('semana_id', $semanas->first()->id);

        
        $temaSemana = $this->obterTemasDaSemana($semanaSelecionadaId);
        $materialSemana = $this->obterMateriaisDaSemana($semanaSelecionadaId, "Material");
        $repertorioSemana = $this->obterMateriaisDaSemana($semanaSelecionadaId, "Repertório");

        return view('site.professor.homeProfessor', compact('semanas', 'semanaSelecionadaId', 'temaSemana', 'materialSemana', 'repertorioSemana'));
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
