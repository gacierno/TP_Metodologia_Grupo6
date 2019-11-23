<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/assets/css/reset.css">
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/public/assets/owlcarousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="icon" type="image/png" href="/public/assets/images/favicon.png"/>
    <title>MoviePass</title>
</head>
<body>


<div id="nav" class="nav row container-fluid">
  <div class="overlay"></div>
<div class="nav__container col-3"></div>
  <div class="nav__container col-6">
    <div class="nav__logo--container ">
      <a target="_self" href="/">
        <img src="/public/assets/images/logo.svg" >
      </a>
    </div>
  </div>

  <div class="nav__container nav__links--container col-3 nav__menu--desktop">
    <?php if(isset($user)) : ?>
    <div id="desktop__menu" class="some">MENU
    <?php $role = $user->getRole()->getName(); ?>
    <div class="nav__desktop--menu-container">
      <ul>
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/cines">Administrar Cines</a></li>
        <hr class="rgb-divider">
        <?php else : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/cines">Cines</a></li>
        <hr class="rgb-divider">
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/peliculas">Funciones</a></li>
        <hr class="rgb-divider">
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/funciones">Administrar Funciones</a></li>
        <hr class="rgb-divider">
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/tickets">Mis Tickets</a></li>
        <hr class="rgb-divider">
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/estadisticas">Estadisticas</a></li>
        <hr class="rgb-divider">
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/usuario">Perfil</a></li>
        <hr class="rgb-divider">
        <li class="nav__desktop--inner-link"><a class="no-border" href="/logout">Cerrar Sesión</a></li>
      </ul>
    </div>
    </div>
    <?php endif; ?>
  </div>

  <div class="nav__container nav__links--container col-3 nav__menu--mobile">
  <?php if(isset($user)) : ?>
  <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
  <label for="openSidebarMenu" class="sidebarIconToggle">
    <div class="spinner diagonal part-1"></div>
    <div class="spinner horizontal"></div>
    <div class="spinner diagonal part-2"></div>
  </label>
  <div id="sidebarMenu">
  <ul>
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/cines">Administrar Cines</a></li>
        <hr class="rgb-divider">
        <?php else : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/cines">Cines</a></li>
        <hr class="rgb-divider">
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/peliculas">Funciones</a></li>
        <hr class="rgb-divider">
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/funciones">Administrar Funciones</a></li>
        <hr class="rgb-divider">
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/tickets">Mis Tickets</a></li>
        <hr class="rgb-divider">
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/estadisticas">Estadisticas</a></li>
        <hr class="rgb-divider">
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/usuario">Perfil</a></li>
        <hr class="rgb-divider">
        <li class="nav__desktop--inner-link"><a class="no-border" href="/logout">Cerrar Sesión</a></li>
      </ul>
  </div>
  <?php endif; ?>

  </div>

</div>
