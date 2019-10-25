<?php if(isset($this->errorMsg)) : ?>

    <div class="custom-msg__container error-msg__container">
        <h2><?php echo $this->errorMsg; ?></h2>
    </div>

<?php endif; ?>


<?php if(isset($this->successMsg)) : ?>

    <div class="custom-msg__container success-msg__container">
        <h2><?php echo $this->successMsg; ?></h2>
    </div>

<?php endif; ?>