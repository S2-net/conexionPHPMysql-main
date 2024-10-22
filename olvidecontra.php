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
    // Configuración del servidor SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Cambia esto
    $mail->SMTPAuth = true;
    $mail->Username = 'user@example.com'; // Cambia esto
    $mail->Password = 'secret'; // Cambia esto
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

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
