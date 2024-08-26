<?php



define("SMTP_HOST", "sandbox.smtp.mailtrap.io");
define("SMTP_PORT", "2525");
define("SMTP_USER", "bcc267b27391ec");
define("SMTP_PASS", "");

require_once __DIR__.'/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = SMTP_HOST;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = SMTP_USER;                     //SMTP username
    $mail->Password   = SMTP_PASS;                               //SMTP password
    $mail->Port       = SMTP_PORT;         
    //Recipients
    $mail->setFrom('palavrearautenticacao@email.com', 'Palavrear Bauru');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Alteração de senha';
    $mail->Body    = 'Isso é um <b>Teste!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Erro: {$mail->ErrorInfo}";
}