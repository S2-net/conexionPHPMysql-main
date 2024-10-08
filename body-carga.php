

   <header class="header">


    </div>


<?php require("header-carga.php");
    ?>

   
        <form action="RF_registro_resi.php" method="POST" id="envio">
        <div class="card_resi">
            <h1>INGRESA LOS DATOS DE TU RESIDENCIA</h1>
        <div>
            <label for="nombreresi" class="form-label"></label>
            <input type="text" name="nombreresi" id="nombreresi"placeholder="Nombre de la residencia" required>
        </div>
        <div>
            <label for="tipo-residencia" class="form-label">Tipo de residencia</label>
            <br>
            <select name="tipo-residencia" id="tipo-residencia">
                <option value="1">Masculina</option>
                <option value="2">Femenina</option>
                <option value="3">Mixta</option>
            </select>
        </div>
        <div >
            <label for="descripcion" class="form-label"></label>
            <input type="text" id="descripcion" name="descripcion"placeholder="Descripción" required>
        </div>
        <div >
            <label for="normas" class="form-label"></label>
            <input type="text" id="normas" name="normas" placeholder="Normas de convivencia" required>
        </div>
        <div >
            <label for="precio" class="form-label"></label>
            <input type="number" min="0" max="100000" step="1" id="precio" name="precio"placeholder="Precio" required>
        </div>
        <div >
            <label for="disponibilidad" class="form-label"></label>
            <input type="number" id="disponibilidad" name="disponibilidad"placeholder="Número de habitaciones" required>
        </div>
        <div >
            <label for="banios" class="form-label"></label>
            <input type="number" min="0" max="50" step="1" id="banios" name="banios"placeholder="baños" required>
            <div>
            <label for="detalles" class="form-label"></label>
            <input type="text" id="detalles" name="detalles"placeholder="Detalles" required>
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
    
</html>
    
</body>

 
</div>

</header>
<?php require("footer.php");
    ?>