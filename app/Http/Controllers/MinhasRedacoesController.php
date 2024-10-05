<?php
namespace App\Http\Controllers;

use App\Models\Alunos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MinhasRedacoesController extends Controller
{
    public function index() {
        $idUser = $_SESSION['id'];

        $aluno = Alunos::where('id_user', $idUser)->first();

        if (!$aluno) {
            return response()->json(['error' => 'Aluno não encontrado'], 404);
        }

        $idAluno = $aluno->id;

        // Obtendo os ids das bancas na tabela redacoes para o aluno específico
        $bancas = DB::table('redacoes')
            ->select('id_banca')
            ->where('id_aluno', '=', $idAluno)
            ->distinct()
            ->get();

        // Agrupando as redações corrigidas por banca, incluindo frases temáticas
        $redacoesPorBanca = DB::table('redacoes')
            ->join('bancas', 'redacoes.id_banca', '=', 'bancas.id')
            ->join('temas', 'redacoes.id_tema', '=', 'temas.id')
            ->where('redacoes.situacao_redacao', 'Corrigida')
            ->where('redacoes.id_aluno', $idAluno)
            ->select(
                'bancas.nome as banca_nome',
                DB::raw('COUNT(redacoes.id) as total_redacoes'),
                DB::raw('json_agg(redacoes.id) as ids_redacoes'), // Agregando IDs das redações
                DB::raw('json_agg(temas.frase_tematica) as frases_tematicas') // Usando json_agg para agregar como JSON
            )
            ->groupBy('bancas.nome')
            ->orderBy('bancas.nome')
            ->get();

        // Convertendo as frases temáticas e IDs de JSON para Array
        foreach ($redacoesPorBanca as $redacao) {
            $redacao->frases_tematicas = json_decode($redacao->frases_tematicas);
            $redacao->ids_redacoes = json_decode($redacao->ids_redacoes);
        }

        return view('site.aluno.minhasRedacoes',compact('redacoesPorBanca'));
    }
}



