<form action="" method="POST" class="py-5">
  <div class="container-form-avis d-flex flex-row justify-content-center align-items-center pb-5">
    <div class="px-5">
      <div>
        <label for="lastName" class="form-label">Votre nom</label>
        <input type="text" id="lastName" name="lastName" class="form-control" required>
      </div>
      <div>
        <label for="firstName" class="form-label">Votre prénom</label>
        <input type="text" id="firstName" name="firstName" class="form-control" required>
      </div>
      <div>
        <label for="numTel" class="form-label">Numéro de téléphone</label>
        <input type="tel" id="numTel" name="numTel" class="form-control" pattern="(0|\\+33|0033)[1-9][0-9]{8}" required>
      </div>
      <div>
        <label for="mail" class="form-label">Adresse mail</label>
        <input type="email" id="mail" name="mail" class="form-control" required>
      </div>
    </div>
    <div>
      <div>
        <label for="subject" class="form-label">Sujet</label>
        <select id="subject" name="subject" class="form-control" required>
          <option value="">--Indiquez le motif de votre message</option>
          <?php foreach($listSubject as $subject) { ?>
            <option value="<?=intval($subject[0])?>"><?=$subject[1]?></option>
          <?php } ?>
        </select>
      </div>
    <div class="mb-3">
      <label for="message" class="form-label">Votre message</label>
      <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
    </div>
    </div>
</div>
  <div class="container text-center">
    <input type="submit" name="sendContact" value="Envoyer">
  </div>
</form>
</div>