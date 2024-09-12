<?php
session_start();
require 'iniregi.php'; // Asegúrate de que config.php contenga los detalles de conexión a tu base de datos

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) { // Verificamos si se está haciendo el POST desde el login
        // Recogemos los datos del formulario
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $contrasena = $_POST['contrasena'] ?? '';

        if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($contrasena)) {
            // Buscamos al usuario en la base de datos
            $stmt = $pdo->prepare('SELECT * FROM usuario WHERE correo = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Verificamos la contraseña
            if ($user && password_verify($contrasena, $user['contrasenia'])) {
                $_SESSION['user_id'] = $user['id_usuario'];
                echo json_encode(['success' => true, 'message' => 'Login exitoso']);
                
                // Redirigir solo si el login es exitoso
                header('Location: index.php');
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Por favor, complete todos los campos correctamente']);
        }
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
?>