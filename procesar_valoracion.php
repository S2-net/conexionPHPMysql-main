<?php
session_start();
require("conexion.php");

$con = conectar_bd(); // Conectar a la base de datos

if (isset($_POST['id_residencia']) && isset($_POST['puntuacion'])) {
    // Obtener los datos enviados por AJAX
    $id_residencia = $_POST['id_residencia'];
    $puntuacion = $_POST['puntuacion'];

    // Si el usuario está logueado, obtener su id
    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

    // Verificar si el usuario ya ha dejado una valoración
    $query_check = "SELECT id_valoracion FROM valoracion WHERE id_residencia = ? AND id_usuario = ?";
    $stmt_check = $con->prepare($query_check);
    $stmt_check->bind_param("ii", $id_residencia, $id_usuario);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // El usuario ya ha valorado, así que actualizamos la valoración
        $query_update = "UPDATE valoracion SET puntuacion = ? WHERE id_residencia = ? AND id_usuario = ?";
        $stmt_update = $con->prepare($query_update);
        $stmt_update->bind_param("iii", $puntuacion, $id_residencia, $id_usuario);
        $stmt_update->execute();
        // No necesitamos echo, simplemente actualizamos sin mensaje.
    } else {
        // El usuario no ha valorado antes, insertamos la valoración
        $query_insert = "INSERT INTO valoracion (id_residencia, id_usuario, puntuacion) 
                         VALUES (?, ?, ?)";
        $stmt_insert = $con->prepare($query_insert);
        $stmt_insert->bind_param("iii", $id_residencia, $id_usuario, $puntuacion);
        $stmt_insert->execute();
        // No necesitamos echo, simplemente insertamos sin mensaje.
    }

    $stmt_check->close();
    $stmt_update->close();
    $stmt_insert->close();
}

mysqli_close($con);
?>
