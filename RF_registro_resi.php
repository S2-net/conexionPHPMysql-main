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
    $id_usuario = $_SESSION['id_usuario']; 

    // DATOS DE LA RESIDENCIA
    $nombreresi = $_POST["nombreresi"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $normas = $_POST["normas"];
    $imagen = ''; // Inicializar imagen

    // Verificar si se subió un archivo
    if (isset($_FILES["foto"])) {
        $file = $_FILES["foto"];
        $nombre = $file["name"];
        $tipo = $file["type"];
        $ruta_provisional = $file["tmp_name"];
        $size = $file["size"];
        $carpeta = "fotos/";

        if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/jpeg' && $tipo != 'image/png') {
            echo "Error: el archivo no es una imagen";
        } else if ($size > 3*1024*1024) {
            echo "Error: el tamaño máximo permitido es 3MB";
        } else {
            $src = $carpeta.$nombre;
            if (move_uploaded_file($ruta_provisional, $src)) {
                echo "Imagen movida correctamente a: ".$src; // Verificar ruta movida
                $imagen = $src; // Asegurarse de que $imagen contiene la ruta completa
            } else {
                echo "Error al mover la imagen.";
            }
        }
    }

    // Verificar si la imagen tiene una ruta asignada
    if (empty($imagen)) {
        echo "Error: No se ha asignado una imagen.";
        return; // Evitar inserción si no hay imagen
    }

    // DATOS DE LA HABITACION DE RESIDENCIA
    $detalles = $_POST["detalles"];
    $disponibilidad = $_POST["disponibilidad"];
    $banios = $_POST["banios"];

    // Mostrar datos antes de insertarlos
    echo "Nombre residencia: $nombreresi, Imagen: $imagen, Descripción: $descripcion, Precio: $precio, Normas: $normas";

    // Inserción en la base de datos
    insertar_datos($con, $nombreresi, $imagen, $descripcion, $precio, $normas, $detalles, $disponibilidad, $banios, $id_usuario);
}

function insertar_datos($con, $nombreresi, $imagen, $descripcion, $precio, $normas, $detalles, $disponibilidad, $banios, $id_usuario) {
    // Insertar en la tabla Residencia
    $consulta_insertar_residencia = "INSERT INTO residencia (nombreresi, foto, descripcion, precio, normas, id_usuario) 
                                     VALUES ('$nombreresi', '$imagen', '$descripcion', '$precio', '$normas', '$id_usuario')";
    echo "<br>Consulta SQL: $consulta_insertar_residencia<br>"; // Depurar consulta SQL

    if (mysqli_query($con, $consulta_insertar_residencia)) {
        echo "Residencia insertada correctamente.<br>";

        // Traer el último id insertado de residencia
        $id_residencia = mysqli_insert_id($con);

        // Insertar la habitación asociada a esa residencia
        $consulta_insertar_habitacion = "INSERT INTO habitaciones (id_residencia, detalles, disponibilidad, banios) 
                                         VALUES ('$id_residencia', '$detalles', '$disponibilidad', '$banios')";
        echo "<br>Consulta SQL: $consulta_insertar_habitacion<br>"; // Depurar consulta SQL

        if (mysqli_query($con, $consulta_insertar_habitacion)) {
            echo "Habitación insertada correctamente.<br>";
            
            // Actualizar la residencia con el id de la habitación
            $id_habitacion = mysqli_insert_id($con);
            $actualizar_residencia = "UPDATE residencia SET id_habitacion = '$id_habitacion' WHERE id_residencia = '$id_residencia'";
            $actualizar_usuario = "UPDATE usuario SET id_residencia = '$id_residencia' WHERE id_usuario = '$id_usuario'";
            
            // Ejecutar las actualizaciones
            if (mysqli_query($con, $actualizar_residencia) && mysqli_query($con, $actualizar_usuario)) {
                echo "Residencia y usuario actualizados correctamente.";
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