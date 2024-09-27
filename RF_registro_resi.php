<?php

require("conexion.php");

$con = conectar_bd();

// Comprobar que se envió un formulario por POST desde carga_datos
if (isset($_POST["envio"])) {

    $nombreresi = $_POST["nombreresi"];
    $nrohabitaciones =  $_POST["nro-habitaciones"];
    $tiporesidencia = $_POST["tipo-residencia"];
    $descripcion = $_POST["descripcion"];
    $normas = $_POST["normas"];
    $baños = $_POST["baños"];
   
    // Consultar si el usuario ya existe
    $existe_resi = consultar_existe_usr($con, $email);

    // Insertar datos si el usuario no existe
    insertar_datos($con, $nombre, $apellido, $email, $contrasenia, $existe_usr);

}

function consultar_existe_usr($con, $nombreresi) {

    $nombreresi = mysqli_real_escape_string($con, $nombreresi); // Escapar los campos para evitar inyección SQL
    $consulta_existe_resi = "SELECT nombreresi FROM residencia WHERE nombreresi = '$nombreresi'";
    $resultado_existe_resi = mysqli_query($con, $consulta_existe_resi);

    if (mysqli_num_rows($resultado_existe_resi) > 0) {
        return true;
    } else {
        return false;
    }
}

function insertar_datos($con, $nombre, $apellido, $email, $contrasenia, $existe_usr) {

    if ($existe_usr == false) {
        $nombreCompleto = $nombre . ' ' . $apellido;
        $email = mysqli_real_escape_string($con, $email);

        // Encripto la controaseña usando la función password_hash
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

        $consulta_insertar = "INSERT INTO usuarios (nombrecompleto, email, pass) VALUES ('$nombreCompleto', '$email', '$contrasenia')";

        if (mysqli_query($con, $consulta_insertar)) {
            $salida = consultar_datos($con);
            echo $salida;
        } else {
            echo "Error: " . $consulta_insertar . "<br>" . mysqli_error($con);
        }
    } else {
        echo "El usuario ya existe.";
    }
}

function consultar_datos($con) {
    $consulta = "SELECT * FROM usuarios";
    $resultado = mysqli_query($con, $consulta);

    // Inicializo una variable para guardar los resultados
    $salida = "";

    // Si se encuentra algún registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {
        // Mientras haya registros
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "id: " . $fila["id_user"] . " - Nombre: " . $fila["nombrecompleto"] . " - Email: " . $fila["email"] . "<br> <hr>";
        }
    } else {
        $salida = "Sin datos";
    }

    return $salida;
}

mysqli_close($con);
