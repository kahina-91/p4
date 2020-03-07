 <?php
include_once('_config.php');
Autoloader::register();
$routeur = new Routeur();
$routeur->route();

