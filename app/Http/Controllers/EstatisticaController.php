<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstatisticaController extends Controller
{
    public function index(Request $request)
    {
        $examType = $request->input('exam', '1');
        $id_user = $_SESSION['id'];

        // Obter ID do aluno
        $id_aluno = DB::table('alunos')
            ->select('id')
            ->where('id_user', $id_user)
            ->first();

        $id_aluno_value = $id_aluno->id ?? null;

        // Consultar notas
        $notas = DB::table('redacoes')
            ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
            ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
            ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select('redacoes.nota_aluno_redacao as nota', 'temas.frase_tematica as frase_tematica', 
                     'redacoes.id_tema as id_tema', 'bancas.nome', 'turmas.id as id_turma', 
                     'redacoes.id_banca as id_banca', 'bancas.nota_maxima_banca as nota_maxima')
            ->where('redacoes.id_banca', $examType)
            ->where('redacoes.id_aluno', $id_aluno_value)
            ->orderBy('redacoes.nota_aluno_redacao', 'asc')
            ->get();

        $firstNota = $notas->first();
        $id_turma = $firstNota->id_turma ?? 0;
        $id_banca = $firstNota->id_banca ?? 0;

        // Calcular médias
        $temas = $notas->pluck('id_tema')->unique();
        $medias = [];
        foreach ($temas as $tema) {
            $mediaSala = DB::table('redacoes')
                ->join('alunos', 'redacoes.id_aluno', '=', 'alunos.id')
                ->where('alunos.id_turma', $id_turma)
                ->where('redacoes.id_tema', $tema)
                ->where('redacoes.id_banca', $id_banca)
                ->select(DB::raw('AVG(redacoes.nota_aluno_redacao) as media'))
                ->first();
            $medias[$tema] = $mediaSala->media ?? 0;
        }

        // Obter a nota máxima
        $notaMaxima = DB::table('bancas')
            ->where('id', $id_banca)
            ->value('nota_maxima_banca') ?? 0;

        // Preparar dados para JavaScript
        $notasArray = [];
        $notasArray[] = ['Frase Temática', 'Nota do Aluno', 'Média da Sala', 'Nota Máxima'];
        foreach ($notas as $nota) {
            $notasArray[] = [
                $nota->frase_tematica,
                number_format($nota->nota, 2),
                number_format($medias[$nota->id_tema], 2),
                $notaMaxima
            ];
        }

        if ($request->ajax()) {
            return response()->json($notasArray);
        }

        return view('site.aluno.painel_redacoes', compact('examType', 'notasArray'));
    }
}
