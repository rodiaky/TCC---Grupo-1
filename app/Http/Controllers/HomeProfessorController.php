<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Semanas;
use App\Models\Turmas;
use App\Models\Bancas;
use App\Models\Redações;
use App\Models\Alunos;

class HomeProfessorController extends Controller
{
    public function index(Request $request) {
        $semanas = Semanas::orderBy('nome', 'asc')->get();

      
        $semanaSelecionadaId = $request->input('semana_id', $semanas->first()->id);

        
        $temaSemana = $this->obterTemasDaSemana($semanaSelecionadaId);
        $materialSemana = $this->obterMateriaisDaSemana($semanaSelecionadaId, "Material");
        $repertorioSemana = $this->obterMateriaisDaSemana($semanaSelecionadaId, "Repertório");

        $bancas = Bancas::all();
        $examType = $request->input('exam', '1');

        // Consulta para pegar todas as notas
        $notas = DB::table('redacoes')
            ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
            ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
            ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select(
                'redacoes.nota_aluno_redacao as nota',
                'temas.frase_tematica as frase_tematica',
                'redacoes.id_tema as id_tema',
                'bancas.nome as banca_nome',
                'turmas.id as id_turma',
                'redacoes.id_banca as id_banca',
                'bancas.nota_maxima_banca as nota_maxima'
            )
            ->where('redacoes.id_banca', $examType) 
            ->where('redacoes.situacao_redacao', 'Corrigida') // Apenas corrigidas
            ->orderBy('redacoes.nota_aluno_redacao', 'asc') // Ordena as notas
            ->get();

        if ($notas->isEmpty()) {
            $notasArray = [];
        }
        else{

    
        // Calculando médias por tema
        $temas = $notas->groupBy('id_tema');
        $medias = [];
    
        foreach ($temas as $id_tema => $notasTema) {
            $fraseTematica = $notasTema->first()->frase_tematica;
            $mediaTema = $notasTema->avg('nota'); // Calcula a média das notas para o tema
            $medias[$fraseTematica] = $mediaTema;
        }
    
        // Obtendo a nota máxima da banca
        $notaMaxima = DB::table('bancas')
            ->where('id', $notas->first()->id_banca)
            ->value('nota_maxima_banca') ?? 0;
    
       // Preparar dados para JavaScript
       $notasArray = [];
       $notasArray[] = ['Frase Temática', 'Média dos Alunos', 'Nota Máxima'];
       foreach ($medias as $fraseTematica => $media) {
        $notasArray[] = [
            $fraseTematica,
            number_format($media, 2),
            $notaMaxima
        ];
    
       }
    }

       if ($request->ajax()) {
           return response()->json($notasArray);
       }

        return view('site.professor.homeProfessor', compact('semanas', 'semanaSelecionadaId', 'temaSemana', 'materialSemana', 'repertorioSemana', 'examType', 'notasArray', 'bancas'));
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
