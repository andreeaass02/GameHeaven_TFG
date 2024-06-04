<?php
// Inicia la sesión solo si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tu página principal</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/eb8f3619b9.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles/style-index.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container-fluid">
    <div class="row">
    <div class="col-md-8">
  <div id="carruselJuegos" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/elden_ring.jpg" class="d-block w-100" alt="">
      </div>
      <div class="carousel-item">
        <img src="images/red-dead-redemption-2.jpg" class="d-block w-100" alt="">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carruselJuegos" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carruselJuegos" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div class="col-md-4">
    <div class="juegos-ofertas">
        <h3>Más Vendidos</h3>
        <div class="ofertas">
            <div class="oferta_1">
            <div class="juego-info">
                    <img src="images/the-witcher3-pc.jpg" alt="">
                    <div class="descripcion-y-compra">
                        <p>En el mundo abierto de Wild Hunt, tú trazas tu propio rumbo hacia la aventura.</p>
                        <a href="pc.php" class="comprar-btn">Cómpralo YA!!</a>
                    </div>
                </div>
            </div>
            <div class="oferta_1">
            <div class="juego-info">
                    <img src="images/the_last_of_us_2-playstation.jpg" alt="">
                    <div class="descripcion-y-compra">
                        <p>Ellie y Joel vuelven a un viaje épico en la secuela del aclamado juego de Naughty Dog.</p>
                        <a href="playstation.php" class="comprar-btn">Cómpralo YA!!</a>
                    </div>
                </div>
            </div>
            <div class="oferta_1">
            <div class="juego-info">
                    <img src="images/gear5_xbox.jpg" alt="">
                    <div class="descripcion-y-compra">
                        <p>Gears 5 (Gears of War 5) es la quinta entrega de la saga de acción Gears of War</p>
                        <a href="xbox.php" class="comprar-btn">Cómpralo YA!!</a>
                    </div>
                </div>
            </div>
            <div class="oferta_1">
            <div class="juego-info">
                    <img src="images/zelda_switch.jpg" alt="">
                    <div class="descripcion-y-compra">
                        <p>Sumérgete en un mundo de aventuras y exploración en The Legend of Zelda™: Breath of the Wild.</p>
                        <a href="nintendo.php" class="comprar-btn">Cómpralo YA!!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


      <div id="games-container">
  <!-- Aquí se mostrarán los juegos -->
</div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
