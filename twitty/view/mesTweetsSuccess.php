<div id="div-tweet-creation">
	<h1>Nouveau tweet</h1>
	<form id="form-nouveau-tweet">
		<table>
			<tr>
				<td colspan="2">
					<textarea name="texte" maxlength="140"
					    placeholder="Voici le texte de mon super tweet"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label class="input-file-container">
						Images...
						<input type="text" id="input-file-text-1" class="input-file-text" disabled placeholder="Une belle image..." />
						<input type="file" id="input-file-1" class="input-file" name="imageTweet" accept=".png,.jpg,.bmp" />
					</label>
				</td>
				<td class="td-droite"><input type="button" value="Envoyer" onclick="ajaxNouveauTweet()" /></td>
			</tr>
		</table>
	</form>
<div>

<br />
<h1>Mes tweets</h1>
<div id="div-liste-tweets">
<?php
    // On obtient la liste des tweets qui devrait être dans la session.
    // Pour chaque tweet, on inclut le template et on ajoute l'info nécessaire dans la session
    $tweets = context::getSessionAttribute("mesTweets");
    
    if (empty($tweets))
        echo "Tu n'as pas encore créé aucun tweet. Fais-le maintenant! :D";
        
    else
	    foreach ($tweets as $tweet) {
	        context::setSessionAttribute("userTweetTemplate", $moi); // $moi a été défini dans le layout
	        context::setSessionAttribute("tweetTemplate", $tweet);
            context::setSessionAttribute("marquerNonLu", false);
		    include($nameApp."/layout/tweet_template.php");
	    }
?>
</div>
