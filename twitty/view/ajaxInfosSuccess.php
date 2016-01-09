<?php
	// On affiche les messages d'information sur des nouveaux tweets créés.
	
	if (key_exists("info", $_SESSION)
		&& ! is_null($info = context::getSessionAttribute("info"))) {
			
		echo $info;
		context::setSessionAttribute("info", null);
	}
?>


ON VA AFFICHER LES TWEETS QU ON N A PAS VU. QUAND ON VA A L'ACUEIL ON RESETE UNE VARIABLE DE SESSION