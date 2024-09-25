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
    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['correo']) >= 1) {
        // Capturar los datos del formulario
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $contrasenia = trim($_POST['contrasenia']);
        $correo = trim($_POST['correo']);
        $genero = trim($_POST['genero']); // Asegurarse de que 'genero' sea un número
        $edad = $_POST['edad'];
      

            // Hash de la contraseña
        $contrasenia = trim($_POST['contrasenia']);
        $contrasenia_hash = password_hash($contrasenia, PASSWORD_DEFAULT);

        // Verificar si el hash se generó correctamente
        if ($contrasenia_hash === false) {
            echo '<h3 class="bad">Error al crear el hash de la contraseña.</h3>';
        } else {
            echo '<h3 class="good">Hash de contraseña generado: ' . $contrasenia_hash . '</h3>'; // Muestra el hash
        }

// Usar una consulta preparada para mayor seguridad
$stmt = mysqli_prepare($conex, "INSERT INTO usuario (nombre, apellido, contrasenia, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?, ?)");

        // Usar una consulta preparada para mayor seguridad
        $stmt = mysqli_prepare($conex, "INSERT INTO usuario (nombre, apellido, contrasenia, correo, fecha_nacimiento, genero) VALUES (?, ?, ?, ?, ?, ?)");

        // Enlazar los parámetros
        mysqli_stmt_bind_param($stmt, "ssssis", $nombre, $apellido, $contrasenia_hash, $correo, $edad, $genero);

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