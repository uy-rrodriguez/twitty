<?php
    // On récupère l'utilisateur qui devrait être dans la session.
    $u = context::getSessionAttribute("utilisateurProfil");
?>

<h1>Profil de <?php echo $u->prenom . " " . $u->nom; ?></h1>

<div id="div-grand-profil">
	<table>
		<tr>
			<td><img class="img-avatar" src="<?php echo $u->avatar; ?>"
			        onerror="this.src='img/default.png'" /></td>
			<td>
				<span class="nom"><?php echo $u->prenom . " " . $u->nom; ?></span>
				<br />
				<span class="statut"><?php echo $u->statut; ?></span>
			</td>
		</tr>
	</table>
</div>


<h1>Tweets</h1>
<?php
    // On obtient la liste des tweets qui devrait être dans la session.
    // Pour chaque tweet, on inclut le template et on ajoute l'info nécessaire dans la session
    $tweets = context::getSessionAttribute("tweetsProfil");

    if (empty($tweets))
        echo "Cet utilisateur n'as jamais créé un tweet. Dis-lui de le faire maintenant! :D";

    else {
	    foreach ($tweets as $tweet) {
	        context::setSessionAttribute("userTweetTemplate", $u);
	        context::setSessionAttribute("tweetTemplate", $tweet);
            context::setSessionAttribute("marquerNonLu", false);
		    include($nameApp."/layout/tweet_template.php");
	    }
    }
?>
