<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tweety Avignonnais</title>
    <link type="text/css" rel="stylesheet" href="css/style.php" />
  </head>

  <body>
    <div id="div-centre">
   
      <div id="div-tete">
        <div id="div-menu">
          <ul id="menu">
            <li id="item-active"><a href="twitty.php?action=myProfil">Accueil</a></li>
            <li><a href="twitty.php?action=listeUtilisateurs">Mon réseau</a></li>
            <li><a href="twitty.php?action=params">Paramètres</a></li>
            <li><a href="#">Autre...</a></li>
          </ul>
        </div>
     
      </div>
      
      <div id="div-corps">
      
        <?php include($template_view); ?>
        
      </div>
      
      <div id="div-pied">Tweety Avignonnais v0.001</div>
    </div>
  </body>

</html>
