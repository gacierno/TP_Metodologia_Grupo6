<?php include_once('header.php'); ?>


<div class="container-fluid">
    <div class="row login__row">
    <div class="login__overlay"></div>
    <video autoplay muted controls="false" loop id="loginvideo">
      <source src="/public/assets/video/back.mp4" type="video/mp4">
    </video>
    <div class="row login__inner-row">
        <div class="hide-on-mobile-flex col-md-7 col-lg-8 login-creation__first-column">
          <div class="nav-only-logo">
            <a target="_self" href="/">
              <img src="/public/assets/images/logo.png" >
            </a>
          
          </div>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-4 login__container">
            <h2 class="user-register__h2--format">Registro</h2>
        <form method="POST" action="/usuario/nuevo" class="login-form">
            <label>
                <input class="inputText" type="email" name="user_email" required autocomplete="off">
                <span class="floating-label">Ingrese Correo Electronico</span>
            </label>
            <label>
                <input class="inputText" type="password" name="user_password" required autocomplete="off">
                <span class="floating-label">Contraseña</span>
            </label>
            <label>
                <input class="inputText" type="text" name="profile_nombre" required>
                <span class="floating-label">Ingresar nombre</span>
            </label>
            <label>
                <input class="inputText" type="text" name="profile_apellido" required>
                <span class="floating-label">Ingresar Apellido</span>
            </label>
            <label>
                <input class="inputText dni-input" type="number" name="profile_dni" required>
                <span class="floating-label">Ingresar DNI</span>
            </label>
            <div class="login__button--container">
                <button class="login__button glow-on-hover" type="submit">Crear Usuario</button>
            </div>
        </form>
        </div>
    </div>

    </div>
</div>

<?php include_once('footer.php'); ?>
