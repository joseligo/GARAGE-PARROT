<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
use App\Entity\User;

if (!User::adminOnly()) {
  header('location:?controller=admin&action=home');
}
?>

<h2 class="my-5">Modifier l'article <?= $service->getTitle() ?></h2>
<div class="container-service" id="container-service">

  <form action="?controller=service&action=modify" method="POST" class="d-flex flex-column" enctype="multipart/form-data">
  <!-- <form action="http://localhost:3000/templates/page/test.php" method="POST" class="d-flex flex-column" enctype="multipart/form-data"> -->
    <input type="hidden" value="<?= $service->getId() ?>" name="id" />
    <div>
      <label for="title" class="form-label my-2">Titre de l'article</label>
      <input type="texte" id="title" name="title" class="form-control" value="<?= $service->getTitle() ?>">
    </div>
    <div>
      <label for="content" class="form-label my-2">Contenu de l'article</label>
      <textarea class="form-control" id="content" name="content" rows="10" cols="50"><?= $service->getComment() ?></textarea>
    </div>
    <div>
        <img src="./assets/images/uploads/<?= $service->getPicture() ?>" class="picture-form my-2">
        <input type="hidden" value="<?= $service->getPicture() ?>" name="PictureUse"> 
      <div>
        <label for="picture">Photo principale</label>
        <input type="file" id="picture" name="picture" class="my-2" accept="image/png, image/jpeg"/>
      </div>
    <input type="submit" value="Modifier" name="modifyService" class="btn btn-primary m-3" id="<?= $service->getId() ?>">
  </form>

</div>

<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';
?>