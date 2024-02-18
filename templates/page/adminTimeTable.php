<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>
<div class="container">
  <h2 class="my-5">Horaires du garage</h2>

  <?php foreach ($listTimeTable as $dayTimeTable) { ?>
    <form action="?controller=admin&action=saveTimeTable" method="POST" enctype="multipart/form-data" class="py-3">
      <h3><?= $dayTimeTable->getDay() ?></h3>
      <input type="number" name="idDay" hidden value="<?php echo $dayTimeTable->getIdDay(); ?>">
      <div class="d-flex flex-row gap-3">
        <div class="d-flex flex-column gap-3">
          <h4>Matin</h4>
          <div class="d-flex flex-column">
            <div class="d-flex flex-row gap-3">
              <div>
                <label for="ouvertureAm" class="form-label">Ouverture</label>
                <input type="time" name="ouvertureAm" class="form-control" value="<?php echo $dayTimeTable->getOuvertureAm(); ?>" />
              </div>
              <div>
                <label for="fermetureAm" class="form-label">Fermeture</label>
                <input type="time" name="fermetureAm" class="form-control" value="<?php echo $dayTimeTable->getFermetureAm(); ?>" />
              </div>
            </div>
            <div class="p-3">
              <input type="checkbox" id="closeAm" name="closeAm" <?php echo $dayTimeTable->getOuvertureAm() == "Fermé" ? "checked" : ""; ?>>
              <label for="closeAm">Fermé le matin</label>
            </div>
          </div>
        </div>
        <div class="d-flex flex-column gap-3">
          <h4>Après-midi</h4>
          <div class="d-flex flex-column">
            <div class="d-flex flex-row gap-3">
              <div>
                <label for="ouverturePm" class="form-label">Ouverture</label>
                <input type="time" name="ouverturePm" class="form-control" value="<?php echo $dayTimeTable->getOuverturePm(); ?>" />
              </div>
              <div>
                <label for="fermeturePm" class="form-label">Fermeture</label>
                <input type="time" name="fermeturePm" class="form-control" value="<?php echo $dayTimeTable->getFermeturePm(); ?>" />
              </div>
            </div>
            <div class="p-3">
              <input type="checkbox" id="closePm" name="closePm" <?php echo $dayTimeTable->getFermeturePm() == "Fermé" ? "checked" : ""; ?>>
              <label for="closePm">Fermé l'après-midi</label>
            </div>
          </div>
        </div>
        <input type="submit" class="btn btn-primary p-1" name="saveHour" value="sauvegarder"> 
      </div>
      <div class="p-3">
        <input type="checkbox" id="continue" name="continue" <?php echo $dayTimeTable->getFermetureAm() == "Continue" ? "checked" : ""; ?>>
        <label for="continue">Journée continue</label>
      </div>
    </form>
  <?php } ?>
</div>
</div>