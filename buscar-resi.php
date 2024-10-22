<?php  
// Conexión a la base de datos
include("conexion.php");
$conexion = conectar_bd(); // Asegúrate de que esta función conecta correctamente a tu base de datos

// Validación de entrada
$num_habitaciones = isset($_POST['num_habitaciones']) && $_POST['num_habitaciones'] > 0 ? (int)$_POST['num_habitaciones'] : null;
$num_banos = isset($_POST['num_banos']) && $_POST['num_banos'] > 0 ? (int)$_POST['num_banos'] : null;
$max_precio = isset($_POST['max_precio']) && $_POST['max_precio'] > 0 ? (int)$_POST['max_precio'] : null;
$tipo_residencia = isset($_POST['tipo_residencia']) && !empty($_POST['tipo_residencia']) ? $_POST['tipo_residencia'] : null;

// Construcción de la consulta SQL
$sql = "SELECT r.precio, r.tipo_residencia, r.id_residencia, h.disponibilidad, h.banios
        FROM residencia r
        JOIN habitaciones h ON r.id_residencia = h.id_residencia
        WHERE 1=1"; // Esto permite agregar condiciones dinámicamente

// Arreglo para almacenar los parámetros de la consulta
$params = [];

// Agregar condiciones opcionales
if ($num_habitaciones !== null) {
    $sql .= " AND h.disponibilidad >= ?";
    $params[] = $num_habitaciones;
}

if ($num_banos !== null) {
    // Convierte h.banios a un número para la comparación, si es necesario
    $sql .= " AND CAST(h.banios AS UNSIGNED) >= ?";
    $params[] = $num_banos;
}

if ($max_precio !== null) {
    $sql .= " AND r.precio <= ?";
    $params[] = $max_precio;
}

if ($tipo_residencia !== null) {
    $sql .= " AND r.tipo_residencia = ?";
    $params[] = $tipo_residencia;
}

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($sql);

// Dinámicamente vincular los parámetros
if (!empty($params)) {
    // Crear el tipo de datos de los parámetros
    $types = str_repeat("i", count($params) - 1) . "s"; // Asume que el último parámetro es un string
    $stmt->bind_param($types, ...$params);
} else {
    // Si no hay parámetros, ejecutar la consulta sin parámetros
    $stmt->execute();
}

// Ejecutar la consulta
if ($stmt->execute()) {
    $resultado = $stmt->get_result();
    
    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Mostrar los resultados
        while ($row = $resultado->fetch_assoc()) {
            echo "Precio: $" . htmlspecialchars($row["precio"]) . "<br>";
            echo "Tipo de Residencia: " . htmlspecialchars($row["tipo_residencia"]) . "<br>";
            echo "ID de Residencia: " . htmlspecialchars($row["id_residencia"]) . "<br>"; // Puedes incluir esta columna para más contexto
            echo "Número de Habitaciones: " . htmlspecialchars($row["disponibilidad"]) . "<br>";
            echo "Número de Baños: " . htmlspecialchars($row["banios"]) . "<br><br>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
} else {
    echo "Error en la consulta: " . htmlspecialchars($stmt->error);
}

// Cerrar la conexión
$conexion->close();
?>
