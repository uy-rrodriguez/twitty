<?php
    $userTemplate = context::getSessionAttribute("userTweetTemplate");
    $tweetTemplate = context::getSessionAttribute("tweetTemplate");
    $parentTemplate = $tweetTemplate->getParent();
    $postTemplate = $tweetTemplate->getPost();
?>

<div class="tweet">

<?php
    if (! is_null($parentTemplate)) {
?>
        <div class="tweet-createur">
            Crée par: <a href="twitty.php?action=voirProfil&id=1">
            <?php echo $parentTemplate->prenom . " " . $parentTemplate->nom; ?></a>
        </div>
<?php
    }
?>

	<table class="tweet-info">
		<tr>
			<td rowspan="2"><img src="img/<?php echo $userTemplate->avatar; ?>" /></td>
			<td><span class="nom"><?php echo $userTemplate->prenom . " " . $userTemplate->nom; ?></span></td>
		</tr>
		<tr>
			<td><span class="date"><?php echo $postTemplate->date; ?></span></td>
		</tr>
	</table>
	
	<div class="votes"><?php echo $tweetTemplate->nbvotes; ?> votes</div>
	
	<div class="tweet-message">
		<pre><?php echo $postTemplate->texte; ?></pre>
	</div>

<?php
    if (! empty($postTemplate->image)) {
?>
        <div class="tweet-image">		
		    <img src="img/<?php echo $postTemplate->image; ?>" />
	    </div>
<?php
    }
?>

    <div class="tweet-div-buttons">
        <a class="button" href="twitty.php?action=voterTweet&id=<?php echo $tweetTemplate->id; ?>">+1</a>
        <a class="button" href="twitty.php?action=partagerTweet&id=<?php echo $tweetTemplate->id; ?>">Partager</a>
        <input type="button" value="Partager" />
    </div>
</div>
