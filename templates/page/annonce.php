<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>
<div class="container-annonce">
  <div class="container mb-5">
    <div class="annonce mb-5">
      <h1>Test annonces <?= $car->getTitle() ?></h1>

      <p><?= $car->getComment() ?></p>
      <ul>
        <li><?= $car->getCarburetion() ?></li>
        <li><?= $car->getMilage() ?></li>
      </ul>
      <img src="./assets/images/uploads/<?= $car->getMainImage() ?>" width="500">
    </div>
    <h2>Cette annonce vous interesse ? Prenons rendez-vous :</h2>

  </div>

  <?php
  require_once _ROOTPATH_ . '/templates/footer.php';
  ?>