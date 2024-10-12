<?php
session_start();

// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: iniregi.php");
    exit();
}

// Conectar a la base de datos utilizando la función de 'conexion.php'
$con = conectar_bd();

// Obtener el correo del usuario desde la sesión
$correo = $_SESSION['correo'];

// Consulta para obtener nombre, apellido, género y fecha de nacimiento en base al correo
$sql = "SELECT nombre, apellido, genero, fecha_nacimiento, id_residencia FROM usuario WHERE correo = ?";
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
    $fecha_nacimiento = htmlspecialchars($fila['fecha_nacimiento']);
    $id_residencia = htmlspecialchars($fila['id_residencia']);
} else {
    echo "No se encontraron datos para el usuario.";
}

$stmt->close();
$con->close();
?>