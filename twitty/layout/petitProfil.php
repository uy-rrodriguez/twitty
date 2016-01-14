<?php
    $moi = context::getSessionAttribute("utilisateur");
?>

<div id="div-petit-profil-image">
    <img class="img-avatar" src="<?php echo mainController::REPERTOIRE_AVATAR . $moi->avatar . '?t=' . time(); ?>"
        onerror="this.src='img/default.png'" />
</div>

<div id="div-petit-profil-donnees">
    <span class="nom"><?php echo $moi->prenom . " " . $moi->nom; ?></span> <br />
    <span class="statut"><?php echo $moi->statut; ?></span>
</div>
