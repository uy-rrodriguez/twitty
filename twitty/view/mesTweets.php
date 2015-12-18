<div id="div-tweet-creation">
	<h1>Nouveau tweet</h1>
	<form action="twitty.php?action=creerTweet" method="post">
		<table>
			<tr>
				<td colspan="2">
					<textarea name="texte" maxlength="140" placeholder="Voici le texte de mon super tweet"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label class="input-file-container">
						Images...
						<input type="text" id="text-file-1" class="input-file-text" disabled placeholder="Une image pour mon tweet" />
						<input type="file" id="input-file-1" name="avatar" accept=".png,.jpg,.bmp" />
					</label>
				</td>
				<td class="td-droite"><input type="submit" value="Envoyer" /></td>
			</tr>
		</table>
	</form>
<div>

<br />
<h1>Mes tweets</h1>
<?php
    $tweet = array(
        "createur"=> "Don Omar",
        "image_profil"=> "profil.png",
        "prenom"=> "Prenom",
        "nom"=> "Nom",
        "message"=> "Ceci n'est pas un tweet.\n\tCelle ci est une nouvelle ligne de texte.",
        "image"=> "tweet_exemple.png",
        "date"=> "20/11/2015",
        "heure"=> "15:30",
        "votes"=> "10"
    );
    
	for($boucleTweet = 0 ; $boucleTweet < 5 ; $boucleTweet++) {
		include($nameApp."/layout/tweet_template.php");
	}
?>
