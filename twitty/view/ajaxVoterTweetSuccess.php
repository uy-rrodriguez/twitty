<?php
	$tweetTemplate = context::getSessionAttribute("tweetTemplate");
	echo $tweetTemplate->getLikes() . " votes";
?>
