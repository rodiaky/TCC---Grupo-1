<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;

class CustomEmailController extends Controller
{
    public function showForm()
    {
        return view('site.emails.email_form');
    }

    public function sendEmail(Request $request)
    {
        // Valida se o e-mail foi preenchido corretamente
        $request->validate([
            'email' => 'required|email',
        ]);

        // Recupera o e-mail do formulário
        $destinatario = $request->input('email');

        // Verifica se o e-mail existe no banco de dados
        $user = User::where('email', $destinatario)->first();

        if (!$user) {
            // Se o usuário não for encontrado, exibe uma mensagem de erro
            return redirect()->route('send.email.form')->with('error', 'Usuário com esse e-mail não encontrado.');
        }

        // Gera uma senha aleatória
        $senha = $this->generateRandomPassword(8);

        // Atualiza a senha do usuário encontrado
        $user->password = bcrypt($senha);
        $user->save();

        // Envia o e-mail com a nova senha
        $nome = 'Rodrigo';  // Nome do remetente
        Mail::to($destinatario)->send(new WelcomeMail($nome, $senha));

        // Redireciona para a página de login após o envio bem-sucedido
        return redirect()->route('login', ['erro' => 6])->with('success', 'E-mail enviado com sucesso e senha atualizada. Por favor, faça login com a nova senha.');
    }

    // Função para gerar uma senha aleatória
    private function generateRandomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
