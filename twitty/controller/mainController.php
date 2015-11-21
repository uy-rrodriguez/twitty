<?php

/*
 * Controler 
 */

class mainController
{

	public static function listeUtilisateurs($request,$context)
	{
		return context::SUCCESS;
	}
	
	public static function viewProfile($request,$context)
	{
		if(!(key_exists("id",$request))  || !is_numeric($_REQUEST['id']) ) {
			return context::ERROR;		
		}
		else {	
			return context::SUCCESS;
		}
	}
	
	public static function params($request,$context)
	{
		return context::SUCCESS;
	}
	
	public static function myProfil($request,$context)
	{
	    // Code pour ouvrir la session (DEBUG)
	    context::setSessionAttribute("utilisateur", "aubergine");
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{
		return context::SUCCESS;
	}
	
	
	public static function login($request,$context)
	{
	    // Code pour fermer la session (DEBUG)
	    context::setSessionAttribute("utilisateur", NULL);
	    
		if(key_exists("identifiant",$request)) {
			$returnLogin = utilisateurTable::getUserByLoginAndPass($request['identifiant'],$request['password']);
			if($returnLogin == false) { // Identification qui a échouée
				return context::ERROR;	
			}
			else { // Identification réussie
				context::setSessionAttribute("utilisateur",$returnLogin);
				context::redirect('twitty.php?action=listeUtilisateurs');
			}
		}
		else {
			return context::SUCCESS;	
		}
		
	}


}

?>
