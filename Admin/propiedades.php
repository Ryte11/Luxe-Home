<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe-Home Properties</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/propiedades.css">
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
            <a href="properties.php" class="nav-item active">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Properties
            </a>
            <a href="reservasiones.php" class="nav-item">
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
            <h1>Property Management</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Properties List</h2>
                <button class="btn btn-primary">Add Property</button>
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
                        <div class="property-features">
                            <span>3 beds</span>
                            <span>2 baths</span>
                            <span>1500 sqft</span>
                        </div>
                        <div class="property-actions">
                            <a href="#" class="edit-link">Edit</a>
                            <a href="#" class="delete-link">Delete</a>
                        </div>
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
                        <div class="property-features">
                            <span>4 beds</span>
                            <span>3 baths</span>
                            <span>2200 sqft</span>
                        </div>
                        <div class="property-actions">
                            <a href="#" class="edit-link">Edit</a>
                            <a href="#" class="delete-link">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/properties.js"></script>
</body>
</html>