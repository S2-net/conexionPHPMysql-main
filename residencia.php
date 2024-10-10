<body>
    
    <?php 
    
    require("header-propietario.php");
    require("conexion.php");
    $con = conectar_bd();

    
    ?>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<div class="residencia">
    <div class="tamanio">
    <div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="http://localhost/conexionPHPMysql-main/images/1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="http://localhost/conexionPHPMysql-main/images/2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="http://localhost/conexionPHPMysql-main/images/3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>

    <?php 
        // Función para consultar y mostrar los datos de residencia y habitaciones
        function consultar_datos($con) {
          $consulta_residencia = "SELECT * FROM residencia";
          $consulta_habitaciones = "SELECT * FROM habitaciones";
          
          $resultado_residencia = mysqli_query($con, $consulta_residencia);
          $resultado_habitaciones = mysqli_query($con, $consulta_habitaciones);

            // Verificar que la consulta fue exitosa
            if ($resultado_residencia === false) {
              echo "Error en la consulta: " . mysqli_error($con);
              return;
          }

            // Verificar si hay registros
            if (mysqli_num_rows($resultado_residencia) && (mysqli_num_rows($resultado_habitaciones)) > 0) {
              while (($resultado = mysqli_fetch_assoc($resultado_residencia)) && ($resultadoo = mysqli_fetch_assoc($resultado_habitaciones))) {
        ?>

<h1 class="precio">$<?php echo $resultado['precio']; ?></h1>

                    <div class="datosresi">
                        <p>Nombre de la residencia: <?php echo $resultado['nombreresi']; ?> </p>
                        <p>Numero de baños: <?php echo $resultadoo['banios']; ?></p>
                        <p>Cantidad de Dormitorios: <?php echo $resultadoo['disponibilidad']; ?></p>
                        <p>Normas de convivencia: <?php echo $resultado['normas']; ?> </p>
                        <p>Tipo: <?php echo $resultadoo['detalles']; ?></p>
                        <p>Descripción: <?php echo $resultado['descripcion']; ?></p>
                        <div class="boton_info">
                            <button>Info Completa</button>
                        </div>
                    </div>
        <?php
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<?php
    require("footer.php");
?>
</html>