<?php
require("conexion.php");

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: iniregi.php");
    exit();
}

$con = conectar_bd();

// Comprobar que se envió un formulario por POST desde carga_datos
if (isset($_POST["envio"])) {
    // Obtener el id_usuario de la sesión
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de que este valor esté definido

    // DATOS DE LA RESIDENCIA
    $nombreresi = $_POST["nombreresi"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $normas = $_POST["normas"];

    // DATOS DE LA HABITACION DE RESIDENCIA
    $detalles = $_POST["detalles"];
    $disponibilidad = $_POST["disponibilidad"];
    $banios = $_POST["banios"];

    insertar_datos($con, $nombreresi, $descripcion, $precio, $normas, $detalles, $disponibilidad, $banios, $id_usuario);
}

function insertar_datos($con, $nombreresi, $descripcion, $precio, $normas, $detalles, $disponibilidad, $banios, $id_usuario) {
    // Insertar en la tabla Residencia
    $consulta_insertar_residencia = "INSERT INTO residencia (nombreresi, descripcion, precio, normas, id_usuario) 
                                     VALUES ('$nombreresi', '$descripcion', '$precio', '$normas', '$id_usuario')";

    if (mysqli_query($con, $consulta_insertar_residencia)) {

        // Traer el último id insertado de residencia
        $id_residencia = mysqli_insert_id($con);

        // Insertar la habitación asociada a esa residencia
        $consulta_insertar_habitacion = "INSERT INTO habitaciones (id_residencia, detalles, disponibilidad, banios) 
                                         VALUES ('$id_residencia', '$detalles', '$disponibilidad', '$banios')";

        if (mysqli_query($con, $consulta_insertar_habitacion)) {
            
            // Traer el id de la habitación insertada
            $id_habitacion = mysqli_insert_id($con);

            // Actualizar la residencia con el id de la habitación
            $actualizar_residencia = "UPDATE residencia SET id_habitacion = '$id_habitacion' WHERE id_residencia = '$id_residencia'";

            // Actualizar el id_residencia en la tabla usuario
            $actualizar_usuario = "UPDATE usuario SET id_residencia = '$id_residencia' WHERE id_usuario = '$id_usuario'";

            // Ejecutar las actualizaciones
            if (mysqli_query($con, $actualizar_residencia) && mysqli_query($con, $actualizar_usuario)) {
                header("Location: perfil-propietario.php");
            } else {
                echo "Error al actualizar la residencia o el usuario: " . mysqli_error($con);
            }

        } else {
            echo "Error al insertar la habitación: " . mysqli_error($con);
        }

    } else { 
        echo "Error al insertar la residencia: " . mysqli_error($con);
    }
}
?>
