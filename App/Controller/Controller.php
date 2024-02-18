<?php

namespace App\Controller;

use App\Controller\PageController;
use App\Controller\AdminController;
use App\Controller\AnnonceController;
use App\Controller\ServiceController;


class Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['controller'])) {
                switch ($_GET['controller']) {
                    case 'page':
                        //charger controleur page
                        $controller = new PageController();
                        $controller->route();
                        break;
                    case 'annonces':
                        //charger controleur auth
                        $controller = new AnnonceController();
                        $controller->route();
                        break;
                    case 'auth':
                        $controller = new AuthController();
                        $controller->route();
                        break;
                    case 'admin':
                        $controller = new AdminController();
                        $controller->route();
                        break;
                    case 'service':
                        $controller = new ServiceController();
                        $controller->route();
                        break;
                    case 'user':
                        $controller = new UserController();
                        $controller->route();
                        break;
                    case 'avis':
                        $controller = new AvisController();
                        $controller->route();
                        break;
                    case 'contact':
                        $controller = new ContactController();
                        $controller->route();
                        break;
                    default:
                        throw new \Exception("Le controleur n'existe pas");
                }
            } else {
                //Chargement la page d'accueil si pas de controleur dans l'url
                $controller = new PageController();
                $controller->home();
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function render(string $path, array $params = []): void
    {
        $filePath = _ROOTPATH_ . '/templates/' . $path . '.php';

        try {
            if (!file_exists($filePath)) {
                throw new \Exception("Fichier non trouvé : " . $filePath);
            } else {
                // Extrait chaque ligne du tableau et crée des variables pour chacune
                extract($params);
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
