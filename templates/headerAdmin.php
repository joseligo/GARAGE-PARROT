<?php
spl_autoload_register();
require_once './App/Db/Mysql.php';

use App\Entity\User;

if (!User::isLogged()) {
  header('location: index.php');
}
// require_once './App/Tools/session.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./assets/css/override-bootstrap.css" rel="stylesheet">
  <link href="./assets/css/adminStyle.css" rel="stylesheet">
  <title>Espace admin Garage V. Parrot</title>
</head>

<body class="min-height-0">

  <div class="container d-flex text-third">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark navbar">
      <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-primary text-decoration-none">
        <span class="fs-4">Espace employés</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto">
        <li>
          <a href="?controller=admin&action=annonces" class="nav-link text-white" aria-label="Annonces">
            <i class="bi bi-car-front-fill pe-2"></i>
            <span>Annonces</span>
          </a>
        </li>

        <?php if (User::adminOnly()) { ?>
          <li>
            <a href="?controller=service&action=show" class="nav-link text-white">
              <i class="bi bi-tools pe-2"></i>
              <span>Services</span>
            </a>
          </li>
          <li>
            <a href="?controller=admin&action=timeTable" class="nav-link text-white">
              <i class="bi bi-calendar-date pe-2"></i>
              <span>Horaires d'ouverture</span>
            </a>
          </li>
          <li>
            <a href="?controller=admin&action=listUser" class="nav-link text-white">
              <i class="bi bi-person-fill pe-2"></i>
              <span>Employés</span>
            </a>
          </li>
        <?php } ?>


        <li>
          <a href="?controller=avis&action=listAvis" class="nav-link text-white">
            <i class="bi bi-star-fill pe-2"></i>
            <span>Avis client</span>
          </a>
        </li>
        <li>
          <a href="?controller=contact&action=listContact" class="nav-link text-white">
            <i class="bi bi-envelope-fill pe-2"></i>
            <span>Demande de contact</span>
          </a>
        </li>

        <li>
          <a href="index.php" class="nav-link text-white">
            <i class="bi bi-eye-fill pe-2"></i>
            <span>Voir le site</span>
          </a>
        </li>
        <li>
          <a href="?controller=auth&action=logout" class="nav-link text-white">
            <i class="bi bi-box-arrow-right pe-2"></i>
            <span>Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="d-flex flex-column flex-grow-1 container">
      <main class="d-flex flex-column px-4 ">