<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Certifique-se de que o modelo Aluno está configurado

class CadastroAlunoController extends Controller
{
    // Exibir o formulário de cadastro
    public function index()
    {
        return view('site.professor.cadastroAluno'); // Certifique-se de que a view está no local correto
    }

    // Armazenar o novo aluno
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'senha' => 'required|string|min:3',
            'selecionar-turma' => 'required|integer|exists:turmas,id', // Certifique-se de que você tem um modelo Turma configurado
        ]);

        // Criação de um novo aluno
        $aluno = new User();
        $aluno->nome = $validatedData['nome'];
        $aluno->email = $validatedData['email'];
        $aluno->senha = $validatedData['password']; // Hash a senha antes de armazenar
        $aluno->turma_id = $validatedData['selecionar-turma']; // Certifique-se de que a coluna de turma no modelo está correta
        $aluno->save();

        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('cadastroAluno')->with('success', 'Aluno cadastrado com sucesso!');
    }
}
