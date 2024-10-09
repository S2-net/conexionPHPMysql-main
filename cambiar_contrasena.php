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
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Comprobar si la nueva contraseña y la confirmación coinciden
    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "La nueva contraseña y la confirmación no coinciden.";
        exit();
    }

    // Consulta para obtener la contraseña actual del usuario
    $sql = "SELECT contrasenia FROM usuario WHERE correo = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $hash_contrasenia = $fila['contrasenia'];

        // Verificar la contraseña actual
        if (password_verify($contrasena_actual, $hash_contrasenia)) {
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
        } else {
            echo "La contraseña actual es incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
    $con->close();
}
?>
