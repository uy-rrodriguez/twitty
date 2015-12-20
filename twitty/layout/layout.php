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
            // On controle qu'il existe un utilisateur connecté.
            // S'il y en a, l'object sera stocké dans $moi.
            if (key_exists("utilisateur", $_SESSION)
                && ! is_null($moi = context::getSessionAttribute("utilisateur"))) {
?>
                <div id="div-petit-profil">
                    <div id="div-petit-profil-image">
                        <img src="img/profil.png" />
                    </div>
                    <div id="div-petit-profil-donnees">
	                    <span class="nom"><?php echo $moi->prenom . " " . $moi->nom; ?></span> <br />
	                    <span class="statut"><?php echo $moi->id . " : " . $moi->statut; ?></span>
                    </div>
                </div>
                
                <div id="div-menu">
                    <ul id="menu">
                        <li><a href="twitty.php?action=test"><strong>TESTS</strong></a></li>
                        <li><a href="twitty.php?action=accueil">Accueil</a></li>
                        <li><a href="twitty.php?action=mesTweets">Mes tweets</a></li>
                        <li><a href="twitty.php?action=reseau">Mon réseau</a></li>
                        <li><a href="twitty.php?action=params">Paramètres</a></li>
                        <li class="item-image"><a href="twitty.php?action=quitter"><img src="img/shutdown.png" /></a></li>
                    </ul>
                </div>
                
                <div id="div-titre-en-bas">
                    <h1>Twitty</h1>
                    <img src="img/tucan.png" alt="Dessin d'un tucan" />
                </div>
<?php
            }
            else {
?>
                <div id="div-titre-login">
                    <h1>Twitty</h1>
                    <img src="img/tucan.png" alt="Dessin d'un tucan" />
                </div>
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
						
						echo "<div class='div-erreur'>" . $erreurMsg->getMessage() . "</div>";
						
						context::setSessionAttribute("erreur", NULL);
					}
					
					
					/* *** Et après le code de la page actuelle *** */
					include($template_view);
?>
            </div>
            
            <div id="div-pied">Twitty Avignonnais v0.0002 - Thomas Garayt - Ricardo Rodríguez - UAPV 2015</div>
        </div>
    </body>


    <!-- Script pour l'effet de l'entête -->
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

    <!-- Script pour les champs de fichier modifiés -->
    <script type="text/javascript">
        window.onload = function() {
            // Noter que tous les input file doivent avoir un id de la forme: input-file-#
            // et les input text associés: input-file-text-#
            // # étant le numéro qui permet de les associer
            //
            // Noter aussi que tous les input file doivent avoir une classe: input-file
            
            // On cherche tous les input file de la page
            var inputsFile = document.querySelectorAll("input.input-file");
            for (var i = 0 ; i < inputsFile.length ; i++) {
                var file = inputsFile[i];
                var numero = file.id.split("input-file-")[1];
                var text = document.getElementById("input-file-text-" + numero);

                // On associe les input. Quand le file change, le text affiche le contenu
	            file.onchange = new Function("evt",
	                "document.getElementById('" + text.id + "').value = '../' + this.value;");
            }
        }
    </script>

</html>
