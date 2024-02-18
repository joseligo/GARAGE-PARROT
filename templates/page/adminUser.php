<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';

use App\Entity\User;

if (!User::adminOnly()) {
  header('location:?controller=admin&action=home');
}
?>
<?php if ($message) { ?>
  <div class="alert alert-success">
    <p><?= $message ?></p>
  </div>
<?php } ?>
<?php if ($errors) { ?>
  <div class="alert alert-danger">
    <?php foreach ($errors as $error) { ?>
      <p><?= $error ?></p>
    <?php } ?>
  </div>
<?php } ?>

  <h2 class="mt-2">Créer un accès</h2>

  <form action="?controller=user&action=save" method="POST" enctype="multipart/form-data">
    <div class="container-form-avis d-flex flex-column justify-content-center align-items-center">
      <div d-flex flex-row>
        <div>
          <label for="lastName" class="form-label">Nom</label>
          <input type="text" id="lastName" name="lastName" class="form-control">
        </div>
        <div>
          <label for="firstName" class="form-label">Prénom</label>
          <input type="text" id="firstName" name="firstName" class="form-control">
        </div>
        <div>
          <label for="email" class="form-label">Mail</label>
          <input type="text" id="email" name="email" class="form-control">
        </div>
        <div>
          <label for="password" class="form-label">Mot de passe</label>
          <input type="text" id="password" name="password" class="form-control">
        </div>
        <div>
          <label for="role" class="form-label">Rôle</label>
          <select id="role" name="role" class="form-control" required>
            <option value="">--Rôle</option>
            <option value="admin">Admin</option>
            <option value="employé">Employé</option>
          </select>
        </div>
      </div>
      <input type="submit" class="btn btn-primary my-3" name="saveUser" value="Envoyer">

    </div>
  </form>

  <h2 class="mt-2">Gestion des accès</h2>

  <div class="table-responsive small">
    <table class="table table-striped table-sm" id="TableA">
      <thead>
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Rôle</th>
          <th scope="col">email</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) { ?>
          <tr>
            <td><?= $user->getLastName() ?></td>
            <td><?= $user->getFirstName() ?></td>
            <td><?= $user->getRole() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td>
              <form action="?controller=user&action=edit" method="POST" class="d-flex flex-row">
                <input type="hidden" value="<?= $user->getId() ?>" name="userEdit" />
                <input type="submit" value="Modifier" name="modifyUser" class="btn btn-primary mx-3" id="<?= $user->getId() ?>">
              </form>
              <form action="?controller=user&action=delete" method="POST" class="d-flex flex-row">
                <input type="hidden" value="<?= $user->getId() ?>" name="userId" />
                <input type="submit" value="Supprimer" name="deleteUser" class="btn btn-secondary" id="<?= $user->getId() ?>">
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>


<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';

?>