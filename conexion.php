<?php

//definir variables de conexion

function conectar_bd(){

$servidor = "localhost";
$bd = "repay";
$usuario = "root";
$pass = "";

//definir la conexion usando las variables.

$conn = mysqli_connect($servidor, $usuario, $pass, $bd);


// Comprobar la conexión
if (!$conn) {
    header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
        }

//devuelvo la conexion  
return $conn;
 
}


$con= conectar_bd();

