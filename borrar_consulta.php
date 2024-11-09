<?php
session_start();  // Inicia la sesión

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Redirige a la página de inicio de sesión si no está logueado
    header("Location: iniregi.php");
    exit();
}

require_once("conexion.php");  // Asegúrate de incluir la conexión a la base de datos

// Conectar a la base de datos
$conn = conectar_bd();

// Verifica si la conexión fue exitosa
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verifica si se recibió el ID de la consulta
if (isset($_POST['id'])) {
    $id_consulta = $_POST['id'];

    // Prepara la consulta SQL para borrar la consulta de la base de datos
    $sql = "DELETE FROM consultas WHERE id = ?";

    // Prepara la sentencia
    $stmt = $conn->prepare($sql);

    // Vincula el parámetro
    $stmt->bind_param("i", $id_consulta);  // El ID de la consulta es un entero

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Redirige de nuevo al perfil con un mensaje de éxito
        header("Location: perfil-propietario.php?mensaje=Consulta eliminada con éxito");
    } else {
        // Si la ejecución falla, muestra un error
        echo "Error al eliminar la consulta: " . $stmt->error;
    }
} else {
    echo "ID de consulta no válido.";
}
?>
