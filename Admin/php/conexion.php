<?php
$host = "localhost";
$usuario = "root"; 
$clave = ""; 
$base_de_datos = "luxe-home";

$conn = new mysqli($host, $usuario, $clave, $base_de_datos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>