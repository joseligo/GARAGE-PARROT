<?php

namespace App\Controller;

use App\Controller\UserController;
use App\Repository\CarsRepository;
use App\Repository\TimetableRepository;

class AdminController extends Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'home':
            $this->home();
            break;
          case 'annonces':
            $this->getAnnonces();
            break;
          case 'delete':
            $controller = new AnnonceController();
            $controller->route();
            break;
          case 'edit':
            $controller = new AnnonceController();
            $controller->route();
            break;
          case 'service':
            $controller = new AnnonceController();
            $controller->route();
            break;
          case 'listUser':
            $controller = new UserController();
            $controller->route();
            break;
          case 'timeTable':
            $this->setTimeTable();
            break;
          case 'saveTimeTable':
            $this->saveTimeTable();
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
  protected function home()
  {
    try {
      $this->render('page/adminHome', [
        'user' => $_SESSION['user']
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function getAnnonces()
  {
    try {
      $carRepository = new CarsRepository();
      $cars = $carRepository->getCars();
      $listCarburation = $carRepository->getCarburetion();
      $listBrand = $carRepository->getBrand();
      // $listPicture = $carRepository->getPicturesByIdCar($idCar);
      // $car->setSecondaryImage($listPicture);

      $this->render('page/adminAnnonces', [
        'listCars' => $cars,
        'car' => "",
        'carJSON' => json_encode(""),
        'listCarburation' => $listCarburation,
        'listBrand' => $listBrand,
        'listPicture' => '',
        'values' => false
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function setTimeTable()
  {
    try {
      $timeTableRepository = new TimetableRepository();
      $listTimeTable = $timeTableRepository->getTimeTable();

      $this->render('page/adminTimeTable', [
        'listTimeTable' => $listTimeTable,
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function saveTimeTable()
  {
    try {
      $timeTableRepository = new TimetableRepository();
      if(isset($_POST['closeAm'])) {
        $ouvertureAm = "Fermé";
        $fermetureAm = "Fermé";
      } else {
        $ouvertureAm = $_POST['ouvertureAm'];
        $fermetureAm = $_POST['fermetureAm'];
      }
      if(isset($_POST['closePm'])) {
        $ouverturePm = "Fermé";
        $fermeturePm = "Fermé";
      } else {
        $ouverturePm = $_POST['ouverturePm'];
        $fermeturePm = $_POST['fermeturePm'];
      }
      if(isset($_POST['continue'])) {
        $fermetureAm = "Continue";
        $ouverturePm = "Continue";
      }

      $timeTableRepository->saveTimeTable(intval($_POST["idDay"]), $ouvertureAm, $fermetureAm, $ouverturePm, $fermeturePm);

      $this->setTimeTable();
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
}
