<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<style>
    .mensaje-alerta {
  padding: 15px;
  margin-top: 20px;
  border-radius: 5px;
  font-size: 16px;
  text-align: center;
  font-weight: bold;
  width: 640px;
  margin-inline: 440px;
}

.mensaje-alerta.success {
  background-color: #004aad; /* Verde para éxito */
  color: white;
}

.mensaje-alerta.error {
  background-color: #f44336; /* Rojo para error */
  color: white;
}
@media screen and (max-width:600px) {
  .mensaje-alerta {
    margin-inline:6px ;
    width: 400px;
}
 }

</style>
<body class="body2">
    <div class="container2">
        <div class="box-info">
            <h1>CONTACTANOS</h1>
            <div class="data">
                <p><i class="fa-solid fa-phone"></i>+598 96 626 103</p>
                <p><i class="fa-solid fa-envelope"></i>repayailea2024@gmail.com</p>
                <p><i class="fa-solid fa-location-dot"></i>Av.España entre Felippone y Juncal. PAYSANDÚ</p>
            </div>
            <div class="links">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        <form class="form2" method="POST" action="enviar_contacto.php">
            <div class="input-box">
                <input type="text" name="nombre" required placeholder="Nombre y Apellido">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <input type="email" name="correo" required placeholder="Correo electrónico">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="input-box">
                <input type="text" name="asunto" required placeholder="Asunto">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input-box">
                <textarea name="mensaje" cols="30" rows="10" required placeholder="Escribe tu mensaje"></textarea>
            </div>
            <button type="submit" name="enviar">Enviar mensaje</button>
        </form>
    </div>
    <div id="mensaje-alerta" class="mensaje-alerta" style="display: none;"></div>

    <?php require("footer.php"); ?>
</body>
<script>
    // Verificar si hay un parámetro 'status' en la URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const mensajeAlerta = document.getElementById('mensaje-alerta');

    // Si el parámetro es 'success', mostrar el mensaje de éxito
    if (status === 'success') {
        mensajeAlerta.textContent = 'Mensaje enviado correctamente.';
        mensajeAlerta.classList.add('success');
        mensajeAlerta.style.display = 'block'; // Mostrar el contenedor
    }

    // Si el parámetro es 'error', mostrar el mensaje de error
    if (status === 'error') {
        mensajeAlerta.textContent = 'Hubo un error al enviar el mensaje. Intenta de nuevo.';
        mensajeAlerta.classList.add('error');
        mensajeAlerta.style.display = 'block'; // Mostrar el contenedor
    }
</script>


</html>
