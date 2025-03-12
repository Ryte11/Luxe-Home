<?php
include 'conexion.php';

if (!$conn) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $cedula = trim($_POST['cedula']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['num']);
    $codigo_postal = trim($_POST['codigo']);
    $fecha_inicio = trim($_POST['fecha_entrada']);
    $fecha_fin = trim($_POST['fecha_salida']);
    $metodo_pago = trim($_POST['metodo_de_pago']);
    $tipo_casa = trim($_POST['tipo_de_casa']); // Antes era "categoria", ahora es "tipo_propiedad"
    $total = trim($_POST['total']);
    $num_huespedes = trim($_POST['num_huespedes']);
    $comentarios = trim($_POST['comentarios']);

    // Obtener el nombre de la propiedad desde la base de datos
    $stmt = $conn->prepare("SELECT nombre FROM productos WHERE categoria = ? LIMIT 1");

    if (!$stmt) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    $stmt->bind_param("s", $tipo_casa);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("Error: No se encontró una propiedad con esa categoría.");
    }

    $nombre_propiedad = $result->fetch_assoc()['nombre'];
    $stmt->close();

    // Insertar en la tabla reservas (antes estaba "categoria", ahora se usa "tipo_propiedad")
    $stmt = $conn->prepare("INSERT INTO reservas (nombre, email, cedula, direccion, telefono, codigo_postal, fecha_entrada, fecha_salida, metodo_pago, tipo_propiedad, total, nombre_propiedad, num_huespedes, comentarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Error en la consulta de inserción: " . $conn->error);
    }

    $stmt->bind_param("ssssssssssssss", $name, $email, $cedula, $direccion, $telefono, $codigo_postal, $fecha_inicio, $fecha_fin, $metodo_pago, $tipo_casa, $total, $nombre_propiedad, $num_huespedes, $comentarios);

    if ($stmt->execute()) {
        $reservation_id = $stmt->insert_id;
        header("Location: confirmation.php?id=$reservation_id");
        exit();
    } else {
        die("Error al insertar la reserva: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>