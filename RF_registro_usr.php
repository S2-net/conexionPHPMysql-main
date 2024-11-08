<?php
require("conexion.php");

$con = conectar_bd();

// Comprobar que se envió un formulario por POST desde carga_datos
if (isset($_POST["register"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contrasenia = $_POST["contrasenia"];
    $fecha_nacimiento = mysqli_real_escape_string($con, $_POST["fecha_nacimiento"]);
    $genero = trim($_POST["genero"]);

    // Validación de longitud para nombre y apellido
    if (strlen($nombre) > 50 || strlen($apellido) > 50) {
        header("Location: iniregi.php?error=El nombre y el apellido no pueden tener más de 50 caracteres.");
        exit(); // Detener la ejecución si hay error
    }

    // Consultar si el usuario ya existe
    $existe_usr = consultar_existe_usr($con, $correo);

    // Insertar datos si el usuario no existe
    insertar_datos($con, $nombre, $apellido, $correo, $contrasenia, $fecha_nacimiento, $genero, $existe_usr);
}

function consultar_existe_usr($con, $correo) {
    $correo = mysqli_real_escape_string($con, $correo); // Escapar los campos para evitar inyección SQL
    $consulta_existe_usr = "SELECT correo FROM usuario WHERE correo = '$correo'";
    $resultado_existe_usr = mysqli_query($con, $consulta_existe_usr);

    return mysqli_num_rows($resultado_existe_usr) > 0;
}

function insertar_datos($con, $nombre, $apellido, $correo, $contrasenia, $fecha_nacimiento, $genero, $existe_usr) {
    if (!$existe_usr) {
        $correo = mysqli_real_escape_string($con, $correo);
        
        // Encripto la contraseña usando la función password_hash
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

        $consulta_insertar = "INSERT INTO usuario (nombre, apellido, correo, contrasenia, fecha_nacimiento, genero) 
                              VALUES ('$nombre', '$apellido', '$correo', '$contrasenia', '$fecha_nacimiento', '$genero')";
        
        // Ejecutar la consulta de inserción
        if (mysqli_query($con, $consulta_insertar)) {
            header("Location: iniregi.php"); // Redirigir a la página de registro si se inserta correctamente
            exit();
        } else {
            echo "Error: " . $consulta_insertar . "<br>" . mysqli_error($con);
        }
    } else {
        echo "El usuario ya existe.";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
