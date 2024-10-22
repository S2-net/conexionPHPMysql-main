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
            <h1 class="precio">$<?php echo $residencia['precio']; ?></h1>
            <div class="datosresi">
                <p>Nombre de la residencia: <?php echo $residencia['nombreresi']; ?> </p>
                <p>Número de baños: <?php echo $residencia['banios']; ?></p>
                <p>Cantidad de Dormitorios: <?php echo $residencia['disponibilidad']; ?></p>
                <p>Normas de convivencia: <?php echo $residencia['normas']; ?> </p>
                <p>Tipo: <?php echo $residencia['detalles']; ?></p>
                <p>Descripción: <?php echo $residencia['descripcion']; ?></p>
            </div>
        </div>
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
