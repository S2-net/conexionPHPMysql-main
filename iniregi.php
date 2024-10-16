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
            <form action="RF_registro_usr.php" method="POST" id="formulario">
                <div class="h1iniregi">
                    <h1>Crear Cuenta</h1>
                </div>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre" required maxlength="50">
                <input type="text" id="apellido" name="apellido" placeholder="Apellido" required maxlength="50">
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                <input type="password" id="contrasenia" name="contrasenia" placeholder="Contraseña" required minlength="8" maxlength="12">
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                <select name="genero" id="genero">
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="0">Otro</option>
                </select>
                <button type="submit" name="register">Crear Cuenta</button>
            </form>
        </div>

        <div class="form-containerIR sign-in">
            <form id="loginForm" method="POST" onsubmit="validateForm(event)">
                <div class="h1iniregi">
                    <h1>Iniciar Sesión</h1>
                </div>
                <input type="email" id="correo1" name="correo1" placeholder="Correo Electrónico" required>
                <input type="password" id="password" name="contrasenia" placeholder="Contraseña" required>
                <a href="#">Olvidaste tu contraseña?</a>
                <button type="submit" name="login">Iniciar Sesión</button>
                <p id="errorMsg" style="color:red"></p>
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


    para abajo estan todos los script 

    <script src="iniregi.js"></script>
    <script src="app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        function validateForm(event) {
            event.preventDefault();
            var correo = document.getElementById('correo1').value; // Cambiado a 'correo1'
            var password = document.getElementById('password').value;
            var errorMsg = document.getElementById('errorMsg');

            console.log('Sending request with:', { correo, password });

            $.ajax({
                url: 'RF_login_usr.php',
                type: 'POST',
                data: {
                    login: true,
                    correo1: correo, // Cambiado a 'correo1'
                    contrasenia: password
                },
                success: function(response) {
                    console.log('Received response:', response);
                    if (response.trim() === 'success') {
                        window.location.href = 'index-usuario.php';
                    } else {
                        errorMsg.textContent = 'Contraseña incorrecta. Inténtalo de nuevo.';
                    }
                },
                error: function() {
                    errorMsg.textContent = 'Hubo un error con el servidor. Inténtalo de nuevo más tarde.';
                }
            });
        }

        document.getElementById('formulario').addEventListener('submit', function(event) {
            const correo = document.getElementById('correo').value;
            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const fechaNacimiento = new Date(document.getElementById('fecha_nacimiento').value);
            const hoy = new Date();

            // Validación del correo
            const gmailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            const hotmailRegex = /^[a-zA-Z0-9._%+-]+@hotmail\.com$/;

            if (!gmailRegex.test(correo) && !hotmailRegex.test(correo)) {
                alert('Por favor, ingrese un correo electrónico válido con @gmail.com o @hotmail.com');
                event.preventDefault(); // Evita el envío del formulario
                return;
            }

            // Validación de la fecha de nacimiento
            const edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const mesNacimiento = fechaNacimiento.getMonth();
            const mesActual = hoy.getMonth();
            const diaNacimiento = fechaNacimiento.getDate();
            const diaActual = hoy.getDate();

            if (edad < 18 || edad > 99 || (edad === 18 && (mesNacimiento > mesActual || (mesNacimiento === mesActual && diaNacimiento > diaActual)))) {
                alert('Debes ser mayor de 18 años y menor de 100 años.');
                event.preventDefault(); // Evita el envío del formulario
                return;
            }

            // Validación de nombre y apellido
            const letraRegex = /^[a-zA-Z]+$/;
            if (!letraRegex.test(nombre) || !letraRegex.test(apellido)) {
                alert('El nombre y apellido solo pueden contener letras.');
                event.preventDefault(); // Evita el envío del formulario
                return;
            }
        });
    </script>
</body>
</html>