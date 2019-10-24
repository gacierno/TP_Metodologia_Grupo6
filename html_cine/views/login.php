<?php include_once('header.php'); ?>

<div class="container-fluid">
    <div class="row login__row">
    <div class="login__overlay"></div>
        <div class="col-sm-10 col-md-8 col-lg-4 login__container">
        <form method="POST" action="/login" class="login-form">
            <label>
                <input class="inputText" type="text" name="username" required>
                <span class="floating-label">Nombre de Usuario</span>
            </label>
            <label>
                <input class="inputText" type="password" name="password" required>
                <span class="floating-label">Contraseña</span>
            </label>
            <div class="login__button--container">
                <button class="login__button glow-on-hover" type="submit">INGRESAR</button>
                <button class="fb-login__button glow-blue-on-hover">INGRESAR CON FACEBOOK</button>
            </div>
        </form>
        <div class="login__create--container">
            <p>No tienes usuario? <a href="/login/create">REGISTRATE</a></p>
        </div>
        </div>
        
    </div>
</div>

<?php include_once('footer.php'); ?>