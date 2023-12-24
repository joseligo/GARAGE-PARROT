<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use App\Repository\CarsRepository;
use App\Repository\ServicesRepository;


class PageController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'home':
                        //charger controleur home
                        $this->home();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : ".$_GET['action']);
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch(\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }

    }

    /*
    Exemple d'appel depuis l'url
        ?controller=page&action=home
    */
    protected function home()
    {   
      try {
        $serviceRepository = new ServicesRepository();
        $services = $serviceRepository->getServices();

        $carRepository = new CarsRepository();
        $cars = $carRepository->getCars(4);

        $avisRepository = new AvisRepository();
        $listAvis = $avisRepository->getAvis(4);

        if (isset($_POST['saveAvis'])) {
            $avisRepository = new AvisRepository();
            $avisRepository->saveAvis($_POST['firstName'], $_POST['lastName'], $_POST['avis'], $_POST['note']);
          }

        $this->render('page/home', [
            'services' => $services,
            'cars' => $cars,
            'listAvis' => $listAvis
        ]);
      }
     catch (\Exception $e) {
      $this->render('errors/default', [
          'error' => $e->getMessage()
      ]);
  } 
    }

}