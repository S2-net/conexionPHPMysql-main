<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://localhost/pruebasrepay/images/ICONO.png" type="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="estilo.css">
    <title>Inicio de sesión | Registro</title>
</head>
<style>
    .containerIR1{
  background-color: #004aad;
  border-radius: 30px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
  position: relative;
  overflow: hidden;
  width: 570px;
  max-width: 100%;
  min-height: 350px;

}
.containerIR1 form {
    background-color: #004aad;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
    font-family: 'Montserrat', sans-serif;
}
.h1iniregi{
 
 color: #fff;
}

.containerIR1 h1{
 font-family: 'Montserrat', sans-serif;
 font-size: 30px;
    text-align: center;
}
.containerIR1 p{
  font-size: 14px;
  line-height: 20px;
  letter-spacing: 0.3px;
  margin: 20px 0;
  font-family: 'Montserrat', sans-serif;

}

.containerIR1 span{
  font-size: 12px;
  font-family: 'Montserrat', sans-serif;

}

.containerIR1 a{
  color: #cecece;
  font-size: 13px;
  text-decoration: none;
  margin: 15px 0 10px;
  font-family: 'Montserrat', sans-serif;

}

.containerIR1 button{
  background-color: #ffffff;
  color: #004aad;
  font-size: 12px;
  padding: 10px 45px;
  border: 1px solid transparent;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  margin-top: 10px;
  cursor: pointer;
  font-family: 'Montserrat', sans-serif;

}
.sign-in1{
  left: 0;
  width: 100%;
  z-index: 2;
  font-family: 'Montserrat', sans-serif;

}
.containerIR1 input{
  background-color: #eee;
  border: none;
  margin: 8px 0;
  padding: 10px 15px;
  font-size: 13px;
  border-radius: 8px;
  width: 100%;
  outline: none;
  font-family: 'Montserrat', sans-serif;

}
p{
    color: white;
    text-align: center;
}
.mensaje-alerta {
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
            font-size: 13px;
            text-align: center;
            font-weight: bold;
        }

        .mensaje-alerta.success {
            background-color: white;
            color:#004aad;
        }

        .mensaje-alerta.error {
            background-color: #f44336;
            color: white;
        }

        .mensaje-alerta.info {
            background-color: #2196F3;
            color: white;
        }

</style>

<body class="iniregibody">
    <div class="containerIR1" id="containerIR">

        <di class="form-containerIR sign-in1">
        <form action="enviar_correo.php" method="POST">
    <div class="h1iniregi">
        <h1>Olvidaste tu Contraseña?</h1>
    </div>
    <p>Introduce tu correo y te mandaremos un link para que puedas restablecerla</p>
    <input type="email" name="correo" placeholder="Correo Electrónico" required>
    <button type="submit" name="enviar">Enviar</button>
    <div id="mensaje-alerta" class="mensaje-alerta" style="display: none;"></div>

</form>

        </div>
    </div>

    <script src="iniregi.js"></script>
    <script src="app.js"></script>

</body>
<script>
        // Verificar si hay un parámetro 'status' en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        const mensajeAlerta = document.getElementById('mensaje-alerta');

        // Mostrar el mensaje dependiendo del valor de 'status'
        if (status === 'success') {
            mensajeAlerta.textContent = 'Se ha enviado un enlace para restablecer tu contraseña a tu correo.';
            mensajeAlerta.classList.add('success');
            mensajeAlerta.style.display = 'block'; // Mostrar el contenedor
        }

        if (status === 'error') {
            mensajeAlerta.textContent = 'Hubo un error al enviar el correo. Intenta de nuevo.';
            mensajeAlerta.classList.add('error');
            mensajeAlerta.style.display = 'block'; // Mostrar el contenedor
        }

        if (status === 'email_not_found') {
            mensajeAlerta.textContent = 'El correo no está registrado.';
            mensajeAlerta.classList.add('info');
            mensajeAlerta.style.display = 'block'; // Mostrar el contenedor
        }
    </script>
</html>
