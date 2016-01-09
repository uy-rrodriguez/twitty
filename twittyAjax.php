<?php
//nom de l'application
$nameApp = "twitty";

//action par défaut
$action = "login";

if(key_exists("action", $_REQUEST))
	$action =  $_REQUEST['action'];

require_once ('lib/core.php');
require_once ($nameApp.'/controller/mainController.php');
session_start();

$context = context::getInstance();
$context->init($nameApp);

$view = $context->executeAction($action, $_REQUEST);

// Inclusion de la vue
if($view == context::SUCCESS) {
	$template_view = $nameApp."/view/".$action.$view.".php";
	include($template_view);
}

// Traitement des erreurs
elseif($view == context::ERROR) {
	echo context::ERROR . ":" . context::getSessionAttribute("erreur");
	die;
}
else {
	echo context::ERROR . ":Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}

?>

