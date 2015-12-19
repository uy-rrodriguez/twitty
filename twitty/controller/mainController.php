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
			try {
				$returnLogin = utilisateurTable::getUserByLoginAndPass($request['identifiant'], $request['password']);
			
				if (is_null($returnLogin)) { // Identification qui a échouée
					throw new Exception("L'identifiant et le mot de passe ne sont pas corrects !");
				}
				else { // Identification réussie
					context::setSessionAttribute("utilisateur", $returnLogin);
					context::redirect('twitty.php?action=accueil');
				}
			}
			catch (Exception $e) {
				context::setSessionAttribute("erreur", $e);
				return context::ERROR;	
			}
		}
		else {
			return context::SUCCESS;	
		}
		
	}
	
	
	public static function inscription($request, $context) {
		return context::SUCCESS;
	}
	
	
	public static function finInscription($request, $context) {
		try {
	        // On cherche l'utilisateur par son identifiant
	        if ( is_null(utilisateurTable::getUserByLogin($request["identifiant"])) ) {
	        
	            // Si l'identifiant n'existe pas, on continue
	            $data = array(
			        "identifiant" => $request["identifiant"],
			        "pass" => sha1($request["pass"]),
			        "nom" => $request["nom"],
			        "prenom" => $request["prenom"],
			        "statut" => "",
			        "avatar" => ""
		        );
		
		        $u = new utilisateur($data);
	            $u->id = $u->save();
	
	            if (is_null($u->id))
	                throw new Exception("Il y a eu une erreur pour inscrire l'utilisateur. Désolé.");
	            else
	                context::redirect('twitty.php');
	        }
	        else {
	            throw new Exception("Il existe déjà un utilisateur avec le même identifiant.");
	        }
        }
        catch(Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	public static function accueil($request,$context) {
		return context::SUCCESS;
	}
	
	
	/* Fonction auxiliaire pour créer un tweet ayant déjà créé le post associé */
	private static function creerTweetAux($post, $parent) {
	    // On crée le tweet
        $dataTweet = array(
		    "emetteur" => context::getSessionAttribute("utilisateur")->id,
		    "parent" => $parent,
		    "post" => $post->id,
		    "nbVotes" => 0
	    );
	    $tweet = new tweet($dataTweet);
	
	    var_dump($tweet);
	    
	    if ( is_null($tweet->save()) )
	        return false;
	    else
	        return true;
	}
	
	
	public static function creerTweet($request, $context) {
	    try {
	        // On crée le post
            $dataPost = array(
		        "texte" => $request["texte"],
		        "date" => date("Y/m/d H:i:s"),
		        "image" => ""
	        );
	        $post = new post($dataPost);
	        $post->id = $post->save();
	
	        if ( is_null($post->id) )
	            throw new Exception("Il y a eu une erreur pour créer le tweet.");

	            
	        if (mainController::creerTweetAux($post, 0))
		        context::redirect('twitty.php?action=mesTweets');
	        else
	            throw new Exception("Il y a eu une erreur pour créer le tweet.");
        }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	public static function partagerTweet($request, $context) {
	    try {
	        $tweet = tweetTable::getTweetById($request["id"]);
	        $post = $tweet->getPost();
	        $parent = $tweet->parent;
	        if ($parent == 0)
	            $parent = $tweet->emetteur;
	        
	        if (mainController::creerTweetAux($post, $parent))
		        context::redirect('twitty.php?action=mesTweets');
	        else
	            throw new Exception("Il y a eu une erreur pour partager le tweet.");
        }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	public static function mesTweets($request, $context) {
	    try {
	        $tweets = tweetTable::getTweetsPostedBy(context::getSessionAttribute("utilisateur")->id);
		    context::setSessionAttribute("mesTweets", $tweets);
		    return context::SUCCESS;
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
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
