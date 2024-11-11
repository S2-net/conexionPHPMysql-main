<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de tener tu conexión a la base de datos

$con = conectar_bd();

if (isset($_POST["enviar"])) {
    $nombre = $_POST["nombre"];
    $correoUsuario = $_POST["correo"]; // Correo del usuario
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

    // Configurar PHPMailer
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'alejo011106@gmail.com'; // Tu correo
        $mail->Password = 'fsfj elwg ymfa guzx'; // Usa la contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el correo
        $mail->setFrom('alejo011106@gmail.com', 'Tu Nombre'); // Tu nombre
        $mail->addAddress('alejo011106@gmail.com'); // Tu correo, donde quieres recibir los mensajes
        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto: $asunto";
        $mail->Body = "Nombre: $nombre<br>Email: $correoUsuario<br>Mensaje: $mensaje";
        $mail->AltBody = "Nombre: $nombre\nEmail: $correoUsuario\nMensaje: $mensaje";

             // Enviar el correo
             $mail->send();
             // Redirigir con el parámetro de éxito
             header("Location: contacto.php?status=success");
             exit();
         } catch (Exception $e) {
             // Redirigir con el parámetro de error
             header("Location: contacto.php?status=error");
             exit();
         }
     }

    // Cerrar la conexión
    $con->close();

?>
