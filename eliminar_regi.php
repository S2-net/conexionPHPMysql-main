<?php
// Incluir el archivo de conexión
require("conexion.php");

// Obtener el correo y la contraseña desde el formulario o URL
$correo = $_REQUEST['correo'];
$contrasenia = $_REQUEST['contrasenia'];

// Verificar si el correo y la contraseña fueron proporcionados
if (!$correo || !$contrasenia) {
    die("Por favor, proporcione un correo y una contraseña.");
}

// Conectar a la base de datos usando la función del archivo de conexión
$conn = conectar_bd();

// Sanitizar el correo para evitar inyecciones SQL
$correo = mysqli_real_escape_string($conn, $correo);

// Consulta para buscar por correo
$query = "SELECT * FROM usuario WHERE correo = '$correo'";
$consulta = mysqli_query($conn, $query) or die('Hubo un error en la consulta: ' . mysqli_error($conn));

// Verificar si el correo existe
if (mysqli_num_rows($consulta) < 1) {
    echo 'El alumno con correo ' . $correo . ' no existe.';
} else {
    // Si el correo existe, verificamos la contraseña
    $fila = mysqli_fetch_assoc($consulta);
    $password_bd = $fila['contrasenia']; // Asumiendo que el campo en la base de datos es 'contrasenia'

    // Verificar la contraseña usando password_verify
    if (password_verify($contrasenia, $password_bd)) {
        // Si la contraseña es correcta, eliminar el registro
        $query = "DELETE FROM usuario WHERE correo = '$correo'";
        $consulta = mysqli_query($conn, $query) or die('Hubo un error en la consulta: ' . mysqli_error($conn));
        echo 'El alumno con correo ' . $correo . ' ha sido eliminado.';
    } else {
        // Si la contraseña es incorrecta
        echo 'Contraseña incorrecta.';
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>