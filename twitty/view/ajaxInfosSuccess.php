<?php
	// On affiche le nombre de nouveaux tweets.
	
	$info = null;
	if (key_exists("info", $_SESSION)) {
	    $info = context::getSessionAttribute("info");
	    context::setSessionAttribute("info", null);
	}
	
	if (!is_null($info) && $info > 0) {
?>
        <div id='div-bulle-infos'>
            <?php
                echo $info;
                echo ($info == 1) ? ' nouveau <br/> tweet !' : ' nouveaux <br/> tweets !';
            ?>
        </div>
<?php
	}
?>
