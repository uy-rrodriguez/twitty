<h1>Profil de Flash Gordon</h1>

<div id="div-grand-profil">
	<table>
		<tr>
			<td><img src="img/profil.png" /></td>
			<td>
				<span class="nom">Flash Gordon</span> <br />
				<span class="statut">J'aime les aubergines!!!</span>
			</td>
		</tr>		
	</table>
</div>


<h1>Tweets</h1>
	<!-- Liste des tweets de l'utilisateur -->
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
