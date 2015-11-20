<h1>Informations sur NOM Prénom</h1>

<div id="div-petit-profil">
	<table>
		<tr>
			<td><img src="img/profil.png" /></td>
			<td>
				<span>Flash Gordon</span> <br />
				<span id="status">J'aime les aubergines!!!</span>
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
