<form action="?controller=annonces&action=save" method="POST" enctype="multipart/form-data">
  <div class="container-form-avis d-flex flex-column justify-content-center align-items-center">
    <div d-flex flex-row>
      <div>
        <label for="brand" class="form-label">Marque</label>
        <select id="brand" name="brand" class="form-control" required>
          <option value="">--Marque du véhicule</option>
          <?php foreach ($listBrand as $brand) { ?>
            <option value="<?= $brand['idBrand'] ?>"><?= $brand['nameBrand'] ?></option>
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
          <option value="<?= $carburation[0] ?>"><?= $carburation[1] ?></option>
        <?php } ?>
      </select>
    </div>
    <div>
      <label for="year" class="form-label">Année</label>
      <input type="number" id="year" name="year" class="form-control">
    </div>
    <div>
      <label for="km" class="form-label">Kilométrage</label>
      <input type="number" id="km" name="km" class="form-control">
    </div>
    <div>
      <label for="price" class="form-label">Prix</label>
      <input type="number" id="price" name="price" class="form-control">
    </div>
    <div class="mb-3">
      <label for="comment" class="form-label">Commentaire</label>
      <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
    </div>
    <div>
      <label for="mainImage">Photo principale</label>
      <input type="file" id="mainImage" name="mainImage" />
    </div>
    <div>
      <label for="secondaryPicture">Photos complementaires</label>
      <input type="file" id="secondaryPicture" name="secondaryPicture[]" multiple accept="image/png, image/jpeg" />
    </div>
    <input type="submit" name="saveCar" value="Envoyer">
  </div>
</form>