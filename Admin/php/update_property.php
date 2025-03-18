<?php
// ==== UPDATE_PROPERTY.PHP ====
include 'conexion.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $habitaciones = intval($_POST['habitaciones']);
    $banos = floatval($_POST['banos']);
    $precio = floatval($_POST['precio']);
    $operacion = mysqli_real_escape_string($conn, $_POST['operacion']);
    $ubicacion = mysqli_real_escape_string($conn, $_POST['ubicacion']);

    $image_path = $current_image; // Default to current image

    // Check if a new image was uploaded
    if (isset($_FILES["imagen_nueva"]) && $_FILES["imagen_nueva"]["size"] > 0) {
        // Handle image upload - MODIFIED PATHS
        $target_dir = "../ParteUsuario/img/";
        $file_extension = pathinfo($_FILES["imagen_nueva"]["name"], PATHINFO_EXTENSION);
        $new_filename = "property_" . time() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;
        $image_path = "ParteUsuario/img/" . $new_filename;  // MODIFIED PATH for database storage

        // Check if image is valid
        $upload_ok = 1;
        $check = getimagesize($_FILES["imagen_nueva"]["tmp_name"]);
        if ($check === false) {
            header("Location: ../propiedades.php?msg=error&error=not_image");
            exit();
        }

        // Check file size (5MB limit)
        if ($_FILES["imagen_nueva"]["size"] > 5000000) {
            header("Location: ../propiedades.php?msg=error&error=file_too_large");
            exit();
        }

        // Allow certain file formats
        if ($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg") {
            header("Location: ../propiedades.php?msg=error&error=invalid_format");
            exit();
        }

        // Upload file
        if (!move_uploaded_file($_FILES["imagen_nueva"]["tmp_name"], $target_file)) {
            header("Location: ../propiedades.php?msg=error&error=upload_failed");
            exit();
        }

        // Delete old image if it's not the default one and exists
        if (file_exists("../" . $current_image) && !strpos($current_image, "Fondo")) {
            unlink("../" . $current_image);
        }
    }

    // Update property data in database
    $sql = "UPDATE productos SET 
            nombre = '$nombre',
            descripcion = '$descripcion',
            imagen = '$image_path',
            categoria = '$categoria',
            habitaciones = $habitaciones,
            banos = $banos,
            precio = $precio,
            operacion = '$operacion',
            ubicacion = '$ubicacion'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../propiedades.php?msg=success");
    } else {
        // If new image was uploaded but database error occurs, delete the new image
        if (isset($_FILES["imagen_nueva"]) && $_FILES["imagen_nueva"]["size"] > 0) {
            if (file_exists($target_file)) {
                unlink($target_file);
            }
        }
        header("Location: ../propiedades.php?msg=error&error=db_error");
    }
} else {
    // Not a POST request, redirect
    header("Location: ../propiedades.php");
}

$conn->close();
?>