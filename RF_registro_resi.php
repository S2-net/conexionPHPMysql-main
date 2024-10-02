<?php

require("conexion.php");

$con = conectar_bd();

// Comprobar que se envió un formulario por POST desde carga_datos
if (isset($_POST["envio"])) {

    $nombreresi = $_POST["nombreresi"];
    $normas = $_POST["normas"];
    $precio = $_POST["precio"];
   
    // Consultar si la residencia ya existe
    $existe_resi = consultar_existe_resi($con, $nombreresi);

    // Insertar datos si la residencia no existe
    insertar_datos($con, $precio, $nombreresi, $normas, $existe_resi);

}

function consultar_existe_resi($con, $nombreresi) {
    $consulta = "SELECT * FROM residencia WHERE nombreresi = '$nombreresi'";
    $resultado = mysqli_query($con, $consulta);

    // Si existe al menos un registro, significa que la residencia ya existe
    return mysqli_num_rows($resultado) > 0;
}


function consultar_datos($con) {
    $consulta = "SELECT * FROM residencia";
    $resultado = mysqli_query($con, $consulta);

    // Inicializo una variable para guardar los resultados
    $salida = "";

    // Si se encuentra algún registro de la consulta
    if (mysqli_num_rows($resultado) > 0) {
        // Mientras haya registros
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $salida .= "id: " . $fila["id_residencia"] . " - Nombre: " . $fila["nombreresi"] . " - Normas: " . $fila["normas"] . " - Precio: " . $fila["precio"] . "<br> <hr>";
        }
    } else {
        $salida = "Sin datos";
    }

    return $salida;
}

function insertar_datos($con, $precio, $nombreresi, $normas, $existe_resi) {

    if ($existe_resi == false) {

        $consulta_insertar = "INSERT INTO residencia (precio, normas, nombreresi) VALUES ('$precio', '$normas', '$nombreresi')";

        if (mysqli_query($con, $consulta_insertar)) {
            $salida = consultar_datos($con);
            echo $salida;
        } else {
            echo "Error: " . $consulta_insertar . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Ya existe una residencia con este nombre.";
    }
}

mysqli_close($con);
