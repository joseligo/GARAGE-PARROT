<?php

namespace App\Controller;

use App\Repository\AvisRepository;

class AvisController extends Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'listAvis':
            $this->getAvis();
            break;
          case 'valider':
            $this->valideAvis();
            break;
          case 'create':
            $this->saveAvis();
            break;
          case 'delete':
            $this->deleteAvis();
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
  protected function getAvis()
  {
    try {
      if (isset($_POST['saveAvis'])) {
        $avisRepository = new AvisRepository();
        $avisRepository->saveAvis($_POST['firstName'], $_POST['lastName'], $_POST['avis'], $_POST['note']);
      }
      
      $avisRepository = new AvisRepository();
      $avisAvalider = $avisRepository->getAvisDashboard(0);
      $avisValide = $avisRepository->getAvisDashboard(1);

      $this->render('page/adminAvis', [
        'avisAvalider' => $avisAvalider,
        'avisValide' => $avisValide
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function saveAvis()
  {
    try {
      if (isset($_POST['saveAvis'])) {
        $avisRepository = new AvisRepository();
        $avisRepository->saveAvis($_POST['firstName'], $_POST['lastName'], $_POST['avis'], $_POST['note']);
      }

      header('location:?controller=avis&action=listAvis');
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function valideAvis()
  {
    try {
      $avisRepository = new AvisRepository();
      $avisAvalider = $avisRepository->validateAvis($_POST['avisId']);

      header('location:?controller=avis&action=listAvis');
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function deleteAvis()
  {
    try {
      $avisRepository = new AvisRepository();
      $avisRepository->deleteAvis($_POST['avisId']);

      header('location:?controller=avis&action=listAvis');
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
}
