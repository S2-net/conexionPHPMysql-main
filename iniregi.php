<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://localhost/pruebasrepay/images/ICONO.png" type="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="iniregi.css">
    <title>Inicio de sesion | Registro</title>
</head>

<body class="iniregibody">

    <div class="containerIR" id="containerIR">
        <div class="form-containerIR sign-up">
        <form method="post" action="">
    <div class="h1iniregi">
        <h1>Crear Cuenta</h1>
    </div>
    
    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
    <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
    <input type="email" id="gmail" name="gmail" placeholder="Correo Electrónico" required>
    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required minlength="8" maxlength="12">
    <input type="date" id="edad" name="edad" required>
    
    <select name="genero" id="genero">
        <option value="male">Masculino</option>
        <option value="female">Femenino</option>
        <option value="other">Otro</option>
    </select>
    
    <button type="submit" name="register">Crear Cuenta</button>
</form>

            <?php

          include("registrar.php")

             ?>
          
        </div>
        <div class="form-containerIR sign-in">
        <form method="post" action="iniciosesion.php">
    <div class="h1iniregi">
        <h1>Iniciar Sesión</h1>
    </div>
    <input type="email" name="email" placeholder="Correo Electrónico" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <a href="#">Olvidaste tu contraseña?</a>
    <button type="submit" name="login">Iniciar Sesión</button>
</form>
        </div>
        <div class="toggle-containerIR">
            <div class="toggle">
                <div class="toggle-panel toggle-left">

                    <img src="http://localhost/pruebasrepay/images/logosinfondohd1.png" alt="">

                    <h1>Bienvenido!</h1>
                    <p>Ingrese sus datos personales para utilizar todas las funciones del sitio
                    </p>
                    <button class="hidden" id="login">Inicia Sesion</button>
                </div>
                <div class="toggle-panel toggle-right">

                    <img src="http://localhost/pruebasrepay/images/logosinfondohd1.png" alt="">

                    <h1>Hola, amigo!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio
                    </p>
                    <button class="hidden" id="register">Registrate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="iniregi.js"></script>
</body>

</html>