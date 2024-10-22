<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olvidé mi Contraseña</title>
</head>
<body>
    <h1>Restablecer Contraseña</h1>
    <form id="forgot-password-form" action="reset_password.php" method="POST">
        <label for="email">Ingresa tu correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Enviar enlace para restablecer contraseña</button>
    </form>
    <div id="message"></div>
</body>
</html>
