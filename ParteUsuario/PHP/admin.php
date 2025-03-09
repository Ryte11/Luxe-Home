<?php
include 'PHP/conexion.php';

// Handle form submission for adding/editing products
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $operacion = $_POST['operacion'];
    $imagen = $_POST['imagen'];
    $habitaciones = $_POST['habitaciones'];
    $banos = $_POST['banos'];
    $precio = $_POST['precio'];

    if ($id) {
        // Update existing product
        $stmt = $conn->prepare("UPDATE productos SET nombre=?, categoria=?, operacion=?, imagen=?, habitaciones=?, banos=?, precio=? WHERE id=?");
        $stmt->bind_param("ssssiiii", $nombre, $categoria, $operacion, $imagen, $habitaciones, $banos, $precio, $id);
    } else {
        // Insert new product
        $stmt = $conn->prepare("INSERT INTO productos (nombre, categoria, operacion, imagen, habitaciones, banos, precio) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiii", $nombre, $categoria, $operacion, $imagen, $habitaciones, $banos, $precio);
    }

    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM productos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
    exit();
}

// Fetch all products
$result = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Luxe Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Admin Panel</h1>
    <h2>Manage Products</h2>

    <form action="admin.php" method="POST">
        <input type="hidden" name="id" id="product-id">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria" required>
            <option value="villa">Villa</option>
            <option value="apartamento">Apartamento</option>
            <option value="casa">Casa</option>
        </select>
        <label for="operacion">Operación:</label>
        <select name="operacion" id="operacion" required>
            <option value="venta">Venta</option>
            <option value="renta">Renta</option>
        </select>
        <label for="imagen">Imagen URL:</label>
        <input type="text" name="imagen" id="imagen" required>
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" name="habitaciones" id="habitaciones" required>
        <label for="banos">Baños:</label>
        <input type="number" name="banos" id="banos" required>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" required>
        <button type="submit">Guardar</button>
    </form>

    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Operación</th>
                <th>Imagen</th>
                <th>Habitaciones</th>
                <th>Baños</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['categoria'] ?></td>
                    <td><?= $row['operacion'] ?></td>
                    <td><img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" width="100"></td>
                    <td><?= $row['habitaciones'] ?></td>
                    <td><?= $row['banos'] ?></td>
                    <td>$<?= number_format($row['precio'], 2) ?></td>
                    <td>
                        <button onclick="editProduct(<?= htmlspecialchars(json_encode($row)) ?>)">Editar</button>
                        <a href="admin.php?delete=<?= $row['id'] ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <script src="js/admin.js"></script>
</body>

</html>