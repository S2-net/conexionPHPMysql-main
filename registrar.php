<?php

// Conectar a la base de datos
$conex = mysqli_connect("localhost", "root", "", "repay");

// Verificar la conexión
if (!$conex) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Verificar si el formulario fue enviado
if (isset($_POST['register'])) {

    // Mostrar los datos enviados para depurar
    print_r($_POST);

    // Verificar si los campos obligatorios están completos
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['gmail']) >= 1) {
        // Capturar los datos del formulario
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $contraseña = trim($_POST['contraseña']);
        $gmail = trim($_POST['gmail']);
        $genero = intval($_POST['genero']); // Asegurarse de que 'genero' sea un número
        $edad = $_POST['edad'];

        // Usar una consulta preparada para mayor seguridad
        $stmt = mysqli_prepare($conex, "INSERT INTO usuario (nombre, apellido, contrasenia, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?, ?)");

        // Enlazar los parámetros
        mysqli_stmt_bind_param($stmt, "sssssi", $nombre, $apellido, $contraseña, $gmail, $edad, $genero);

        // Ejecutar la consulta
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la consulta fue exitosa
        if ($resultado) {
            // Redirigir al usuario si todo salió bien
            header('Location: index.php');
            exit();
        } else {
            // Mostrar error si algo salió mal
            echo '<h3 class="bad">¡Ups, ocurrió un error al guardar los datos!</h3>';
            echo "Error: " . mysqli_error($conex);
        }
    } else {
        echo '<h3 class="bad">¡Por favor completa todos los campos!</h3>';
    }
}

?>