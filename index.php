 <?php

 include_once('_config.php');
 Autoloader::register();
 require_once(APP.'Router.php');
$routeur = new Routeur();
$routeur->route();

