<?php
	// On affiche les erreurs et les messages de succès.
	
	/* *** Petit morceau de code pour afficher les erreurs *** */
	if (key_exists("erreur", $_SESSION)
		&& ! is_null($erreurMsg = context::getSessionAttribute("erreur"))) {
		
		echo "<div class='div-erreur'>" . $erreurMsg->getMessage() . "</div>";
		
		context::setSessionAttribute("erreur", null);
	}
	
	/* *** Petit morceau de code pour afficher les messages de succès *** */
	if (key_exists("succes", $_SESSION)
		&& ! is_null($succesMsg = context::getSessionAttribute("succes"))) {
		
		echo "<div class='div-succes'>" . $succesMsg . "</div>";
		
		context::setSessionAttribute("succes", null);
	}
?>
