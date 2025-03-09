<?php
include 'conexion.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($data['userId']) && isset($data['name']) && isset($data['email']) && isset($data['role'])) {
        $userId = $data['userId'];
        $name = trim($data['name']);
        $email = trim($data['email']);
        $role = trim($data['role']);
        $phone = isset($data['phone']) ? trim($data['phone']) : '';

        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, rol = ?, telefono = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $email, $role, $phone, $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
    $conn->close();
}
?>