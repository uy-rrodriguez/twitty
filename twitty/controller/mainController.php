<?php

/*
 * Controler 
 */

class mainController
{

	public static function helloWorld($request,$context)
	{	
		if(key_exists("utilisateur",$_SESSION)) {
			$context->mavariable = "hello world";
			return context::SUCCESS;
		}
		else {
			return context::ERROR;
		}
		
	}
	
	public static function superTest($request,$context)
	{
		$context->paramUn = $request['paramUn'];
		$context->paramDeux = $request['paramDeux'];
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{
		
		return context::SUCCESS;
	}
	
	
	public static function login($request,$context)
	{
		if(key_exists("identifiant",$request)) {
			$returnLogin = utilisateurTable::getUserByLoginAndPass($request['identifiant'],$request['password']);
			if($returnLogin == false) { // Identification qui a échouée
				return context::ERROR;	
			}
			else { // Identification réussie
				context::setSessionAttribute("utilisateur",$returnLogin);
				context::redirect('https://pedago02a.univ-avignon.fr/~uapv1602799/twitty.php?action=helloWorld');
			}
		}
		else {
			return context::SUCCESS;	
		}
		
	}


}

?>