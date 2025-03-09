<?php
include 'conexion.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $stmt = $conn->prepare("SELECT id, nombre, email, rol, telefono FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($id, $nombre, $email, $rol, $telefono);
    $stmt->fetch();

    if ($id) {
        $user = [
            'id' => $id,
            'nombre' => $nombre,
            'email' => $email,
            'rol' => $rol,
            'telefono' => $telefono
        ];
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado']);
}

$conn->close();
?>