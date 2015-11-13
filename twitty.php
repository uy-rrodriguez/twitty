<html>

<head>
	<meta charset="UTF-8" />
	<meta name="author" content="GARAYT Thomas UAPV1602799 & RODRIGUEZ Ricardo UAPV1601663" />
	<meta name="description" content="Première page qui permet de voir la liste d'utilisateurs" />
	<link type="text/css" rel="stylesheet" href="css/style.php" />
	<title>Accueil</title>
</head>
<body>

<?php
//nom de l'application
$nameApp = "twitty";

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/model/utilisateurTable.class.php';
require_once $nameApp.'/controller/mainController.php';
session_start();

$context = context::getInstance();
$context->init($nameApp);

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

</body>
</html>
