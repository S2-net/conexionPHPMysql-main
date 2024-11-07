<?php
session_start();
require("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    // Si el usuario no está autenticado, redirigir a la página de login o mostrar un mensaje de error.
    die("Debes iniciar sesión para dejar un comentario.");
}

$id_usuario = $_SESSION['id_usuario']; // Obtener el ID del usuario desde la sesión

if (isset($_POST['id_residencia'], $_POST['comentario']) && !empty($_POST['id_residencia']) && !empty($_POST['comentario'])) {
    // Obtener los valores del formulario
    $id_residencia = $_POST['id_residencia'];
    $comentario = $_POST['comentario'];

    // Validar que el id_residencia sea un valor numérico válido
    if (!is_numeric($id_residencia)) {
        die("El ID de la residencia no es válido.");
    }

    // Validar que el comentario no esté vacío
    if (empty($comentario)) {
        die("El comentario no puede estar vacío.");
    }

    // Verificar si el id_residencia realmente existe en la tabla residencia
    $residencia_check = "SELECT 1 FROM residencia WHERE id_residencia = ?";
    $stmt_residencia = $con->prepare($residencia_check);
    $stmt_residencia->bind_param("i", $id_residencia);
    $stmt_residencia->execute();
    $stmt_residencia->store_result();

    if ($stmt_residencia->num_rows == 0) {
        die("El ID de la residencia no existe.");
    }

    // Verificar si el id_usuario realmente existe en la tabla usuario
    $usuario_check = "SELECT 1 FROM usuario WHERE id_usuario = ?";
    $stmt_usuario = $con->prepare($usuario_check);
    $stmt_usuario->bind_param("i", $id_usuario);
    $stmt_usuario->execute();
    $stmt_usuario->store_result();

    if ($stmt_usuario->num_rows == 0) {
        die("El usuario no existe.");
    }

    // Preparar y ejecutar la consulta de inserción del comentario
    $consulta_comentario = "INSERT INTO comentarios (id_residencia, id_usuario, comentario) VALUES (?, ?, ?)";
    $stmt_comentario = $con->prepare($consulta_comentario);
    $stmt_comentario->bind_param("iis", $id_residencia, $id_usuario, $comentario);
    
    if ($stmt_comentario->execute()) {
        // Redirigir al usuario a la página de la residencia después de insertar el comentario
        header("Location: residencia.php?id_residencia=" . $id_residencia);
        exit();
    } else {
        die("Error al insertar el comentario: " . $stmt_comentario->error);
    }

    // Cerrar la sentencia preparada
    $stmt_comentario->close();
    $stmt_residencia->close();
    $stmt_usuario->close();
} else {
    die("Por favor, completa todos los campos del formulario.");
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
