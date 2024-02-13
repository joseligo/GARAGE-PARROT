<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>

<div class="container-annonce">
  <div class="container mb-5">
    <div class="annonce mb-5">
      <h1><?= $car->getTitle() ?></h1>

      <p><?= $car->getComment() ?></p>
      <ul>
        <li>Carburation : <?= $car->getCarburetion() ?></li>
        <li>Kilométrage : <?= $car->getMilage() ?></li>
        <li>Année : <?= $car->getYearOfManufacture() ?></li>
        <li>Prix : <?= $car->getPrice() ?></li>
      </ul>
      <div class="container-picture">
          <img src="./assets/images/uploads/<?= $car->getMainImage() ?>" class="picture1">
          <?php $indices = array_keys($car->getSecondaryImage());
          foreach ($indices as $index) { ?>
            <img src="./assets/images/uploads/<?= $car->getSecondaryImage()[$index]['path'] ?>" class="picture2">

          <?php } ?>
      </div>
    </div>
    <h2>Cette annonce vous interesse ? Prenons rendez-vous :</h2>
    <?php require_once _ROOTPATH_ . '/templates/template/formContact.php' ?>
  </div>

  <?php
  require_once _ROOTPATH_ . '/templates/footer.php';
  ?>