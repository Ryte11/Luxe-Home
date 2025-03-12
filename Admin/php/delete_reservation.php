<?php
// Establece el tipo de contenido a JSON
header('Content-Type: application/json');

try {
    include 'conexion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

        if ($id > 0) {
            // Elimina la reservación
            $stmt = $conn->prepare("DELETE FROM reservas WHERE id = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación: " . $conn->error);
            }

            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'ID inválido']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Método de solicitud inválido']);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>