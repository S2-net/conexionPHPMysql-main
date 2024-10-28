<?php  
// Conexión a la base de datos
include("conexion.php");
$conexion = conectar_bd();

// Validación de entrada
$num_habitaciones = isset($_POST['num_habitaciones']) && $_POST['num_habitaciones'] > 0 ? (int)$_POST['num_habitaciones'] : null;
$num_banos = isset($_POST['num_banos']) && $_POST['num_banos'] > 0 ? (int)$_POST['num_banos'] : null;
$max_precio = isset($_POST['max_precio']) && $_POST['max_precio'] > 0 ? (int)$_POST['max_precio'] : null;
$tipo = isset($_POST['tipo']) && in_array($_POST['tipo'], ['Masculina', 'Femenina', 'Mixta']) ? $_POST['tipo'] : null;

// Construcción de la consulta SQL
$sql = "SELECT r.precio, r.tipo, r.id_residencia, h.disponibilidad, h.banios
        FROM residencia r
        JOIN habitaciones h ON r.id_residencia = h.id_residencia
        WHERE 1=1";

// Arreglo para almacenar los parámetros de la consulta
$params = [];
$types = "";

// Agregar condiciones opcionales
if ($num_habitaciones !== null) {
    $sql .= " AND h.disponibilidad >= ?";
    $params[] = $num_habitaciones;
    $types .= "i";
}

if ($num_banos !== null) {
    $sql .= " AND h.banios >= ?";
    $params[] = $num_banos;
    $types .= "i";
}

if ($max_precio !== null) {
    $sql .= " AND r.precio <= ?";
    $params[] = $max_precio;
    $types .= "i";
}

if ($tipo !== null) {
    $sql .= " AND r.tipo = ?";
    $params[] = $tipo;
    $types .= "s";
}

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($sql);

if (!empty($params)) {
    // Vincula los parámetros dinámicamente
    $stmt->bind_param($types, ...$params);
}

// Ejecutar la consulta
if ($stmt->execute()) {
    $resultado = $stmt->get_result();
    
    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Mostrar los resultados
        while ($row = $resultado->fetch_assoc()) {
            echo "Precio: $" . htmlspecialchars($row["precio"]) . "<br>";
            echo "Tipo de Residencia: " . htmlspecialchars($row["tipo"]) . "<br>";
            echo "ID de Residencia: " . htmlspecialchars($row["id_residencia"]) . "<br>";
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
