<?php
session_start();
require("conexion.php"); // Asegúrate de que este archivo establece la conexión y define $conexion

// Verifica si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['id_usuario'])) {
    die('Error: Usuario no autenticado');
}

$id_usuario = $_SESSION['id_usuario'];

if (isset($_FILES["foto"])) { // El input del archivo debe coincidir con el nombre que tienes en el formulario
    $file = $_FILES["foto"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $carpeta = "fotos/";

    // Validaciones de tipo de archivo y tamaño
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png') {
        echo "Error: el archivo no es una imagen";
    } elseif ($size > 3*1024*1024) {
        echo "Error: el tamaño máximo permitido es 3MB";
    } else {
        // Mover el archivo subido a la carpeta de destino
        $src = $carpeta . $nombre;
        move_uploaded_file($ruta_provisional, $src);

        // Guarda la ruta de la imagen para almacenar en la base de datos
        $imagen = "fotos/" . $nombre;

        // Actualiza la foto de perfil del usuario en la base de datos
        $query = mysqli_query($conexion, "UPDATE usuario SET foto = '$imagen' WHERE id_usuario = '$id_usuario'");

        // Redirigir después de subir la foto
        header('location: perfil-propietario.php');
        exit(); // Asegúrate de que el script se detenga aquí
    }
}
?>
