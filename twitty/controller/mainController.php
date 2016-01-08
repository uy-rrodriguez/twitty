<?php

/*
 * Controler 
 */

class mainController {

	/* ********************************************************************************* */
	/*                                    CONSTANTES                                     */
	/* ********************************************************************************* */
	
	const REPERTOIRE_AVATAR = "upload/avatars/";
	const REPERTOIRE_TWEET = "upload/tweets/";

	/* ********************************************************************************* */
	/*                                    AUXILIAIRES                                    */
	/* ********************************************************************************* */

	/*
	 *  Fonction auxiliaire pour créer un tweet ayant déjà créé le post associé
	 */
	private static function creerTweetAvecPost($post, $parent) {
	    // On crée le tweet
        $dataTweet = array(
		    "emetteur" => context::getSessionAttribute("utilisateur")->id,
		    "parent" => $parent,
		    "post" => $post->id,
		    "nbvotes" => 0
	    );
	    $tweet = new tweet($dataTweet);
	    
	    if ( is_null($tweet->save()) )
	        return false;
	    else
	        return $tweet;
	}


	/*
	 *  Cette fonction permet de mettre en ligne une image contenu dans $_FILES
	 */
	private static function uploadImage($keyImage, $repertoireDestin, $nomDestin) {
		$fichier = $_FILES[$keyImage];
		$type = pathinfo($fichier["name"], PATHINFO_EXTENSION);
		$pathDestin = $repertoireDestin . $nomDestin . "." . $type;

		if (! move_uploaded_file($fichier["tmp_name"], $pathDestin)) {
			return "";
		}
		else {
			return $nomDestin . "." . $type;
		}
	}
	

	/*
	 *  Pour chaque tweet dans la liste, crée un attribut pour indiquer s'il a été voté
     *  par l'utilisateur connecté.
	 */
	private static function marquerTweetsVotes($tweets) {
	    $u = context::getSessionAttribute("utilisateur");
	    
	    foreach ($tweets as $tweet) {
	        $vote = voteTable::getVoteByTweetAndUser($tweet->id, $u->id);
	        $tweet->dejaVote = ! is_null($vote);
	    }
	}
	
	
	
	
	/* ********************************************************************************* */
	/*                                      ACTIONS                                      */
	/* ********************************************************************************* */
	
	public static function index($request,$context) {
		return context::SUCCESS;
	}
	
	
	/* Action pour se connecter au système. On stocke l'utilisateur dans la session. */
	public static function login($request,$context) {
	    // Avant tout, on controle si on a recu un identifiant. Cela signifie que quelqu'un
	    // essaye d'accèder au système. Sinon, on affiche la page avec les champs pour se connecter.
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


    /* Action pour se déconnecter. On supprime l'utilisateur de la session. */
	public static function quitter($request, $context) {
		context::setSessionAttribute("utilisateur", null);
		context::redirect('twitty.php?action=login');
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
	
	
	/* Action pour afficher les derniers tweets créés */
	public static function accueil($request, $context) {
	    try {
	        // On cherche les tweets dans la base, on marque ceux déjà votés
	        // et on les ajoute à la session
	        $tweets = tweetTable::getLastTweets(10, 5);
	        mainController::marquerTweetsVotes($tweets);
		    context::setSessionAttribute("derniersTweets", $tweets);
		    
		    // Cet attribut permet de retourner à la même page après de voter ou partager un tweet
		    context::setSessionAttribute("actionRetour", "accueil");
		    
		    return context::SUCCESS;
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}


	/*
	 *  Action pour créer un nouveau tweet (et post) associé à l'utilisateur connecté
	 */
	public static function ajaxNouveauTweet($request, $context) {
	    try {
			// On crée le post
			$dataPost = array(
				"texte" => htmlspecialchars($request["texte"], $flags = ENT_QUOTES | ENT_HTML401),
				"date" => date("Y/m/d H:i:s"),
				"image" => ""
			);
			$post = new post($dataPost);
			$post->id = $post->save();

			if ( is_null($post->id) )
				throw new Exception("Il y a eu une erreur pour créer le post.");

			
			// On essaye de mettre en ligne l'image et on actualise le post
			if (key_exists("imageTweet", $_FILES) && ($_FILES["imageTweet"]["size"] > 0)) {
				$path = mainController::uploadImage("imageTweet", mainController::REPERTOIRE_TWEET, $post->id);
				$post->image = $path;
				
				if (empty($path) || is_null($post->save())) {
					// Si on n'arrive pas stocker l'image, on ne s'arrête pas.
					context::setSessionAttribute("erreur", new Exception("Il y a eu une erreur pour télécharger l'image."));
				}
			}

			
			// On crée le tweet
			$tweet = mainController::creerTweetAvecPost($post, 0);
			if ($tweet === false)
				throw new Exception("Il y a eu une erreur pour créer le tweet.");
		    
			
			// Il faut stocker le tweet dans la session pour que le template des tweets puisse l'afficher
			context::setSessionAttribute("userTweetTemplate", context::getSessionAttribute("utilisateur"));
	        context::setSessionAttribute("tweetTemplate", $tweet);
		    return context::SUCCESS;
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	/* Action pour partager un tweet. On obtient le post du tweet original sans en créer un autre */
	public static function ajaxPartagerTweet($request, $context) {
	    try {
	        $tweet = tweetTable::getTweetById($request["id"]);
	        $post = $tweet->getPost();
	        $parent = $tweet->parent;
	        if ($parent == 0)
	            $parent = $tweet->emetteur;
			
	        if (mainController::creerTweetAvecPost($post, $parent) === false) {
	            throw new Exception("Il y a eu une erreur pour partager le tweet.");
		    }
	        else {
				//S'il n'y a pas de souci, on affiche le nouveau tweet.
				// Il faut stocker le tweet dans la session pour que le template des tweets puisse l'afficher
				context::setSessionAttribute("userTweetTemplate", context::getSessionAttribute("utilisateur"));
				context::setSessionAttribute("tweetTemplate", $tweet);
	            return context::SUCCESS;
			}   

        }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	/* Action pour voter un tweet. On ajoute la relation tweet-utilisateur. */
	public static function ajaxVoterTweet($request, $context) {
	    try {
	        // On cherche le tweet
	        $tweet = tweetTable::getTweetById($request["id"]);
	        if (is_null($tweet))
	            throw new Exception("Erreur pour voter un tweet. Le tweet n'existe pas.");
	        
	        // On ajoute la relation avant de continuer
            $dataVote = array(
		        "message" => $tweet->id,
		        "utilisateur" => context::getSessionAttribute("utilisateur")->id
	        );
	        $vote = new vote($dataVote);
	        
	        if (is_null($vote->save()))
	            throw new Exception("Il y a eu une erreur pour enregistrer le vote.");
	        
	        
	        // S'il ny a pas de soucis, on actualise le tweet
	        $tweet->nbvotes++;
	        
	        if (is_null($tweet->save()))
	            throw new Exception("Il y a eu une erreur pour actualiser le nombre de votes.");
	        
	        // On affiche la nouvelle quantité de votes
			context::setSessionAttribute("tweetTemplate", $tweet);
			return context::SUCCESS;
        }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            context::redirect('twitty.php?action=mesTweets');
        }
	}


	/*
	 *  Action pour afficher les tweets de l'utilisateur connecté
	 *  S'il y a un tweet à enregistrer dans le $request, on fait ca avant de continuer avec la page
	 */
	public static function mesTweets($request, $context) {
	    try {
	        // On crée un tweet si c'est nécessaire. S'il y a des erreurs, on les gère dans le catch.
	        if (key_exists("enregistrerTweet", $request))
	            mainController::creerPostEtTweet($request, $context);
	        
	        
	        // On cherche les tweets dans la base, on marque ceux déjà votés
	        // et on les ajoute à la session
	        $tweets = tweetTable::getTweetsPostedBy(context::getSessionAttribute("utilisateur")->id, 10);
	        mainController::marquerTweetsVotes($tweets);
		    context::setSessionAttribute("mesTweets", $tweets);
		    
		    // Cet attribut permet de retourner à la même page après de voter ou partager un tweet
		    context::setSessionAttribute("actionRetour", "mesTweets");
		    
		    return context::SUCCESS;
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	/* Action pour afficher le réseau d'utilisateurs associé à celui connecté */
	public static function reseau($request, $context)	{
	    try {
	        // On cherche les utilisateurs dans la base et on les met dans la session
	        $mesAmis = utilisateurTable::getUsersWithLimit(10);
		    context::setSessionAttribute("mesAmis", $mesAmis);
		    return context::SUCCESS;
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}

    
    /* Action pour afficher le données et les tweets d'un utilisateur non connecté */
	public static function voirProfil($request, $context) {
	    try {
		    // Au cas où, on controle la validité de 
		    if(! key_exists("id", $request)  || ! is_numeric($request["id"]) ) {
			    throw new Exception("L'utilisateur que tu cherches n'existe pas.");
		    }
		    else {
    		    // On cherche le profil et les tweets dans la base, on les mets dans la session
    		    $u = utilisateurTable::getUserById($request["id"]);
    		    
		        if (is_null($u))
		            throw new Exception("L'utilisateur que tu cherches n'existe pas.");
		        
	            $tweets = tweetTable::getTweetsPostedBy($request["id"], 10);
	            mainController::marquerTweetsVotes($tweets);
	            
		        context::setSessionAttribute("utilisateurProfil", $u);
		        context::setSessionAttribute("tweetsProfil", $tweets);
		    
		        // Cet attribut permet de retourner à la même page après de voter ou partager un tweet
		        context::setSessionAttribute("actionRetour", "voirProfil&id=" . $u->id);
		    
			    return context::SUCCESS;
		    }
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	/* Action pour afficher et enregistrer différents paramètres */
	/*
	 *  Il y a trois actions possibles:
	 *      - enregistrer le profil public
	 *      - enregistrer les paramètres de sécurité 
	 *      - afficher la page
	 */
	public static function params($request, $context) {
		try {
		    $u = context::getSessionAttribute("utilisateur");
		    
		    // Enregistrer le profil public
		    if (key_exists("enregistrerProfil", $request)) {
		        $u->statut = htmlspecialchars($request["statut"], $flags = ENT_QUOTES | ENT_HTML401);
		        $u->prenom = $request["prenom"];
		        $u->nom = $request["nom"];
		        
                if (key_exists("avatar", $_FILES) && ($_FILES["avatar"]["size"] > 0)) {
                    $path = mainController::uploadImage("avatar", mainController::REPERTOIRE_AVATAR, $u->id);
                    if (empty($path)) {
                        // Si on n'arrive pas à stocker l'image, on ne s'arrête pas.
                        context::setSessionAttribute("erreur", new Exception("Il y a eu une erreur pour télécharger l'avatar."));
                    }
                    else {
                        $u->avatar = $path;
                    }
                }
                
                if (is_null($u->save()))
                    throw new Exception("Il y a eu une erreur pour enregistrer le profil public.");
                else {
                    context::setSessionAttribute("succes", "Le profil à bien été modifié.");
		            return context::SUCCESS;
		        }
		    }
		    
		    
		    // Enregistrer les paramètres de sécurité 
		    else if (key_exists("enregistrerSecurite", $request)) {
		        // On contrôle le mot de passe actuel
		        $returnLogin = utilisateurTable::getUserByLoginAndPass($u->identifiant, $request['passwordActuel']);

		        if (is_null($returnLogin))
		            throw new Exception("Le mot de passe actuel n'est pas correct!");
		        
		        
		        // On contrôle que les nouveaux mot de passe soient égales et pas vides
		        if (empty($request["passwordNouveau"]))
		            throw new Exception("Le nouveau mot de passe est vide.");

                if ($request["passwordNouveau"] != $request["passwordRepete"])
		            throw new Exception("Les nouveaux mots de passe ne sont pas égales.");
		        
		        
		        // Enfin, on stocke le nouveau mot de passe dans la base
		        $u->pass = sha1($request["passwordNouveau"]);
		        
		        if (is_null($u->save()))
		            throw new Exception("Il y a eu une erreur pour enregistrer les paramètres de sécurité");
		        else {
                    context::setSessionAttribute("succes", "Le nouveau mot de passe à bien été modifié.");
		            return context::SUCCESS;
		        }
		    }
		    
		    
		    // Afficher la page
		    else {
		        return context::SUCCESS;
		    }
	    }
        catch (Exception $e) {
            context::setSessionAttribute("erreur", $e);
            return context::ERROR;
        }
	}
	
	
	
	
	/* ********************************************************************************* */
	/*                                        TESTS                                      */
	/* ********************************************************************************* */

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
