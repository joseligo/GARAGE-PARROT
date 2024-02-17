<?php

namespace App\Controller;

use App\Entity\User;
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
                    case 'save':
                        $this->saveUser();
                        break;
                    case 'delete':
                        $this->delete();
                        break;
                    case 'edit':
                        $this->edit();
                        break;
                    case 'saveEdit':
                        $this->saveEdit();
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


    protected function listUser($text = NULL, $errors = NULL)
    {
        $message = $text;

        $userRepository = new UserRepository();

        $users = $userRepository->getAllUser();

        $this->render('page/adminUser', [
            'users' => $users,
            'message' => $message,
            'errors' => $errors
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
        header('location: index.php?controller=auth&action=login');
    }
    protected function saveUser()
    {
        try {
            $errors = [];
            $message = "";
            $userRepository = new UserRepository();
            if (isset($_POST['saveUser'])) {
                if ($userRepository->findOneByEmail($_POST['email'])) {
                    $errors[] = "Cet email est déjà utilisé";
                } else {
                    $user = $userRepository->saveUser($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['role']);
                    if ($user) {
                        $prenom = $user->getFirstName();
                        $role = $user->getRole();
                        $message = "L'inscription de $prenom en tant qu'$role s'est bien déroulée";
                    } else {
                        $errors[] = 'Une erreur s\'est produite lors de l\'inscription';
                    }
                }
            }
            $this->listUser($message, $errors);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    protected function delete()
    {
        try {
            $errors = [];
            $message = "";
            $userRepository = new UserRepository();
            $res = $userRepository->deleteUser($_POST['userId']);
            if ($res) {
                $message = "L'accès a été supprimé";
            } else {
                $errors[] = "La suppression a échoué";
            }
            $this->listUser($message, $errors);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    protected function edit()
    {
        try {
            $errors = [];
            $message = "";
            $userRepository = new UserRepository();
            $user = $userRepository->findOneById($_POST['userEdit']);
            $this->render('page/adminEditUser', [
                "user" => $user,
                "message" => $message,
                "errors" => $errors
            ]);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
    protected function saveEdit()
    {
        try {
            $errors = [];
            $message = "";
            $userRepository = new UserRepository();
            if (isset($_POST['saveEditUser'])) {
                $idEmail = $userRepository->findOneByEmail($_POST['email'])->getId();
                if ($idEmail != $_POST['idUser']) {
                    $errors[] = "Cet email est déjà utilisé par un autre utilisateur";
                    $this->edit();
                } else {
                    $user = $userRepository->editUser($_POST['idUser'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['role']);
                    if ($user) {
                        $prenom = $user->getFirstName();
                        $role = $user->getRole();
                        $message = "La modification de $prenom en tant qu'$role s'est bien déroulée";
                    } else {
                        $errors[] = 'Une erreur s\'est produite lors de l\'inscription';
                    }
                    $this->listUser($message, $errors);
                }
            }
            $this->listUser($message, $errors);
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
