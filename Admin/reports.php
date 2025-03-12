<?php
include 'PHP/conexion.php';

// Consulta para obtener la cantidad de reportes
$sqlCantidadReportes = "SELECT COUNT(*) AS cantidad_reportes FROM contacts";
$resultCantidadReportes = $conn->query($sqlCantidadReportes);
$cantidadReportes = $resultCantidadReportes->fetch_assoc()['cantidad_reportes'];

// Consulta para obtener el promedio de reportes por semana
$sqlPromedioReportes = "SELECT AVG(reportes_por_semana) AS promedio_reportes FROM (
    SELECT COUNT(*) AS reportes_por_semana
    FROM contacts
    GROUP BY YEARWEEK(fecha_envio)
) AS subquery";
$resultPromedioReportes = $conn->query($sqlPromedioReportes);
$promedioReportes = $resultPromedioReportes->fetch_assoc()['promedio_reportes'];

// Consulta para obtener una métrica inventada para transacciones (por ejemplo, cantidad de usuarios únicos que han enviado reportes)
$sqlCantidadUsuariosUnicos = "SELECT COUNT(DISTINCT correo) AS cantidad_usuarios_unicos FROM contacts";
$resultCantidadUsuariosUnicos = $conn->query($sqlCantidadUsuariosUnicos);
$cantidadUsuariosUnicos = $resultCantidadUsuariosUnicos->fetch_assoc()['cantidad_usuarios_unicos'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe-Home Reports</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/reports.css">
</head>

<body>
    <!-- Sidebar - Keep your existing sidebar, I've included it for reference -->
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
            <a href="dashboard.php" class="nav-item">
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
            <a href="reports.php" class="nav-item active">
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
            <h1>Reportes & Análisis</h1>
        </div>

        <!-- Performance Overview -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Resumen de Rendimiento</h2>
                <div class="date-filter">
                    <select id="dateRange" class="date-select">
                        <option value="30">Últimos 30 días</option>
                        <option value="90">Últimos 90 días</option>
                        <option value="180">Últimos 6 meses</option>
                        <option value="365">Último año</option>
                    </select>
                </div>
            </div>
            <div class="card-content">
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon sales-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="stat-number"><?= $cantidadReportes ?></div>
                            <div class="stat-label">Cantidad de Reportes</div>
                            <div class="stat-change positive">+15% vs periodo anterior</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon transaction-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                        </div>
                        <div>
                            <div class="stat-number"><?= $cantidadUsuariosUnicos ?></div>
                            <div class="stat-label">Usuarios Únicos</div>
                            <div class="stat-change positive">+8% vs periodo anterior</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon avg-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="stat-number"><?= number_format($promedioReportes, 2) ?></div>
                            <div class="stat-label">Promedio de Reportes por Semana</div>
                            <div class="stat-change positive">+5% vs Semana anterior</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Report -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Reporte de Ventas</h2>
                <button id="downloadContactReport" class="download-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Descargar Reporte
                </button>
            </div>
            <div class="card-content">
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Mensaje</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Incluir archivo de conexión
                            include 'PHP/conexion.php';

                            // Consulta para obtener mensajes de contacto
                            $sql = "SELECT * FROM contacts ORDER BY fecha_envio DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $mensaje_corto = strlen($row["mensaje"]) > 50 ? substr($row["mensaje"], 0, 50) . "..." : $row["mensaje"];

                                    // Definir el estado (puedes adaptarlo según tus necesidades)
                                    $estado = isset($row["estado"]) ? $row["estado"] : "No leído";
                                    $estado_clase = "";

                                    switch ($estado) {
                                        case "Leído":
                                            $estado_clase = "completed";
                                            break;
                                        case "En proceso":
                                            $estado_clase = "active";
                                            break;
                                        default:
                                            $estado_clase = "pending";
                                            break;
                                    }

                                    echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . htmlspecialchars($row["nombre"]) . "</td>
                                <td>" . htmlspecialchars($row["correo"]) . "</td>
                                <td>" . htmlspecialchars($row["telefono"]) . "</td>
                                <td class='mensaje-celda'>
                                    <span class='mensaje-corto'>" . htmlspecialchars($mensaje_corto) . "</span>
                                    <div class='mensaje-completo'>
                                        <div class='mensaje-contenido'>" . nl2br(htmlspecialchars($row["mensaje"])) . "</div>
                                    </div>
                                    " . (strlen($row["mensaje"]) > 50 ? "<button class='ver-mas-btn' data-id='" . $row["id"] . "'>Ver más</button>" : "") . "
                                </td>
                                <td>" . date('d/m/Y H:i', strtotime($row["fecha_envio"])) . "</td>
                                <td><span class='status-badge " . $estado_clase . "'>" . $estado . "</span></td>
                                <td class='action-btn'>
                                    <button class='marcar-btn' data-id='" . $row["id"] . "' data-action='marcar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                            <polyline points='20 6 9 17 4 12'></polyline>
                                        </svg>
                                    </button>
                                    <button class='eliminar-btn' data-id='" . $row["id"] . "' data-action='eliminar'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                                            <polyline points='3 6 5 6 21 6'></polyline>
                                            <path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='no-data'>No hay mensajes de contacto.</td></tr>";
                            }

                            // Cerrar conexión
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    <button class="pagination-btn prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>
                    <div class="page-numbers">
                        <button class="page-number active">1</button>
                        <button class="page-number">2</button>
                        <button class="page-number">3</button>
                    </div>
                    <button class="pagination-btn next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>                       
    <script src="js/reports.js"></script>
</body>

</html>