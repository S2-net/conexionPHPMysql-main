<?php 
session_start(); 
require("conexion.php");
 // Asegúrate de que el ID del usuario esté en la sesión


$con = conectar_bd(); 
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;


if (isset($_SESSION['id_rol'])) {
    $rol = $_SESSION['id_rol'];

    if ($rol == 1) {
        require("header-usuario.php");
    } elseif ($rol == 2) {
        require("header-propietario.php");
    } else {
        echo "Rol de usuario no reconocido.";
        exit;
    }
} else {
    require("header.php");
}
?>