<?php 
$id_usuario = $_SESSION['id_usuario'] ?? 1; // Usa el ID real del usuario si está en sesión

function consultar_datos($con, $id_usuario) {
    // Consulta para obtener las residencias y sus habitaciones
    $consulta_residencia = "SELECT residencia.*, habitaciones.* 
                            FROM residencia 
                            JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia";
    $resultado_residencia = mysqli_query($con, $consulta_residencia);

    // Verifica si la consulta fue exitosa
    if ($resultado_residencia === false) {
        echo "Error en la consulta: " . mysqli_error($con);
        return; // Salir de la función en caso de error
    }

    if (mysqli_num_rows($resultado_residencia) > 0) {
        $isFirst = true;
        while ($resultado = mysqli_fetch_assoc($resultado_residencia)) {
            $cardCount = 0;
            echo '<div class="carousel-item ' . ($isFirst ? 'active' : '') . '">';
            echo '<div class="d-flex justify-content-around">';

            do {
                $id_residencia = $resultado['id_residencia'];
                $consulta_foto = "SELECT ruta_foto FROM fotos_residencia WHERE id_residencia = $id_residencia LIMIT 1";
                $resultado_foto = mysqli_query($con, $consulta_foto);
                
                if ($resultado_foto === false) {
                    echo "Error en la consulta de fotos: " . mysqli_error($con);
                    continue;
                }

                $foto = mysqli_fetch_assoc($resultado_foto);
                
                echo '<div class="card">';
                echo '<div class="image">';
                
                if ($foto) {
                    echo '<img src="' . $foto['ruta_foto'] . '" class="card-img-top" alt="Imagen de ' . $resultado['nombreresi'] . '">';
                } else {
                    echo '<img src="ruta/a/imagen_por_defecto.jpg" class="card-img-top" alt="Imagen no disponible">';
                }

                echo '</div>';
                echo '<div class="contenido">';
                echo '<a href="#"><span class="title">' . $resultado['nombreresi'] . '</span></a>';
                echo '<p class="desc">Descripción: ' . $resultado['descripcion'] . '</p>';
                echo '<p class="desc">Precio: $' . $resultado['precio'] . '</p>';
                echo '<a class="action" href="residencia.php?id_residencia=' . $resultado['id_residencia'] . '">Acceder<span aria-hidden="true">→</span></a>';
                echo '<span class="star" onclick="guardarResidencia(' . $resultado['id_residencia'] . ', ' . $id_usuario . ')">★</span>';
                echo '</div></div>';
                $cardCount++;
            } while ($cardCount < 3 && ($resultado = mysqli_fetch_assoc($resultado_residencia)));

            echo '</div></div>';
            $isFirst = false;
        }
    } else {
        echo "No se encontraron datos de residencia.";
    }
}

consultar_datos($con, $id_usuario);
?>
