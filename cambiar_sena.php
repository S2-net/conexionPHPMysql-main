<?php
require 'conexion.php'; // Incluir el archivo de conexión
$conn = conectar_bd();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    // Aquí puedes agregar lógica para validar el correo (verificar si existe en la base de datos)
    // y encriptar la nueva contraseña si es necesario.
    
    // Encriptar la nueva contraseña (opcional pero recomendable)
    $nueva_contraseña_encriptada = password_hash($nueva_contraseña, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE usuario SET contrasenia = ? WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nueva_contraseña_encriptada, $correo);

    if ($stmt->execute()) {
        echo "Contraseña cambiada con éxito.";
    } else {
        echo "Error al cambiar la contraseña: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
</head>
<body>
<form action="cambiar_sena.php" method="POST">
    <label for="correo">Correo electrónico:</label>
    <input type="email" name="correo" required>
    
    <label for="nueva_contraseña">Nueva contraseña:</label>
    <input type="password" name="nueva_contraseña" required>

    <input type="submit" value="Cambiar contraseña">
</form>

</body>
</html>
