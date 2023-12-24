<?php foreach ($services as $service) { ?>
  <div class="card-service">
    <img src=<?= $service->getPicture() ?>>
    <h4><?= $service->getTitleUpperCase() ?></h4>
    <p class="fw-bold">---</p>
    <p><?= $service->getComment() ?></p>
  </div>
<?php } ?>