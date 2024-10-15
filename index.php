<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de la Página</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .carousel-inner {
            display: flex;
        }

        .carousel-item {
            display: flex;
            justify-content: space-between; /* Espacio entre las tarjetas */
        }

        .card {
            flex: 0 0 25%; /* Ancho de cada tarjeta (30% de contenedor) */
            margin: 30px; /* Espacio entre las tarjetas */
            margin-top: 70px; /* Ajusta este valor para bajar las tarjetas más */

        }
    </style>
</head>
<body>
    
    <?php require("header.php"); ?>
    <?php require("conexion.php"); ?>

    <div id="residenciasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php 
                // Función para consultar y mostrar los datos de residencia y habitaciones
                function consultar_datos($con) {
                    $consulta_residencia = "SELECT residencia.*, habitaciones.*
                                            FROM residencia
                                            JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia";
                    $resultado_residencia = mysqli_query($con, $consulta_residencia);
    
                    // Verificar que la consulta fue exitosa
                    if ($resultado_residencia === false) {
                        echo "Error en la consulta: " . mysqli_error($con);
                        return;
                    }
    
                    // Verificar si hay registros
                    if (mysqli_num_rows($resultado_residencia) > 0) {
                        $isFirst = true; // Para el primer elemento
                        while ($resultado = mysqli_fetch_assoc($resultado_residencia)) {
                            // Contador para las tarjetas
                            $cardCount = 0;
                            echo '<div class="carousel-item ' . ($isFirst ? 'active' : '') . '">';
                            echo '<div class="d-flex justify-content-around">'; // Ajusta la alineación

                            do {
                                echo '<div class="card">';
                                echo '<div class="image"></div>'; // Aquí puedes agregar la imagen
                                echo '<div class="contenido">';
                                echo '<a href="#"><span class="title">' . $resultado['nombreresi'] . '</span></a>';
                                echo '<p class="desc">Descripción: ' . $resultado['descripcion'] . '</p>';
                                echo '<p class="desc">Precio: $' . $resultado['precio'] . '</p>';
                                echo '<a class="action" href="residencia.php">Acceder<span aria-hidden="true">→</span></a>';
                                echo '</div></div>';
                                $cardCount++;
                            } while ($cardCount < 3 && ($resultado = mysqli_fetch_assoc($resultado_residencia))); // Muestra hasta 3 tarjetas
                            
                            echo '</div></div>'; // Cierra d-flex y carousel-item
                            $isFirst = false; // Cambia a falso después del primer elemento
                        }
                    } else {
                        echo "No se encontraron datos de residencia.";
                    }
                }

                // Llamada a la función para mostrar los datos
                consultar_datos($con);

                // Cerrar la conexión
                mysqli_close($con);
            ?>
        </div> <!-- Fin de carousel-inner -->

        <button class="carousel-control-prev" type="button" data-bs-target="#residenciasCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#residenciasCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div> <!-- Fin del carrusel -->

    <?php require("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
