<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>
<h2 class="mt-2">Nouvelle annonce</h2>
<div>
  <?php require_once './templates/template/formAnnonce.php' ?>
</div>


<div class="container my-5">
  <h2 class="mt-2">Annonces publiées</h2>

  <div class="table-responsive small">
    <table class="table table-striped table-sm" id="TableA">
      <thead>
        <tr>
          <th scope="col">Titre</th>
          <th scope="col">Marque</th>
          <th scope="col">Modèle</th>
          <th scope="col">Commentaire</th>
          <th scope="col">Date</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php require_once './templates/template/annonceAdmin.php' ?>
      </tbody>
    </table>
  </div>

</div>

<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';

?>