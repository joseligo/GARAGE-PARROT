<?php
spl_autoload_register();
require_once './App/Db/Mysql.php';

use App\Entity\User;

if (!User::isLogged()){
  header('location: index.php');
}
// require_once './App/Tools/session.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./App/assets/css/override-bootstrap.css" rel="stylesheet">
  <link href="./App/assets/css/adminStyle.css" rel="stylesheet">
  <title>Espace admin Garage V. Parrot</title>
</head>
<body>
<div class="container d-flex">
  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
    <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4">Espace employés</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="indexAdmin.php" class="nav-link active" aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#home"></use>
          </svg>
          Avis client
        </a>
      </li>
      <li>
        <a href="annoncesAdmin.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          Annonces
        </a>
      </li>
      <li>
        <a href="servicesAdmin.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#table"></use>
          </svg>
          Services
        </a>
      </li>
      <li>
        <a href="userAdmin.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#people-circle"></use>
          </svg>
          Employés
        </a>
      </li>
      <li>
        <a href="contactAdmin.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#people-circle"></use>
          </svg>
          Demande de contact
        </a>
      </li>
      <li>
        <a href="index.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#people-circle"></use>
          </svg>
          Voir le site
        </a>
      </li>
      <li>
        <a href="./App/templates/logout.php" class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#people-circle"></use>
          </svg>
          Déconnexion
        </a>
      </li>
    </ul>
  </div>
  <main main class="d-flex flex-column px-4">