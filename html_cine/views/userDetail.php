<?php include_once('header.php'); ?>

<?php include_once('partials/customMessage.php'); ?>

<div class="main-container container-fluid">

<h1 class="profile__header--format">Mi Perfil</h1>

<div class="row">
    <div class="col-sm-12 col-lg-4 col-xl-3 user-detail__profilepic--container">
        <img src="/public/assets/images/person.png" alt="">
    </div>
    <div class="col-sm-12 col-lg-8 col-xl-9 user-detail__user-desc--container">

    <form id="user-detail-form" class="user-detail__form" method="POST" action="/usuario/actualizar">
        <input class="inputText" type="text" name="user_id" value="<?php echo($user->getId()); ?>" hidden>
        <?php if($user->getFBId() == null) : ?>
        <label>
            <input id="user_email" class="inputText" type="text" name="user_email" value="<?php echo($user->getEmail()); ?>" disabled required>
            <span class="floating-label">Correo Electronico</span>
        </label>
        
        <label>
            <input class="inputText" type="password"  name="user_password" value="<?php echo($user->getPass()); ?>" disabled required>
            <span class="floating-label">Contraseña</span>
            <span class="user-detail__toggle-pass"><img src="/public/assets/images/eye.png" alt=""></span>
        </label>
        <label>
            <input class="inputText" type="text" name="profile_nombre" value="<?php echo($user->getProfile()->getNombre()); ?>" disabled required>
            <span class="floating-label">Nombre</span>
        </label>
        <label>
            <input class="inputText" type="text"  name="profile_apellido" value="<?php echo($user->getProfile()->getApellido()); ?>" disabled required>
            <span class="floating-label">Apellido</span>
        </label>
        <label>
            <input class="inputText" type="number"  name="profile_dni" value="<?php echo($user->getProfile()->getDni()); ?>" disabled required>
            <span class="floating-label">DNI</span>
        </label>
        <?php endif; ?>
        <button id="user-update" type="button" class="cinemaform__button--primary">Actualizar</button>

        <button id="user-delete" type="button" class="cinemaform__button--secondary">Desactivar Mi Cuenta</button>

        </form>

    </div>
</div>


</div>




<?php include_once('footer.php'); ?>

