<?php
spl_autoload_register();
require_once './App/Db/Mysql.php';
require_once './App/Entity/User.php';
require_once './App/Tools/NavigationTools.php';

use App\Entity\User;
use App\Tools\NavigationTools;
// require_once './App/Tools/session.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="./assets/css/override-bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./assets/css/doubleRange.css" />
  <title>Garage V. Parrot</title>
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
          <img src="./assets/images/Logo 1.png" width="120" alt="logo">
        </a>
      </div>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="index.php" class="nav-link px-2 <?= NavigationTools::addActiveClass('page', 'home') ?>">ACCUEIL</a></li>
        <li><a href="?controller=annonces&action=list" class="nav-link px-2 <?= NavigationTools::addActiveClass('annonces', 'list') ?>">A VENDRE</a></li>
        <li><a href="?controller=contact&action=home" class="nav-link px-2 <?= NavigationTools::addActiveClass('contact', 'home') ?>">CONTACT</a></li>
        <li><a href="<?php if (User::isLogged()) {
                        echo ('?controller=admin&action=home');
                      } else {
                        echo ('?controller=auth&action=login');
                      } ?>" class="nav-link px-2">Espace employés</a></li>

      </ul>
  </div>
  </header>

  <main>