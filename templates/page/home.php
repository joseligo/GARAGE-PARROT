<?php
require_once _ROOTPATH_ . '/templates/header.php';
require_once 'config.php';

spl_autoload_register();
?>


<div class="px-4 py-5 text-center div-title">
  <div class="container">
    <h1 class="display-5 fw-bold">GARAGE V. PARROT</h1>
    <p class="fw-bold">---</p>
    <div class="col-lg-6 mx-auto">
      <p class="lead dt mb-4 fw-bold">Vente et réparation de véhicules anciens</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="#container-service" class="btn btn-primary btn-lg px-4 gap-3">En savoir plus</a>
        <a href="?controller=annonces&action=list" class="btn btn-primary btn-lg px-4">Voir les voitures</a>
      </div>
    </div>
  </div>
</div>
<!-- Section présentation des services -->
<div class="px-4 py-5 text-center div-primary">
  <div class="container d-flex align-items-center justify-content-center flex-column">
    <div class="encart text-center mb-4 py-5 px-5">
      <h2>NOUS SOMMES SPÉCIALISTES DE LA RESTAURATION, DE L’ENTRETIEN ET DE LA VENTE DE VOITURES DE COLLECTION.</h2>
      <p class="fw-bold">---</p>
      <p>Notre équipe est composée de spécialistes passionnés par les véhicules de collection. Nous nous occupons de la restauration complète mais également de l’entretien des voitures.</p>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum assumenda amet vitae at error veritatis voluptatibus nesciunt accusantium quis quisquam in quod fugiat nemo nisi, saepe sapiente est soluta dolor!</p>
    </div>
    <div class="container-service" id="container-service">
      <?php
      require_once _ROOTPATH_ . '/templates/template/service.php';
      ?>
    </div>
  </div>
</div>
<div class="px-4 py-5 text-center div-grise">
  <h3>NOS VOITURES A VENDRE</h3>
  <p class="fw-bold">---</p>
  <div class="container container-vignette">
    <?php require_once './templates/template/carsHome.php' ?>
  </div>
  <div class="d-flex align-items-center justify-content-center mt-5">
    <a href="?controller=annonces&action=list" class="btn btn btn-outline-dark btn-lg px-4">Voir toutes les voitures</a>
  </div>
</div>
<!-- Section Avis -->
<?php
require_once './templates/template/avis.php';
?>

<h4>Satisfaits de nos services ? Laisser nous votre avis</h4>
<p class="fw-bold">---</p>
<?php require_once './templates/template/formAvis.php' ?>
</div>

<div class="container text-center">
  <p class="question">
    Des questions ? N’hésitez pas à nous contacter
    <a href="contact.php">
      <i class="bi bi-envelope-fill"></i>
    </a>
  </p>

</div>

<?php
require_once _ROOTPATH_ . '/templates/footer.php';
?>