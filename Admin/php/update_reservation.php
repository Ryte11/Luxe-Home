<?php
// Establece el tipo de contenido a JSON
header('Content-Type: application/json');

// Registra información para depuración
$log_file = fopen("debug_log.txt", "a");
fwrite($log_file, "Request recibido: " . date('Y-m-d H:i:s') . "\n");
fwrite($log_file, "POST data: " . print_r($_POST, true) . "\n");

try {
    include 'conexion.php';

    fwrite($log_file, "Conexión establecida\n");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['reservationId']) ? (int) $_POST['reservationId'] : 0;
        $nombre = isset($_POST['clientName']) ? $_POST['clientName'] : '';
        $nombre_propiedad = isset($_POST['property']) ? $_POST['property'] : '';
        $telefono = isset($_POST['phone']) ? $_POST['phone'] : '';
        $tipo_propiedad = isset($_POST['reservationType']) ? $_POST['reservationType'] : '';
        $fecha_entrada = isset($_POST['checkInDate']) ? $_POST['checkInDate'] : '';
        $fecha_salida = isset($_POST['checkOutDate']) ? $_POST['checkOutDate'] : '';
        $num_huespedes = isset($_POST['guestCount']) ? (int) $_POST['guestCount'] : 0;
        $comentarios = isset($_POST['comments']) ? $_POST['comments'] : '';
        $total = isset($_POST['total']) ? (float) $_POST['total'] : 0;
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        fwrite($log_file, "ID: $id, Nombre: $nombre, Teléfono: $telefono, Status: $status\n");

        // Verifica que la conexión esté activa
        if ($conn->connect_error) {
            throw new Exception("Conexión fallida: " . $conn->connect_error);
        }

        if ($id > 0) {
            // Actualiza solo los campos especificados
            $stmt = $conn->prepare("UPDATE reservas SET 
                                    nombre = ?, 
                                    nombre_propiedad = ?, 
                                    telefono = ?,
                                    tipo_propiedad = ?,
                                    fecha_entrada = ?,
                                    fecha_salida = ?,
                                    num_huespedes = ?,
                                    comentarios = ?,
                                    total = ?,
                                    status = ? 
                                    WHERE id = ?");

            if (!$stmt) {
                throw new Exception("Error en la preparación: " . $conn->error);
            }

            $stmt->bind_param(
                "ssssssisssi",
                $nombre,
                $nombre_propiedad,
                $telefono,
                $tipo_propiedad,
                $fecha_entrada,
                $fecha_salida,
                $num_huespedes,
                $comentarios,
                $total,
                $status,
                $id
            );
        } else {
            // Inserta una nueva reservación
            $stmt = $conn->prepare("INSERT INTO reservas (
                                    nombre, 
                                    nombre_propiedad, 
                                    telefono,
                                    tipo_propiedad,
                                    fecha_entrada,
                                    fecha_salida,
                                    num_huespedes,
                                    comentarios,
                                    total,
                                    status) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            if (!$stmt) {
                throw new Exception("Error en la preparación: " . $conn->error);
            }

            $stmt->bind_param(
                "ssssssisss",
                $nombre,
                $nombre_propiedad,
                $telefono,
                $tipo_propiedad,
                $fecha_entrada,
                $fecha_salida,
                $num_huespedes,
                $comentarios,
                $total,
                $status
            );
        }

        fwrite($log_file, "Consulta preparada\n");

        if ($stmt->execute()) {
            fwrite($log_file, "Actualización exitosa\n");
            echo json_encode(['success' => true, 'id' => $id > 0 ? $id : $stmt->insert_id]);
        } else {
            fwrite($log_file, "Error en ejecución: " . $stmt->error . "\n");
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }

        $stmt->close();
    } else {
        fwrite($log_file, "Método incorrecto: " . $_SERVER['REQUEST_METHOD'] . "\n");
        echo json_encode(['success' => false, 'message' => 'Método de solicitud inválido']);
    }

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