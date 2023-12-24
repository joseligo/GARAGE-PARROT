<div style="display:none">
  <svg>
    <symbol id="star" viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="m10 15-5.9 3 1.1-6.5L.5 7 7 6 10 0l3 6 6.5 1-4.7 4.5 1 6.6z" />
    </symbol>
  </svg>
</div>

<form action="" method="POST">
  <div class="container-form-avis d-flex flex-column justify-content-center align-items-center">
    <!-- test étoiles -->
    <input type="hidden" name="id" value="sessionID">
    <p class="wrapper-rating">
      <input name="note" id="note_0" value="-1" type="radio" checked>
      <span class="star">
        <input name="note" id="note_1" value="1" type="radio">
        <label for="note_1" title="Très mauvaise"><svg>
            <use href="#star"></use>
          </svg></label>
        <span class="star">
          <input name="note" id="note_2" value="2" type="radio">
          <label for="note_2" title="Médiocre"><svg>
              <use href="#star"></use>
            </svg></label>
          <span class="star">
            <input name="note" id="note_3" value="3" type="radio">
            <label for="note_3" title="Moyenne"><svg>
                <use href="#star"></use>
              </svg></label>
            <span class="star">
              <input name="note" id="note_4" value="4" type="radio">
              <label for="note_4" title="Bonne"><svg>
                  <use href="#star"></use>
                </svg></label>
              <span class="star">
                <input name="note" id="note_5" value="5" type="radio">
                <label for="note_5" title="Excellente"><svg>
                    <use href="#star"></use>
                  </svg></label>
              </span>
            </span>
          </span>
        </span>
      </span>
    </p>
    <div>
      <label for="lastName" class="form-label">Votre nom</label>
      <input type="text" id="lastName" name="lastName" class="form-control input-form-avis">
    </div>
    <div>
      <label for="firstName" class="form-label">Votre prénom</label>
      <input type="text" id="firstName" name="firstName" class="form-control input-form-avis">
    </div>
    <div class="mb-3">
      <label for="avis" class="form-label">Votre commentaire</label>
      <textarea class="form-control input-form-avis" id="avis" name="avis" rows="3"></textarea>
    </div>
    <input type="submit" name="saveAvis" value="Envoyer" class="btn btn-outline-light btn-lg px-4 gap-3">
  </div>
</form>
</div>