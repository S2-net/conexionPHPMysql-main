<?php

session_start();
include("conexion.php"); // Asegúrate de que la ruta sea correcta

// Verificar si la conexión fue exitosa
if (!$conex) {
    die("Error en la conexión a la base de datos.");
}

if (isset($_POST['login'])) {
    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
  



    // Consulta a la base de datos para verificar el usuario
    $query = "SELECT * FROM usuario WHERE correo = ? AND contrasenia = ?";
    $stmt = $conex->prepare($query);
    $stmt->bind_param("ss", $correo, $contrasenia);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobar si se encontró el usuario
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contrasenia, $user['contrasenia'])) {
            // Contraseña correcta, redirigir
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
  
    }
       
  
    
    }
        
        
        
        
