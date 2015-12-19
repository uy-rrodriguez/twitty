<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tweety Avignonnais</title>
        <link type="text/css" rel="stylesheet" href="css/style.php" />
    </head>

    <body>
        <div id="div-tete">
            <div id="div-tete-contenu">
            
<?php
            if (key_exists("utilisateur", $_SESSION)) {
                $moi = context::getSessionAttribute("utilisateur");
?>
                <div id="div-petit-profil">
                    <div id="div-petit-profil-image">
                        <img src="img/profil.png" />
                    </div>
                    <div id="div-petit-profil-donnees">
	                    <span class="nom"><?php echo $moi->prenom . " " . $moi->nom; ?></span> <br />
	                    <span class="statut"><?php echo $moi->statut; ?></span>
                    </div>
                </div>
                
                <div id="div-menu">
                    <ul id="menu">
                        <li><a href="twitty.php?action=test"><strong>TESTS</strong></a></li>
                        <li><a href="twitty.php?action=accueil">Accueil</a></li>
                        <li><a href="twitty.php?action=mesTweets">Mes tweets</a></li>
                        <li><a href="twitty.php?action=reseau">Mon réseau</a></li>
                        <li><a href="twitty.php?action=params">Paramètres</a></li>
                        <li class="item-image"><a href="twitty.php?action=login"><img src="img/shutdown.png" /></a></li>
                    </ul>
                </div>
<?php
            }
            else {
?>
                <div id="div-titre-login"><h1>Identification</h1></div>
<?php
            }
?>
            </div>
        </div>
            
        <div id="div-centre">
            <div id="div-corps">
<?php
            		/* *** Petit morceau de code pour afficher les erreurs *** */
					if (key_exists("erreur", $_SESSION)
						&& ! is_null($erreurMsg = context::getSessionAttribute("erreur"))) {
						
						echo "<div class='div-erreur'>" . $erreurMsg . "</div>";
						
						context::setSessionAttribute("erreur", NULL);
					}
					
					
					/* *** Et après le code de la page actuelle *** */
					include($template_view);
?>
            </div>
            
            <div id="div-pied">Tweety Avignonnais v0.001</div>
        </div>
    </body>


    <script type="text/javascript">
        window.onscroll = function() {
            var tete = document.getElementById("div-tete");
            var centre = document.getElementById("div-centre");
            if (window.pageYOffset > 50) {
                tete.className = "on-scroll";
                centre.className = "on-scroll";
            }
            else {
                tete.className = "";
                centre.className = "";
            }
        }
        window.onscroll();
    </script>

</html>
