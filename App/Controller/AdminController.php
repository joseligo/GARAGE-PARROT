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
}
