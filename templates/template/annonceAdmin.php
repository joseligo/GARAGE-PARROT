<?php foreach ($listCars as $car) { ?>
  <tr>
    <td><?= $car->getTitle() ?></td>
    <td><?= $car->getModel() ?></td>
    <td><?= $car->getBrand() ?></td>
    <td><?= $car->getComment() ?></td>
    <td><?= $car->getAnnouncementDate() ?></td>
    <td><?= $car->getMainImage() ?><td>
    <td></td>
    <td>
    <form action="" method="POST" class="d-flex flex-row">
        <input type="hidden" value="<?= $car->getIdCar() ?>" name="carId" />
        <input type="submit" value="Modifier" name="modifyCar" class="btn btn-primary mx-3" id="<?= $car->getIdCar() ?>">
    </form>
    <form action="?controller=admin&action=delete" method="POST" class="d-flex flex-row">
        <input type="hidden" value="<?= $car->getIdCar() ?>" name="carId" />
        <input type="submit" value="Supprimer" name="deleteCar" class="btn btn-secondary" id="<?= $car->getIdCar() ?>">
    </form>
    </td>

  </tr>
<?php } ?>