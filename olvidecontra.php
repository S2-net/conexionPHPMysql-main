<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'conexion.php'; // Incluir el archivo de conexión

// Obtener la conexión
$conn = conectar_bd();

// Consultar destinatarios
$sql = "SELECT correo, nombre FROM usuario"; // Cambia según tu tabla
$result = $conn->query($sql);

// Crear una instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Cambia esto
    $mail->SMTPAuth = true;
    $mail->Username = 'alejo011106@gmail.com'; // Cambia esto
    $mail->Password = 'fsfj elwg ymfa guzx'; // La contraseña de aplicación generada
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Cambia según el método de cifrado
    $mail->Port = 587; // Cambia esto

    while ($row = $result->fetch_assoc()) {
        $mail->clearAddresses();
        $mail->addAddress($row['correo'], $row['nombre']);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Aquí está el asunto';
        $mail->Body = "Hola {$row['nombre']},<br>Este es el mensaje en HTML <b>en negrita!</b>";
        $mail->AltBody = "Hola {$row['nombre']}, este es el cuerpo en texto plano.";

        // Enviar el correo
        $mail->send();
        echo "Mensaje enviado a: {$row['nombre']}<br>";
    }
} catch (Exception $e) {
    echo "Mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
}

// Cerrar la conexión
$conn->close();
