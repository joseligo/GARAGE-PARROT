<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>
<div class="container-annonce">
  <div class="container">
    <h1 class="text-center">VOITURES ANCIENNES A VENDRE</h1>
    <p class="fw-bold text-center">---</p>
    <h2>Notre garage s’est spécialisé dans la remise en état et la vente de voitures anciennes</h2>
    <p>Nous vous proposons différents véhicules sur stock ou en dépôt vente.

    <p>Chaque véhicule est vendu révisé et garanti afin de vous permettre de profiter pleinement de votre acquisition.
      Venez découvrir nos véhicules en stock sur rendez vous, contactez-nous.</p>

    <p>Si vous souhaitez vendre votre véhicule, nous nous tenons à votre disposition pour vous proposer une formule de dépôt vente. Nous établirons ensemble meilleures conditions de vente.</p>

    <div>
      <div>
        <form id="formFilter" name="formFilter" class="d-flex flex-row justify-content-around gap-3">
          <?php require_once('./templates/template/filter.php') ?>
        </form>
      </div>
    </div>
    <!-- Affichage des annonces (alimenté par JS) -->
    <div class="row" id="card-car-container">
    </div>
    <!-- Affichage de la pagination (alimenté par JS) -->
    <div class="pagination" id="pagination">

    </div>
  </div>
  
</div>

<script type="text/javascript" src="./assets/script/showCars.js"></script>
<script type="text/javascript" src="./assets/script/doubleRange.js"></script>

<?php
require_once _ROOTPATH_ . '/templates/footer.php';
?>