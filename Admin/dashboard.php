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
            <a href="reservaciones.php" class="nav-item">
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
                    <div class="stat-number">2</div>
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
                    <div class="stat-number">1</div>
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
                    <div class="stat-number">1</div>
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
                    <div class="stat-number">1</div>
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
                    <div class="activity-item">
                        <div class="activity-icon confirmed-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="activity-details">
                            <div class="activity-name">Sarah Johnson - visita</div>
                            <div class="activity-date">20/03/2024</div>
                        </div>
                        <span class="activity-status confirmed">confirmado</span>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon pending-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="activity-details">
                            <div class="activity-name">Michael Brown - reunión</div>
                            <div class="activity-date">21/03/2024</div>
                        </div>
                        <span class="activity-status pending">pendiente</span>
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Métricas de Rendimiento</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
                <div class="card-content">
                    <div class="metric">
                        <div class="metric-label">
                            <div>
                                <div class="metric-title">Ventas Mensuales</div>
                                <div class="metric-time">Marzo 2024</div>
                            </div>
                            <div class="metric-change">+15%</div>
                        </div>
                        <div class="metric-value">$2,500,000</div>
                    </div>
                    <div class="metric">
                        <div class="metric-label">
                            <div>
                                <div class="metric-title">Ingresos por Renta</div>
                                <div class="metric-time">Q1 2024</div>
                            </div>
                            <div class="metric-change">+8%</div>
                        </div>
                        <div class="metric-value">$45,000</div>
                    </div>
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
            <div class="properties-grid">
                <div class="property-card">
                    <img src="../ParteUsuario/img/Apartamento_3.jpeg" alt="Modern Luxury Apartment" class="property-image">
                    <div class="property-details">
                        <div class="property-title">
                            Modern Luxury Apartment
                            <span class="property-tag for-sale">For Sale</span>
                        </div>
                        <div class="property-location">Downtown</div>
                        <div class="property-price">$750,000</div>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../ParteUsuario/img/Villa_2.jpg" alt="Beachfront Villa" class="property-image">
                    <div class="property-details">
                        <div class="property-title">
                            Beachfront Villa
                            <span class="property-tag for-rent">For Rent</span>
                        </div>
                        <div class="property-location">Coastal Area</div>
                        <div class="property-price">$4500/month</div>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../ParteUsuario/img/Apartamento_3.jpeg" alt="Modern Luxury Apartment" class="property-image">
                    <div class="property-details">
                        <div class="property-title">
                            Modern Luxury Apartment
                            <span class="property-tag for-sale">For Sale</span>
                        </div>
                        <div class="property-location">Downtown</div>
                        <div class="property-price">$750,000</div>
                    </div>
                </div>
                <div class="property-card">
                    <img src="../ParteUsuario/img/Villa_2.jpg" alt="Beachfront Villa" class="property-image">
                    <div class="property-details">
                        <div class="property-title">
                            Beachfront Villa
                            <span class="property-tag for-rent">For Rent</span>
                        </div>
                        <div class="property-location">Coastal Area</div>
                        <div class="property-price">$4500/month</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional potential script includes -->
        <script src="js/dashboard.js"></script>
    </main>
</body>

</html>