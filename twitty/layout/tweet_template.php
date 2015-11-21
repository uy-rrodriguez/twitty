
<div class="tweet">
    <div class="tweet-createur">Crée par: <a href="twitty.php?action=voirProfil&id=1"><?php echo $tweet['createur']; ?></a></div>
    
	<table class="tweet-info">
		<tr>
			<td rowspan="2"><img src="img/<?php echo $tweet['image_profil']; ?>" /></td>
			<td><span class="nom"><?php echo $tweet['prenom'] . ' ' . $tweet['nom']; ?></span></td>
		</tr>
		<tr>
			<td><span class="date"><?php echo $tweet['date'] . ' à ' . $tweet['heure']; ?></span></td>
		</tr>
	</table>
	
	<div class="votes"><?php echo $tweet['votes']; ?> votes</div>
	
	<div class="tweet-message">
		<pre><?php echo $tweet['message']; ?></pre>
	</div>
	
	<div class="tweet-image">		
		<img src="img/<?php echo $tweet['image']; ?>" />
	</div>
	
	<div class="tweet-button">
		<input type="button" value="+1"></input>
		<input type="button" value="Partager"></input>
	</div>
</div>
