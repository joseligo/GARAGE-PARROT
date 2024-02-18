<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>

<h2>Demande de contact</h2>

<div class="table-responsive small">
  <?php if (count($listContact) == 0) { ?>
    <p>Aucun contact pour le moment</p>
  <?php } else { ?>
    <table class="table table-striped table-sm" id="TableA">
      <thead>
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Téléphone</th>
          <th scope="col">Mail</th>
          <th scope="col">Message</th>
          <th scope="col">Sujet</th>
          <th scope="col">Date</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listContact as $contact) { ?>
          <tr>
            <td><?= $contact->getLastName() ?></td>
            <td><?= $contact->getFirstName() ?></td>
            <td><?= $contact->getPhoneNumber() ?></td>
            <td><?= $contact->getEmail() ?></td>
            <td><?= $contact->getComment() ?></td>
            <td><?= $contact->getSubject() ?></td>
            <td><?= $contact->getDateFormated() ?></td>
            <td class="d-flex flex-column">
              <form action="?controller=contact&action=valider" method="POST">
                <input type="hidden" value="<?= $contact->getIdContact() ?>" name="contactId" />
                <input type="submit" value="Valider" name="contacted" class="btn btn-primary" id="<?= $contact->getIdContact() ?>">
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } ?>
</div>