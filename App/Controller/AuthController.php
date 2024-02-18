<?php

namespace App\Controller;

use App\Db\Mysql;
use App\Repository\UserRepository;
use App\Repository\TimetableRepository;

class AuthController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'login':
                        $this->login();
                        break;
                    case 'logout':
                        $this->logout();
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


    protected function login()
    {
        $errors = [];

        $timeTableRepository = new TimetableRepository();
        $listTimeTable = $timeTableRepository->getTimeTable();

        if (isset($_POST['loginUser'])) {

            $userRepository = new UserRepository();

            $user = $userRepository->findOneByEmail($_POST['email']);

            if ($user && $userRepository->verifyUserLoginPassword($_POST['email'],$_POST['password'])) {
                // Regénère l'id session pour éviter la fixation de session
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'email' => $user->getEmail(),
                    'first_name' => $user->getFirstName(),
                    'last_name' => $user->getLastName(),
                    'role' => $user->getRole(),
                ];
                header('location:?controller=admin&action=home');
            } else {
                $errors[] = 'Email ou mot de passe incorrect';
            }
        }

        $this->render('page/login', [
            'errors' => $errors,
            'listTimeTable' => $listTimeTable,
        ]);
    }


    protected function logout()
    {
        //Prévient les attaques de fixation de session
        session_regenerate_id(true);
        //Supprime les données de session du serveur
        session_destroy();
        //Supprime les données du tableau $_SESSION
        unset($_SESSION);
        header ('location: index.php?controller=auth&action=login');
    }
}