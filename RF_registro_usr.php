<?php
require("conexion.php");

$con = conectar_bd();

if (isset($_POST["register"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contrasenia = $_POST["contrasenia"];
    $fecha_nacimiento = mysqli_real_escape_string($con, $_POST["fecha_nacimiento"]);
    $genero = trim($_POST["genero"]);

    // Validar si el correo ya existe
    $existe_usr = consultar_existe_usr($con, $correo);

    if ($existe_usr) {
        // Si el correo ya existe, devolver error en JSON
        echo json_encode(["error" => "El correo ya está en uso."]);
        exit();
    }

    // Si no existe, registrar el usuario
    $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);  // Encriptar la contraseña
    $consulta_insertar = "INSERT INTO usuario (nombre, apellido, correo, contrasenia, fecha_nacimiento, genero) 
                          VALUES ('$nombre', '$apellido', '$correo', '$contrasenia', '$fecha_nacimiento', '$genero')";

    if (mysqli_query($con, $consulta_insertar)) {
        // Si se inserta correctamente, devolver éxito en JSON
        echo json_encode(["success" => true]);
    } else {
        // Si hay un error al insertar, devolver error
        echo json_encode(["error" => "Hubo un problema al registrar los datos."]);
    }
}

// Función para consultar si el correo ya existe
function consultar_existe_usr($con, $correo) {
    $correo = mysqli_real_escape_string($con, $correo);
    $consulta_existe_usr = "SELECT correo FROM usuario WHERE correo = '$correo'";
    $resultado_existe_usr = mysqli_query($con, $consulta_existe_usr);

    return mysqli_num_rows($resultado_existe_usr) > 0;
}

mysqli_close($con);
?>
