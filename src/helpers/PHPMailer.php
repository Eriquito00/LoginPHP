<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../vendor/autoload.php";

function enviarCorreu($subjecte, $email, $missatge){
    $mail = new PHPMailer(true);
    try {
        $config = require __DIR__ . "/../config.php";
        // Configuració del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = $config['SMTP_HOST'] ?? throw new Exception("Les dades de 'SMTP_HOST' no son valides, exemple: 'smtp.example.com'");
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['SMTP_USER'] ?? throw new Exception("Les dades de 'SMTP_USER' no son valides, exemple: 'user@example.com'");
        $mail->Password   = $config['SMTP_PASS'] ?? throw new Exception("Les dades de 'SMTP_PASS' no son valides, exemple: 'yourpassword'");
        $mail->SMTPSecure = $config['SMTP_SECURE'] ?? throw new Exception("Les dades de 'SMTP_SECURE' no son valides, exemple: 'tls'");
        $mail->Port       = $config['SMTP_PORT'] ?? throw new Exception("Les dades de 'SMTP_PORT' no son valides, exemple: 587");

        $mail->setFrom($mail->Username);
        $mail->addAddress($email);

        // Contingut de l'email
        $mail->isHTML(true);
        $mail->Subject = $subjecte;
        $mail->Body    = $missatge;

        $mail->send();
        return true;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

?>