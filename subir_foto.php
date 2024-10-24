<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['correo'])) {
    header("Location: iniregi.php");
    exit();
}

$con = conectar_bd();
$correo = $_SESSION['correo'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $foto = $_FILES['foto'];

    // Validaciones
    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($extension, $allowed_extensions) && $foto['size'] <= 4000000) { // 4MB max
        $ruta_foto = 'fotos/' . uniqid() . '.' . $extension; // Ruta donde se guardará la imagen

        if (move_uploaded_file($foto['tmp_name'], $ruta_foto)) {
            // Consulta para actualizar la ruta de la foto en la base de datos
            $sql = "UPDATE usuario SET foto = ? WHERE correo = ?";
            $stmt = $con->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("ss", $ruta_foto, $correo);

                if ($stmt->execute()) {
                    if (isset($_SESSION['id_rol'])) {
                        $rol = $_SESSION['id_rol'];
                    
                        if ($rol == 1) {
                            header("Location: perfilusuario.php");
                            exit();
                        } elseif ($rol == 2) {
                            header("Location: perfil-propietario.php");
                            exit();
                        }
                        }
                    
                } else {
                    echo "Error al subir la foto: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error en la preparación de la consulta: " . $con->error;
            }
        } else {
            echo "Error al mover la foto al destino.";
        }
    } 
}

$con->close();

?>
