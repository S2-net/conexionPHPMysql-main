<?php
require("conexion.php");

$con = conectar_bd();

// Comprobar que se envió un formulario por POST desde carga_datos
if (isset($_POST["envio"])) {

    //DATOS DE LA RESIDENCIA
    $nombreresi =  $_POST["nombreresi"];
    $descripcion= $_POST["descripcion"];
    $precio= $_POST["precio"];
    $normas= $_POST["normas"];

    //DATOS DE LA HABITACION DE RESIDENCIA
    $detalles = $_POST["detalles"];
    $disponibilidad = $_POST["disponibilidad"];
    $banios = $_POST["banios"];

    insertar_datos($con, $nombreresi, $descripcion, $precio, $normas, $detalles, $disponibilidad, $banios);
}





function insertar_datos($con, $nombreresi, $descripcion, $precio, $normas, $detalles, $disponibilidad, $banios) {
    // Insertar en la tabla Residencia
    $consulta_insertar_residencia = "INSERT INTO residencia (nombreresi, descripcion, precio, normas) VALUES ('$nombreresi', '$descripcion', '$precio', '$normas')";

    if (mysqli_query($con, $consulta_insertar_residencia)) {

        // Traer el último id insertado de residencia
        $id_residencia = mysqli_insert_id($con);

        // Insertar la habitación asociada a esa residencia
        $consulta_insertar_habitacion = "INSERT INTO habitaciones (id_residencia, detalles, disponibilidad, banios) 
                                         VALUES ('$id_residencia', '$detalles', '$disponibilidad', '$banios')";
        
        $consulta_insertar_propietario = "INSERT INTO propietario (id_residencia, ) 
                                          VALUES ('$id_residencia')";

        if (mysqli_query($con, $consulta_insertar_habitacion)) {
            header("Location: perfil-propietario.php");
        } else {
            echo "Error al insertar la habitación: " . mysqli_error($con);
        }

    } else { 
        echo "Error al insertar la residencia: " . mysqli_error($con);
    }
}
?>
