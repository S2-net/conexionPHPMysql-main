<?php

session_start();
include("conexion.php"); // Asegúrate de que la ruta sea correcta

// Verificar si la conexión fue exitosa
if (!$con) {
    die("Error en la conexión a la base de datos.");
}

if (isset($_POST['login'])) {
    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];

    // Consulta a la base de datos para verificar el usuario
    $query = "SELECT * FROM usuario WHERE correo = ? AND contrasenia = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $correo, $contrasenia);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobar si se encontró el usuario
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contrasenia, $user['contrasenia'])) {
            // Contraseña correcta, redirigir
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://localhost/pruebasrepay/images/ICONO.png" type="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
    <title>Inicio de sesión | Registro</title>
</head>
<body class="iniregibody">
    <div class="containerIR" id="containerIR">
        <div class="form-containerIR sign-up">
            <form method="post" action="registrar.php">
                <div class="h1iniregi">
                    <h1>Crear Cuenta</h1>
                </div>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña" required minlength="8" maxlength="12">
                <input type="date" id="edad" name="edad" required>
                <select name="genero" id="genero">
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="0">Otro</option>
                </select>
                <button type="submit" name="register">Crear Cuenta</button>
            </form>
            <?php include("registrar.php"); ?>
        </div>

        <div class="form-containerIR sign-in">
            <form method="post" action="iniregi.php">
                <div class="h1iniregi">
                    <h1>Iniciar Sesión</h1>
                </div>
                <input type="email" name="correo" placeholder="Correo Electrónico" required>
                <input type="password" name="contrasenia" placeholder="Contraseña" required>
                <a href="#">Olvidaste tu contraseña?</a>
                <button type="submit" name="login">Iniciar Sesión</button>
            </form>
        </div>

        <div class="toggle-containerIR">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img src="http://localhost/conexionPHPMysql-main/images/logosinfondohd1.png" alt="">
                    <h1>Bienvenido!</h1>
                    <p>Ingrese sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="login">Inicia Sesion</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="http://localhost/conexionPHPMysql-main/images/logosinfondohd1.png" alt="">
                    <h1>Bienvenido!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="register">Registrate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="iniregi.js"></script>
</body>
</html>
