<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        /* Reset de márgenes y padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        img{
            width: 250px;
            height:150px;
            margin-left:20px;
        }

        @media (max-width:411px){
            img{
                display:flex;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Fondo suave azul */
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #0066cc;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005bb5;
        }

        .success-message, .error-message {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Estilo del formulario */
        form {
            display: flex;
            flex-direction: column;
        }

    </style>
</head>
<body>
  

    <div class="container">
    <img src="http://localhost/conexionPHPMysql-main/images/logosinfondohd1.png" alt="">
        <h1>Cambiar Contraseña</h1>
        <form action="cambiar_sena.php" method="POST">
            <label for="correo">Correo electrónico:</label>
            <input type="email" name="correo" required>

            <label for="nueva_contraseña">Nueva contraseña:</label>
            <input type="password" name="nueva_contraseña" required>

            <input type="submit" value="Cambiar contraseña">
        </form>
    </div>

</body>
</html>