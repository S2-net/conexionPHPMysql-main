
<body>
    
    <?php require("header.php");
    require("conexion.php")
    ?>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


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

<div class="padre">
<div class="card">
 <div class="image"></div>
  <div class="contenido">
    <a href="#">
      <span class="title">
      <?php echo $resultado['nombreresi']; ?>
      </span>
    </a>

    <p class="desc">
    <p>Descripción: <?php echo $resultado['descripcion']; ?></p> 
    </p>
    <p class="desc">
    <p>Precio: $<?php echo $resultado['precio']; ?></p> 
    </p>

    <a class="action" href="residencia.php">
      Acceder
      <span aria-hidden="true">
        →
      </span>
    </a>
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


<div class="card">
 <div class="image"></div>
  <div class="contenido">
    <a href="#">
      <span class="title">
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
      </span>
    </a>

    <p class="desc">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae
      dolores, possimus pariatur animi temporibus nesciunt praesentium 
    </p>

    <a class="action" href="#">
      Acceder
      <span aria-hidden="true">
        →
      </span>
    </a>
  </div>
</div>
<div class="card">
 <div class="image"></div>
  <div class="contenido">
    <a href="#">
      <span class="title">
        Lorem ipsum dolor sit amet consectetur adipisicing elit.
      </span>
    </a>

    <p class="desc">
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae
      dolores, possimus pariatur animi temporibus nesciunt praesentium 
    </p>

    <a class="action" href="#">
      Acceder
      <span aria-hidden="true">
        →
      </span>
    </a>
  </div>
</div>

</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
  <?php
    require("footer.php");
   ?>
</html>