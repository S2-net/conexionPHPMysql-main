<?php
session_start();
require("conexion.php");

$id_usuario = $_SESSION['id_usuario']; // Asegúrate de tener esto configurado correctamente

if (isset($_FILES["foto_perfil"])) {
    $archivo = $_FILES["foto_perfil"];
    $tipo = $archivo["type"];
    $ruta_provisional = $archivo["tmp_name"];
    $size = $archivo["size"];
    $carpeta = "fotos_perfil/";
    $src = $carpeta . $nombre_unico;

    if (($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png') && $size <= 3 * 1024 * 1024) {
        if (move_uploaded_file($ruta_provisional, $src)) {
            $stmt = $con->prepare("UPDATE usuario SET foto_perfil = ? WHERE id_usuario = ?");
            $stmt->bind_param("si", $src, $id_usuario);
            if ($stmt->execute()) {
                echo "Foto de perfil actualizada con éxito.";
            } else {
                echo "Error al actualizar en la base de datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Archivo no válido o demasiado grande.";
    }
} else {
    echo "No se recibió ninguna imagen.";
}
?>
