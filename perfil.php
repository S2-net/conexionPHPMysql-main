<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <title>Ver Perfil</title>
</head>
<body>
    
    <div class="container mt-5">
        <div class="d-flex justify-content-start">
            <a href="index.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
        <h2 class="text-center">Perfil de Usuario</h2>
        <form action="perfil.php" method="post">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="augustodlsr" required="">
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Nueva Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required="">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>