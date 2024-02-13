<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>

<h2 class="my-5">Services en ligne</h2>
<div class="container-service" id="container-service">
  <?php foreach ($services as $service) { ?>
    <form action="?controller=service&action=edit" method="POST" class="d-flex flex-row">
      <input type="hidden" value="<?= $service->getId() ?>" name="serviceIdEdit" />
      <?php require _ROOTPATH_ . '/templates/template/service.php'; ?>
      <input type="submit" value="Modifier" name="modifyService" class="btn btn-primary mx-3" id="<?= $service->getId() ?>">
    </form>
  <?php } ?>
</div>

<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';
?>