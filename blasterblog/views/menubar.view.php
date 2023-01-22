<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlasterBlog</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
    <!-- Aqui empieza el menu -->
<nav class="navbar fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand toggler-icon" href="index.php" class="enlace">
        <img src="img/logo1.png" alt="#" class="logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Parte del menu desplegable -->
    <div class="offcanvas offcanvas-end bg-warning" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">BlasterBlog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a> <!-- aria-current="page" -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="galeria.php">Galeria</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Perfil
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Inicia sesión</a></li>
              <li><a class="dropdown-item" href="#">Crear Cuenta</a></li>
                         
            </ul>
        <form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>