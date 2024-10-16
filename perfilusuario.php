<?php
require("datos_perfil.php"); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    </head>
<body>
    <section class="perfil-usuario">
        <div class="contendor-perfil">
            <div class="portada-perfil" style="background-image: url(http://localhost/conexionPHPMysql-main/images/resi4.jpeg);">
                <div class="avatar-perfil">
                    <img src="http://localhost/conexionPHPMysql-main/images/user.png" alt="">
                    <a href="#" class="cambiar-foto">
                        Cambiar foto
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="tony">
    <div class="datosresi1">
    <div class="nombreusu">
        <h1>Nombre de usuario: <?php echo $nombre . ' ' . $apellido; ?></h1>
        <br>
        <p>Correo: <?php echo $correo; ?></p>
        <br>
        <p>Contraseña: <button type="button" onclick="abrirModal()">Cambiar Contraseña</button></p>
        <br>
        <p>Género: <?php echo $genero; ?></p>
        <br>
        <p>Fecha de Nacimiento: <?php echo $fecha_nacimiento; ?></p>
    </div>

    <button class="button" type="button" onclick="borrarCuenta()">
        <span class="button__text" >Borrar Cuenta</span>
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

    </div>
    

    <section class="cambiar-contrasena" >
       <!-- Modal para cambiar la contraseña -->
<div id="contrasenaModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal(1)">&times;</span>
        <h1>Cambiar Contraseña</h1>
        <form action="cambiar_contrasena.php" method="POST">
            <label for="contrasena_actual">Contraseña Actual:</label>
            <input type="password" id="contrasena_actual" name="contrasena_actual" required>
            <br>
            <label for="nueva_contrasena">Nueva Contraseña:</label>
            <input type="password" id="nueva_contrasena" name="nueva_contrasena" required minlength="8">
            <br>
            <label for="confirmar_contrasena">Confirmar Nueva Contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required minlength="8">
            <br>
            <button type="submit" name="cambiar_contrasena">Cambiar Contraseña</button>
        </form>
    </div>
</div>
    </section>

    

<script src="alerta_cuenta.js"></script>
<script src="modal_cambiar_contrasena.js"></script>


</body>


</html>