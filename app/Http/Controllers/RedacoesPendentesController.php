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
        ->join('users', 'alunos.id_user', '=', 'users.id')
        ->select(
            'temas.frase_tematica as frase_tematica',
            'users.name as nome',
            'turmas.horario_entrada as horario_entrada',
            'turmas.horario_saida as horario_saida',
            'bancas.nome as banca_nome',
            'redacoes.id as id'
        )
        ->where('redacoes.situacao_redacao', 'Pendente')
        ->get();

        // Formatação de horários
        $redacoes = $redacoes->map(function($redacao) {
            $redacao->horario_entrada = \Carbon\Carbon::parse($redacao->horario_entrada)->format('H:i');
            $redacao->horario_saida = \Carbon\Carbon::parse($redacao->horario_saida)->format('H:i');
            return $redacao;
        });

        return view('site.professor.redPendentes', compact('redacoes'));
    }

    public function uploadpage() {
        return view('product');
    }

    public function store(Request $request) {
        $redacao = Redacoes::find($id);
        $file = $request->file('redacao_enviada');

        // Gera um nome único para o arquivo
        $filename = time() . '.' . $file->getClientOriginalExtension();

        // Move o arquivo para a pasta 'assets'
        $file->move(('assets/redacao_enviada'), $filename);

        $redacao->redacao_enviada = $filename;
        $redacao->save();

        return redirect()->back();
    }

    public function show() {
        $data = Conteudo::all();
        return view('showproduct', compact('data'));
    }

    public function download(Request $request, $filename) {
        return response()->download(public_path('assets/' . $filename));
    }

    public function view($id) {
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
                'redacoes.nota_aluno_redacao as nota_aluno_redacao'
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

        return view('site.professor.viewproduct', compact('redacao', 'criterios'));
    }

    public function atualizar(Request $request, $id)
    {
        $redacao = Redacao::find($id);
        if (!$redacao) {
            return response()->json(['success' => false, 'message' => 'Redação não encontrada.']);
        }
    
        $redacao->nota = $request->input('nota');
        
        // Captura a imagem do canvas
        if ($request->input('imagem')) {
            $data = $request->input('imagem');
            $data = str_replace('data:image/png;base64,', '', $data);
            $data = str_replace(' ', '+', $data);
            $image = base64_decode($data);
            
            // Salvar a imagem em um caminho específico
            $imagePath = public_path('assets/materiais/redacoes/' . $id . '.png');
            file_put_contents($imagePath, $image);
            
            // Atualizar o caminho no banco de dados, se necessário
            $redacao->caminho_imagem = 'assets/materiais/redacoes/' . $id . '.png';
        }
    
        $redacao->save();
        return response()->json(['success' => true]);
    }
    

    public function delete($id) {
        $data = Conteudo::find($id);
        if ($data) {
            // Exclui o arquivo associado
            $filePath = public_path('assets/' . $data->filename);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Exclui o registro do banco de dados
            $data->delete();
        }
        return redirect()->back()->with('success', 'Registro excluído com sucesso!');
    }

    public function saveImage(Request $request, $id) {
        $redacao = Redacoes::find($id);

        if ($redacao) {
            $imageData = $request->input('image');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);

            // Gera um nome de arquivo único para a imagem editada
            $newFileName = 'corrigida_' . uniqid() . '.png';
            $imagePath = ('assets/redacao_corrigida/' . $newFileName);

            if (file_put_contents($imagePath, base64_decode($imageData))) {
                $redacao->redacao_corrigida = $newFileName;
                $redacao->save();

                return response()->json(['success' => true, 'message' => 'Imagem corrigida salva com sucesso!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Erro ao salvar a imagem no diretório.']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Redação não encontrada.']);
    }
}
