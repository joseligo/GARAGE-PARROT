<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>

<h1>Bonjour <?=$user['first_name']?></h1>

<p>L'utilisation du dashboard est optimisé sur ordinateur ou mobile en mode paysage</p>
<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';
?>