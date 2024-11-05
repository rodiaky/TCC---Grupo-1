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

        $nome_turma = Turmas::where('id', $id)
            ->pluck('nome')
            ->first();
    
        return view('admin.alunos.index', compact('pessoas', 'nome_turma'));
    }
    
    
    public function adicionar() {
        $turmas = Turmas::pluck('nome', 'id')->all();
        return view('admin.alunos.adicionar', compact('turmas'));
    }
    
    public function editar($id_pessoa) {
        $url = url()->previous();

        $alunos = DB::table('users')
        ->join('alunos', 'users.id', '=', 'alunos.id_user')
        ->join('turmas', 'alunos.id_turma', '=', 'turmas.id') 
        ->select('users.*', 'alunos.*', 'turmas.nome as nome_turma', 'users.id as id', 'turmas.id as id_turma') 
        ->where('users.id', $id_pessoa)
        ->first();

        $id = $alunos->id_turma;
 
        $turmas = Turmas::pluck('nome', 'id')->all();
    
  
        return view('admin.alunos.editar', compact('alunos', 'turmas','id','url'));
    }
    
    
    public function excluir($id_pessoa) {
        $user = User::find($id_pessoa);
        $id_turma = Alunos::where('id_user', $id_pessoa)
            ->pluck('id_turma')
            ->first();
        if ($user) {
            $user->delete();
            return redirect()->route('professor.admin.alunos', ['id' => $id_turma])->with('success', 'Aluno excluído com sucesso.');
        }
        return redirect()->route('professor.admin.alunos', ['id' => $id_turma])->with('error', 'Aluno não encontrado.');
    }
    
    
    public function salvar(Request $req) {
        $file = $req->file('arquivo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(('assets/fotoPerfil'), $filename);
        $req->foto =  $filename;

        $nome = $req->input('name');
        $email = $req->input('email');
        $senha = $req->input('password');
        $id_turma= $req->input('id_turma');
        
        $meuVetor = [
            'name' => $nome,
            'foto' => $filename,
            'eh_admin' => "Aluno",
            'email' =>  $email,
            'password' => $senha     
        ];

        User::create($meuVetor);
        $ultimoId = User::latest()->value('id');
        $aluno = new Alunos();
        $aluno->id_turma = $id_turma; 
        $aluno->id_user = $ultimoId; 
        $aluno->save();
        
        return redirect()->route('admin.turmas');
    }
    
    public function atualizar(Request $request, $id)
    {
        $alunoAtual = User::find($id);
            if ($request->hasFile('arquivo')) {
                // Se um novo arquivo foi enviado, armazena o novo arquivo
                $image = $request->file('arquivo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(('assets/fotoPerfil'), $imageName);
            } else {
                // Se não foi enviado um novo arquivo, mantém o arquivo existente
                $imageName = $alunoAtual->foto; // Nome do arquivo atual
            }

        $aluno = $_SESSION['eh_admin'] === 'Aluno';
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
        $user->email=$request->email;
        $user->foto = $imageName;

        // Salva as alterações
        $userSaved = $user->save();
        $alunoSaved = $aluno->save();

        // Verifica se as alterações foram salvas
        if (!$userSaved || !$alunoSaved) {
            return redirect()->back()->with('error', 'Erro ao atualizar os dados do aluno.')->withInput();
        }

        // Redireciona para a página de alunos da turma anterior com uma mensagem de sucesso
        if(!$aluno){
        return redirect()->route('professor.admin.alunos', ['id' => $id_turma_antiga])
                        ->with('success', 'Aluno atualizado com sucesso.');
        }
        else{
            $url = $request->input('url');
            return redirect()->to($url);
        }
}

    public function completo(){
        
    }

}
