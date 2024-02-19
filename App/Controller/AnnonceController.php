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
                    case 'edit':
                        $this->editAnnonce($_POST['carIdEdit']);
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
            if (isset($filesData['mainImage']) && $filesData['mainImage']['error'] == 0) {
                $mainImage = $carRepository->saveImage($filesData['mainImage']);
            } else {
                $mainImage = $postData['mainImageUse'];
            }
            if(isset($postData['newBrand'])) {
                $brand = $carRepository->addBrand($postData['newBrand']);
            } else {
                $brand = $postData['brand'];
            }
            if(isset($postData['newModel'])) {
                $model = $carRepository->addModel($postData['newModel'], $brand);
            } else {
                $model = $postData['model'];
            }
            if ($postData['idCar']) {
                $idCar = $postData['idCar'];
                $carRepository->modifyCar($idCar, $brand, $model, $postData['carburetion'], $postData['km'], $mainImage, $postData['year'], $postData['price'], $postData['comment']);
            } else {
                $idCar = $carRepository->saveCar($brand, $model, $postData['carburetion'], $postData['km'], $mainImage, $postData['year'], $postData['price'], $postData['comment']);
            }
            if (isset($filesData['secondaryPicture'])) {
                for ($i = 0; $i < count($filesData['secondaryPicture']['name']); $i++) {
                    $pictureSecondaryList = ['name' => $filesData['secondaryPicture']['name'][$i], 'tmp_name' => $filesData['secondaryPicture']['tmp_name'][$i]];
                    if($filesData['secondaryPicture']['error'][$i] == 0){
                    $picture = $carRepository->saveImage($pictureSecondaryList);
                    $carRepository->savePictureBdd($picture, $idCar);
                    }
                }
            }
            header("location:?controller=annonces&action=annonce&id=$idCar");
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    protected function editAnnonce($idCar)
    {
        $carRepository = new CarsRepository();
        $car = $carRepository->getCarById($idCar);
        $listPicture = $carRepository->getPicturesByIdCar($idCar);
        $car->setSecondaryImage($listPicture);
        $carJSON = json_encode($car, JSON_FORCE_OBJECT | JSON_INVALID_UTF8_IGNORE);
        // $carJSON = $car->jsonSerialize();
        $listCarburation = $carRepository->getCarburetion();
        $listBrand = $carRepository->getBrand();

        $this->render('page/adminEditAnnonce', [
            "car" => $car,
            "carJSON" => $carJSON,
            'listPicture' => json_encode($listPicture),
            'listCarburation' => $listCarburation,
            'listBrand' => $listBrand,
            "values" => true
        ]);
    }
}
