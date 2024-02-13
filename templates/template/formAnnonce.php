<div data-objet-php='<?php echo ($carJSON); ?>'></div>

<?php var_dump($listPicture) ?>

<form action="?controller=annonces&action=save" method="POST" enctype="multipart/form-data">
<!-- <form action="http://localhost:3000/templates/page/test.php" method="POST" enctype="multipart/form-data"> -->
  <div class="container-form-avis d-flex flex-column justify-content-center align-items-center">
    <div d-flex flex-row>
    <input type="hidden" value="<?php echo $values ? $car->getIdCar() : ""?>" name="idCar"> 
      <div>
        <label for="brand" class="form-label">Marque</label>
        <select id="brand" name="brand" class="form-control" required>
          <option value="">--Marque du véhicule</option>
          <?php foreach ($listBrand as $brand) { ?>
            <option value="<?= $brand['idBrand'] ?>" <?php echo ($values && $car->getBrand() === $brand['nameBrand']) ? 'selected' : '' ?>><?= $brand['nameBrand'] ?></option>
          <?php } ?>
          <option value="newBrand">--Ajouter une marque</option>
        </select>
      </div>
      <div class="hidden" id="addBrand">
        <label for="newBrand" class="form-label">Nouvelle marque</label>
        <input type="texte" id="newBrand" name="newBrand" class="form-control" disabled>
      </div>
    </div>
    <div>
      <label for="model" class="form-label">Modèle</label>
      <select id="model" name="model" class="form-control" required>
        <option value="">--Modèle du véhicule</option>
      </select>
    </div>
    <div class="hidden" id="addModel">
      <label for="newModel" class="form-label">Nouvelle marque</label>
      <input type="texte" id="newModel" name="newModel" class="form-control" disabled>
    </div>
    <div>
      <label for="carburetion" class="form-label">Carburation</label>
      <select id="carburetion" name="carburetion" class="form-control" required>
        <option value="">--Carburation</option>
        <?php foreach ($listCarburation as $carburation) { ?>
          <option value="<?= $carburation[0] ?>" <?php echo ($values && $car->getCarburetion() === $carburation[1]) ? 'selected' : '' ?>><?= $carburation[1] ?></option>
        <?php } ?>
      </select>
    </div>
    <div>
      <label for="year" class="form-label">Année</label>
      <input type="number" id="year" name="year" class="form-control" value="<?php echo $values ? $car->getYearOfManufacture() : '' ?>">
    </div>
    <div>
      <label for="km" class="form-label">Kilométrage</label>
      <input type="number" id="km" name="km" class="form-control" value="<?php echo $values ? $car->getMilage() : '' ?>">
    </div>
    <div>
      <label for="price" class="form-label">Prix</label>
      <input type="number" id="price" name="price" class="form-control" value="<?php echo $values ? $car->getPrice() : '' ?>">
    </div>
    <div class="mb-3">
      <label for="comment" class="form-label">Commentaire</label>
      <textarea class="form-control" id="comment" name="comment" rows="3"><?php echo $values ? $car->getComment() : '' ?></textarea>
    </div>
    <div>
      <?php if ($values) { ?>
        <img src="./assets/images/uploads/<?= $car->getMainImage() ?>" class="picture-form">
        <input type="hidden" value="<?= $car->getMainImage() ?>" name="mainImageUse"> 
      <?php } ?>
      <div>
        <label for="mainImage">Photo principale</label>
        <input type="file" id="mainImage" name="mainImage" accept="image/png, image/jpeg" />
      </div>
    </div>
    <div>
      <div>
      <?php if($values){$indices = array_keys($car->getSecondaryImage());
          foreach ($indices as $index) { ?>
            <img src="./assets/images/uploads/<?= $car->getSecondaryImage()[$index]['path'] ?>" class="picture-form">
            <button class="delete-picture btn btn-primary" id="<?= $car->getSecondaryImage()[$index]['id'] ?>">supprimer</button>
          <?php }} ?>
        <label for="secondaryPicture">Photos complementaires</label>
        <input type="file" id="secondaryPicture" name="secondaryPicture[]" multiple accept="image/png, image/jpeg" />
      </div>
    </div>
    <input type="submit" name="saveCar" value="Envoyer">
  </div>
</form>