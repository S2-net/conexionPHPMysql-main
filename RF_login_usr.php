<?php
session_start();
ob_start(); // Iniciar el almacenamiento en búfer de salida
include 'conexion.php'; // Incluir la conexión a la base de datos

// Desactivar la visualización de errores para producción
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Establecer el encabezado para que la respuesta sea JSON
header('Content-Type: application/json');

// Verificar si la conexión a la base de datos fue exitosa
if (!$con) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la conexión a la base de datos.']);
    exit;
}

// Verificar el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
    exit;
}

// Capturar los datos enviados por POST
$correo = $_POST['correo'] ?? null;
$contrasenia = $_POST['contrasenia'] ?? null;

// Validar el formato del correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'El correo electrónico no es válido.']);
    exit;
}

// Verificar si los campos están presentes y no vacíos
if (empty(trim($correo)) || empty(trim($contrasenia))) {
    echo json_encode(['status' => 'error', 'message' => 'Correo y contraseña son obligatorios.']);
    exit;
}

// Preparar la consulta a la base de datos
$sql = "SELECT * FROM usuario WHERE correo = ?";
$stmt = $con->prepare($sql);

if ($stmt) {
    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Verificar la contraseña usando password_verify
        if (password_verify($contrasenia, $usuario['contrasenia'])) {
            // Iniciar sesión
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['id_rol'] = $usuario['id_rol']; // Guardar el rol del usuario en la sesión
            echo json_encode(['status' => 'success']);
        } else {
            // Contraseña incorrecta
            echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta.']);
        }
    } else {
        // Correo no encontrado
        echo json_encode(['status' => 'error', 'message' => 'El correo no está registrado.']);
    }
    $stmt->close(); // Cerrar la declaración
} else {
    // Error en la preparación de la consulta
    echo json_encode(['status' => 'error', 'message' => 'Error en la consulta a la base de datos.']);
}

$con->close(); // Cerrar la conexión a la base de datos
ob_end_flush(); // Limpia el búfer de salida y devuelve la respuesta
?>