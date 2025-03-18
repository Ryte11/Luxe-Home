<?php
include 'PHP/conexion.php';

// Fetch reservations from the database
$sql = "SELECT * FROM reservas";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

// Consulta para obtener las ventas totales
$sqlVentasTotales = "SELECT SUM(total) AS ventas_totales FROM reservas";
$resultVentasTotales = $conn->query($sqlVentasTotales);
$ventasTotales = $resultVentasTotales->fetch_assoc()['ventas_totales'];

// Consulta para obtener la cantidad de reservaciones
$sqlCantidadReservaciones = "SELECT COUNT(*) AS cantidad_reservaciones FROM reservas";
$resultCantidadReservaciones = $conn->query($sqlCantidadReservaciones);
$cantidadReservaciones = $resultCantidadReservaciones->fetch_assoc()['cantidad_reservaciones'];

// Consulta para obtener el valor promedio
$sqlValorPromedio = "SELECT AVG(total) AS valor_promedio FROM reservas";
$resultValorPromedio = $conn->query($sqlValorPromedio);
$valorPromedio = $resultValorPromedio->fetch_assoc()['valor_promedio'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe-Home Properties - Reservations</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/reservasiones.css">
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
                Properties
            </a>
            <a href="reservasiones.php" class="nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Reservations
            </a>
            <a href="user.php" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Users
            </a>
            <a href="reports.php" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                Reports
            </a>
            <a href="index.php" class="nav-item logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
                Sign Out
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Reservations</h1>
        </div>
        <!-- reservation datos -->
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
                            <div class="stat-number">$<?= number_format($ventasTotales, 2) ?></div>
                            <div class="stat-label">Ventas Totales</div>
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
                            <div class="stat-number"><?= $cantidadReservaciones ?></div>
                            <div class="stat-label">Transacciones</div>
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
                            <div class="stat-number">$<?= number_format($valorPromedio, 2) ?></div>
                            <div class="stat-label">Valor Promedio</div>
                            <div class="stat-change positive">+5% vs periodo anterior</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Lista de reservaciones</h2>
                <div style="display: flex; gap: 1rem;">
                    <button id="downloadContactReport" class="download-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Descargar Reporte
                    </button>
                    <button class="btn btn-primary" id="openFormBtn">Nueva Reservasión</button>

                </div>
            </div>

            <div class="reservations-table">
                <table class="reservaciones-table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th style="width: 200px;">Propiedad</th>
                            <th>Telefono</th>
                            <th>Tipo</th>
                            <th>Fecha entrada</th>
                            <th>Fecha Salida</th>
                            <th>Num. Huespedes</th>
                            <th>Comentarios</th>
                            <th>Total a pagar</th>
                            <th>Estado</th>
                            <th>Aceptar/Denegar</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td><?= htmlspecialchars($row['nombre_propiedad']) ?></td>
                                <td><?= htmlspecialchars($row['telefono']) ?></td>
                                <td><?= htmlspecialchars($row['tipo_propiedad']) ?></td>
                                <td><?= date('m/d/Y', strtotime($row['fecha_entrada'])) ?></td>
                                <td><?= date('m/d/Y', strtotime($row['fecha_salida'])) ?></td>
                                <td><?= htmlspecialchars($row['num_huespedes']) ?></td>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                    <div style="display: none;" id="comentarios">
                                        <?= htmlspecialchars($row['comentarios']) ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($row['total']) ?>$</td>
                                <td><span
                                        class="status-badge <?= strtolower($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span>
                                </td>
                                <td class="status-actions">

                                    <?php if ($row['status'] === 'Pending'): ?>
                                        <div class="status-buttons">
                                            <button class="btn-accept" data-id="<?= $row['id'] ?>">Accept</button>
                                            <button class="btn-deny" data-id="<?= $row['id'] ?>">Deny</button>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="actions">
                                    <button class="btn-edit" data-id="<?= $row['id'] ?>">Edit</button>
                                    <button class="btn-cancel" data-id="<?= $row['id'] ?>">Cancel</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
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
    </main>

    <!-- Popup Comment Modal -->
    <div id="commentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Comentario de <span id="commentClientName"></span></h3>
                <span class="close-comment-modal">&times;</span>
            </div>
            <div class="modal-body">
                <p id="commentText"></p>
            </div>
        </div>
    </div>
    <!-- Popup Form Modal -->


    <!-- Popup Form Modal -->
    <div id="reservationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Nueva Reservación</h3>
                <span class="close">&times;</span>
            </div>
            <form id="reservationForm">
                <input type="hidden" id="reservationId" name="reservationId">
                <div class="form-group">
                    <label for="clientName">Client Name</label>
                    <input type="text" id="clientName" name="clientName" required>
                </div>
                <div class="form-group">
                    <label for="property">Property</label>
                    <input type="text" id="property" name="property" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="reservationType">Reservation Type</label>
                    <input type="text" id="reservationType" name="reservationType" required>
                </div>
                <div class="form-group">
                    <label for="checkInDate">Check-in Date</label>
                    <input type="date" id="checkInDate" name="checkInDate" required>
                </div>
                <div class="form-group">
                    <label for="checkOutDate">Check-out Date</label>
                    <input type="date" id="checkOutDate" name="checkOutDate" required>
                </div>
                <div class="form-group">
                    <label for="guestCount">Number of Guests</label>
                    <input type="number" id="guestCount" name="guestCount" min="1" required>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea id="comments" name="comments" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="total">Total Payment</label>
                    <input type="number" id="total" name="total" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Denied">Denied</option>
                        <option value="Cancelado">Cancelled</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Reservation</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="js/reservaciones1.js"></script>
</body>

</html>