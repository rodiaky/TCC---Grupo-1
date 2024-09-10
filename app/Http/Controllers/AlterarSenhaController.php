<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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

        // Passe os dados para a visão
        return view('site.aluno.alterarSenha', compact('email'));
    }

    public function update(Request $request)
    {
        // Validar os dados recebidos do formulário
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'novaSenha' => 'required|min:3|confirmed', // Senha mínima de 8 caracteres e confirmação
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obter o usuário logado
        $user = $_SESSION['email'];

        // Verificar se o email corresponde ao email do usuário logado
        if ($user !== $request->input('email')) {
            return redirect()->back()->with('error', 'O e-mail fornecido não corresponde ao e-mail do usuário logado.');
        }

        // Atualizar a senha do usuário
        DB::table('users')->where('email', $user)->update([
            'password' => $request->input('novaSenha'),
        ]);

        // Redirecionar com uma mensagem de sucesso
        return redirect()->route('aluno.alterar_senha')->with('success', 'Senha atualizada com sucesso!');
    }
}
