<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Twitty Avignonnais</title>
        <link type="text/css" rel="stylesheet" href="css/style.php" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
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
                    <?php include($nameApp."/layout/petitProfil.php"); ?>
                </div>

                <div id="div-menu">
                    <ul id="menu">
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
                    <div id='div-bulle-infos-container'></div>
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
				<div id='div-messages'>
					<?php include($nameApp."/view/ajaxMessagesSuccess.php"); ?>
				</div>

<?php
				// Le code de la page actuelle
				include($template_view);
?>

            </div>

            <div id="div-pied">Twitty Avignonnais v1 - Thomas Garayt - Ricardo Rodríguez - UAPV 2015</div>
        </div>
    </body>


    <!-- Script chargé à la fin pour éviter des erreurs -->
    <script type="text/javascript" src="js/twitty.js"></script>
</html>
