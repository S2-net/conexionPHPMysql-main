<?php 
require("header-propietario.php");
require("conexion.php");
$con = conectar_bd();

// Obtener el id_residencia desde la URL
if (isset($_GET['id_residencia'])) {
    $id_residencia = $_GET['id_residencia'];

    // Modificar la consulta para mostrar solo la residencia seleccionada
    $consulta_residencia = "SELECT residencia.*, habitaciones.*
                            FROM residencia
                            JOIN habitaciones ON residencia.id_residencia = habitaciones.id_residencia
                            WHERE residencia.id_residencia = ?";
    $stmt_residencia = $con->prepare($consulta_residencia);
    $stmt_residencia->bind_param("i", $id_residencia);
    $stmt_residencia->execute();
    $resultado_residencia = $stmt_residencia->get_result();

    if ($resultado_residencia->num_rows > 0) {
        while ($resultado = $resultado_residencia->fetch_assoc()) {
            ?>
            <div class="residencia">
                <div id="carouselExampleFade" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <?php echo '<img src="'.$resultado['foto'].'" class="d-block w-100" alt="...">'; ?>
                        </div>
                       
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
                <h1 class="precio">$<?php echo $resultado['precio']; ?></h1>
                <div class="datosresi">
                    <p>Nombre de la residencia: <?php echo $resultado['nombreresi']; ?> </p>
                    <p>Número de baños: <?php echo $resultado['banios']; ?></p>
                    <p>Cantidad de Dormitorios: <?php echo $resultado['disponibilidad']; ?></p>
                    <p>Normas de convivencia: <?php echo $resultado['normas']; ?> </p>
                    <p>Tipo: <?php echo $resultado['detalles']; ?></p>
                    <p>Descripción: <?php echo $resultado['descripcion']; ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No se encontraron datos para la residencia seleccionada.";
    }
    
    $stmt_residencia->close();
} else {
    echo "No se ha seleccionado ninguna residencia.";
}

mysqli_close($con);
?>
