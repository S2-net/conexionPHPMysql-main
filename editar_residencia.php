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

    $consulta_actualizar_residencia = "UPDATE residencia SET nombreresi='$nombreresi', descripcion='$descripcion', precio='$precio', normas='$normas' WHERE id_residencia='$id_residencia'";

    if (mysqli_query($con, $consulta_actualizar_residencia)) {
        echo "Residencia actualizada correctamente.";
        header("Location: perfil-propietario.php");
    } else {
        echo "Error al actualizar la residencia: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
