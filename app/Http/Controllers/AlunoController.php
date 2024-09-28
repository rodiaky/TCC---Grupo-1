<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alunos;
use App\Models\User;
use App\Models\Turmas;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function index($id) {
        $pessoas = User::join('alunos', 'users.id', '=', 'alunos.id_user')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select('users.*', 'alunos.*', 'users.id as id')
            ->where('turmas.id', $id)
            ->get();

        $nome_turma = User::join('alunos', 'users.id', '=', 'alunos.id_user')
            ->join('turmas', 'alunos.id_turma', '=', 'turmas.id')
            ->select('turmas.nome as nome_turma')
            ->where('turmas.id', $id)
            ->first();
    
        return view('admin.alunos.index', compact('pessoas', 'nome_turma'));
    }
    
    
    public function adicionar() {
        $turmas = Turmas::pluck('nome', 'id')->all();
        return view('admin.alunos.adicionar', compact('turmas'));
    }
    
    public function editar($id_pessoa) {
        // Busca a pessoa e as informações do aluno
        $pessoa = DB::table('users')
            ->join('alunos', 'users.id', '=', 'alunos.id_user')
            ->select('users.*', 'alunos.*', 'users.id as id')
            ->where('users.id', $id_pessoa)
            ->first();
    
        // Pega todas as turmas
        $turmas = Turmas::pluck('nome', 'id')->all();
    
        // Retorna a view com os dados
        return view('admin.alunos.editar', compact('pessoa', 'turmas'));
    }
    
    
    public function excluir($id_pessoa) {
        User::find($id_pessoa)->delete();
        return redirect()->route('admin.alunos');
    }
    
    public function salvar(Request $req) {
        $dados = $req->all();
        if($req->hasFile('foto')){
            $imagem = $req->file('foto');
            $num = rand(1111,9999);
            $dir = "foto/alunos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['foto'] = $dir."/".$nomeImagem;
            }
        $dados['eh_admin'] = "Aluno";
        User::create($dados);
        $ultimoId = User::latest()->value('id');
        $funcionario = new Alunos();
        $funcionario->id_turma = $dados['id_turma']; 
        $funcionario->id_user = $ultimoId; 
        $funcionario->save();
        return redirect()->route('admin.alunos');
    }
    
    public function atualizar(Request $request, $id)
{
    // Validação dos dados recebidos
    $request->validate([
        'name' => 'required|string|max:255',
        'id_turma' => 'required|exists:turmas,id',
    ]);

    // Tente encontrar o aluno com base no ID do usuário
    $aluno = Alunos::where('id_user', $id)->first();

    // Verifica se o aluno foi encontrado
    if (!$aluno) {
        return redirect()->route('professor.admin.alunos', ['id' => $request->id_turma])
                         ->with('error', 'Aluno não encontrado.');
    }

    // Armazena o ID da turma anterior
    $id_turma_antiga = $aluno->id_turma;

    // Atualiza a turma do aluno
    $aluno->id_turma = $request->id_turma; 

    // Atualiza também o nome do usuário
    $user = User::findOrFail($id); 
    $user->name = $request->name; 

    // Salva as alterações
    $userSaved = $user->save();
    $alunoSaved = $aluno->save(); 

    // Verifica se as alterações foram salvas
    if (!$userSaved || !$alunoSaved) {
        return redirect()->back()->with('error', 'Erro ao atualizar os dados do aluno.')->withInput();
    }

    // Redireciona para a página de alunos da turma anterior com uma mensagem de sucesso
    return redirect()->route('professor.admin.alunos', ['id' => $id_turma_antiga])
                     ->with('success', 'Aluno atualizado com sucesso.');
}





}