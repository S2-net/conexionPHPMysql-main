<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de la Página</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .carousel-control-prev {
            left: 10px; /* Ajusta la distancia desde la izquierda */
        }

        .carousel-control-next {
            right: 10px; /* Ajusta la distancia desde la derecha */
        }

        .card .action {
            position: relative;
            z-index: 20; /* Asegúrate de que este valor sea mayor que el de las flechas */
        }

        .carousel-item {
            padding: 0 50px; /* Espacio adicional para las tarjetas */
        }

        .carousel-control-next, .carousel-control-prev {
            position: absolute;
            top: 65%;
            bottom: 0;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 15%;
            padding: 0;
            color: #fff;
            text-align: center;
            background: 0 0;
            border: 0;
            opacity: .5;
            transition: opacity .15s ease;
        }

        .card {
            margin-top: 70px;
            flex: 0 0 24%;
        }

        .star {
            color: gold;
            cursor: pointer;
            font-size: 1.5em; /* Ajusta el tamaño según sea necesario */
            position: absolute;
            top: 10px; /* Ajusta la posición vertical */
            right: 10px; /* Ajusta la posición horizontal */
        }
    </style>
</head>
<body>
    
    <?php 
    session_start(); // Iniciar la sesión para acceder a los datos del usuario
    require("header-usuario.php"); 
    require("conexion.php"); 

    // Asegúrate de que el ID del usuario esté en la sesión
    $id_usuario = $_SESSION['id_usuario'] ?? null; 
    if ($id_usuario === null) {
        echo "Error: ID de usuario no definido.";
        exit; // Termina el script si no hay ID de usuario
    }
    ?>

    <div id="residenciasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php 
        function consultar_datos($con, $id_usuario) {
            $consulta_residencia = "SELECT residencia.*, habitaciones.*
                                    FROM residencia
                                    JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia";
            $resultado_residencia = mysqli_query($con, $consulta_residencia);

            if (mysqli_num_rows($resultado_residencia) > 0) {
                $isFirst = true;
                while ($resultado = mysqli_fetch_assoc($resultado_residencia)) {
                    $cardCount = 0;
                    echo '<div class="carousel-item ' . ($isFirst ? 'active' : '') . '">';
                    echo '<div class="d-flex justify-content-around">';

                    do {
                        echo '<div class="card">';
                        echo '<div class="image"></div>';
                        echo '<div class="contenido">';
                        echo '<a href="#"><span class="title">' . $resultado['nombreresi'] . '</span></a>';
                        echo '<p class="desc">Descripción: ' . $resultado['descripcion'] . '</p>';
                        echo '<p class="desc">Precio: $' . $resultado['precio'] . '</p>';
                        echo '<a class="action" href="residencia.php?id_residencia=' . $resultado['id_residencia'] . '">Acceder<span aria-hidden="true">→</span></a>';
                        // Aquí pasamos el ID de residencia y el ID de usuario
                        echo '<span class="star" onclick="guardarResidencia(' . $resultado['id_residencia'] . ', ' . $id_usuario . ')">★</span>'; // Estrella llena

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
    <script>
        function guardarResidencia(id_residencia, id_usuario) {
            console.log("ID Residencia:", id_residencia, "ID Usuario:", id_usuario); // Debugging
            if (id_usuario === undefined) {
                alert("ID de usuario no está definido.");
                return;
            }

            fetch('guardar_residencia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id_residencia: id_residencia, id_usuario: id_usuario }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Residencia guardada con éxito.");
                } else {
                    alert("Error al guardar la residencia: " + data.error);
                }
            })
            .catch((error) => {
                alert("Error: " + error);
            });
        }
    </script>
</body>
</html>
