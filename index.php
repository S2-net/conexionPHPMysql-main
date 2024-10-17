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
.card{
    margin-top: 70px;
    flex: 0 0 24%;
}


    </style>
</head>
<body>
    
    <?php require("header.php"); ?>
    <?php require("conexion.php"); ?>

    <div id="residenciasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php 
    function consultar_datos($con) {
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
                    // Aquí modificamos el enlace para incluir el ID de la residencia
                    echo '<a class="action" href="residencia.php?id_residencia=' . $resultado['id_residencia'] . '">Acceder<span aria-hidden="true">→</span></a>';
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

    consultar_datos($con);
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
