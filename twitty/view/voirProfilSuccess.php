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
	for($boucleTweet = 0 ; $boucleTweet < 5 ; $boucleTweet++) {
		include($nameApp."/layout/tweet_template.php");
	}
?>
