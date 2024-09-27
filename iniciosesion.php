<!-- php 
session_start();
include("conexion.php"); // Incluir la conexión
require 'iniregi.php'; // Asegúrate de que config.php contenga los detalles de conexión a tu base de datos

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) { // Verificamos si se está haciendo el POST desde el login
        // Recogemos los datos del formulario
        $correo = trim($_POST['correo']);
        $contrasenia = trim($_POST['contrasenia']);

        if (filter_var($correo, FILTER_VALIDATE_EMAIL) && !empty($contrasenia)) {
            // Buscamos al usuario en la base de datos
            $stmt = $con->prepare('SELECT * FROM usuario WHERE correo = ?');
            $stmt->bind_param('s', $correo);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // Verificamos la contraseña
            if ($user && password_verify($contrasenia, $user['contrasenia'])) {
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
