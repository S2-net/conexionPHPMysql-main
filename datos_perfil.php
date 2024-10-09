<?php
session_start();

// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: login.php");
    exit();
}

// Conectar a la base de datos utilizando la función de 'conexion.php'
$con = conectar_bd();

// Obtener el correo del usuario desde la sesión
$correo = $_SESSION['correo'];

// Consulta para obtener el nombre, apellido y género en base al correo
$sql = "SELECT nombre, apellido, genero FROM usuario WHERE correo = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $nombre = htmlspecialchars($fila['nombre']);
    $apellido = htmlspecialchars($fila['apellido']);
    $genero = htmlspecialchars($fila['genero']);
} else {
    echo "No se encontraron datos para el usuario.";
}

$stmt->close();
$con->close();
?>
