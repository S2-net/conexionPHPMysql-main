<?php
session_start();

// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit();
}

// Leer los datos enviados por el fetch
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_residencia'])) {
    $id_residencia = $data['id_residencia'];

    // Conectar a la base de datos
    $con = conectar_bd();

    // Eliminar las habitaciones asociadas a la residencia
    $sql_eliminar_habitaciones = "DELETE FROM habitaciones WHERE id_residencia = ?";
    $stmt_habitaciones = $con->prepare($sql_eliminar_habitaciones);
    $stmt_habitaciones->bind_param("i", $id_residencia);
    $stmt_habitaciones->execute();

    // Eliminar la residencia
    $sql_eliminar_residencia = "DELETE FROM residencia WHERE id_residencia = ?";
    $stmt_residencia = $con->prepare($sql_eliminar_residencia);
    $stmt_residencia->bind_param("i", $id_residencia);

    if ($stmt_residencia->execute()) {
        // Enviar respuesta en JSON
        echo json_encode(['message' => 'Residencia eliminada exitosamente.']);
    } else {
        // Enviar error en JSON si hay problemas al eliminar la residencia
        echo json_encode(['error' => 'Error al eliminar la residencia: ' . $con->error]);
    }

    $stmt_residencia->close();
    $con->close();
} else {
    // Enviar error en JSON si no se recibió el id_residencia
    echo json_encode(['error' => 'Solicitud inválida.']);
}
?>
