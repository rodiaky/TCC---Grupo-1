<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm(Request $request) {
        $erro = '';

        $opcao = $request->get('erro');

        switch ($opcao) {   
            case 1:
                $erro = 'Usuário e ou senha não existe';
                break;
            case 2:
                $erro = 'Necessario realizar login para como Aluno ter acesso a página';
                break;
            case 3:
                $erro = 'Necessario realizar login como Professor para ter acesso a página';
                break;
            case 4:
                $erro = 'Necessario realizar login como Administrador para ter acesso a página';
                break;
            case 5:
                $erro = 'Necessario realizar login primeiramente';
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

        //recuperamos os parâmetros do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //iniciar o Model User
        $aluno = new User();

        $usuario = $aluno->where('email', $email)
                    ->where('password', $password)
                    ->get()
                    ->first();

        if(isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            $_SESSION['eh_admin'] = $usuario->eh_admin;

            if($_SESSION['eh_admin'] == "Aluno"){return redirect()->route('aluno.home');}
            else{return redirect()->route('professor.home');}
        } else {
            return redirect()->route('login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_start();
        session_destroy();
        return redirect()->route('login', ['erro' => 6]);
    }
}
