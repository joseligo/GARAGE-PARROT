<?php foreach ($cars as $car) { ?>
  <div class="card-vignette">
    <img src="./assets/images/uploads/<?= $car->getMainImage() ?>">

    <span class="text_holder">
      <span class="text_outer">
        <span class="text_inner">
              <h5 class="portfolio_title entry_title">
                <?= $car->getTitle() ?>
              </h5>
              <div class="btn-group">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $car->getIdCar() ?>">
              Voir le véhicule
            </button>
          </div>
        </span>
      </span>
    </span>
  </div>
  <div class="modal fade" id="exampleModal<?= $car->getIdCar() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $car->getTitle() ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= $car->getComment() ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>