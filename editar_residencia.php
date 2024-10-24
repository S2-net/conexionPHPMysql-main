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

    $consulta_actualizar_residencia = "UPDATE residencia SET nombreresi='$nombreresi', descripcion='$descripcion', precio='$precio', normas='$normas' WHERE id_residencia='$id_residencia'";

    $consulta_insertar_habitacion = "UPDATE habitaciones SET detalles='$detalles', disponibilidad='$disponibilidad', banios='$banios' WHERE id_residencia='$id_residencia'";                                        
        
        if (mysqli_query($con, $consulta_insertar_habitacion)) {
            echo "Habitación insertada correctamente.<br>";
            
            // Redirigir a otra página o mostrar mensaje de éxito
            header("Location: perfil-propietario.php");
        } else {
            echo "Error al insertar la habitación: " . mysqli_error($con);
        }

    } else {
        echo "Error al insertar la residencia: " . mysqli_error($con);
    }


mysqli_close($con);
?>

