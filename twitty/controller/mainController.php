<?php

/*
 * Controler 
 */

class mainController {

	public static function index($request,$context) {
		return context::SUCCESS;
	}
	
	
	public static function login($request,$context) {
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
	
	
	public static function accueil($request,$context) {
	    // Code pour ouvrir la session (DEBUG)
	    context::setSessionAttribute("utilisateur", "aubergine");
		return context::SUCCESS;
	}
	
	
	public static function monProfil($request,$context) {
		return context::SUCCESS;
	}
	
	
	public static function reseau($request,$context)	{
		return context::SUCCESS;
	}


	public static function voirProfil($request,$context) {
		if(!(key_exists("id",$request))  || !is_numeric($_REQUEST['id']) ) {
			return context::ERROR;		
		}
		else {	
			return context::SUCCESS;
		}
	}
	
	
	public static function params($request,$context) {
		return context::SUCCESS;
	}

	
	/* ********************************** TESTS ********************************** */

	public static function test($request, $context) {
		if (key_exists("nomTest", $request)) {
			$nomTest = $request["nomTest"];
			$rep = json_encode(mainController::$nomTest($request, $context));
			
			$context->setSessionAttribute("reponse", $rep);
			
			/*
			switch () {
				case "testUtilisateur":
					
					break;
					
				case "testTweet":
					$rep = testTweet($request, $context);
					break;
					
				case "testPost":
					$rep = testPost($request, $context);
					break;
					
				case "testUtilisateur":
					$rep = testUtilisateur($request, $context);
					break;
					
				case "testUtilisateur":
					$rep = testUtilisateur($request, $context);
					break;
					
				case "testUtilisateur":
					$rep = testUtilisateur($request, $context);
					break;
					
				case "testUtilisateur":
					$rep = testUtilisateur($request, $context);
					break;
			}
			*/
		}
		else {
			if (key_exists("reponse", $_SESSION)) {
				unset($_SESSION["reponse"]);
			}
		}
		
		return context::SUCCESS;
	}
	
	public static function testUtilisateur($request, $context) {
		$data = array(
			"identifiant" => $request["identifiant"],
			"pass" => $request["pass"],
			"nom" => $request["nom"],
			"prenom" => $request["prenom"],
			"statut" => $request["statut"],
			"avatar" => ""
		);
		$utilisateur = new utilisateur($data);
		$utilisateur->id = $utilisateur->save();
		
		return $utilisateur;
	}
	
	public static function testTweet($request, $context) {
		$data = array(
			"emetteur" => $request["emetteur"],
			"parent" => $request["parent"],
			"post" => $request["post"],
			"nbVotes" => $request["nbVotes"]
		);
		$tweet = new tweet($data);
		$tweet->id = $tweet->save();
		
		return $tweet;
	}
	
	public static function testPost($request, $context) {
		$data = array(
			"texte" => $request["texte"],
			"date" => $request["date"],
			"image" => $request["image"]
		);
		$post = new post($data);
		$post->id = $post->save();
		
		return $post;
	}
	
	public static function testTweetGetPost($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		if ($tweet !== false) {
			return $tweet->getPost();
		}
		else {
			return null;
		}
	}
	
	public static function testTweetGetParent($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		$utilisateur = $tweet->getParent();
		
		return $utilisateur;
	}
	
	public static function testTweetGetLikes($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		if ($tweet !== false) {
			return $tweet->getLikes();
		}
		else {
			return null;
		}
	}
	
	public static function testTweetGetUtilisateursVotes($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		if ($tweet !== false) {
			return $tweet->getUsersWhoLikeMe();
		}
		else {
			return null;
		}
	}
}

?>
