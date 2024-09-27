<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("location:iniregi.php");
    exit();
} else {
    $correo = $_SESSION["correo"];
}