<div class="px-4 py-5 text-center div-primary">
  <h4>Ils nous ont fait confiance</h4>
  <p class="fw-bold">---</p>
  <div class="container container-avis mb-4">
    <?php foreach ($listAvis as $avis) { ?>
      <div class="card-avis">
        <h4><?= $avis->getName() ?></h4>
        <div class="star">
        <?php for($i=1; $i<=$avis->getNote(); $i++){ ?>
          &#x2605
          <?php }?>
        </div>
        <span> le <?= $avis->getDateFormated() ?></span>
        <p><?= $avis->getComment() ?></p>
      </div>
    <?php } ?>

  </div>