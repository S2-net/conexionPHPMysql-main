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

    // Consultar si el usuario ya tiene un id_residencia
    $consulta_residencia = "SELECT id_residencia FROM usuario WHERE id_usuario = '$id_usuario'";
    $resultado_residencia = mysqli_query($con, $consulta_residencia);
    $row = mysqli_fetch_assoc($resultado_residencia);

    if ($row && !empty($row['id_residencia'])) {
        // Mostrar alerta y recargar la página
        echo "<script>alert('Solo puedes cargar una residencia.'); window.location.href='body-carga.php';</script>";
        exit();
    } else {
        // DATOS DE LA RESIDENCIA
        $nombreresi = $_POST["nombreresi"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $normas = $_POST["normas"];
        $tipoo = trim($_POST["tipo"]);
        $latitud = $_POST["latitud"];
        $longitud = $_POST["longitud"];
        
        // Inserción de la residencia en la base de datos (incluyendo latitud y longitud)
        $consulta_insertar_residencia = "INSERT INTO residencia (nombreresi, descripcion, precio, normas, id_usuario, tipo, latitud, longitud) 
                                         VALUES ('$nombreresi', '$descripcion', '$precio', '$normas', '$id_usuario', '$tipoo', '$latitud', '$longitud')";
        
        if (mysqli_query($con, $consulta_insertar_residencia)) {
            // Obtener el último id_residencia insertado
            $id_residencia = mysqli_insert_id($con);

            echo "Residencia insertada correctamente.<br>";

            // Actualizar el id_residencia en la tabla de usuarios
            $consulta_actualizar_usuario = "UPDATE usuario SET id_residencia = '$id_residencia' WHERE id_usuario = '$id_usuario'";
            
            if (mysqli_query($con, $consulta_actualizar_usuario)) {
                echo "ID de residencia actualizado en el perfil del usuario.<br>";
            } else {
                echo "Error al actualizar el ID de residencia en el perfil del usuario: " . mysqli_error($con);
            }

            // Manejar las fotos
            if (isset($_FILES["fotos"])) {
                $files = $_FILES["fotos"];
                $cantidad_fotos = count($files["name"]);

                for ($i = 0; $i < $cantidad_fotos; $i++) {
                    $nombre = $files["name"][$i];
                    $tipo = $files["type"][$i];
                    $ruta_provisional = $files["tmp_name"][$i];
                    $size = $files["size"][$i];
                    $carpeta = "fotos/";

                    // Verifica que el archivo sea una imagen y el tamaño
                    if (($tipo == 'image/jpg' || $tipo == 'image/jpeg' || $tipo == 'image/png') && $size <= 3*1024*1024) {
                        $src = $carpeta.$nombre;
                        if (move_uploaded_file($ruta_provisional, $src)) {
                            // Insertar la ruta de la imagen en la base de datos
                            $consulta_insertar_foto = "INSERT INTO fotos_residencia (id_residencia, ruta_foto) 
                                                       VALUES ('$id_residencia', '$src')";
                            mysqli_query($con, $consulta_insertar_foto);
                        }
                    }
                }
            }

            // Insertar la habitación asociada a esa residencia
            $detalles = $_POST["detalles"];
            $disponibilidad = $_POST["disponibilidad"];
            $banios = $_POST["banios"];
            
            $consulta_insertar_habitacion = "INSERT INTO habitaciones (id_residencia, detalles, disponibilidad, banios) 
                                             VALUES ('$id_residencia', '$detalles', '$disponibilidad', '$banios')";
            
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
    }
}

mysqli_close($con);
?>
