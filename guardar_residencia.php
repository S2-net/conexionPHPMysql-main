

<?php
require("conexion.php");
session_start(); // Iniciar sesión

$data = json_decode(file_get_contents("php://input"), true);
$id_residencia = $data['id_residencia'] ?? null;

// Verificar si el usuario está logueado
$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    // Si no hay usuario en sesión, devolver un mensaje de error específico
    echo json_encode(['success' => false, 'error' => 'no_session']);
    exit;
}

if ($id_residencia && $id_usuario) {
    // Verificar si ya existe en favoritos
    $query_check = "SELECT 1 FROM favoritos WHERE id_usuario = ? AND id_residencia = ?";
    $stmt_check = $con->prepare($query_check);
    $stmt_check->bind_param("ii", $id_usuario, $id_residencia);
    $stmt_check->execute();
    $resultado = $stmt_check->get_result();

    if ($resultado->num_rows > 0) {
        // Eliminar de favoritos si ya está guardado
        $query_delete = "DELETE FROM favoritos WHERE id_usuario = ? AND id_residencia = ?";
        $stmt_delete = $con->prepare($query_delete);
        $stmt_delete->bind_param("ii", $id_usuario, $id_residencia);
        $success = $stmt_delete->execute();
        echo json_encode(['success' => $success, 'action' => 'removed']);
    } else {
        // Guardar en favoritos si no está guardado
        $query_insert = "INSERT INTO favoritos (id_usuario, id_residencia) VALUES (?, ?)";
        $stmt_insert = $con->prepare($query_insert);
        $stmt_insert->bind_param("ii", $id_usuario, $id_residencia);
        $success = $stmt_insert->execute();
        echo json_encode(['success' => $success, 'action' => 'saved']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID no recibido']);
}
?>

