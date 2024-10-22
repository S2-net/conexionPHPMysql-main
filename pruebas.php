<div class="header-content container">
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
                  
                </div>
                <div class="col-md-12">
                        <input type="submit" value="Buscar" class="btn btn-primary mt-3">
                    </div>
            </form>
        </div>
    </div>
   </header> 
</body>
</html>