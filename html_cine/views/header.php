<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/assets/css/reset.css">
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="icon" type="image/png" href="/public/assets/images/favicon.png"/>
    <title>MoviePass</title>  
</head>
<body>


<?php $url = $_SERVER["REQUEST_URI"];
$pos = strrpos($url, "login"); ?>

<?php if(!$pos) : ?>
<div id="nav" class="nav row container-fluid">
  <div class="overlay"></div>
  <div class="nav__container col-4">
    <div class="nav__logo--container ">
      <a target="_self" href="/">
        <img src="/public/assets/images/logo.png" >
      </a>
    </div>
  </div>


  <div class="nav__container hide-on-mobile-flex nav__links--container col-8 nav__menu--desktop">
    <?php if(isset($user)) : ?>
    <?php $role = $user->getRole()->getName(); ?>
      <ul>
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/cines">Adm Cines</a></li>
        <?php else : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/cines">Cines</a></li>
        <?php endif; ?>
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/funciones">Adm Funciones</a></li>
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/tickets">Mis Tickets</a></li>
        <?php if ($role === 'admin') : ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/admin/estadisticas">Estadisticas</a></li>
        <?php endif; ?>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/usuario">Perfil</a></li>
        <li class="nav__desktop--inner-link"><a class="no-border" href="/logout"><button class="btn btn-danger">Cerrar Sesión</button></a></li>
      </ul>
    <?php endif; ?>
  </div>

  <div class="nav__container nav__links--container col-8 nav__menu--mobile">
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

<?php endif; ?>
<?php include_once('partials/customMessage.php'); ?>
