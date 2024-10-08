

   <header class="header">


    </div>


<?php require("header-carga.php");
    ?>

   
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
    
</html>
    
</body>

 
</div>

</header>
<?php require("footer.php");
    ?>