<?php
require_once _ROOTPATH_ . '/templates/header.php';
?>
<div class="container mb-1 text-secondary">

  <h1 class="my-1 ">Accès employés</h1>

  <?php foreach ($errors as $error) { ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php } ?>

  <form action="" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" name="password" id="password" class="form-control">
    </div>
    <input type="submit" value="Connexion" name="loginUser" class="btn btn-primary">
  </form>
</div>
<?php
require_once _ROOTPATH_ . '/templates/footer.php';
?>