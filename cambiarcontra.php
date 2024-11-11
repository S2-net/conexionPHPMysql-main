<?php
session_start();
require 'conexion.php';

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: iniregi.php");
    exit();
}

$con = conectar_bd();
$correo = $_SESSION['correo'];  // Correo del usuario logueado

// Verificar si se envió el formulario
if (isset($_POST['cambiar_contrasena'])) {
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Comprobar si la nueva contraseña y la confirmación coinciden
    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "La nueva contraseña y la confirmación no coinciden.";
        exit();
    }

    // Encriptar la nueva contraseña
    $nueva_contrasenia_hashed = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

    // Actualizar la nueva contraseña en la base de datos
    $sql_update = "UPDATE usuario SET contrasenia = ? WHERE correo = ?";
    $stmt_update = $con->prepare($sql_update);
    $stmt_update->bind_param("ss", $nueva_contrasenia_hashed, $correo);

    if ($stmt_update->execute()) {
        echo "Contraseña actualizada correctamente.";
    } else {
        echo "Error al actualizar la contraseña.";
    }
    
    $stmt_update->close();
    $con->close();
}
?>
