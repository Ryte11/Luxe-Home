<?php
include 'conexion.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['name']) && isset($data['email']) && isset($data['password']) && isset($data['role'])) {
    $name = trim($data['name']);
    $email = trim($data['email']);
    $password = password_hash(trim($data['password']), PASSWORD_DEFAULT);
    $role = trim($data['role']);
    $phone = isset($data['phone']) ? trim($data['phone']) : '';

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, rol, telefono) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $role, $phone);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar el usuario, el email existe']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}

?>