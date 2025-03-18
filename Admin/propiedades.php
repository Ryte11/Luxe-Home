<?php
include 'php/conexion.php';

// Realizar consulta a la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Verificar si la consulta fue exitosa
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}
?>
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
            <a href="propiedades.php" class="nav-item active">
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
            <h1>Manejo de propiedades</h1>
        </div>

        <!-- Success/Error Messages -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'success'): ?>
            <div class="alert alert-success">
                Operacion completada con exito!
            </div>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] == 'error'): ?>
            <div class="alert alert-danger">
                Ha ocurrido un error porfavor intente de nuevo.
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Properties List</h2>
                <button class="btn btn-primary" id="openAddModal">Add Property</button>
            </div>

            <div class="table-responsive">
                <table class="properties-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>habitaciones</th>
                            <th>Baños</th>
                            <th>Precio</th>
                            <th>Operación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td>
                                        <img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" class="property-thumbnail">
                                    </td>
                                    <td><?= $row['nombre'] ?></td>
                                    <td><?= ucfirst($row['categoria']) ?></td>
                                    <td><?= $row['habitaciones'] ?></td>
                                    <td><?= $row['banos'] ?></td>
                                    <td>$<?= number_format($row['precio'], 2) ?></td>
                                    <td>
                                        <span class="badge <?= $row['operacion'] == 'venta' ? 'badge-sale' : 'badge-rent' ?>">
                                            <?= $row['operacion'] == 'venta' ? 'For Sale' : 'For Rent' ?>
                                        </span>
                                    </td>
                                    <td class="actions">
                                        <button class="btn btn-icon btn-edit"
                                            onclick="openEditModal(<?= $row['id'] ?>, '<?= htmlspecialchars($row['nombre'], ENT_QUOTES) ?>', 
                                                '<?= htmlspecialchars($row['descripcion'], ENT_QUOTES) ?>', '<?= $row['imagen'] ?>', 
                                                '<?= $row['categoria'] ?>', <?= $row['habitaciones'] ?>, <?= $row['banos'] ?>, 
                                                <?= $row['precio'] ?>, '<?= $row['operacion'] ?>', '<?= htmlspecialchars($row['ubicacion'] ?? '', ENT_QUOTES) ?>')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-icon btn-delete" onclick="confirmDelete(<?= $row['id'] ?>)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="no-data">No properties found. Add your first property!</td>
                            </tr>
                        <?php endif; ?>
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

    <!-- delete modal -->
    <div class="modal" id="deleteConfirmModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm Delete</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this property?</p>
                <form action="php/delete_property.php" method="post">
                    <input type="hidden" id="delete_id" name="id">
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary close-modal-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Property Modal -->
    <div class="modal" id="addPropertyModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Agregar una nueva propiedad</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form action="php/add_property.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nombre">Property Name</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Description</label>
                        <textarea id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagen">Image</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" required>
                        <small>Recommended size: 800x600px</small>
                    </div>

                    <div class="form-group">
                        <label for="categoria">Category</label>
                        <select id="categoria" name="categoria" required>
                            <option value="">Select category</option>
                            <option value="villa">Villa</option>
                            <option value="apartamento">Apartment</option>
                            <option value="casa">House</option>
                            <option value="condominio">Condo</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group half">
                            <label for="habitaciones">Bedrooms</label>
                            <input type="number" id="habitaciones" name="habitaciones" min="1" required>
                        </div>

                        <div class="form-group half">
                            <label for="banos">Bathrooms</label>
                            <input type="number" id="banos" name="banos" min="1" step="0.5" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group half">
                            <label for="precio">Price</label>
                            <input type="number" id="precio" name="precio" min="0" step="0.01" required>
                        </div>

                        <div class="form-group half">
                            <label for="operacion">Operation</label>
                            <select id="operacion" name="operacion" required>
                                <option value="">Select operation</option>
                                <option value="venta">For Sale</option>
                                <option value="renta">For Rent</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="ubicacion">Location</label>
                        <input type="text" id="ubicacion" name="ubicacion" required>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary close-modal-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Property</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- editar modal -->

    <!-- Edit Property Modal -->
    <!-- Edit Property Modal -->
    <div class="modal" id="editPropertyModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar propiedad</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form action="php/update_property.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">

                    <div class="form-group">
                        <label for="edit_nombre">Nombre de propiedad</label>
                        <input type="text" id="edit_nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_descripcion">Descripción</label>
                        <textarea id="edit_descripcion" name="descripcion" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="edit_imagen">Imagen</label>
                        <div class="current-image-container">
                            <img id="current_image_preview" src="" alt="Current Property Image">
                            <input type="hidden" id="current_image" name="current_image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_imagen_nueva">Cambiar Imagen (opcional)</label>
                        <input type="file" id="edit_imagen_nueva" name="imagen_nueva" accept="image/*">
                        <small>Dejar vacío para mantener la imagen actual</small>
                    </div>

                    <div class="form-group">
                        <label for="edit_categoria">Categoría</label>
                        <select id="edit_categoria" name="categoria" required>
                            <option value="villa">Villa</option>
                            <option value="apartamento">Apartamento</option>
                            <option value="casa">Casa</option>
                            <option value="condominio">Condominio</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group half">
                            <label for="edit_habitaciones">Habitaciones</label>
                            <input type="number" id="edit_habitaciones" name="habitaciones" min="1" required>
                        </div>

                        <div class="form-group half">
                            <label for="edit_banos">Baños</label>
                            <input type="number" id="edit_banos" name="banos" min="1" step="0.5" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group half">
                            <label for="edit_precio">Precio</label>
                            <input type="number" id="edit_precio" name="precio" min="0" step="0.01" required>
                        </div>

                        <div class="form-group half">
                            <label for="edit_operacion">Operación</label>
                            <select id="edit_operacion" name="operacion" required>
                                <option value="venta">Venta</option>
                                <option value="renta">Renta</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_ubicacion">Ubicación</label>
                        <input type="text" id="edit_ubicacion" name="ubicacion" required>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary close-modal-btn">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Propiedad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/propiedades.js"></script>
</body>

</html>