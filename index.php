<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/App/Controller/Controller.php';
require_once __DIR__.'/App/Controller/PageController.php';
require_once __DIR__.'/App/Controller/AdminController.php';
require_once __DIR__.'/App/Controller/AnnonceController.php';
require_once __DIR__.'/App/Controller/AvisController.php';
require_once __DIR__.'/App/Controller/ContactController.php';
require_once __DIR__.'/App/Controller/PageController.php';
require_once __DIR__.'/App/Controller/ServiceController.php';
require_once __DIR__.'/App/Controller/UserController.php';
require_once __DIR__.'/App/Db/Mysql.php';


// Sécurise le cookie de session avec httponly
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => $_SERVER['SERVER_NAME'],
    'httponly' => true
]);
session_start();
define('_ROOTPATH_', __DIR__);
define('_TEMPLATEPATH_', __DIR__.'/templates');
spl_autoload_register();

use App\Controller\Controller;
// Nous avons besoin de cette classe pour verifier si l'utilisateur est connecté
use App\Entity\User;


$controller = new Controller();
$controller->route();


?>
