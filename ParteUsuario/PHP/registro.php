<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encriptar contraseña

    // Verifica que el email no exista ya en la base de datos
    $verificar_email = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $verificar_email->bind_param("s", $email);
    $verificar_email->execute();
    $verificar_email->store_result();

    if ($verificar_email->num_rows > 0) {
        echo "error_email_existente";
    } else {
        // Inserta usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $password);
        if ($stmt->execute()) {
            echo "registro_exitoso";
        } else {
            echo "error";
        }
        $stmt->close();
    }
    $verificar_email->close();
    $conn->close();
}
?>