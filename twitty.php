<?php
//nom de l'application
$nameApp = "twitty";

//action par défaut
$action = "login";

require_once ('lib/core.php');
require_once ($nameApp.'/controller/mainController.php');
session_start();

$context = context::getInstance();
$context->init($nameApp);


// Contrôle de l'utilisateur connecté
if (key_exists("action", $_REQUEST)
    && key_exists("utilisateur", $_SESSION)
    && ! is_null(context::getSessionAttribute("utilisateur"))) {
    
    $action =  $_REQUEST['action'];
}
    
$view = $context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view === false) {
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
//inclusion du layout qui va lui meme inclure le template view
elseif($view != context::NONE) {
	$template_view = $nameApp."/view/".$action.$view.".php";
	include($nameApp."/layout/".$context->getLayout().".php");
}

?>

