<h1>Actualité</h1>
<div id="div-liste-tweets">
<?php
    // On obtient la liste des tweets qui devrait être dans la session.
    // Pour chaque tweet, on inclut le template et on ajoute l'info nécessaire dans la session
    $tweets = context::getSessionAttribute("derniersTweets");
    
    if (is_null($tweets) || empty($tweets))
        echo "Il n'y a aucun tweet récent à montrer...";
        
    else {
	    foreach ($tweets as $tweet) {
	        context::setSessionAttribute("userTweetTemplate", $tweet->getEmetteur());
	        context::setSessionAttribute("tweetTemplate", $tweet);
	        
            // Cette variable permet d'afficher les nouveaux tweets différemment
            context::setSessionAttribute("marquerNonLu", true);
            
		    include($nameApp."/layout/tweet_template.php");
	    }
    }
?>
</div>
