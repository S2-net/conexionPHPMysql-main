<?php
session_start();

// Verificar que el usuario ha iniciado sesión


// Los datos del usuario están en la sesión
$nombre = htmlspecialchars($_SESSION['nombre']);
$correo = htmlspecialchars($_SESSION['correo']);
$genero = htmlspecialchars($_SESSION['genero']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <section class="perfil-usuario">
        <div class="contendor-perfil">
            <div class="portada-perfil" style="background-image: url(http://localhost/conexionPHPMysql-main/images/resi4.jpeg);">
                <div class="avatar-perfil">
                    <img src="http://localhost/conexionPHPMysql-main/images/user.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <div class="datosresi1">
    <div class="nombreusu">
        <h1>Nombre de usuario: <?php echo $nombre; ?></h1>
        <br>
        <p>Correo: <?php echo $correo; ?></p>
        <br>
        <p>Género: <?php echo $genero; ?></p>
    </div>

    <button class="button" type="button" onclick="abrirModal(1)">
        <span class="button__text">Borrar Cuenta</span>
        <span class="button__icon">
            <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                <title></title>
                <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
            </svg>
        </span>
    </button>
    </div>
</body>
<div id="modal1" class="modal">
  <span class="close" onclick="cerrarModal(1)">&times;</span>
  <h2>Eliminar Cuenta</h2>

  <form action="eliminar_regi.php" method="POST">
    <input type="email" name="correo" placeholder="Introduce tu correo" required>
    <input type="password" name="contrasenia" placeholder="Introduce tu contraseña" required>
    <button type="submit">Eliminar cuenta</button>
  </form>
</div>

<script src="modal_borrar_cuenta.js"></script>
</html>
