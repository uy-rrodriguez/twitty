<?php
    // On obtient l'information du tweet qui devrait être dans la session.
    $userTemplate = context::getSessionAttribute("userTweetTemplate");
    $tweetTemplate = context::getSessionAttribute("tweetTemplate");
<<<<<<< HEAD
	$moi = context::getSessionAttribute("utilisateur");
=======
>>>>>>> 2238aabb3b1a3e76b04cfb8dee756b83425839fa
    
    if (is_null($userTemplate)) {
        $userTemplate = new Utilisateur();
    }
    
    if (is_null($tweetTemplate)) {
        $tweetTemplate = new Tweet();
        $parentTemplate = null;
        $postTemplate = new Post();
    }
    else {
        $parentTemplate = $tweetTemplate->getParent();
        $postTemplate = $tweetTemplate->getPost();
    }
    
    // On nettoye la session
    context::setSessionAttribute("userTweetTemplate", null);
    context::setSessionAttribute("tweetTemplate", null);
?>

<div id="div-tweet-<?php echo $tweetTemplate->id; ?>" class="tweet">

<?php
    if (! is_null($parentTemplate)) {
        if ($parentTemplate->id == $moi->id) {
?>
            <div class="tweet-createur-fond"></div>
            <div class="tweet-createur">
                Crée par: toi
            </div>
<?php
        }
        else {
?>
            <div class="tweet-createur-fond"></div>
            <div class="tweet-createur">
                Crée par: <a href="twitty.php?action=voirProfil&id=<?php echo $parentTemplate->id; ?>">
                <?php echo $parentTemplate->prenom . " " . $parentTemplate->nom; ?></a>
            </div>
<?php
        }
    }
?>

	<table class="tweet-info">
		<tr>
			<td rowspan="2">
			    <img class="img-avatar" src="<?php echo mainController::REPERTOIRE_AVATAR . $userTemplate->avatar; ?>"
			        onerror="this.src='img/default.png'" />
			</td>
			<td>
			    <span class="nom"><?php echo $userTemplate->prenom . " " . $userTemplate->nom; ?></span>
			</td>
		</tr>
		<tr>
			<td><span class="date"><?php echo $postTemplate->date; ?></span></td>
		</tr>
	</table>
	
	<div class="votes"><?php echo $tweetTemplate->getLikes(); ?> votes</div>
	
	<div class="tweet-message">
		<pre><?php echo $postTemplate->texte; ?></pre>
	</div>

<?php
    if ($postTemplate->image != "") {
?>
        <div class="tweet-image">
		    <img src="<?php echo mainController::REPERTOIRE_TWEET . $postTemplate->image; ?>" />
	    </div>
<?php
    }
?>

    <div class="tweet-div-buttons">
    
<?php
        if ($tweetTemplate->getDejaVote()) {
?>
            <input type="button" value="T'as déjà voté" disabled />
<?php
        }
        else {
?>
<<<<<<< HEAD
            <a class="button" onclick="ajaxVoterTweet(<?php echo $tweetTemplate->id; ?>)">+1</a>
=======
            <a class="button" href="twitty.php?action=voterTweet&id=<?php echo $tweetTemplate->id; ?>">+1</a>
>>>>>>> 2238aabb3b1a3e76b04cfb8dee756b83425839fa
<?php
        }
?>

<<<<<<< HEAD
        <a class="button" onclick="ajaxPartagerTweet(<?php echo $tweetTemplate->id; ?>)">Partager</a>
=======
        <a class="button" href="twitty.php?action=partagerTweet&id=<?php echo $tweetTemplate->id; ?>">Partager</a>
>>>>>>> 2238aabb3b1a3e76b04cfb8dee756b83425839fa
    </div>
</div>
