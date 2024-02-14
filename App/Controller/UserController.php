<?php

namespace App\Controller;

use App\Db\Mysql;
use App\Repository\UserRepository;

class UserController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'listUser':
                        $this->listUser();
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


    protected function listUser()
    {
        $errors = [];

        

            $userRepository = new UserRepository();

            $users = $userRepository->getAllUser();

        $this->render('page/adminUser', [
            'users' => $users,
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