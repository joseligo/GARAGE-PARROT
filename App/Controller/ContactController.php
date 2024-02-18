<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use App\Repository\ContactRepository;

class ContactController extends Controller
{
  public function route(): void
  {
    try {
      if (isset($_GET['action'])) {
        switch ($_GET['action']) {
          case 'home':
            $this->home();
            break;
          case 'save':
            $this->saveContact();
            break;
          case 'listContact':
            $this->listContact();
            break;
          case 'valider':
            $this->valider();
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
  protected function home(string $message = NULL, string $errors = NULL)
  {

    try {
      $contactRepostory = new ContactRepository();
      $listSubject = $contactRepostory->getSubject();

      $this->render('page/contact', [
        'listSubject' => $listSubject,
        'message' => $message,
        'errors' => $errors
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function saveContact():void
  {
    try {
      $message = "";
      $errors = "";
      $contactRepository = new ContactRepository();
      if (isset($_POST['subjectAnnonce'])) {
        $subject = 6;
        $comment = $_POST['subjectAnnonce'] . " " . $_POST['message'];
      } else {
        $subject = $_POST['subject'];
        $comment = $_POST['message'];
      }
      $res = $contactRepository->saveContact($_POST['lastName'], $_POST['firstName'], $_POST['numTel'], $_POST['mail'], $comment, $subject);
      if ($res) {
        $message = "Votre message a été envoyé. Nous vous contacterons rapidement pour un rendez-vous.";
      } else {
        $errors = "Une erreur s'est produite. Veuillez réessayer ultérieurement ou nous contacter par téléphone.";
      }
      $this->home($message, $errors);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function listContact()
  {
    try {
      $message = "";
      $errors = "";

      $contactRepository = new ContactRepository();
      $res = $contactRepository->getFormContact();
      
      $this->render('page/adminContact', [
        'listContact' => $res,
        'message' => $message,
        'errors' => $errors
      ]);
    } catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
  protected function valider() {
    try {
      $contactRepository = new ContactRepository();
      $res = $contactRepository->deleteFormContact($_POST['contactId']);
      $this->listContact();
    }catch (\Exception $e) {
      $this->render('errors/default', [
        'error' => $e->getMessage()
      ]);
    }
  }
}
