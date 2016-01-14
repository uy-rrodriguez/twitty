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
if (key_exists("utilisateur", $_SESSION)
    && ! is_null(context::getSessionAttribute("utilisateur"))) {

    // Cas d'un utilisateur dans la session

    if (! key_exists("action", $_REQUEST)
        || $_REQUEST['action'] == "login"
        || $_REQUEST['action'] == "inscription"
        || $_REQUEST['action'] == "finInscription") {

        $action = "accueil";
    }
    else {
        $action =  $_REQUEST['action'];
    }
}
else {
    // Cas utilisateur non connecté
    if (! key_exists("action", $_REQUEST)
        || ( $_REQUEST['action'] != "login"
            && $_REQUEST['action'] != "inscription"
            && $_REQUEST['action'] != "finInscription" )) {

        $action = "login";
    }
    else {
        $action =  $_REQUEST['action'];
    }
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

