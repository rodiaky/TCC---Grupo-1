<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Importar Hash
use App\Models\User;

class AlterarSenhaController extends Controller
{
    public function index()
    {
        $email = $_SESSION['email'];
        $usuario = DB::table('users')
            ->select('users.*')
            ->where('users.email', $email)
            ->get();
        $url = url()->previous();

        // Passe os dados para a visão
        return view('site.aluno.alterarSenha', compact('email', 'url'));
    }

    public function update(Request $request)
    {
        // Validar os dados recebidos do formulário
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'novaSenha' => 'required|min:4|confirmed', // Senha mínima de 8 caracteres e confirmação
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obter o usuário logado
        $userEmail = $_SESSION['email'];

        // Verificar se o email corresponde ao email do usuário logado
        if ($userEmail !== $request->input('email')) {
            return redirect()->back()->with('error', 'O e-mail fornecido não corresponde ao e-mail do usuário logado.');
        }

        // Atualizar a senha do usuário com Hash
        DB::table('users')->where('email', $userEmail)->update([
            'password' => Hash::make($request->input('novaSenha')), // Aqui você usa o Hash
        ]);

        // Redirecionar com uma mensagem de sucesso
        $url = $request->input('url');
        return redirect()->to($url);
    }

    public function indexProfessor()
    {
        $email = $_SESSION['email'];
        $usuario = DB::table('users')
            ->select('users.*')
            ->where('users.email', $email)
            ->get();
        $url = url()->previous();

        // Passe os dados para a visão
        return view('site.aluno.alterarSenha', compact('email', 'url'));
    }

    public function updateProfessor(Request $request)
    {
        // Validar os dados recebidos do formulário
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'novaSenha' => 'required|min:8|confirmed', // Senha mínima de 8 caracteres e confirmação
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obter o usuário logado
        $userEmail = $_SESSION['email'];

        // Verificar se o email corresponde ao email do usuário logado
        if ($userEmail !== $request->input('email')) {
            return redirect()->back()->with('error', 'O e-mail fornecido não corresponde ao e-mail do usuário logado.');
        }

        // Atualizar a senha do usuário com Hash
        DB::table('users')->where('email', $userEmail)->update([
            'password' => Hash::make($request->input('novaSenha')), // Aqui você usa o Hash
        ]);

        // Redirecionar com uma mensagem de sucesso
        $url = $request->input('url');
        return redirect()->to($url);
    }
}
