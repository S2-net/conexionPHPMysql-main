

   <header class="header2">


    </div>


<?php require("header-carga.php");
    ?>




   <br>
   <br>
        <form action="RF_registro_resi.php" method="POST" enctype="multipart/form-data"  id="envio">

        <div class="card_resi">
            <h1>INGRESA LOS DATOS DE TU RESIDENCIA</h1>

        <div class="cargadatos">
            <div class="nombre_carga">
            <label for="nombreresi" class="form-label">Nombre</label>
            </div>
            <input type="text" name="nombreresi" id="nombreresi"placeholder="Nombre de la residencia" required>
        </div>

        <div class="cargadatos">
            <label for="tipo" class="form-label">Tipo de residencia</label>
            <select name="tipo" id="tipo">
                <option value="1">Masculina</option>
                <option value="2">Femenina</option>
                <option value="3">Mixta</option>
            </select>
        </div>
        <div class="cargadatos">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" id="descripcion" name="descripcion"placeholder="Descripción" required>
        </div>
        <div class="cargadatos">
            <label for="normas" class="form-label">Normas de convivencia</label>
            <input type="text" id="normas" name="normas" placeholder="Normas de convivencia" required>
        </div>
        <div class="cargadatos">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" min="0" max="100000" step="1" id="precio" name="precio"placeholder="Precio" required>
        </div>
        <div class="cargadatos">
            <label for="disponibilidad" class="form-label">Numero de habitaciones</label>
            <input type="number" id="disponibilidad" name="disponibilidad"placeholder="Número de habitaciones" required>
        </div>
        <div class="cargadatos">
            <label for="banios" class="form-label">Baños</label>
            <input type="number" min="0" max="50" step="1" id="banios" name="banios"placeholder="baños" required>
            <div class="cargadatos">
            <label for="detalles" class="form-label">Detalles</label>
            <input type="text" id="detalles" name="detalles"placeholder="Detalles" required>
        </div>
        <div class="cargadatos">
            <label for="latitud" class="form-label">Latitud</label>
            <input type="text" name="latitud" id="latitud" placeholder="Latitud" required>
        </div>
        <div class="cargadatos">
            <label for="longitud" class="form-label">Longitud</label>
            <input type="text" name="longitud" id="longitud" placeholder="Longitud" required>
        </div>


        <div id="map" style="width:100%; height: 400px; margin-top: 20px;"><script>
// Inicializa el mapa centrado en una ubicación predeterminada
var map = L.map('map').setView([-34.9011, -56.1645], 13); // Coordenadas predeterminadas (ej., Montevideo)

// Carga el mapa de OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Agrega un marcador inicial en la posición predeterminada
var marker = L.marker([-34.9011, -56.1645]).addTo(map);

// Función para actualizar el marcador en el mapa
function updateMarker(lat, lng) {
    marker.setLatLng([lat, lng]);
    map.setView([lat, lng], 13);
}

// Escuchar los cambios en los campos de latitud y longitud
document.getElementById('latitud').addEventListener('input', function() {
    var lat = parseFloat(document.getElementById('latitud').value);
    var lng = parseFloat(document.getElementById('longitud').value);
    if (!isNaN(lat) && !isNaN(lng)) {
        updateMarker(lat, lng);
    }
});

document.getElementById('longitud').addEventListener('input', function() {
    var lat = parseFloat(document.getElementById('latitud').value);
    var lng = parseFloat(document.getElementById('longitud').value);
    if (!isNaN(lat) && !isNaN(lng)) {
        updateMarker(lat, lng);
    }
});
</script></div>


        <div class="cargardatos">
            <label for="imagen" class="form-label">Cargar Imagenes</label>
            <label for="imagen">Solo cargar imagenes JPG</label>
            <input type="file" name="fotos[]" id="fotos" multiple>

            <input type="submit" value="Cargar" name="envio" id=envio>
            <input type="reset" value="Cancelar">
        </form>
    </div>
    
    <script src="app.js"></script>
        
</div>
    
</html>
    
</body>

 
</div>

</header>


<?php require("footercarga.php");
    ?>
    </footer>