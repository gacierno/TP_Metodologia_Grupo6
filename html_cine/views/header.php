<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>MoviePass</title>
</head>
<body>
    
<div class="nav">
  <div class="nav__container nav-desktop">
    <div class="nav__logo--container">
      <a routerLink="/">
        <img src="./assets/images/black-cat.svg" >
      </a>
    </div><div class="nav__search-box--container">
      <input type="text">
    </div><div class="nav__login-opt--container">
      <ul class="nav__login--options">
        <li><a class="nav__option--format" routerLink="/login">LOGIN</a></li>
        <li><a class="nav__option--format" routerLink="/register">REGISTER</a></li>
      </ul>
    </div>
  </div>
  <div class="nav-mobile"></div>
</div>