<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'conexion.php'; // Asegúrate de tener tu conexión a la base de datos

$con = conectar_bd();

if (isset($_POST["enviar"])) {
    $correo = $_POST["correo"];

    // Verificar si el correo existe en la base de datos
    $stmt = $con->prepare("SELECT nombre FROM usuario WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nombre = $fila["nombre"];

        // Generar un token único
        $token = bin2hex(random_bytes(16));
        $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar el token en la base de datos (puedes crear una tabla `reset_password`)
        $sql = "INSERT INTO cambiar_contra (correo, token, expiracion) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $correo, $token, $expiracion);
        $stmt->execute();

        // Crear el enlace de restablecimiento
// Crear el enlace de restablecimiento
$enlace = "http://localhost/conexionPHPMysql-main/cambiar_sena.php?token=" . $token;

        // Configurar PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alejo011106@gmail.com'; // Cambia esto
            $mail->Password = 'fsfj elwg ymfa guzx'; // Usa la contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configurar el correo
            $mail->setFrom('alejo011106@gmail.com', 'Alejo');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de Contraseña';
            $mail->Body = "Hola $nombre,<br>Haz clic en el siguiente enlace para restablecer tu contraseña: <a href='$enlace'>$enlace</a>";
            $mail->AltBody = "Hola $nombre, haz clic en el siguiente enlace para restablecer tu contraseña: $enlace";

            // Enviar el correo
            $mail->send();
            echo "Se ha enviado un enlace para restablecer tu contraseña a $correo.";
        } catch (Exception $e) {
            echo "Mensaje no pudo ser enviado. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "El correo no está registrado.";
    }

    // Cerrar la conexión
    $stmt->close();
    $con->close();
}
?>
