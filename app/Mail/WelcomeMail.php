<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;  // Variável pública para o nome
    public $senha;  // Variável pública para a senha gerada

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $senha)
    {
        $this->nome = $nome;  // Atribui o nome
        $this->senha = $senha;  // Atribui a senha gerada
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('site.emails.email')  // A view que será usada para o e-mail
                    ->subject('Bem-vindo ao Sistema!')  // Assunto do e-mail
                    ->with([
                        'nome' => $this->nome,  // Passa o nome para a view
                        'senha' => $this->senha,  // Passa a senha para a view
                    ]);
    }
}
