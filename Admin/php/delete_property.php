<?php
// ==== DELETE_PROPERTY.PHP ====
include 'conexion.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Get property image before deletion to delete the file
    $sql = "SELECT imagen FROM productos WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = $row['imagen'];

        // Delete property from database
        $delete_sql = "DELETE FROM productos WHERE id = $id";

        if ($conn->query($delete_sql) === TRUE) {
            // Delete image file if it's not a default image and exists
            if (file_exists("../" . $image_path) && !strpos($image_path, "Fondo")) {
                unlink("../" . $image_path);
            }
            header("Location: ../propiedades.php?msg=success");
        } else {
            header("Location: ../propiedades.php?msg=error&error=db_error");
        }
    } else {
        header("Location: ../propiedades.php?msg=error&error=not_found");
    }
} else {
    // Not a POST request or ID not set, redirect
    header("Location: ../propiedades.php");
}

$conn->close();
?>