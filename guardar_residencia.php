<?php
require("conexion.php"); // Asegúrate de que este archivo esté correcto

// Obtén los datos JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

$id_residencia = $data['id_residencia'] ?? null; // Usa null si no existe
$id_usuario = $data['id_usuario'] ?? null;

if ($id_residencia && $id_usuario) {
    // Inserta la residencia en la tabla favoritos
    $query = "INSERT INTO favoritos (id_usuario, id_residencia) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $id_usuario, $id_residencia);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID no recibido']);
}
?>
