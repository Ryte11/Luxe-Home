<?php
include 'php/conexion.php';

// Obtener el total de propiedades
$sql_total_propiedades = "SELECT COUNT(*) AS total FROM productos";
$result_total_propiedades = $conn->query($sql_total_propiedades);
$total_propiedades = $result_total_propiedades->fetch_assoc()['total'];

// Obtener la cantidad de usuarios
$sql_total_usuarios = "SELECT COUNT(*) AS total FROM usuarios";
$result_total_usuarios = $conn->query($sql_total_usuarios);
$total_usuarios = $result_total_usuarios->fetch_assoc()['total'];

// Obtener la cantidad de propiedades en venta
$sql_propiedades_venta = "SELECT COUNT(*) AS total FROM productos WHERE operacion = 'venta'";
$result_propiedades_venta = $conn->query($sql_propiedades_venta);
$total_propiedades_venta = $result_propiedades_venta->fetch_assoc()['total'];

// Obtener la cantidad de propiedades en renta
$sql_propiedades_renta = "SELECT COUNT(*) AS total FROM productos WHERE operacion = 'renta'";
$result_propiedades_renta = $conn->query($sql_propiedades_renta);
$total_propiedades_renta = $result_propiedades_renta->fetch_assoc()['total'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe-Home Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Luxe-Home
        </div>

        <nav>
            <a href="dashboard.php" class="nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Dashboard
            </a>
            <a href="propiedades.php" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Propiedades
            </a>
            <a href="reservasiones.php" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Reservaciones
            </a>
            <a href="user.php" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Usuarios
            </a>
            <a href="reports.php" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                Reportes
            </a>
            <a href="index.php" class="nav-item logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Cerrar Sesión
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Resumen del Dashboard</h1>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon properties-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <div>
                    <div class="stat-number"><?= $total_propiedades ?></div>
                    <div class="stat-label">Propiedades</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon users-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <div class="stat-number"><?= $total_usuarios ?></div>
                    <div class="stat-label">Usuarios</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon sale-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div>
                    <div class="stat-number"><?= $total_propiedades_venta ?></div>
                    <div class="stat-label">En Venta</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rent-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div>
                    <div class="stat-number"><?= $total_propiedades_renta ?></div>
                    <div class="stat-label">En Renta</div>
                </div>
            </div>
        </div>

        <!-- Activity and Metrics Row -->
        <div class="row">
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Actividad Reciente</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                <div class="card-content">
                    <?php
                    include 'php/conexion.php';
                    // Consulta para obtener las reservaciones más recientes
                    $queryReservaciones = "SELECT r.id, r.fecha_reserva, r.status as estado, r.tipo_propiedad, 
                            r.nombre as nombre_usuario, r.nombre_propiedad
                          FROM reservas r 
                          ORDER BY r.fecha_reserva DESC LIMIT 4";

                    $resultReservaciones = $conn->query($queryReservaciones);

                    if ($resultReservaciones && $resultReservaciones->num_rows > 0) {
                        while ($rowReservacion = $resultReservaciones->fetch_assoc()) {
                            // Determinar el icono y el estilo según el estado
                            $iconClass = ($rowReservacion['estado'] == 'Confirmed') ? 'confirmed-icon' : 'pending-icon';
                            $statusClass = ($rowReservacion['estado'] == 'Confirmed') ? 'confirmed' : 'pending';

                            // Formatear la fecha
                            $fecha = !empty($rowReservacion['fecha_reserva']) ?
                                date('d/m/Y', strtotime($rowReservacion['fecha_reserva'])) : 'Fecha no disponible';
                            ?>
                            <div class="activity-item">
                                <div class="activity-icon <?= $iconClass ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <?php if ($rowReservacion['estado'] == 'Confirmed'): ?>
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        <?php else: ?>
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        <?php endif; ?>
                                    </svg>
                                </div>
                                <div class="activity-details">
                                    <div class="activity-name"><?= htmlspecialchars($rowReservacion['nombre_usuario']) ?> -
                                        <?= htmlspecialchars($rowReservacion['tipo_propiedad']) ?>
                                    </div>
                                    <div class="activity-date"><?= $fecha ?></div>
                                </div>
                                <span class="activity-status <?= $statusClass ?>"><?= $rowReservacion['estado'] ?></span>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="no-activity">No hay actividad reciente.</div>';
                    }
                    ?>
                </div>
            </div>


            <!-- Performance Metrics -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Calendario de Operaciones</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <div class="card-content">
                    <?php
                    include 'php/conexion.php';

                    // Obtener el mes actual y crear un calendario simple
                    $mesActual = date('m');
                    $anioActual = date('Y');
                    $primerDia = date('N', strtotime("$anioActual-$mesActual-01"));
                    $diasMes = date('t', strtotime("$anioActual-$mesActual-01"));

                    // Consulta simple para obtener operaciones del mes actual
                    $query = "SELECT DAY(fecha_reserva) as dia, 
                       operacion, 
                       COUNT(*) as cantidad 
                FROM reservas 
                WHERE MONTH(fecha_reserva) = $mesActual 
                AND YEAR(fecha_reserva) = $anioActual 
                GROUP BY DAY(fecha_reserva), operacion";

                    $result = $conn->query($query);

                    // Crear array asociativo para almacenar los datos
                    $operacionesPorDia = array();
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $dia = $row['dia'];
                            $operacion = $row['operacion'];
                            $cantidad = $row['cantidad'];

                            if (!isset($operacionesPorDia[$dia])) {
                                $operacionesPorDia[$dia] = array('venta' => 0, 'renta' => 0);
                            }

                            $operacionesPorDia[$dia][$operacion] = $cantidad;
                        }
                    }

                    // Nombres de días de la semana
                    $nombresDias = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];

                    // Nombre del mes actual
                    $nombresMeses = [
                        1 => 'Enero',
                        2 => 'Febrero',
                        3 => 'Marzo',
                        4 => 'Abril',
                        5 => 'Mayo',
                        6 => 'Junio',
                        7 => 'Julio',
                        8 => 'Agosto',
                        9 => 'Septiembre',
                        10 => 'Octubre',
                        11 => 'Noviembre',
                        12 => 'Diciembre'
                    ];

                    echo "<h3 class='calendar-title'>" . $nombresMeses[(int) $mesActual] . " " . $anioActual . "</h3>";

                    // Crear tabla de calendario
                    echo "<table class='calendar'>";
                    echo "<tr>";
                    foreach ($nombresDias as $dia) {
                        echo "<th>$dia</th>";
                    }
                    echo "</tr>";

                    // Primera semana con espacios vacíos
                    echo "<tr>";
                    for ($i = 1; $i < $primerDia; $i++) {
                        echo "<td class='empty'></td>";
                    }

                    // Rellenar el calendario
                    $currentDay = 1;
                    $currentWeekDay = $primerDia;

                    while ($currentDay <= $diasMes) {
                        // Si es domingo, comenzar nueva fila
                        if ($currentWeekDay > 7) {
                            echo "</tr><tr>";
                            $currentWeekDay = 1;
                        }

                        // Verificar si hay operaciones para este día
                        $clasesDia = 'day';
                        $ventasHoy = isset($operacionesPorDia[$currentDay]) ? $operacionesPorDia[$currentDay]['venta'] : 0;
                        $rentasHoy = isset($operacionesPorDia[$currentDay]) ? $operacionesPorDia[$currentDay]['renta'] : 0;

                        if ($ventasHoy > 0 || $rentasHoy > 0) {
                            $clasesDia .= ' has-operations';
                        }

                        // Marcar el día actual
                        if ($currentDay == date('j') && $mesActual == date('m') && $anioActual == date('Y')) {
                            $clasesDia .= ' today';
                        }

                        echo "<td class='$clasesDia'>";
                        echo "<div class='day-number'>$currentDay</div>";

                        if ($ventasHoy > 0 || $rentasHoy > 0) {
                            echo "<div class='operations-container'>";
                            if ($ventasHoy > 0) {
                                echo "<div class='operation venta'>$ventasHoy</div>";
                            }
                            if ($rentasHoy > 0) {
                                echo "<div class='operation renta'>$rentasHoy</div>";
                            }
                            echo "</div>";
                        }

                        echo "</td>";

                        $currentDay++;
                        $currentWeekDay++;
                    }

                    // Completar la última semana con celdas vacías
                    while ($currentWeekDay <= 7) {
                        echo "<td class='empty'></td>";
                        $currentWeekDay++;
                    }

                    echo "</tr>";
                    echo "</table>";

                    // Leyenda
                    echo "<div class='legend'>";
                    echo "<div class='legend-item'><span class='legend-color venta'></span> Ventas</div>";
                    echo "<div class='legend-item'><span class='legend-color renta'></span> Rentas</div>";
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>

        <!-- Latest Properties -->
        <div class="properties-section">
            <div class="card-header"
                style="background-color: white; border-radius: var(--border-radius) var(--border-radius) 0 0;">
                <h2 class="card-title">Latest Properties</h2>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
            </div>
            <!-- dinamic card -->
            <div class="properties-grid">
                <?php
                include 'php/conexion.php';
                // Consulta para obtener las propiedades más recientes (limitado a 4)
                $query = "SELECT id, nombre, imagen, precio, operacion, categoria, ubicacion FROM productos ORDER BY id DESC LIMIT 4";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Determinar la etiqueta y clase según la operación
                        $tagLabel = $row['operacion'] == 'venta' ? 'For Sale' : 'For Rent';
                        $tagClass = $row['operacion'] == 'venta' ? 'for-sale' : 'for-rent';

                        // Formatear el precio dependiendo de si es venta o renta
                        $formattedPrice = $row['operacion'] == 'venta'
                            ? '$' . number_format($row['precio'], 2)
                            : '$' . number_format($row['precio'], 2) . '/month';
                        ?>
                        <div class="property-card">
                            <img src="../Admin/<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" class="property-image">
                            <div class="property-details">
                                <div class="property-title">
                                    <?= $row['nombre'] ?>
                                    <span class="property-tag <?= $tagClass ?>"><?= $tagLabel ?></span>
                                </div>
                                <div class="property-location"><?= $row['ubicacion'] ?></div>
                                <div class="property-price"><?= $formattedPrice ?></div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Mensaje si no hay propiedades
                    echo '<div class="no-properties">No hay propiedades disponibles actualmente.</div>';
                }
                ?>
            </div>
            <!-- dinamic card -->


        </div>

        <!-- Additional potential script includes -->
        <script src="js/dashboard.js"></script>
    </main>
</body>

</html>