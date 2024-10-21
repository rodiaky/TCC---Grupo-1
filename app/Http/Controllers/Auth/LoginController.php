<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm(Request $request) {
        $erro = '';

        $opcao = $request->get('erro');

        switch ($opcao) {   
            case 1:
                $erro = 'Usuário e ou senha não existem';
                break;
            case 2:
                $erro = 'Necessário realizar login para como Aluno ter acesso à página';
                break;
            case 3:
                $erro = 'Necessário realizar login como Professor para ter acesso à página';
                break;
            case 4:
                $erro = 'Necessário realizar login como Administrador para ter acesso à página';
                break;
            case 5:
                $erro = 'Necessário realizar login primeiramente';
                break;
            case 6:
                $erro = '';
                break;
            default:
                $erro = "Entrada Inválida";
        }

        return view('auth.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function login(Request $request) {
        // Validate input
        $validatedData = $request->validate([
            'usuario' => 'required|string|email|max:255',
            'senha' => 'required|string',
        ], [
            'usuario.required' => 'O email é obrigatório.',
            'usuario.email' => 'O email deve ser um endereço de email válido.',
            'senha.required' => 'A senha é obrigatória.',
        ]);
    
        // Retrieve email and password from validated data
        $email = $validatedData['usuario'];
        $password = $validatedData['senha'];
    
        // Check user credentials
        $usuario = User::where('email', $email)->first();
    
        if ($usuario && Hash::check($password, $usuario->password)) {
            // Password matches
            session_start();
            $_SESSION['id'] = $usuario->id;
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['eh_admin'] = $usuario->eh_admin; // Corrigido para 'ed_admin'
    
            return redirect()->route($_SESSION['eh_admin'] === "Aluno" ? 'aluno.home' : 'professor.home');
        } else {
            // Password does not match or user not found
            return redirect()->route('login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_start();
        session_destroy();
        return redirect()->route('login', ['erro' => 6]);
    }
}
