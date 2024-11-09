<?php
session_start(); // Asegúrate de que la sesión está iniciada
require("conexion.php");

$con = conectar_bd(); // Conectar a la base de datos

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si la sesión está activa antes de procesar el formulario
    if (!isset($_SESSION['id_usuario'])) {
        // Si no hay sesión activa, redirigir a la página de inicio de sesión
        header("Location: iniregi.php");
        exit; // Es importante usar exit después de la redirección
    }
    
    // Si la sesión está activa, continuar con el procesamiento del formulario
    $id_usuario = $_SESSION['id_usuario']; 
    $id_residencia = isset($_POST['id_residencia']) ? $_POST['id_residencia'] : null;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : ''; 
    $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';

    // Verificar si el usuario ya ha consultado por esta residencia
    $consulta_existente = "SELECT * FROM consultas WHERE id_usuario = ? AND id_residencia = ?";
    $stmt_existente = $con->prepare($consulta_existente);
    $stmt_existente->bind_param("ii", $id_usuario, $id_residencia);
    $stmt_existente->execute();
    $resultado_existente = $stmt_existente->get_result();

    if ($resultado_existente->num_rows > 0) {
        // Si ya existe una consulta para esta residencia, mostramos un alerta y no procesamos el formulario
        echo "<script>alert('Ya consultaste por esta residencia.');</script>";
    } else {
        // Solo procesar el formulario si no se ha consultado antes
        if ($id_usuario && $id_residencia && $nombre && $email && $mensaje) {
            // Inserción en la base de datos
            $sql = "INSERT INTO consultas (id_usuario, id_residencia, nombre, email, mensaje) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iisss", $id_usuario, $id_residencia, $nombre, $email, $mensaje);
            $stmt->execute();
        }
    }

    $stmt_existente->close();
}


// Verificar si hay una sesión activa
if (isset($_SESSION['id_rol'])) {
    $rol = $_SESSION['id_rol']; // Obtener el rol del usuario desde la sesión

    // Mostrar el header correspondiente según el rol
    if ($rol == 1) {
        require("header-usuario.php");
    } elseif ($rol == 2) {
        require("header-propietario.php");
    } else {
        echo "Rol de usuario no reconocido.";
        exit; 
    }
} else {
    // Si no hay sesión, mostrar el header general
    require("header.php");
}

// Obtener el id_residencia desde la URL
if (isset($_GET['id_residencia'])) {
    $id_residencia = $_GET['id_residencia'];

    // Consulta para obtener la residencia y sus habitaciones
    $consulta_residencia = "SELECT residencia.*, habitaciones.*, AVG(valoracion.puntuacion) AS valoracion_promedio
                            FROM residencia
                            JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia 
                            LEFT JOIN valoracion ON residencia.id_residencia = valoracion.id_residencia
                            WHERE residencia.id_residencia = ?
                            GROUP BY residencia.id_residencia";
    $stmt_residencia = $con->prepare($consulta_residencia);
    $stmt_residencia->bind_param("i", $id_residencia);
    $stmt_residencia->execute();
    $resultado_residencia = $stmt_residencia->get_result();

    if ($resultado_residencia->num_rows > 0) {
        $residencia = $resultado_residencia->fetch_assoc();
        
        // Consulta para obtener todas las fotos asociadas a la residencia
        $consulta_fotos = "SELECT ruta_foto FROM fotos_residencia WHERE id_residencia = ?";
        $stmt_fotos = $con->prepare($consulta_fotos);
        $stmt_fotos->bind_param("i", $id_residencia);
        $stmt_fotos->execute();
        $resultado_fotos = $stmt_fotos->get_result();

        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        
        <style>
            .carousel-item img {
                max-width: 75%;  
                margin: 0 auto;
                display: block;
            }
            .precio-estrellas {
                display: flex;
                align-items: center;
                width: 100%; 
                margin-bottom:10px;
            }
            .stars:hover,
            .stars.selected {
                color: yellow;
            }
            .starss {
                display: flex;
                align-items: center;
                font-size: 1.5rem;
                color: #ffd700; 
                margin: 0; 
            }
            .stars {
                color: gray;
                cursor: pointer;
                font-size: 1.4rem;
                margin-left: 5px; 
                transition: color 0.3s;
            }
            .stars:hover {
                color: yellow;
            }
            .precio {
                font-size: 2.5rem;
                margin-right: 10px;
                margin-top:13px;
            }
            .alert {
                color: red;
                font-size: 1.2rem;
                margin-top: 20px;
                padding: 10px;
                border: 1px solid red;
                background-color: #f8d7da;
                border-radius: 5px;
            }
            .disabled {
                color: gray !important;
                cursor: not-allowed;
            }
        </style>

        <div class="residencia">
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <?php
                    $isFirst = true;
                    if ($resultado_fotos->num_rows > 0) {
                        while ($foto = $resultado_fotos->fetch_assoc()) {
                            $activeClass = $isFirst ? 'active' : '';
                            $isFirst = false;
                            ?>
                            <div class="carousel-item <?php echo $activeClass; ?>">
                                <img src="<?php echo $foto['ruta_foto']; ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="carousel-item active">
                            <img src="placeholder.jpg" class="d-block w-100" alt="No hay imágenes disponibles">
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="rating">
                <div class="precio-estrellas">
                    <h1 class="precio">$<?php echo $residencia['precio']; ?></h1>
                    <div class="starss" id="star-rating">
                        <?php 
                            $valoracion = round($residencia['valoracion_promedio']); 
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $valoracion) {
                                    echo '<i class="bi bi-star-fill stars" data-value="' . $i . '"></i>';
                                } else {
                                    echo '<i class="bi bi-star stars" data-value="' . $i . '"></i>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="datosresi">
                <p>Nombre de la residencia: <?php echo $residencia['nombreresi']; ?> </p>
                <p>Tipo de residencia: <?php echo $residencia['tipo']; ?> </p>
                <p>Número de baños: <?php echo $residencia['banios']; ?></p>
                <p>Cantidad de Dormitorios: <?php echo $residencia['disponibilidad']; ?></p>
                <p>Normas de convivencia: <?php echo $residencia['normas']; ?> </p>
                <p>Tipo: <?php echo $residencia['detalles']; ?></p>
                <p>Descripción: <?php echo $residencia['descripcion']; ?></p>
            </div>

            <div class="mapaa">
        <!-- Mapa -->
        <div id="map" style="width: 100%; max-width: 65%; height: 400px; margin: 20px;"></div>

        <!-- Formulario de contacto al lado del mapa -->
        <div class="contact-form">
            <h2>Contactar al propietario</h2>
            <form method="POST">
    <!-- Solo agregar el campo oculto para id_usuario si la sesión está iniciada -->
    <?php if (isset($_SESSION['id_usuario'])): ?>
        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
    <?php endif; ?>

    <input type="hidden" name="id_residencia" value="<?php echo $id_residencia; ?>">

    <input type="text" name="nombre" placeholder="Tu nombre" required>
    <input type="email" name="email" placeholder="Tu correo" required>
    <input type="text" name="numero" placeholder="Tu número" required>
    <textarea name="mensaje" placeholder="Tu mensaje" required></textarea>
    <button type="submit" name="enviar">Enviar</button>
</form>
        </div>
    </div>

    <?php 
    // Inicializa el mapa (igual que antes)
    $latitud = $residencia['latitud'];
    $longitud = $residencia['longitud'];
    ?>
    <div class="comentarios">
    <h2>Comentarios</h2>
    <!-- Formulario para comentar -->
    <form method="POST" action="procesar_comentario.php">
        <!-- Campo oculto para id_residencia -->
        <input type="hidden" name="id_residencia" value="<?php echo $id_residencia; ?>">

        <textarea name="comentario" placeholder="Deja tu comentario aquí..." required></textarea>
        <button type="submit" name="enviar_comentario">Enviar comentario</button>
    </form>

    <!-- Mostrar comentarios -->
    <div class="comentarios-lista">
        <?php
        // Consultar los comentarios de esta residencia
        $consulta_comentarios = "SELECT comentarios.*, usuario.nombre AS nombre_usuario 
                                 FROM comentarios 
                                 JOIN usuario ON comentarios.id_usuario = usuario.id_usuario 
                                 WHERE comentarios.id_residencia = ? 
                                 ORDER BY comentarios.fecha DESC";
        $stmt_comentarios = $con->prepare($consulta_comentarios);
        $stmt_comentarios->bind_param("i", $id_residencia);
        $stmt_comentarios->execute();
        $resultado_comentarios = $stmt_comentarios->get_result();

        if ($resultado_comentarios->num_rows > 0) {
            while ($comentario = $resultado_comentarios->fetch_assoc()) {
                echo "<div class='comentario'>";
                echo "<strong>" . htmlspecialchars($comentario['nombre_usuario']) . "</strong><br>";
                echo "<p>" . nl2br(htmlspecialchars($comentario['comentario'])) . "</p>";
                echo "<small>" . date("d/m/Y H:i", strtotime($comentario['fecha'])) . "</small>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>No hay comentarios aún.</p>";
        }

        $stmt_comentarios->close();
        ?>
    </div>
</div>

</div>


    <script>
        // Inicializa el mapa en las coordenadas de la residencia
        var map = L.map('map').setView([<?php echo $latitud; ?>, <?php echo $longitud; ?>], 13);

        // Carga el mapa de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Añade un marcador en la ubicación de la residencia
        L.marker([<?php echo $latitud; ?>, <?php echo $longitud; ?>]).addTo(map)
            .bindPopup('<?php echo $residencia["nombreresi"]; ?>')
            .openPopup();
    </script>
        <script>
      document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".stars");
    const starRatingContainer = document.getElementById("star-rating");
    const idResidencia = <?php echo $id_residencia; ?>;  // Id de la residencia desde PHP
    const userHasRated = <?php echo isset($_SESSION['id_usuario']) && $usuario_ha_valorado ? 'true' : 'false'; ?>;

    let ratingValue = 0; // Valor de la valoración que el usuario selecciona

    // Si el usuario ya ha valorado, deshabilitar las estrellas
    if (userHasRated) {
        stars.forEach(star => {
            star.classList.add('disabled');
        });
    }

    // Función para manejar la selección de estrellas
    stars.forEach(star => {
        star.addEventListener("mouseover", function () {
            if (userHasRated) return; // Si ya valoró, no hace nada
            const value = parseInt(star.getAttribute("data-value"));
            highlightStars(value);
        });

        star.addEventListener("mouseout", function () {
            if (userHasRated) return; // Si ya valoró, no hace nada
            highlightStars(ratingValue);
        });

        star.addEventListener("click", function () {
            if (userHasRated) return; // Si ya valoró, no hace nada
            ratingValue = parseInt(star.getAttribute("data-value"));
            highlightStars(ratingValue);
            sendRating(ratingValue);
        });
    });

    // Resalta las estrellas según el valor
    function highlightStars(value) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute("data-value"));
            if (starValue <= value) {
                star.classList.add("selected");
            } else {
                star.classList.remove("selected");
            }
        });
    }

    // Función para enviar la valoración con AJAX
    function sendRating(rating) {
        if (rating === 0) {
            return;  // No hacemos nada si no se seleccionó una valoración
        }

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "procesar_valoracion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Ya no mostramos ningún cartel ni mensaje
            }
        };

        // Enviar los datos: id_residencia y puntuacion
        xhr.send("id_residencia=" + idResidencia + "&puntuacion=" + rating);
    }
});


        </script>
        <?php
    } else {
        echo "No se encontraron datos para la residencia seleccionada.";
    }

    $stmt_residencia->close();
    $stmt_fotos->close();
} else {
    echo "No se ha seleccionado ninguna residencia.";
}

mysqli_close($con);
?>
