<div id="div-tweet-creation">
	<h1>Nouveau tweet</h1>
	<form>
		<table>
			<tr>
				<td colspan="2">
					<textarea maxlength="140" placeholder="Voici le texte de mon super tweet"></textarea>
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
	for($boucleTweet = 0 ; $boucleTweet < 5 ; $boucleTweet++) {
		include($nameApp."/layout/tweet_template.php");
	}
	/*
	$listeTweets = ["Tweet 1", "Tweet 2", "Tweet 3"];
	foreach ($listeTweets as $tweet)
		echo $tweet . "<br>";
	*/
?>
