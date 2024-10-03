<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <title>Cargar Residencia</title>
</head>
<body>
    <div class="padrino">
        <form action="RF_registro_resi.php" method="POST" id="envio">
        <div class="card_resi">
        <div>
            <label for="nombreresi" class="form-label">Nombre de la residencia</label>
            <input type="text" name="nombreresi" id="nombreresi">
        </div>
        <div>
            <label for="tipo-residencia" class="form-label">Tipo de residencia</label>
            <select name="tipo-residencia" id="tipo-residencia">
                <option value="1">Masculina</option>
                <option value="2">Femenina</option>
                <option value="3">Mixta</option>
            </select>
        </div>
        <div >
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" id="descripcion" name="descripcion">
        </div>
        <div >
            <label for="normas" class="form-label">Normas de convivencia</label>
            <input type="text" id="normas" name="normas">
        </div>
        <div >
            <label for="precio" class="form-label">Precio</label>
            <input type="number" min="0" max="100000" step="1" id="precio" name="precio">
        </div>
        <div >
            <label for="disponibilidad" class="form-label">Número de habitaciones</label>
            <input type="number" id="disponibilidad" name="disponibilidad">
        </div>
        <div >
            <label for="banios" class="form-label">Baños</label>
            <input type="number" min="0" max="50" step="1" id="banios" name="banios">
            <div>
            <label for="detalles" class="form-label">Detalle</label>
            <input type="text" id="detalles" name="detalles">
        </div>
        <div>
            <label for="imagen" class="form-label">Cargar Imagenes</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" >
        </div>
        
        <input type="submit" value="Cargar" name="envio" id=envio>
        <input type="reset" value="Cancelar">
        </form>
        
        <script src="app.js"></script>
        
    </div>
    </div>
</body>
</html>