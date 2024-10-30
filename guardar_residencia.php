<?php
require("conexion.php");

$data = json_decode(file_get_contents("php://input"), true);
$id_residencia = $data['id_residencia'] ?? null;
$id_usuario = $data['id_usuario'] ?? null;

if ($id_residencia && $id_usuario) {
    // Verificar si ya existe en favoritos
    $query_check = "SELECT * FROM favoritos WHERE id_usuario = ? AND id_residencia = ?";
    $stmt_check = $con->prepare($query_check);
    $stmt_check->bind_param("ii", $id_usuario, $id_residencia);
    $stmt_check->execute();
    $resultado = $stmt_check->get_result();

    if ($resultado->num_rows > 0) {
        // Ya existe, devolver un mensaje
        echo json_encode(['success' => false, 'error' => 'Esta residencia ya está guardada.']);
    } else {
        // No existe, insertar en favoritos
        $query_insert = "INSERT INTO favoritos (id_usuario, id_residencia) VALUES (?, ?)";
        $stmt_insert = $con->prepare($query_insert);
        $stmt_insert->bind_param("ii", $id_usuario, $id_residencia);

        if ($stmt_insert->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt_insert->error]);
        }
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID no recibido']);
}
?>
