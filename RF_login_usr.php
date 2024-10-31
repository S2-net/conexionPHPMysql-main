<?php 
require("conexion.php");

$con = conectar_bd();

if (isset($_POST["login"])) {
    $correo = mysqli_real_escape_string($con, $_POST["correo"]);
    $contrasenia = $_POST["contrasenia"]; // No es necesario escapar contraseñas

    // Llamada función login
    logear($con, $correo, $contrasenia);
}

function logear($con, $correo, $contrasenia) {
    session_start();

    // Usando prepared statement para evitar inyección SQL
    $stmt = $con->prepare("SELECT * FROM usuario WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado_login = $stmt->get_result();

    if ($resultado_login->num_rows > 0) {
        $fila = $resultado_login->fetch_assoc();
        $password_bd = $fila["contrasenia"];

        if (password_verify($contrasenia, $password_bd)) {
            // Si todo es correcto, inicio la sesión y redirijo a la página principal (index)
            $_SESSION["id_usuario"] = $fila["id_usuario"];
            $_SESSION["nombre"] = $fila["nombre"];
            $_SESSION["correo"] = $correo;
            $_SESSION["genero"] = $fila["genero"];
            $_SESSION["id_rol"] = $fila["id_rol"];

            header("Location: index.php");
            exit();
        } else {
            header("Location: iniregi.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        header("Location: iniregi.php?error=Usuario no encontrado");
        exit();
    }
}
?>
