<?php require("conexion.php");

$con = conectar_bd();

if (isset($_POST["login"])) {

    $correo = $_POST["correo"];
    $contrasenia = $_POST["contrasenia"];

    // Llamada funcion login
    logear($con, $correo, $contrasenia);
}

function logear($con, $correo, $contrasenia  ) {

    session_start();

    $consulta_login = "SELECT * FROM usuario WHERE correo= '$correo'";
    $resultado_login = mysqli_query($con, $consulta_login);

    if (mysqli_num_rows($resultado_login) > 0) {

        //se crea una variable con el objeto fetch asoc para acceder a las columnas que necesite
        $fila = mysqli_fetch_assoc($resultado_login);

        //asigno en una variable el campo pass de la BD...
        $password_bd = $fila["contrasenia"];

        //uso la funcion password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD.
        if (password_verify($contrasenia, $password_bd)) {
            
            //si todo es correcto inicio la sesion y redirijo a la pagina principal (index)
            $_SESSION["correo"] = $correo;
            header("Location: index-usuario.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    }
}