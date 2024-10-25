<?php
require("conexion.php");
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: iniregi.php");
    exit();
}

$con = conectar_bd();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_residencia = $_POST["id_residencia"];
    $nombreresi = $_POST["nombreresi"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $normas = $_POST["normas"];
    $banios = $_POST["banios"];
    $detalles = $_POST["detalles"];
    $disponibilidad = $_POST["disponibilidad"];
    $tipoo = $_POST["tipo"];

    // Consulta para actualizar la residencia
    $consulta_actualizar_residencia = "UPDATE residencia SET nombreresi='$nombreresi', descripcion='$descripcion', precio='$precio', normas='$normas', tipo='$tipoo' WHERE id_residencia='$id_residencia'";

    // Consulta para actualizar la habitación
    $consulta_actualizar_habitacion = "UPDATE habitaciones SET detalles='$detalles', disponibilidad='$disponibilidad', banios='$banios' WHERE id_residencia='$id_residencia'";                                        
        
    // Ejecutar la consulta de actualización de residencia
    if (mysqli_query($con, $consulta_actualizar_residencia)) {
        // Ejecutar la consulta de actualización de habitación
        if (mysqli_query($con, $consulta_actualizar_habitacion)) {
            echo "Residencia y habitación actualizadas correctamente.<br>";
            // Redirigir a otra página o mostrar mensaje de éxito
            header("Location: perfil-propietario.php");
            exit();
        } else {
            echo "Error al actualizar la habitación: " . mysqli_error($con);
        }
    } else {
        echo "Error al actualizar la residencia: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
