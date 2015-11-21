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
                <div id="div-petit-profil">
                    <div>
                        <img src="img/profil.png" />
                    </div>
                    <div id="div-petit-profil-donnees">
	                    <span class="nom">Pierre Dupont</span> <br />
	                    <span class="statut">J'aime les aubergines!!!</span>
                    </div>
                </div>
                
                <div id="div-menu">
                    <ul id="menu">
                        <li><a href="twitty.php?action=myProfil">Accueil</a></li>
                        <li><a href="twitty.php?action=listeUtilisateurs">Mon réseau</a></li>
                        <li><a href="twitty.php?action=params">Paramètres</a></li>
                        <li><a href="#">Autre...</a></li>
                        <li class="item-image"><a href="twitty.php?action=login"><img src="img/shutdown.png" /></a></li>
                    </ul>
                </div>
            </div>
        </div>
            
        <div id="div-centre">
            <div id="div-corps">
                <?php include($template_view); ?>
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
    </script>

</html>
