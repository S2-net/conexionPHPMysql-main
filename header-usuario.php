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
              <li class="nav-link">
                <a href="#">Inicio</a>   
              </li>
              <li class="nav-link">
                <a href="perfil-propietario.php">Ver Perfil</a>   
              </li>
              <li class="nav-link">
                <a href="contacto.php">Contactanos</a>
              </li>
              <li class="nav-link">
                <a href="index.php">Cerrar Sesion</a>
              </li>
            </ul>
        </nav>  
 
    </div>

    <div class="header-content container">

            <div class="header-txt">
                <h1>Encuentra tu residencia ideal para el exito academico</h1>
             
            </div>
            <div class="content">

<div class="tipo">
    <label for="universidades">Universidades</label>
    <select name="universidades" class="form-select form-select-lg mb-3" aria-label="Large select example">
        <option selected>- Cualquiera -</option>
        <option value="1">Cenur</option>
        <option value="2">Udelar</option>
      </select>
</div>

  <div class="tipo">
    <label for="departamentos">Departamentos</label>
    <select name="departamentos" class="form-select form-select-lg mb-3" aria-label="Large select example">
        <option selected>- Cualquiera -</option>
        <option value="1">Paysandú</option>
      </select>
  </div>
  
  <div class="tipo">
    <label for="tipos">Tipos</label>
    <select name="tipos" class="form-select form-select-lg mb-3" aria-label="Large select example">
        <option selected>- Cualquiera -</option>
        <option value="1">Mixtas</option>
        <option value="2">Masculinas</option>
        <option value="3">Femeninas</option>
      </select>
  </div>
</div>
        
    </div>
   </header> 

   