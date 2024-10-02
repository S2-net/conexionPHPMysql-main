<?php 
require("conexion.php");

$con = conectar_bd();

if (isset($_POST["login"])) {
    $correo = $_POST["correo"];
    $contrasenia = $_POST["contrasenia"];

    // Llamada función login
    logear($con, $correo, $contrasenia);
}

function logear($con, $correo, $contrasenia) {
    session_start();

    $consulta_login = "SELECT * FROM usuario WHERE correo = '$correo'";
    $resultado_login = mysqli_query($con, $consulta_login);

    if (mysqli_num_rows($resultado_login) > 0) {
        // Se crea una variable con el objeto fetch asoc para acceder a las columnas que necesite
        $fila = mysqli_fetch_assoc($resultado_login);
        
        // Asigno en una variable el campo pass de la BD...
        $password_bd = $fila["contrasenia"];

        // Uso la función password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD.
        if (password_verify($contrasenia, $password_bd)) {
            // Si todo es correcto, inicio la sesión y redirijo a la página principal (index)
            $_SESSION["id_usuario"] = $fila["id_usuario"]; // Agregar ID de usuario
            $_SESSION["nombre"] = $fila["nombre"]; // Almacena el nombre
            $_SESSION["correo"] = $correo; // Correo ya existente
            $_SESSION["genero"] = $fila["genero"]; // Almacena el género
            
            header("Location: index-usuario.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}
?>
