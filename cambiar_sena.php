<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <h1>Cambiar Contraseña</h1>
    <form id="change-password-form" action="actualizar_contrasena.php" method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
        <label for="new-password">Nueva Contraseña:</label>
        <input type="password" id="new-password" name="new-password" required>
        <button type="submit">Actualizar Contraseña</button>
    </form>
</body>
</html>
