<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar a la base de datos
    include 'conexion.php';
    $conn = conectar_bd();
    
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    // Hashear la contraseña
    $hashed_password = password_hash($contrasenia, PASSWORD_DEFAULT);
    
    // Comprobar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'El correo ya está registrado.']);
    } else {
        // Insertar usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO usuario (nombre, apellido, correo, contrasenia) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $correo, $hashed_password);
        
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Cuenta creada exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la cuenta.']);
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>