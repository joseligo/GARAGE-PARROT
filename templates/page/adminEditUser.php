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
<div class="container my-5">

  <h2 class="mt-2">Modifier un accès</h2>

  <form action="?controller=user&action=saveEdit" method="POST" enctype="multipart/form-data">
    <div class="container-form-avis d-flex flex-column justify-content-center align-items-center">
      <div d-flex flex-row>
      <input type="hidden" value="<?= $user->getId()?>" name="idUser"> 
        <div>
          <label for="lastName" class="form-label">Nom</label>
          <input type="text" id="lastName" name="lastName" value="<?= $user->getLastName()?>" class="form-control">
        </div>
        <div>
          <label for="firstName" class="form-label">Prénom</label>
          <input type="text" id="firstName" name="firstName" value="<?= $user->getFirstName()?>" class="form-control">
        </div>
        <div>
          <label for="email" class="form-label">Mail</label>
          <input type="text" id="email" name="email" value="<?= $user->getEmail()?>" class="form-control">
        </div>
        <div>
          <label for="role" class="form-label">Rôle</label>
          <select id="role" name="role" class="form-control" required>
            <option value="">--Rôle</option>
            <option value="admin" <?php echo ($user->getRole() === "admin") ? 'selected' : '' ?>>Admin</option>
            <option value="employé" <?php echo ($user->getRole() === "employé") ? 'selected' : '' ?>>Employé</option>
          </select>
        </div>
      </div>
      <input type="submit" class="btn btn-primary my-3" name="saveEditUser" value="Envoyer">

    </div>
  </form>