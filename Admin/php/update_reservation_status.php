<?php
// Establece el tipo de contenido a JSON
header('Content-Type: application/json');

// Registra información para depuración
$log_file = fopen("status_debug_log.txt", "a");
fwrite($log_file, "Request recibido: " . date('Y-m-d H:i:s') . "\n");

try {
    include 'conexion.php';

    fwrite($log_file, "Conexión establecida\n");

    // Acepta tanto GET como POST para mayor flexibilidad
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $status = isset($_POST['status']) ? $_POST['status'] : '';
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $status = isset($_GET['status']) ? $_GET['status'] : '';
    } else {
        throw new Exception("Método HTTP no soportado");
    }

    fwrite($log_file, "ID: $id, Status: $status\n");

    if (!$id || empty($status)) {
        throw new Exception("Faltan parámetros requeridos");
    }

    // Verifica que la conexión esté activa
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE reservas SET status = ? WHERE id = ?");

    if (!$stmt) {
        throw new Exception("Error en la preparación: " . $conn->error);
    }

    $stmt->bind_param("si", $status, $id);

    fwrite($log_file, "Consulta preparada\n");

    if ($stmt->execute()) {
        fwrite($log_file, "Actualización exitosa\n");
        echo json_encode(['success' => true]);
    } else {
        fwrite($log_file, "Error en ejecución: " . $stmt->error . "\n");
        echo json_encode(['success' => false, 'message' => $stmt->error]);
    }

    $stmt->close();

} catch (Exception $e) {
    fwrite($log_file, "Excepción: " . $e->getMessage() . "\n");
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
    fwrite($log_file, "Fin del proceso\n\n");
    fclose($log_file);
}
?>