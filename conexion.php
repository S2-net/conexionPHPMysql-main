<?php

//definir variables de conexion

function conectar_bd(){

$servidor = "localhost";
$bd = "repay";
$usuario = "root";
$contrasenia = "";

//definir la conexion usando las variables.

$conn = mysqli_connect($servidor, $usuario, $contrasenia, $bd);


/// Comprobar la conexión
if (!$conn) {
    die("Error de conexion " . mysqli_connect_error());
}


    

return $conn;
}



$con = conectar_bd();

