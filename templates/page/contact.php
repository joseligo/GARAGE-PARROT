<?php
require_once _ROOTPATH_ . '/templates/header.php';
require_once 'config.php';

spl_autoload_register();
?>
<?php if ($message) { ?>
  <div class="alert alert-success">
    <p><?= $message ?></p>
  </div>
<?php } ?>
<?php if ($errors) { ?>
  <div class="alert alert-danger">
      <p><?= $error ?></p>
  </div>
<?php } ?>

<div class="px-4 py-5 text-center contact-container">
  <div class="container">
    <?php
    require_once _ROOTPATH_ . '/templates/template/formContact.php';
    ?>
  </div>
</div>

<?php
require_once _ROOTPATH_ . '/templates/footer.php';
?>