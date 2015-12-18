<?php

/*
 * Controler 
 */

class mainController {

	public static function index($request,$context) {
		return context::SUCCESS;
	}
	
	
	public static function login($request,$context) {
	
		if (key_exists("identifiant",$request)) {
			$returnLogin = utilisateurTable::getUserByLoginAndPass($request['identifiant'], $request['password']);
			
			if (is_null($returnLogin)) { // Identification qui a échouée
				return context::ERROR;	
			}
			else { // Identification réussie
				context::setSessionAttribute("utilisateur", $returnLogin);
				context::redirect('twitty.php?action=accueil');
			}
		}
		else {
			return context::SUCCESS;	
		}
		
	}
	
	
	public static function accueil($request,$context) {
		return context::SUCCESS;
	}
	
	
	public static function creerTweet($request, $context) {
	    // On crée le post
	    $dataPost = array(
			"texte" => $request["texte"],
			"date" => date("Y/m/d H:i:s"),
			"image" => ""
		);
		$post = new post($dataPost);
		$post->id = $post->save();
		
		if (is_null($post->id))
		    return context::ERROR;
		
		    
		// On crée le tweet    
	    $dataTweet = array(
			"emetteur" => context::getSessionAttribute("utilisateur")->id,
			"parent" => null,
			"post" => $post->id,
			"nbVotes" => 0
		);
		
		$tweet = new tweet($dataTweet);
		$tweet->id = $tweet->save();
		
		if (is_null($tweet->id))
		    return context::ERROR;
		    
		else {
		    // Rédirection a mesTweets
		    context::redirect('twitty.php?action=mesTweets');
		}
	}
	
	public static function mesTweets($request,$context) {
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
			
			try {
			    $rep = mainController::$nomTest($request, $context);
			}
			catch(PDOException $e) {
			    $rep = implode("|", $e->errorInfo);
			}
			
			$context->setSessionAttribute("reponse", $rep);
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
			"pass" => sha1($request["pass"]),
			"nom" => $request["nom"],
			"prenom" => $request["prenom"],
			"statut" => $request["statut"],
			"avatar" => ""
		);
		
		$u = new utilisateur($data);
		$u->id = $u->save();
		
		if (is_null($u->id))
		    return NULL;
		else
		    return $u;
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
		
		if (is_null($tweet->id))
		    return NULL;
		else
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
		
		if (is_null($post->id))
		    return NULL;
		else
		    return $post;
	}
	
	public static function testTweetGetPost($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		
		if (! is_null($tweet)) {
			return $tweet->getPost();
		}
		else {
			return null;
		}
	}
	
	public static function testTweetGetParent($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		
		if (! is_null($tweet)) {
			return $tweet->getParent();
		}
		else {
			return null;
		}
	}
	
	public static function testTweetGetLikes($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		
		if (! is_null($tweet)) {
			return $tweet->getLikes();
		}
		else {
			return null;
		}
	}
	
	public static function testTweetGetUtilisateursVotes($request, $context) {
		$tweet = tweetTable::getTweetById($request["tweet"]);
		
		if (! is_null($tweet)) {
			return $tweet->getUsersWhoLikeMe();
		}
		else {
			return null;
		}
	}
	
}

?>
