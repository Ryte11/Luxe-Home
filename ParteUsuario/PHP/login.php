<?php
include 'conexion.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, nombre, email, password, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $email, $hashed_password, $rol);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['usuario_id'] = $id;
            $_SESSION['usuario_rol'] = $rol;

            $usuario = [
                'id' => $id,
                'nombre' => $nombre,
                'email' => $email,
                'rol' => $rol
            ];

            echo json_encode(['success' => true, 'usuario' => $usuario]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }

    $stmt->close();
    $conn->close();
}
?>