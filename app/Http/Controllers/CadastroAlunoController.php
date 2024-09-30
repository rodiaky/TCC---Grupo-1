<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Certifique-se de que o modelo Aluno está configurado
use App\Models\Alunos;
use App\Models\Turmas;

class CadastroAlunoController extends Controller
{
    // Exibir o formulário de cadastro
    public function index()
    {
        $turmas = Turmas::all(); // Obtém todas as turmas

        return view('site.professor.cadastroAluno', compact('turmas')); // Certifique-se de que a view está no local correto
    }

    // Armazenar o novo aluno
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'senha' => 'required|string|min:3',
            'turma' => 'required|integer', // Certifique-se de que você tem um modelo Turma configurado
        ]);

        // Criação de um novo aluno
        $aluno = new User();
        $aluno->name = $validatedData['nome'];
        $aluno->email = $validatedData['email'];
        $aluno->password = $validatedData['senha']; // Hash a senha antes de armazenar
        $aluno->save();


        $ultimoId = User::latest()->value('id');
        $funcionario = new Alunos();
        $funcionario->id_turma = $validatedData['turma']; 
        $funcionario->id_user = $ultimoId;
        $funcionario->save();

        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('professor.cadastroAluno.index')->with('success', 'Aluno cadastrado com sucesso!');
    }
}
