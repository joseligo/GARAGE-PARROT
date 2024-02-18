<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>

<h2>Avis à valider</h2>

<div class="table-responsive small">
  <?php if(count($avisAvalider) == 0) { ?>
    <p>Aucun avis à valider</p>
  <?php }  else {?>
  <table class="table table-striped table-sm" id="TableA">
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Note</th>
        <th scope="col">Date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($avisAvalider as $avis) { ?>
        <tr>
          <td><?= $avis->getLastName() ?></td>
          <td><?= $avis->getFirstName() ?></td>
          <td><?= $avis->getComment() ?></td>
          <td><?= $avis->getNote() ?></td>
          <td><?= $avis->getDateFormated() ?></td>
          <td class="d-flex flex-column">
            <form action="?controller=avis&action=valider" method="POST">
              <input type="hidden" value="<?= $avis->getId() ?>" name="avisId" />
              <input type="submit" value="Valider" name="valideAvis" class="btn btn-primary" id="<?= $avis->getId() ?>">
            </form>
            <form action="?controller=avis&action=delete" method="POST">
            <input type="hidden" value="<?= $avis->getId() ?>" name="avisId" />
            <input type="submit" value="Supprimer" name="deleteAvis" class="btn btn-warning" id="<?= $avis->getId() ?>">
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
</div>


<h2>Avis publiés</h2>

<div class="table-responsive small">
  <table class="table table-striped table-sm" id="TableA">
    <thead>
      <tr>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Commentaire</th>
        <th scope="col">Note</th>
        <th scope="col">Date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php

      foreach ($avisValide as $avis) { ?>
        <tr>
          <td><?= $avis->getLastName() ?></td>
          <td><?= $avis->getFirstName() ?></td>
          <td><?= $avis->getComment() ?></td>
          <td><?= $avis->getNote() ?></td>
          <td><?= $avis->getDateFormated() ?></td>
          <td><?= $avis->getIdUser() ?>
          <td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<h2>Publier un avis</h2>


<?php require_once './templates/template/formAvis.php'; ?>
</div>

<?php require_once './templates/footerAdmin.php'; ?>