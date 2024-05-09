
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Responsive</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/header.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="images/logo2.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" id="navbar-toggler-icon">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">PC</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">PlayStation</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">XBox</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Nintendo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sobre Nosotros</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['usuario'])): ?>
          <li class="nav-item">
            <span class="navbar-text">¡Bienvenido/a, <?php echo $_SESSION['usuario']; ?>!</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Cerrar sesión</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login/login.php">Login</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Carrito</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $('#navbar-toggler-icon').click(function(){
      $('#collapsibleNavbar').collapse('toggle');
    });
  });
</script>

</body>
</html>
