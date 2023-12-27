<?php

namespace App\Controller;

use App\Repository\TimetableRepository;

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

    /*
  Exemple d'appel depuis l'url
      ?controller=page&action=home
  */
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
}
