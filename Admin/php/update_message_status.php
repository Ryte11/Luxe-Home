<?php
// actions/update_message_status.php

// Iniciar sesión para verificar permisos (asegúrate de tener un sistema de autenticación)
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autorizado']);
    exit;
}

// Verificar que se recibieron los parámetros necesarios
if (!isset($_POST['id']) || !isset($_POST['action'])) {
    echo json_encode(['success' => false, 'message' => 'Parámetros incorrectos']);
    exit;
}

// Incluir archivo de conexión
include 'conexion.php';

$id = intval($_POST['id']);
$action = $_POST['action'];

// Validar que el ID sea un número válido
if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID de mensaje inválido']);
    exit;
}

// Realizar la acción correspondiente
if ($action === 'marcar') {
    // Marcar como leído
    $sql = "UPDATE contacts SET estado = 'Leído' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $conn->error]);
    }

    $stmt->close();
} elseif ($action === 'eliminar') {
    // Eliminar mensaje
    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);    

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar: ' . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Acción desconocida']);
}

// Cerrar conexión
$conn->close();
?>