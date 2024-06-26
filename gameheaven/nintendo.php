<?php
session_start();
include 'BBDD.php';
include 'header.php';

$query = "SELECT * FROM videojuegos WHERE plataforma = 'Nintendo'";
$result = $conex1->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/eb8f3619b9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/paginas.css">
    <title>Juegos de Nintendo</title>
    <script>
        function addToCart(id_videojuego, button) {
            button.disabled = true;
            button.innerHTML = 'Cargando...';

            fetch('añadir_carrito.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id_videojuego: id_videojuego })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Producto añadido al carrito');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .finally(() => {
                button.disabled = false;
                button.innerHTML = 'Añadir al carrito';
            });
        }
    </script>
</head>
<body>
    <div class="titulo">
    <h1>Juegos de Nintendo</h1></div>
    <div class="games-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="card">
                <img src="data:image/jpeg;base64,<?= base64_encode($row['imagen']) ?>" alt="<?= $row['nombre'] ?>" />
                <h5><?= $row['nombre'] ?></h5>
                <div class="precio-stock">
                <p class="precio"><?= $row['precio'] ?>€</p>
                <p class="stock">Stock: <?= $row['stock'] ?></p>
                </div>
                <button onclick="addToCart(<?= $row['id_videojuego'] ?>, this)">Añadir al carrito</button>
            </div>
        <?php endwhile; ?>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
