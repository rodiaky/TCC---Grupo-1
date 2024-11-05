<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alunos;
use App\Models\User;
use App\Models\Funcionarios;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    
    public function editar($id_pessoa) {
        $url = url()->previous();

        $professor = DB::table('users')
        ->join('funcionarios', 'users.id', '=', 'funcionarios.id_user')
        ->select('users.*', 'funcionarios.*', 'users.id as id',) 
        ->where('users.id', $id_pessoa)
        ->first();
  
        return view('site.professor.editar', compact('professor','url'));
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
        $profAtual = User::find($id);
        if ($request->hasFile('arquivo')) {
            // Se um novo arquivo foi enviado, armazena o novo arquivo
            $image = $request->file('arquivo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(('assets/fotoPerfil'), $imageName);
        } else {
            // Se não foi enviado um novo arquivo, mantém o arquivo existente
            $imageName = $profAtual->foto; // Nome do arquivo atual
        }

        $aluno = $_SESSION['eh_admin'] === 'Aluno';
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Tente encontrar o aluno com base no ID do usuário
        $professor = Funcionarios::where('id_user', $id)->first();



        // Atualiza também o nome do usuário
        $user = User::findOrFail($id); 
        $user->name = $request->name;
        $user->email=$request->email;
        $user->foto = $imageName;

        // Salva as alterações
        $userSaved = $user->save();
        $professorSaved = $professor->save();

        // Verifica se as alterações foram salvas
        if (!$professorSaved || !$professorSaved) {
            return redirect()->back()->with('error', 'Erro ao atualizar os dados do aluno.')->withInput();
        }

            $url = $request->input('url');
            return redirect()->to($url);
        
    }
}
