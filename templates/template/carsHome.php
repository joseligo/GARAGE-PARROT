<?php foreach ($cars as $car) { ?>
  <div class="card-vignette">
    <img src="./assets/images/uploads/<?= $car->getMainImage() ?>">

    <span class="text_holder">
      <span class="text_outer">
        <span class="text_inner">
              <h5 class="portfolio_title entry_title">
                <?= $car->getTitle() ?>
              </h5>
          <div>
            <a href="annonces.php" class="btn btn btn-outline-dark btn-lg px-4">Voir</a>
          </div>
        </span>
      </span>
    </span>
  </div>
<?php } ?>