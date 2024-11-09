<?php 
require("idrol_usuario.php");
?>

<style>

.carousel-control-prev {
    left: 5px; /* Ajusta la distancia desde la izquierda */
}

.carousel-control-next {
    right: 100px;
}

.card .action {
    position: relative;
    z-index: 20; /* Asegúrate de que este valor sea mayor que el de las flechas */
}

.carousel-item {
    padding: 10px;
    right: 1px;
}

.carousel-control-next, .carousel-control-prev {
    position: absolute;
    top: 10%;
    bottom: 0;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 15%;
    padding: 0;
    color: #000;
    text-align: center;
    background: 0 0;
    border: 0;
    opacity: .5;
    transition: opacity .15s ease;
    
}
.card{
    margin-top: 70px;
    flex: 0 0 30%;
}
@media (max-width: 768px) {
    .card{
        flex: 0 0 100%; /* Cambia a 90% o el valor que desees */

    }
    .carousel-item {
    padding: 10px;
    right: 1px;
}
}

.star {
            color: gold;
            cursor: pointer;
            font-size: 1.5em; /* Ajusta el tamaño según sea necesario */
            position: absolute;
            top: 10px; /* Ajusta la posición vertical */
            right: 10px; /* Ajusta la posición horizontal */
        }
     
      
    


    .carousel-item {
    padding: 1px; /* Espacio adicional para las tarjetas */
    right: 1px;
}
.card-img-top img{
    width: 100%;
    object-fit: cover;
    height: 200px; /* Ajusta la altura según lo necesites */

  }
  .card-img-top {
    width: 100%;
    height: 200px;
}
  .image {
    overflow: hidden; /* Oculta cualquier parte de la imagen que sobresalga */
    height: 200px; /* Debe coincidir con la altura de la imagen */
}
    


    </style>
</head>

<script>
document.getElementById('formulario-filtro').addEventListener('submit', function(e) {
    e.preventDefault();  // Evita que el formulario se envíe de forma tradicional

    const formData = new FormData(this); // Obtiene los datos del formulario
    
    fetch('buscar-resi.php', {  // Asegúrate de que este sea el archivo correcto
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.querySelector('.carousel-inner').innerHTML = data; // Inserta el HTML recibido en el carrusel
    })
    .catch(error => console.error('Error en el filtrado:', error));
});
</script>


<body>
    

    <div id="residenciasCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

        <?php require("carrusel_residencias.php") ?>

</div>
    <button class="carousel-control-prev" type="button" data-bs-target="#residenciasCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#residenciasCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

    <?php require("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="guardar_residencia.js"></script>
    <script src="carrusel_residencias.js"></script>
</body>
</html>