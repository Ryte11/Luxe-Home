<?php
// Database connection configuration
include 'conexion.php';

// Check if ID is set in URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int) $_GET['id'];

// Fetch reservation details
$stmt = $conn->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}

$reservation = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Reserva</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #c6c6c6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .confirmation-container {
            background: #fff;
            padding: 50px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            max-width: 800px;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #4568DC;
            margin-bottom: 10px;
        }

        .reservation-details {
            margin-bottom: 30px;
        }

        .reservation-details h2 {
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
        }

        .detail-group {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .detail-item {
            flex: 1;
            min-width: 200px;
            margin-bottom: 15px;
            padding-right: 20px;
        }

        .detail-item h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .detail-item p {
            font-size: 16px;
            color: #333;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            font-family: 'Roboto', sans-serif;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .btn-primary {
            background: #4568DC;
            color: white;
        }

        .btn-secondary {
            background: #f1f1f1;
            color: #333;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .reservation-code {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            color: #4568DC;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="confirmation-container">
        <div class="header">
            <h1>¡Reserva Confirmada!</h1>
            <p>Gracias por confiar en nosotros para su alojamiento</p>
        </div>

        <div class="reservation-code">
            Código de Reserva: #<?php echo $reservation['id']; ?>
        </div>

        <div class="reservation-details">
            <h2>Detalles de la Reserva</h2>

            <div class="detail-group">
                <div class="detail-item">
                    <h3>Nombre</h3>
                    <p><?php echo htmlspecialchars($reservation['nombre']); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Email</h3>
                    <p><?php echo htmlspecialchars($reservation['email']); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Teléfono</h3>
                    <p><?php echo htmlspecialchars($reservation['telefono']); ?></p>
                </div>
            </div>

            <div class="detail-group">
                <div class="detail-item">
                    <h3>Nombre de la Propiedad</h3>
                    <p><?php echo htmlspecialchars($reservation['nombre_propiedad']); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Tipo de Propiedad</h3>
                    <p><?php echo htmlspecialchars($reservation['tipo_propiedad']); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Fecha de Entrada</h3>
                    <p><?php echo date('d/m/Y', strtotime($reservation['fecha_entrada'])); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Fecha de Salida</h3>
                    <p><?php echo date('d/m/Y', strtotime($reservation['fecha_salida'])); ?></p>
                </div>
            </div>

            <div class="detail-group">
                <div class="detail-item">
                    <h3>Total Pagado</h3>
                    <p><?php echo htmlspecialchars($reservation['total']); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Método de Pago</h3>
                    <p><?php echo htmlspecialchars($reservation['metodo_pago']); ?></p>
                </div>

                <div class="detail-item">
                    <h3>Fecha de Reserva</h3>
                    <p><?php echo date('d/m/Y H:i', strtotime($reservation['fecha_reserva'])); ?></p>
                </div>
            </div>

            <?php if (!empty($reservation['comentarios'])): ?>
                <div class="detail-group">
                    <div class="detail-item" style="flex: 100%;">
                        <h3>Comentarios</h3>
                        <p><?php echo nl2br(htmlspecialchars($reservation['comentarios'])); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="buttons">
            <button class="btn btn-primary" onclick="window.print()">Imprimir Confirmación</button>
            <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>
</body>

</html>