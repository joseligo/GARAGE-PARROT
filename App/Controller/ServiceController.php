<?php

namespace App\Controller;

use App\Repository\CarsRepository;
use App\Repository\ServicesRepository;
use App\Repository\TimetableRepository;

class ServiceController extends Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'show':
            $this->showService();
            break;
          case 'edit':
            $this->editService();
            break;
          case 'modify':
            $this->modifyService();
            break;
          default:
            throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
        }
      } else {
        throw new \Exception("Aucune action détectée");
      }
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  function showService()
  {
    try {
      $serviceRepository = new ServicesRepository();
      $services = $serviceRepository->getServices();

      $this->render('page/adminServices', [
        'services' => $services
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  function editService()
  {
    try {
      $serviceRepository = new ServicesRepository();
      $service = $serviceRepository->getServiceById($_POST['serviceIdEdit']);
      $this->render('page/adminEditService', [
        'service' => $service
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  function modifyService()
  {
    try {
      $serviceRepository = new ServicesRepository();
      if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $picture = $serviceRepository->saveImage($_FILES['picture']);
      } else {
        $picture = $_POST['PictureUse'];
      }
      $serviceRepository->editService($_POST['id'], $_POST['title'], $_POST['content'], $picture, $_SESSION['user']['id']);
      $this->showService();
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
}
