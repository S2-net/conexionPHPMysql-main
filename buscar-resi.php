<?php 
// buscar-resi.php
include("conexion.php");
session_start();

$conexion = conectar_bd();
$id_usuario = $_SESSION['id_usuario'] ?? null;

$num_habitaciones = isset($_POST['num_habitaciones']) && is_numeric($_POST['num_habitaciones']) ? (int)$_POST['num_habitaciones'] : null;
$num_banos = isset($_POST['num_banos']) && is_numeric($_POST['num_banos']) ? (int)$_POST['num_banos'] : null;
$max_precio = isset($_POST['max_precio']) && is_numeric($_POST['max_precio']) ? (int)$_POST['max_precio'] : null;
$tipo = isset($_POST['tipo']) && in_array($_POST['tipo'], ['masculina', 'femenina', 'mixta']) ? $_POST['tipo'] : null;


// Construir la consulta base
$sql = "SELECT r.id_residencia, r.precio, r.tipo, h.disponibilidad, h.banios, f.ruta_foto
        FROM residencia r
        JOIN habitaciones h ON r.id_residencia = h.id_residencia
        LEFT JOIN fotos_residencia f ON r.id_residencia = f.id_residencia
        WHERE 1=1";

// Variables para parámetros de búsqueda y tipos
$params = [];
$types = "";

// Agregar condiciones a la consulta
if (!is_null($num_habitaciones)) {
    $sql .= " AND h.disponibilidad >= ?";
    $params[] = $num_habitaciones;
    $types .= "i";
}
if (!is_null($num_banos)) {
    $sql .= " AND h.banios >= ?";
    $params[] = $num_banos;
    $types .= "i";
}
if (!is_null($max_precio)) {
    $sql .= " AND r.precio <= ?";
    $params[] = $max_precio;
    $types .= "i";
}
if (!is_null($tipo)) {
    $sql .= " AND r.tipo = ?";
    $params[] = $tipo;
    $types .= "s";
}

// Preparar y ejecutar la consulta
$stmt = $conexion->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$resultado = $stmt->get_result();

// Código para mostrar los resultados en el carrusel
$cardsPerSlide = 3;
$isFirst = true;
$cardCount = 0;

echo '<div class="carousel-inner">';
while ($row = $resultado->fetch_assoc()) {
    if ($cardCount % $cardsPerSlide === 0) {
        if ($cardCount > 0) echo '</div>';
        echo '<div class="carousel-item ' . ($isFirst ? 'active' : '') . '"><div class="d-flex justify-content-around">';
        $isFirst = false;
    }

    echo '<div class="card">';
    echo '<img src="' . ($row['ruta_foto'] ?? 'ruta/a/imagen_por_defecto.jpg') . '" class="card-img-top" alt="Residencia">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Residencia ' . htmlspecialchars($row["tipo"]) . '</h5>';
    echo '<p class="card-text">Precio: $' . htmlspecialchars($row["precio"]) . '</p>';
    echo '<p class="card-text">Habitaciones: ' . htmlspecialchars($row["disponibilidad"]) . '</p>';
    echo '<p class="card-text">Baños: ' . htmlspecialchars($row["banios"]) . '</p>';
    echo '<a class="action" href="residencia.php?id_residencia=' . $row['id_residencia'] . '">Acceder<span aria-hidden="true">→</span></a>';

    echo '<span class="star" onclick="guardarResidencia(' . $row['id_residencia'] . ', ' . $id_usuario . ')">★</span>';

    echo '</div>';
    echo '</div>';

    $cardCount++;
}
if ($cardCount > 0) {
    echo '</div></div>';
} else {
    echo "No se encontraron residencias con esos criterios.";
}

echo '</div>';
$conexion->close();

?>
