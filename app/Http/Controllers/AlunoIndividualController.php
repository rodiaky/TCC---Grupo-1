<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turmas;
use App\Models\Funcionarios;
use App\Models\User;
use App\Models\Pessoas;
use App\Models\Alunos;
use App\Models\Pagamentos;
use App\Models\Bancas;
use Illuminate\Support\Facades\DB;

class AlunoIndividualController extends Controller
{
    public function index($idUser, Request $request) {
        $user = User::find($idUser);
        $aluno = Alunos::where('id_user', $idUser)->first();
        $id_aluno = $aluno->id;
        $id_turma = $aluno->id_turma;
        $turma = Turmas::find($id_turma);
        $idUser = $_SESSION['id'];
        $pagamentos = Pagamentos::where('id_aluno', $id_aluno)->get();

        // Mapear meses do ano
        $meses = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];
        
        // Transformar meses nos pagamentos
        $pagamentos->transform(function ($pagamento) use ($meses) {
            $pagamento->mes = $meses[$pagamento->mes] ?? 'Mês Inválido'; // Mapeia o mês
            return $pagamento;
        });

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


        $examType = $request->input('exam', '1');

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
            ->where('redacoes.id_aluno', $id_aluno)
            ->where('redacoes.situacao_redacao', 'Corrigida')
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

        $bancas = Bancas::all();

        return view('admin.turmas.aluno', compact('aluno', 'turma', 'redacoesPorBanca', 'user', 'pagamentos','examType', 'notasArray', 'bancas'));
    }



    public function adicionar() {
        $alunos = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->select('users.name','alunos.id')
        ->where('eh_admin','Aluno')
        ->get();
        return view('admin.pagamentos.adicionar',compact('alunos'));
    }

    public function editar($id) {
        $alunos = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->select('users.name','alunos.id')
        ->where('eh_admin','Aluno')
        ->get();
        $pagamentos = Pagamentos::find($id);
        return view('admin.pagamentos.editar',compact('linha','alunos'));
    }


    public function excluir($id) {
        Pagamentos::find($id)->delete();
        return redirect()->route('admin.turmas.aluno');
    }

    public function salvar(Request $req){
        $dados = $req->all();  
        Pagamentos::create($dados);
        return redirect()->route('admin.turmas.aluno');

    }

    public function atualizar(Request $req, $id){
        $dados = $req->all();
        Pagamentos::find($id)->update($dados);
        return redirect()->route('admin.turmas.aluno');
    }

}
