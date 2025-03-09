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

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Reservations List</h2>
                <button class="btn btn-primary" id="openFormBtn">New Reservation</button>
            </div>

            <div class="reservations-table">
                <table>
                    <thead>
                        <tr>
                            <th>CLIENT</th>
                            <th>PROPERTY</th>
                            <th>TYPE</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sarah Johnson</td>
                            <td>Modern Luxury Apartment</td>
                            <td>Visit</td>
                            <td>03/20/2025</td>
                            <td><span class="status-badge confirmed">Confirmed</span></td>
                            <td class="actions">
                                <button class="btn-edit">Edit</button>
                                <button class="btn-cancel">Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Michael Brown</td>
                            <td>Beachfront Villa</td>
                            <td>Meeting</td>
                            <td>03/21/2025</td>
                            <td class="status-actions">
                                <span class="status-badge pending">Pending</span>
                                <div class="status-buttons">
                                    <button class="btn-accept">Accept</button>
                                    <button class="btn-deny">Deny</button>
                                </div>
                            </td>
                            <td class="actions">
                                <button class="btn-edit">Edit</button>
                                <button class="btn-cancel">Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jennifer Smith</td>
                            <td>Mountain View Condo</td>
                            <td>Virtual Tour</td>
                            <td>03/25/2025</td>
                            <td><span class="status-badge denied">Denied</span></td>
                            <td class="actions">
                                <button class="btn-edit">Edit</button>
                                <button class="btn-cancel">Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Popup Form Modal -->
    <div id="reservationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>New Reservation</h3>
                <span class="close">&times;</span>
            </div>
            <form id="reservationForm">
                <div class="form-group">
                    <label for="clientName">Client Name</label>
                    <input type="text" id="clientName" name="clientName" required>
                </div>
                <div class="form-group">
                    <label for="property">Property</label>
                    <select id="property" name="property" required>
                        <option value="">Select a property</option>
                        <option value="Modern Luxury Apartment">Modern Luxury Apartment</option>
                        <option value="Beachfront Villa">Beachfront Villa</option>
                        <option value="Mountain View Condo">Mountain View Condo</option>
                        <option value="Downtown Loft">Downtown Loft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reservationType">Reservation Type</label>
                    <select id="reservationType" name="reservationType" required>
                        <option value="">Select type</option>
                        <option value="Visit">Visit</option>
                        <option value="Meeting">Meeting</option>
                        <option value="Virtual Tour">Virtual Tour</option>
                        <option value="Contract Signing">Contract Signing</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reservationDate">Date</label>
                    <input type="date" id="reservationDate" name="reservationDate" required>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" rows="3"></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Reservation</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/reservaciones.js"></script>
</body>

</html>