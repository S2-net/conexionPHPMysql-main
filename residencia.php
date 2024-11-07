<?php 
session_start(); // Asegúrate de que la sesión está iniciada
require("conexion.php");

$con = conectar_bd(); // Conectar a la base de datos

// Verificar si hay una sesión activa
if (isset($_SESSION['id_rol'])) {
    $rol = $_SESSION['id_rol']; // Obtener el rol del usuario desde la sesión

    // Mostrar el header correspondiente según el rol
    if ($rol == 1) {
        require("header-usuario.php");
    } elseif ($rol == 2) {
        require("header-propietario.php");
    } else {
        // Manejar un rol no reconocido si es necesario
        echo "Rol de usuario no reconocido.";
        exit; // Termina el script si el rol no es válido
    }
} else {
    // Si no hay sesión, mostrar el header general
    require("header.php");
}

// Obtener el id_residencia desde la URL
if (isset($_GET['id_residencia'])) {
    $id_residencia = $_GET['id_residencia'];

    // Consulta para obtener la residencia y sus habitaciones
    $consulta_residencia = "SELECT residencia.*, habitaciones.* 
                            FROM residencia 
                            JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia 
                            WHERE residencia.id_residencia = ?";
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
        max-width: 75%;  /* Ajusta el valor según lo que necesites */
        
        margin: 0 auto;
        display: block;
    }
       </style>


        <div class="residencia">
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
                <div class="carousel-inner">
                    <?php
                    $isFirst = true;
                    if ($resultado_fotos->num_rows > 0) {
                        while ($foto = $resultado_fotos->fetch_assoc()) {
                            // Agregar clase 'active' solo a la primera imagen
                            $activeClass = $isFirst ? 'active' : '';
                            $isFirst = false;
                            ?>
                            <div class="carousel-item <?php echo $activeClass; ?>">
                                <img src="<?php echo $foto['ruta_foto']; ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php
                        }
                    } else {
                        // Mostrar un placeholder si no hay fotos
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
            <h1 class="precio">$<?php echo $residencia['precio']; ?></h1>
            <i class="bi bi-star-fill star"></i>
            <i class="bi bi-star-fill star"></i>
            <i class="bi bi-star-fill star"></i>
            <i class="bi bi-star-fill star"></i>
            <i class="bi bi-star-fill star"></i>

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
            <form method="POST" action="enviar_contacto.php">
                <input type="text" name="nombre" placeholder="Tu nombre" required>
                <input type="email" name="correo" placeholder="Tu correo" required>
                <input type="text" name="numero" placeholder="Tu numero" required>
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


