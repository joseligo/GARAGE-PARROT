<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>
<h2 class="mt-2">Modifier l'annonce <?=$car->getTitle()?></h2>
<div>
  <?php require_once './templates/template/formAnnonce.php' ?>
</div>

<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';

?>