<?php
include 'PHP/conexion.php';

// Obtener los datos de los usuarios de la base de datos
$query = "SELECT * FROM usuarios";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxe-Home Properties - User Management</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/users.css">
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
            <a href="user.php" class="nav-item active">
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
            <h1>User Management</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="buscador">
                    <h2 class="card-title">Users List</h2>
                
                </div>
                <div class="card-actions">
                    <div class="filter-container">
                        <select id="roleFilter" class="role-filter">
                            <option value="all">All Users</option>
                            <option value="admin">Administradores</option>
                            <option value="usuario">usuario</option>
                        </select>
                    </div>
                    <button id="downloadContactReport" class="download-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Descargar Reporte
                    </button>
                    <button class="btn btn-primary" id="addUserBtn">Add User</button>
                </div>
            </div>

            <div class="users-table">
                <table>
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr data-role="<?= $row['rol'] ?>">
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><span class="role-badge <?= $row['rol'] ?>"><?= ucfirst($row['rol']) ?></span></td>
                                <td class="actions">
                                    <button class="btn-edit" data-id="<?= $row['id'] ?>">Edit</button>
                                    <button class="btn-delete" data-id="<?= $row['id'] ?>">Delete</button>
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

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New User</h3>
                <span class="close">&times;</span>
            </div>
            <form id="addUserForm" class="user-form" action="php/add_user.php" method="POST">
                <div class="form-group">
                    <label for="userName">Full Name <span class="required">*</span></label>
                    <input type="text" id="userName" name="userName" required>
                    <span class="error-message" id="nameError"></span>
                </div>
                <div class="form-group">
                    <label for="userEmail">Email Address <span class="required">*</span></label>
                    <input type="email" id="userEmail" name="userEmail" required>
                    <span class="error-message" id="emailError"></span>
                </div>
                <div class="form-group">
                    <label for="userPassword">Password <span class="required">*</span></label>
                    <input type="password" id="userPassword" name="userPassword">
                    <span class="error-message" id="passwordError"></span>
                </div>
                <div class="form-group">
                    <label for="userRole">Role <span class="required">*</span></label>
                    <select id="userRole" name="userRole" required>
                        <option value="">Select role</option>
                        <option value="admin">Administrator</option>
                        <option value="usuario">usuario</option>
                    </select>
                    <span class="error-message" id="roleError"></span>
                </div>
                <div class="form-group">
                    <label for="userPhone">Phone Number</label>
                    <input type="tel" id="userPhone" name="userPhone">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit User</h3>
                <span class="close">&times;</span>
            </div>
            <form id="editUserForm" class="user-form" action="php/edit_user.php" method="POST">
                <input type="hidden" id="editUserId" name="editUserId">
                <div class="form-group">
                    <label for="editUserName">Full Name <span class="required">*</span></label>
                    <input type="text" id="editUserName" name="editUserName" required>
                    <span class="error-message" id="editNameError"></span>
                </div>
                <div class="form-group">
                    <label for="editUserEmail">Email Address <span class="required">*</span></label>
                    <input type="email" id="editUserEmail" name="editUserEmail" required>
                    <span class="error-message" id="editEmailError"></span>
                </div>
                <div class="form-group">
                    <label for="editUserRole">Role <span class="required">*</span></label>
                    <select id="editUserRole" name="editUserRole" required>
                        <option value="">Select role</option>
                        <option value="admin">Administrator</option>
                        <option value="client">Usuario</option>
                    </select>
                    <span class="error-message" id="editRoleError"></span>
                </div>
                <div class="form-group">
                    <label for="editUserPhone">Phone Number</label>
                    <input type="tel" id="editUserPhone" name="editUserPhone">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary close-modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteUserModal" class="modal">
        <div class="modal-content delete-modal">
            <div class="modal-header">
                <h3>Delete User</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="warning-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                        stroke="#e74a3b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                <p class="user-to-delete">User: <span id="deleteUserName"></span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close-modal">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
    <!-- Add this in your HTML head section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add the download button listener
            const downloadBtn = document.getElementById('downloadBtn') ||
                document.getElementById('downloadContactReport');

            if (downloadBtn) {
                downloadBtn.addEventListener('click', function () {
                    exportTableToExcel();
                });
            }

            function exportTableToExcel() {
                // Get the table element
                const table = document.querySelector('table');
                const wb = XLSX.utils.book_new();

                const ws = XLSX.utils.table_to_sheet(table);

                XLSX.utils.book_append_sheet(wb, ws, "Estudiantes");

                // GGenera el excel con ese nombre
                XLSX.writeFile(wb, "estudiantes.xlsx");
            }
        });
    </script>
    <script src="js/user.js"></script>
</body>

</html>