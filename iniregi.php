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

    <!-- Cartel de error por encima del contenido del body -->
    <div id="errorMessages" class="error-message" style="display: none; color: red; text-align: center; margin-bottom: 20px;"></div>

    <div class="containerIR" id="containerIR">
        <div class="form-containerIR sign-up">
            <form id="registroForm" action="RF_registro_usr.php" method="POST">
                <div class="h1iniregi">
                    <h1>Crear Cuenta</h1>
                </div>
                
                <!-- Campo de entrada del nombre -->
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                
                <!-- Campo de entrada del apellido -->
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                
                <!-- Campo de entrada del correo -->
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                
                <!-- Campo de entrada de la contraseña -->
                <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña" required minlength="8" maxlength="12">
                
                <!-- Campo de entrada de la fecha de nacimiento -->
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                
                <!-- Selección del género -->
                <select name="genero" id="genero">
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="0">Otro</option>
                </select>
                
                <!-- Botón de creación de cuenta -->
                <button type="submit" name="register">Crear Cuenta</button>
            </form>
        </div>

        <div class="form-containerIR sign-in">
            <form id="loginForm" action="RF_login_usr.php" method="POST">
                <div class="h1iniregi">
                    <h1>Iniciar Sesión</h1>
                </div>
                <input type="email" name="correo" placeholder="Correo Electrónico" required>
                <input type="password" name="contrasenia" placeholder="Contraseña" required>
                <a href="olvidecontra.php">Olvidaste tu contraseña?</a>
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

    <!-- Enlaces a los scripts necesarios -->
    <script src="iniregi.js"></script>
    <script src="cartel-error-regi.js"></script> 
    <script src="cartel-error-ini.js"></script>


</body>
</html>