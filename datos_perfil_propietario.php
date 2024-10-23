<?php
session_start();

// Incluir el archivo de conexión
require_once 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header("Location: iniregi.php");
    exit();
}

// Conectar a la base de datos utilizando la función de 'conexion.php'
$con = conectar_bd();

// Obtener el correo del usuario desde la sesión
$correo = $_SESSION['correo'];

// Consulta para obtener nombre, apellido, género, fecha de nacimiento e id de la residencia
$sql = "SELECT nombre, apellido, genero, fecha_nacimiento, id_residencia FROM usuario WHERE correo = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Obtener los datos del usuario
    $fila = $resultado->fetch_assoc();
    $nombre = htmlspecialchars($fila['nombre']);
    $apellido = htmlspecialchars($fila['apellido']);
    $genero = htmlspecialchars($fila['genero']);
    $fecha_nacimiento = htmlspecialchars($fila['fecha_nacimiento']);
    $id_residencia = htmlspecialchars($fila['id_residencia']);

    // Verificar si el usuario tiene una residencia asociada
    if ($id_residencia) {
        // Consulta para obtener los datos de la residencia
        $sql_residencia = "SELECT residencia.*, habitaciones.*
                           FROM residencia
                           JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia
                           WHERE residencia.id_residencia = ?";
        $stmt_residencia = $con->prepare($sql_residencia);
        $stmt_residencia->bind_param("i", $id_residencia);
        $stmt_residencia->execute();
        $resultado_residencia = $stmt_residencia->get_result();

        if ($resultado_residencia->num_rows > 0) {
            // Obtener los datos de la residencia
            $residencia = $resultado_residencia->fetch_assoc();
            $nombreresi = htmlspecialchars($residencia['nombreresi']);
            $banios = htmlspecialchars($residencia['banios']);
            $disponibilidad = htmlspecialchars($residencia['disponibilidad']);
            $normas = htmlspecialchars($residencia['normas']);
            $detalles = htmlspecialchars($residencia['detalles']);
            $descripcion = htmlspecialchars($residencia['descripcion']);
            
        } else {
            $mensaje = "Aún no se cargó una residencia.";
        }

        $stmt_residencia->close();
    } else {
        $mensaje = "Aún no se cargó una residencia.";
    }
} else {
    echo "No se encontraron datos para el usuario.";
}

$stmt->close();
?>
