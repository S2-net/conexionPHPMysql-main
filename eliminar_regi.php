<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require("conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(403);
    echo json_encode(['message' => 'No autorizado']);
    exit;
}

$conn = conectar_bd();
$id_usuario = $_SESSION['id_usuario'];

$query = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
$consulta = mysqli_query($conn, $query);

if ($consulta) {
    echo json_encode(['message' => 'Cuenta eliminada con éxito.']);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Hubo un error al eliminar la cuenta: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
