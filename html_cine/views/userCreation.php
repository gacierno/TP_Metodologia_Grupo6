<?php include_once('header.php'); ?>

<?php include_once('partials/customMessage.php'); ?>

<div class="container-fluid">
    <div class="row login__row user-creation__row">
    <div class="nav-only-logo">
      <a target="_self" href="/">
        <img src="/public/assets/images/logo.png" >
      </a>
    </div>
    <div class="login__overlay"></div>
        <div class="col-sm-10 col-md-8 col-lg-4 login__container">
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

<?php include_once('footer.php'); ?>
