<?php
session_start();
require 'BBDD.php';
require 'header.php';

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}
// Obtener la lista de videojuegos
$query = "SELECT id_videojuego, nombre FROM videojuegos";
$result = $conex1->query($query);
$videojuegos = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/eb8f3619b9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/admin.css">
    <title>Administración</title>
</head>
<body>
    <h1 class="titulo">Panel de Administración</h1>
    
    <div class="form-container">
        <div class="left-form">
            <h2>Añadir Nuevo Producto</h2>
            <form action="añadir_producto.php" method="post" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br>
                
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea><br>
                
                <label for="genero">Género:</label>
                <input type="text" id="genero" name="genero" required><br>
                
                <label for="plataforma">Plataforma:</label>
                <select id="plataforma" name="plataforma" required>
                    <option value="PC">PC</option>
                    <option value="PlayStation">PlayStation</option>
                    <option value="Xbox">Xbox</option>
                    <option value="Nintendo">Nintendo</option>
                </select><br>
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required><br>
                
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required><br>
                
                <button type="submit">Añadir Producto</button>
            </form>
        </div>
        <div class="right-form">
            <h2>Añadir Nuevo Código</h2>
            <form action="añadir_codigo.php" method="post">
            <label for="id_videojuego">Videojuego:</label>
            <select id="id_videojuego" name="id_videojuego" required>
                <?php 
                    usort($videojuegos, function($a, $b) {
                        return strcmp($a['nombre'], $b['nombre']);
                    });
                    foreach ($videojuegos as $videojuego): 
                ?>
                    <option value="<?= $videojuego['id_videojuego'] ?>"><?= htmlspecialchars($videojuego['nombre']) ?></option>
                <?php endforeach; ?>
            </select><br>
                
                <label for="codigo">Código:</label>
                <input type="text" id="codigo" name="codigo" required><br>
                
                <button type="submit">Añadir Código</button>
            </form>
        </div>
    </div>
    
    <?php include 'footer.php';?>
</body>
</html>
