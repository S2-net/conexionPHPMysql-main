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
            <img src="http://localhost/conexionPHPMysql-main/images/logoblahd.png" alt="" class="logo">
        </a>
        <input type="checkbox" id="menu">
        <label for="menu">
            <img src="http://localhost/conexionPHPMysql-main/images/menu.png" class="menu-icono" alt="">
        </label>
        <nav class="navbar">
            <ul>
              <li class="nav-link"><a href="#">Inicio</a></li>
              <li class="nav-link"><a href="perfil-propietario.php">Ver Perfil</a></li>
              <li class="nav-link"><a href="body-carga.php">Cargar Residencia</a></li>
              <li class="nav-link"><a href="logout.php">Cerrar Sesion</a></li>
            </ul>
        </nav>  
    </div>

    <div class="container-filtro">
    <div class="header-content">
        <div class="header-txt">
            <h1>Encuentra tu residencia ideal para el exito academico</h1>
        </div>
        <div class="content">
            <form method="POST" action="buscar-resi.php">
                <div class="row">
                    <div class="col-md-3">
                        <label for="num_habitaciones">Habitaciones</label>
                        <input type="number" name="num_habitaciones" class="form-control" placeholder="Habitaciones" >
                    </div>
                    <div class="col-md-3">
                        <label for="num_banos">Baños</label>
                        <input type="number" name="num_banos" class="form-control" placeholder="Baños" >
                    </div>
                    <div class="col-md-3">
                        <label for="max_precio">Precio Máximo</label>
                        <input type="number" name="max_precio" class="form-control" placeholder="Precio Máximo" >
                    </div>
                    <div class="col-md-3">
                        <label for="tipo_residencia">Tipo de Residencia</label>
                        <select name="tipo_residencia" class="form-select" >
                            <option value="Masculina">Masculina</option>
                            <option value="Femenina">Femenina</option>
                            <option value="Mixta">Mixta</option>
                           
        
                        </select>
                      
                    </div>
                    <div class="col-md-3">
                        <input type="submit" value="Buscar" class="btn btn-primary mt-3">
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
   </header> 
</body>
</html>