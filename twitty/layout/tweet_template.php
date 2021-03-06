<?php
    // On obtient l'information du tweet qui devrait être dans la session.
    $userTemplate = context::getSessionAttribute("userTweetTemplate");
    $tweetTemplate = context::getSessionAttribute("tweetTemplate");
    $moi = context::getSessionAttribute("utilisateur");

    // On obtient aussi un boolean qui indique si le tweet doit être affiché différemment
    // en fonction de sa date de création (pour identifier les tweets non lus)
    $marquerNonLu = context::getSessionAttribute("marquerNonLu");

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
    context::setSessionAttribute("marquerNonLu", null);


    // Normalement, dans l'accueil on va identifier les messages qui n'ont pas été lus.
    $classeNonLu = "";
    if ($marquerNonLu) {
        $diffDates = strtotime($postTemplate->date) - strtotime(context::getSessionAttribute("preDateAccesAccueil"));
        $classeNonLu = ($diffDates > 0 ? "tweet-non-lu" : "");
    }

    if ($userTemplate->avatar == "") {
        $userTemplate->avatar = "none";
    }
?>

<div id="div-tweet-<?php echo $tweetTemplate->id; ?>" class="tweet <?php echo $classeNonLu; ?>">

<!-- ---------- Image pour les tweets non lus ---------- -->
    <img class="img-non-lu" src="img/new_g.png" />


<!-- ---------- Affichage du parent d'un tweet, s'il existe ---------- -->
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
                Crée par:
				<a class="link-profil" href="twitty.php?action=voirProfil&id=<?php echo $parentTemplate->id; ?>">
					<?php echo $parentTemplate->prenom . " " . $parentTemplate->nom; ?>
				</a>
            </div>
<?php
        }
    }
?>

<!-- ---------- Affichage du contenu d'un tweet ---------- -->
	<table class="tweet-info">
		<tr>
			<td rowspan="2">
			    <img class="img-avatar" src="<?php echo $userTemplate->avatar; ?>"
			        onerror="this.src='img/default.png'" />
			</td>
			<td>
			    <span class="nom">
<?php
				if ($userTemplate->id != $moi->id) {
?>
					<a class="link-profil" href="twitty.php?action=voirProfil&id=<?php echo $userTemplate->id; ?>">
						<?php echo $userTemplate->prenom . " " . $userTemplate->nom; ?>
					</a>
<?php
				}
				else {
					echo $userTemplate->prenom . " " . $userTemplate->nom;
				}
?>
				</span>
			</td>
		</tr>
		<tr>
			<td><span class="date"><?php echo date("d/m/Y H:i:s", strtotime($postTemplate->date) ); ?></span></td>
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
		    <img src="<?php echo $postTemplate->image; ?>" onerror="this.src='img/erreur_image.png'" />
	    </div>
<?php
    }
?>

<!-- ---------- Boutons de vote et de partage ---------- -->

    <div class="tweet-div-buttons">

<?php
        if ($tweetTemplate->getDejaVote()) {
?>
            <a class="btn-voter button disabled">T'as déjà voté</a>
<?php
        }
        else {
?>
            <a id="btn-voter-<?php echo $tweetTemplate->id; ?>" class="btn-voter button" onclick="ajaxVoterTweet(<?php echo $tweetTemplate->id; ?>)">+1</a>
<?php
        }
?>

        <a class="button" onclick="ajaxPartagerTweet(<?php echo $tweetTemplate->id; ?>)">Partager</a>

    </div>
</div>
