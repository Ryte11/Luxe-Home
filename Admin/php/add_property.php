<?php
include 'conexion.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $habitaciones = intval($_POST['habitaciones']);
    $banos = floatval($_POST['banos']);
    $precio = floatval($_POST['precio']);
    $operacion = mysqli_real_escape_string($conn, $_POST['operacion']);
    $ubicacion = mysqli_real_escape_string($conn, $_POST['ubicacion']);

    // Handle image upload
    $target_dir = "../img/";
    $file_extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
    $new_filename = "property_" . time() . "." . $file_extension;
    $target_file = $target_dir . $new_filename;
    $image_path = "img/" . $new_filename;

    // Check if image is valid
    $upload_ok = 1;
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check === false) {
        header("Location: ../propiedades.php?msg=error&error=not_image");
        exit();
    }

    // Check file size (5MB limit)
    if ($_FILES["imagen"]["size"] > 5000000) {
        header("Location: ../propiedades.php?msg=error&error=file_too_large");
        exit();
    }

    // Allow certain file formats
    if ($file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg") {
        header("Location: ../propiedades.php?msg=error&error=invalid_format");
        exit();
    }

    // Upload file
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insert property data to database
        $sql = "INSERT INTO productos (nombre, descripcion, imagen, categoria, habitaciones, banos, precio, operacion, ubicacion) 
                VALUES ('$nombre', '$descripcion', '$image_path', '$categoria', $habitaciones, $banos, $precio, '$operacion', '$ubicacion')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../propiedades.php?msg=success");
        } else {
            // If database error occurs, delete uploaded file
            unlink($target_file);
            header("Location: ../propiedades.php?msg=error&error=db_error");
        }
    } else {
        header("Location: ../propiedades.php?msg=error&error=upload_failed");
    }
} else {
    // Not a POST request, redirect
    header("Location: ../propiedades.php");
}

$conn->close();
?>