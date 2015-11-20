<h1>Informations sur NOM Prénom</h1>

<div id="div-grand-profil">
	<table>
		<tr>
			<td><img width="40px" src="img/profil.png" /></td>
			<td><span>NOM Prénom</span></td>
		</tr>
		<tr>
			<td colspan="2">Etudiant en L3 Informatique au CERI !</td>
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