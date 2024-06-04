<?php
session_start();
require 'BBDD.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $genero = $_POST['genero'];
    $plataforma = $_POST['plataforma'];
    $precio = $_POST['precio'];

    // Stock inicial a 0
    $stock = 0;

    // Verificar si ya existe un juego con el mismo nombre
    $query = "SELECT COUNT(*) FROM videojuegos WHERE nombre = ?";
    $stmt = $conex1->prepare($query);
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close(); // Cerrar el statement

    if ($count > 0) {
        echo "No se puede insertar un juego nuevo porque ya existe un juego con el nombre $nombre.";
        echo "<a href='admin.php'>Volver</a>";
        exit;
    }

    // Procesar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    } else {
        echo "Error al subir la imagen.";
        echo "<a href='admin.php'>Volver</a>";
        exit;
    }

    // Si no existe, proceder con la inserción del nuevo juego
    $query = "INSERT INTO videojuegos (nombre, descripcion, genero, plataforma, precio, stock, imagen) 
    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conex1->prepare($query);
    $stmt->bind_param("ssssdis", $nombre, $descripcion, $genero, $plataforma, $precio, $stock, $imagen);

    if ($stmt->execute()) {
        echo "Producto añadido correctamente.";
    } else {
        echo "Error al añadir el producto: " . $stmt->error;
    }
}
?>
<a href="admin.php">Volver</a>
