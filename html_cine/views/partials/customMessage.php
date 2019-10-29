
<?php if($this->errorMessage) : ?>

    <div class="custom-msg__container error-msg__container">
        <h2><?php echo $this->errorMessage; ?></h2>
    </div>

<?php endif; ?>

<?php if($this->successMessage) : ?>

    <div class="custom-msg__container success-msg__container">
        <h2><?php echo $this->successMessage; ?></h2>
    </div>

<?php endif; ?>
