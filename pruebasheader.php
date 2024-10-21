<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
    <title>Document</title>
</head>

<body>
   <header class="header">
       <div class="menu container">
           <a href="#">
               <img src="http://localhost/conexionPHPMysql-main/images/logoblahd.png" alt="Logo" class="logo">
           </a>
           <input type="checkbox" id="menu">
           <label for="menu">
               <img src="http://localhost/conexionPHPMysql-main/images/menu.png" class="menu-icono" alt="Menu">
           </label>
           <nav class="navbar">
               <ul>
                   <li class="nav-link"><a href="#">Inicio</a></li>
                   <li class="nav-link"><a href="#">Menu</a></li>
                   <li class="nav-link"><a href="iniregi.php">Iniciar Sesión</a></li>
                   <li class="nav-link"><a href="contacto.php">Contáctanos</a></li>
               </ul>
           </nav>  
       </div>

       <div class="header-content container">
           <div class="header-txt">
               <h1>Encuentra tu residencia ideal para el éxito académico</h1>
           </div>
           <div class="content">
               <form id="search-form" method="GET" action="index-usuario.php">
                   <!-- Form Fields -->
                   <div class="tipo">
                       <label for="universidades">Universidades</label>
                       <select name="universidades" class="form-select form-select-lg mb-3" aria-label="Universidades">
                           <option selected>- Cualquiera -</option>
                           <option value="1">Cenur</option>
                           <option value="2">Udelar</option>
                       </select>
                   </div>
                   <div class="tipo">
                       <label for="departamentos">Departamentos</label>
                       <select name="departamentos" class="form-select form-select-lg mb-3" aria-label="Departamentos">
                           <option selected>- Cualquiera -</option>
                           <option value="1">Paysandú</option>
                       </select>
                   </div>
                   <div class="tipo">
                       <label for="tipos">Tipos de residencia</label>
                       <select name="tipos" class="form-select form-select-lg mb-3" aria-label="Tipos de residencia">
                           <option selected>- Cualquiera -</option>
                           <option value="1">Mixtas</option>
                           <option value="2">Masculinas</option>
                           <option value="3">Femeninas</option>
                       </select>
                   </div>
                   <div class="tipo">
                       <label for="precio">Precio</label>
                       <input type="number" name="precio" class="form-control mb-3" placeholder="Máximo precio" aria-label="Precio máximo">
                   </div>
                   <div class="tipo">
                       <label for="banos">Número de baños</label>
                       <input type="number" name="banos" class="form-control mb-3" placeholder="Número de baños" aria-label="Número de baños">
                   </div>
                   <div class="tipo">
                       <label for="habitaciones">Número de habitaciones</label>
                       <input type="number" name="habitaciones" class="form-control mb-3" placeholder="Número de habitaciones" aria-label="Número de habitaciones">
                   </div>
                   <button type="submit" class="btn btn-primary">Buscar</button>
               </form>
           </div>
       </div>
   </header>

   <script>
   document.addEventListener("DOMContentLoaded", function() {
       const form = document.querySelector('#search-form');

       form.addEventListener('submit', function(event) {
           event.preventDefault();
           
           const tipo = form.querySelector('select[name="tipos"]').value;
           const precio = form.querySelector('input[name="precio"]').value;
           const banos = form.querySelector('input[name="banos"]').value;
           const habitaciones = form.querySelector('input[name="habitaciones"]').value;

           if (precio < 0) {
               alert('El precio no puede ser negativo.');
               return;
           }
           if (isNaN(banos) || banos < 0) {
               alert('El número de baños debe ser un número no negativo.');
               return;
           }
           if (isNaN(habitaciones) || habitaciones < 0) {
               alert('El número de habitaciones debe ser un número no negativo.');
               return;
           }

           // Si la validación es correcta, envía el formulario
           form.submit();
       });
   });
   </script>

</div> <!-- Cierra .header-content -->
       </div> <!-- Cierra .header -->
   </header>

   <?php
   // Incluye tu archivo de conexión a la base de datos
   include('conexion.php');

   if ($_SERVER['REQUEST_METHOD'] === 'GET') {
       // Captura los parámetros de búsqueda del formulario
       $tipo = isset($_GET['tipos']) ? $_GET['tipos'] : '';
       $precio = isset($_GET['precio']) ? $_GET['precio'] : '';
       $banos = isset($_GET['banos']) ? $_GET['banos'] : '';
       $habitaciones = isset($_GET['habitaciones']) ? $_GET['habitaciones'] : '';

       function consultar_datos($con, $tipo, $precio, $banos, $habitaciones) {
        $consulta_residencia = "SELECT r.*, h.banios, h.id_habitacion
                                FROM residencia r
                                JOIN habitaciones h ON r.id_habitacion = h.id_habitacion
                                WHERE (r.id_habitacion = ? OR ? = '')
                                AND (r.precio <= ? OR ? = '')
                                AND (h.banios >= ? OR ? = '')
                                AND (h.disponibilidad >= ? OR ? = '')";
        $stmt = $con->prepare($consulta_residencia);
        $stmt->bind_param("ssissii", $tipo, $tipo, $precio, $precio, $banos, $banos, $habitaciones, $habitaciones);
        $stmt->execute();
        $resultado_residencia = $stmt->get_result();
    

           if ($resultado_residencia->num_rows > 0) {
               $isFirst = true;
               while ($resultado = $resultado_residencia->fetch_assoc()) {
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
                       echo '</div></div>';
                       $cardCount++;
                   } while ($cardCount < 3 && ($resultado = $resultado_residencia->fetch_assoc()));

                   echo '</div></div>';
                   $isFirst = false;
               }
           } else {
               echo "No se encontraron datos de residencia.";
           }
       }

       // Llama a la función pasándole los parámetros
       consultar_datos($con, $tipo, $precio, $banos, $habitaciones);
   }
   ?>

</body>
</html>
