<?php

// Conectan a la base de datos :V
$conex = mysqli_connect("localhost", "root", "", "repay");

// mira si se concecto bien 
if (!$conex) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// mira si se envió el coso
if (isset($_POST['register'])) {
    // mira si se llenaron los datos  estss
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['gmail']) >= 1) {
        // agarrra los datos del  formulario
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $contraseña = trim($_POST['contraseña']);
        $gmail = trim($_POST['gmail']);
        $genero = trim($_POST['genero']);
        $edad = $_POST['edad'];

        // esto para mandarle los datos a la tabla 
        $consulta = "INSERT INTO usuario (nombre, apellido, contrasenia, correo, fecha_nacimiento, genero) 
                     VALUES ('$nombre', '$apellido', '$contraseña', '$gmail', '$edad', '$genero')";

        // Mostrar la consulta SQL para depurar
        echo "<p>Consulta SQL: $consulta</p>";

        // Ejecutar la consulta
        $resultado = mysqli_query($conex, $consulta);

        // Verificar si la consulta fue exitosa:no funciona arreglelo isma
        if ($resultado) {
            header('Location: index.php');
                exit();
            echo '<h3 class="ok">¡Te has inscrito correctamente!</h3>';
        } else {
            // Mostrar el error de MySQL si falla la consulta:no funciona arreglalo isma ahre
            echo '<h3 class="bad">¡Ups, ocurrió un error al guardar los datos!</h3>';
            echo "Error: " . mysqli_error($conex);
        }
    } else {
        echo '<h3 class="bad">¡Por favor completa todos los campos!</h3>';
    }
}
?>