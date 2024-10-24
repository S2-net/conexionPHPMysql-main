<?php 
session_start(); 
require("conexion.php");
 // Asegúrate de que el ID del usuario esté en la sesión


$con = conectar_bd(); 
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;


if (isset($_SESSION['id_rol'])) {
    $rol = $_SESSION['id_rol'];

    if ($rol == 1) {
        require("header-usuario.php");
    } elseif ($rol == 2) {
        require("header-propietario.php");
    } else {
        echo "Rol de usuario no reconocido.";
        exit;
    }
} else {
    require("header.php");
}
?>

<style>

.carousel-control-prev {
    left: 5px; /* Ajusta la distancia desde la izquierda */
}

.carousel-control-next {
    right: 100px;
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
    top: 10%;
    bottom: 0;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 15%;
    padding: 0;
    color: #000;
    text-align: center;
    background: 0 0;
    border: 0;
    opacity: .5;
    transition: opacity .15s ease;
    
}
.card{
    margin-top: 70px;
    flex: 0 0 30%;
}
.star {
            color: gold;
            cursor: pointer;
            font-size: 1.5em; /* Ajusta el tamaño según sea necesario */
            position: absolute;
            top: 10px; /* Ajusta la posición vertical */
            right: 10px; /* Ajusta la posición horizontal */
        }
@media (max-width: 768px) {
    .card {
        flex: 0 0 100%; /* 1 tarjeta en pantallas pequeñas */
    }
    .carousel-item {
    padding: 0 50px; /* Espacio adicional para las tarjetas */
    right: 1px;
}
    }


    </style>
</head>


<body>
    

    <div id="residenciasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php 
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
                // Obtener la primera foto de la residencia desde la tabla fotos_residencia
                $id_residencia = $resultado['id_residencia'];
                $consulta_foto = "SELECT ruta_foto FROM fotos_residencia WHERE id_residencia = $id_residencia LIMIT 1";
                $resultado_foto = mysqli_query($con, $consulta_foto);
                
                // Verificar si la consulta se ejecutó correctamente
                if ($resultado_foto === false) {
                    echo "Error en la consulta de fotos: " . mysqli_error($con);
                    continue; // Saltar al siguiente ciclo en caso de error
                }

                $foto = mysqli_fetch_assoc($resultado_foto);
                
                echo '<div class="card">';
                echo '<div class="image">';
                
                // Verificar si se obtuvo una foto
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




</div>
    <button class="carousel-control-prev" type="button" data-bs-target="#residenciasCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#residenciasCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

    <?php require("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
                
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
        
    </script>
    <script>

    document.addEventListener("DOMContentLoaded", function() {
    var carouselItems = document.querySelectorAll('.carousel-item');
    var carouselSize = window.innerWidth < 768 ? 1 : 3; // 1 para móvil, 3 para escritorio

    // Ajustar las clases de Bootstrap según el tamaño de pantalla
    carouselItems.forEach(item => {
        var cards = item.querySelectorAll('.card');
        cards.forEach((card, index) => {
            if (index >= carouselSize) {
                card.style.display = 'none'; // Ocultar tarjetas adicionales
            }
        });
    });

    // Escuchar cambios de tamaño de ventana
    window.addEventListener('resize', function() {
        location.reload(); // Recargar la página para aplicar cambios
    });
});
 
    </script>
</body>
</html>