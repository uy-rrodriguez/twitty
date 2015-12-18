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

    <div class="tweet-button">
	    <input type="button" value="+1"></input>
	    
	    <form action="twitty.php?action=partagerTweet" method="post">
		    <input type="submit" value="Partager"></input>
		    <input type="hidden" name="tweetId" value="<?php echo $tweetTemplate->id; ?>"></input>
    	<form>
    </div>
</div>
