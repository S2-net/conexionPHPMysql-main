<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    if (empty($email)) {
        echo "Email es requerido.";
    } else {
        // Aquí deberías generar un token único
        $token = bin2hex(random_bytes(16)); // Genera un token aleatorio

        // Para la demostración, puedes redirigir a una página de restablecimiento
        header("Location: cambiar_sena.php?token=$token&email=" . urlencode($email));
        exit;
    }
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>
