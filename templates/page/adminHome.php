<?php
require_once _ROOTPATH_ . '/templates/headerAdmin.php';
require_once 'config.php';
spl_autoload_register();
?>

<h1>Bonjour <?=$user['first_name']?></h1>

<?php
require_once _ROOTPATH_ . '/templates/footerAdmin.php';
?>