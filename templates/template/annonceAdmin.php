<?php foreach ($listCars as $car) { ?>
  <tr>
    <td><?= $car->getTitle() ?></td>
    <td><?= $car->getComment() ?></td>
    <td><?= $car->getAnnouncementDate() ?></td>
    <td></td>
    <td class="d-flex flex-row">
    <form action="?controller=admin&action=edit" method="POST">
        <input type="hidden" value="<?= $car->getIdCar() ?>" name="carIdEdit"  />
        <input type="submit" value="Modifier" name="modifyCar" class="btn btn-primary mx-3" id="<?= $car->getIdCar() ?>">
    </form>
    <form action="?controller=admin&action=delete" method="POST">
        <input type="hidden" value="<?= $car->getIdCar() ?>" name="carId" />
        <input type="submit" value="Supprimer" name="deleteCar" class="btn btn-secondary" id="<?= $car->getIdCar() ?>">
    </form>
    </td>

  </tr>
<?php } ?>