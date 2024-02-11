<?php

namespace App\Controller;

use App\Repository\TimetableRepository;
use App\Repository\CarsRepository;

class AnnonceController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'list':
                        //charger controleur liste
                        $this->listAnnonces();
                        break;
                    case 'annonce':
                        $this->getAnnonceById($_GET['id']);
                        break;
                    case 'delete':
                        $this->deleteAnnonce($_POST['carId']);
                        break;
                    case 'save':
                        $this->saveAnnonce($_POST, $_FILES);
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

    protected function listAnnonces()
    {
        try {

            $timeTableRepository = new TimetableRepository();
            $listTimeTable = $timeTableRepository->getTimeTable();

            $doubleRanges = array(
                ["name" => "doubleRange", "type" => "barrePrice", "barreMilieu" => "barreMilieuPrice", "classeT1" => "t1Price", "classeT2" => "t2Price", "name1" => "priceMin", "name2" => "priceMax", "id1" => "priceMin", "id2" => "priceMax"],
                ["name" => "doubleRange2", "type" => "barreKm", "barreMilieu" => "barreMilieuKm", "classeT1" => "t1Km", "classeT2" => "t2Km", "name1" => "kmmin", "name2" => "kmmax", "id1" => "kmmin", "id2" => "kmmax"],
                ["name" => "doubleRange3", "type" => "barreYear", "barreMilieu" => "barreMilieuYear", "classeT1" => "t1Year", "classeT2" => "t2Year", "name1" => "yearmin", "name2" => "yearmax", "id1" => "yearmin", "id2" => "yearmax"]
            );

            $this->render('page/annonces', [
                "doubleRanges" => $doubleRanges,
                "listTimeTable" => $listTimeTable
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    protected function getAnnonceById($idCar)
    {
        try {
            $timeTableRepository = new TimetableRepository();
            $listTimeTable = $timeTableRepository->getTimeTable();

            $carRepository = new CarsRepository();
            $car = $carRepository->getCarById($idCar);
            $listPicture = $carRepository->getPicturesByIdCar($idCar);
            $car->setSecondaryImage($listPicture);


            $this->render('page/annonce', [
                "listTimeTable" => $listTimeTable,
                "car" => $car
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    protected function deleteAnnonce($idCar)
    {
        $carRepository = new CarsRepository();
        $carRepository->deleteCar($idCar);
        header('location:?controller=admin&action=annonces');
    }
    protected function saveAnnonce($postData, $filesData)
    {
        try {
            $carRepository = new CarsRepository();
            $mainImage = $carRepository->saveImage($filesData['mainImage']);
            $idCar = $carRepository->saveCar($postData['brand'], $postData['model'], $postData['carburetion'], $postData['km'], $mainImage, $postData['year'], $postData['price'], $postData['comment']);
            
            header("location:?controller=annonces&action=annonce&id=$idCar");
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
