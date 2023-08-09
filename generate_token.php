<?php
require_once 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Comprobar si el formulario de recuperación se ha enviado
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    echo $email;

    // Generar un token único
    $token = bin2hex(random_bytes(10));

    // Insertar el token en la base de datos para el usuario
    $stmt = $cnnPDO->prepare("UPDATE Usuarios SET TokenRecuperacion = :token WHERE CorreoElectronico = :email");
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alberto@ingenieria2023.space';
        $mail->Password = 'Alberto-cazares12';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('alberto@ingenieria2023.space', 'Eventos Corp');
        $mail->addAddress('d.a.g.c.4652@gmail.com'); // Correo del usuario

        $mail->isHTML(true);
        $mail->Subject = 'Recuperación de Contraseña';
        $mail->Body = "Para restablecer tu contraseña, haz clic en el siguiente enlace: <a href='http://localhost/gabriel/reset_password.php?email=$email&token=$token'>Restablecer Contraseña</a>";


        $mail->send();
        $mail->SmtpClose();
        //echo 'Correo de recuperación enviado correctamente.';
        header("Location: login.php?mensaje='Checa tu correo electronico para cambiar la contraseña'");
    } catch (Exception $e) {
        echo "Error al enviar el correo de recuperación: {$mail->ErrorInfo}";
    }
}
?>