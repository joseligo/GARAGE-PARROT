<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
use App\Entity\User;

if(!User::adminOnly()) {
  header('location:?controller=admin&action=home');
}
?>

<h2 class="my-5">Accès des employés</h2>
<div class="container-service" id="container-service">
  <ul>
  <?php foreach ($users as $user) { ?>
    <li><?=$user->getFirstName()?> / <?=$user->getLastName()?> / <?=$user->getRole()?></li>
  <?php } ?>
  </ul>
</div>

<?php


require_once _ROOTPATH_ . '/templates/footerAdmin.php';
?>