<?php
    // Incluyo el archivo de conexión
    require("conexion.php");

    // Conexión a la base de datos
    $con = conectar_bd();

    // Verificar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_usuario = $_POST['id_usuario'];
        $nuevo_tipo = $_POST['tipo_usuario'];

        // Borrar registros anteriores en las tablas de tipo
        $deleteAdmin = "DELETE FROM admin WHERE id_admin = '$id_usuario'";
        $deletePropietario = "DELETE FROM propietario WHERE id_propietario = '$id_usuario'";
        $deleteEstudiante = "DELETE FROM estudiante WHERE id_estudiante = '$id_usuario'";
        mysqli_query($con, $deleteAdmin);
        mysqli_query($con, $deletePropietario);
        mysqli_query($con, $deleteEstudiante);

        // Insertar en la tabla correspondiente al nuevo tipo
        if ($nuevo_tipo == 'Administrador') {
            $insert = "INSERT INTO admin (id_admin) VALUES ('$id_usuario')";
        } elseif ($nuevo_tipo == 'Propietario') {
            $insert = "INSERT INTO propietario (id_propietario) VALUES ('$id_usuario')";
        } elseif ($nuevo_tipo == 'Estudiante') {
            $insert = "INSERT INTO estudiante (id_estudiante) VALUES ('$id_usuario')";
        }

        mysqli_query($con, $insert);

        // Redirigir al panel de usuarios
        header("Location: panel_usuarios.php");
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($con);
?>
