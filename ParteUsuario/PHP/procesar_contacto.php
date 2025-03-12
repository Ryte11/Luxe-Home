<?php
include 'conexion.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $mensaje = $conn->real_escape_string($_POST['mensaje']);

    // Prepare and execute SQL query to insert data
    $sql = "INSERT INTO contacts (nombre, correo, telefono, mensaje) VALUES ('$nombre', '$correo', '$telefono', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a contactos.php con un mensaje de éxito
        header("Location: ../contactos.php?success=1");
        exit;
    } else {
        // Redirigir a contactos.php con un mensaje de error
        header("Location:../contactos.php?error=1");
        exit;
    }

    // Close the database connection
    $conn->close();
}
?>