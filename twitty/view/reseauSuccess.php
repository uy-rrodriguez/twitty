<h1>Mon réseau</h1>
<table class="table-horiz table-vert">
		<tr>
			<th></th>
			<th>Prénom</th>
			<th>Nom</th>
		</tr>

<?php
    // On obtient la liste d'utilisateurs du réseau, qui devrait être dans la session.
    // Pour chaque objet, on affiche des données basiques
    $mesAmis = context::getSessionAttribute("mesAmis");

    if (empty($mesAmis))
        echo "Tu n'as aucun ami.";

    else
	    foreach ($mesAmis as $u) {
        if ($u->avatar == "") {
            $u->avatar = "none";
        }
?>
		    <tr class="tr-link" onClick="document.location.href='twitty.php?action=voirProfil&id=<?php echo $u->id; ?>'">
			    <td><img class="img-avatar" src="<?php echo $u->avatar; ?>"
			            onerror="this.src='img/default.png'" /></td>
			    <td><?php echo $u->prenom; ?></td>
			    <td><?php echo $u->nom; ?></td>
		    </tr>
<?php
	    }
?>

</table>
